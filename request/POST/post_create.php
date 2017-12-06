<?php

    $postBodyRaw = file_get_contents('php://input');
    $postBody = json_decode($postBodyRaw);
    if(count((array)$postBody) == Constants::API_CREATE_USER_ALLOWED_INPUT){
        if(isset($postBody->username) && isset($postBody->password) && isset($postBody->mobile)){
            if(filter_var($postBody->username, FILTER_VALIDATE_EMAIL)){
                if(is_numeric($postBody->mobile) && strlen($postBody->mobile) == Constants::OTHER_MOBILE_ALLOWED_CHAR){
                    if(strlen($postBody->password) == Constants::AUTH_LENGTH_SHA256){
                        if(!preg_match('/[^A-Za-z]/', $postBody->firstname) && strlen($postBody->firstname) >= 5 && strlen($postBody->firstname) <= 20){
                            include 'db/DB.php';
                            $db = new DB();
                            $reply = $db->selectQuery(Constants::QUERY_IF_EMAIL_AND_MOB_EXISTS, array(":email" => $postBody->username, ":mobile" => $postBody->mobile), Constants::DB_FETCH_ASSOC);
                            if($reply[Constants::DB_ROW_COUNT_KEY] === 0){
                                $md5 = hash("md5", $postBody->password);
                                $hashed = password_hash($md5, PASSWORD_DEFAULT);
                                include 'handles/AuthKeys.php';
                                include 'handles/Auth.php';
                                $auth = new Auth();
                                $token = $auth->generateToken($prk, $auth->generateData($postBody->firstname, Constants::AUTH_TOKEN_ACCESS_USER, $postBody->username), Constants::JWT_EXPIRE_IN_14_DAYS);
                                $items = array(
                                    ":name" => ucfirst($postBody->firstname),
                                    ":email" => $postBody->username,
                                    ":password" => $hashed,
                                    ":mobile" => $postBody->mobile,
                                    ":token" => $token
                                );
                            
                                if($db->InsertUpdateQuery(Constants::QUERY_INSERT_USER_LOGINS, $items, 1)){
                                    $output->success(Constants::SUCCESS_LOGGED_IN, 
                                    array(
                                        Constants::JSON_PROFILE_STATUS => 'N',
                                        Constants::JSON_LOGIN_TOKEN_TAG => $token,
                                        Constants::JSON_PUBLIC_KEY => $puk
                                    ), Constants::HTTP_SUCCESS_CODE_OK);
                                    exit();
                                }else{
                                    $output->error(Constants::ERROR_DB_PDO_ERROR, Constants::HTTP_ERROR_BADREQUEST);
                                    exit();                     
                                }
                            }else{
                                $output->error(Constants::ERROR_CREATE_EMAIL_EXISTS, Constants::HTTP_ERROR_BADREQUEST);
                                exit();
                            }                           
                        }else{
                            $output->error(Constants::ERROR_INVALID_FIRSTNAME, Constants::HTTP_ERROR_BADREQUEST);
                            exit();                            
                        }
                    }else{
                        $output->error(Constants::ERROR_INVALID_PASSWORD, Constants::HTTP_ERROR_BADREQUEST);
                        exit();                         
                    }
                }else{
                    $output->error(Constants::ERROR_INVALID_MOBILE, Constants::HTTP_ERROR_BADREQUEST);
                    exit();                    
                }
            }else{
                $output->error(Constants::ERROR_INVALID_USERNAME, Constants::HTTP_ERROR_BADREQUEST);
                exit();               
            }
        }else{
            $output->error(Constants::ERROR_INVALID_INPUT_FORMAT, Constants::HTTP_ERROR_BADREQUEST);
            exit();
        }
    }else{
        $output->error(Constants::ERROR_INVALID_INPUT_FORMAT, Constants::HTTP_ERROR_FORBIDDEN);
        exit();
    } 
?>