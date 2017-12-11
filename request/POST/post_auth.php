<?php

    $postBodyRaw = file_get_contents('php://input');
    $postBody = json_decode($postBodyRaw);
    if(count((array)$postBody) == Constants::API_AUTH_ALLOWED_INPUT){
        if(isset($postBody->username) && isset($postBody->password)){
            $rec_username = $postBody->username;
            $rec_password = $postBody->password;    
            if(!filter_var($rec_username, FILTER_VALIDATE_EMAIL)){
                $output->error(Constants::ERROR_INVALID_USR_PASSWD, Constants::HTTP_ERROR_BADREQUEST);
            }else{
                if(empty($rec_username) || !filter_var($rec_username, FILTER_VALIDATE_EMAIL)){
                    $output->error(Constants::ERROR_INVALID_USR_FORMAT, Constants::HTTP_ERROR_BADREQUEST);
                }else{
                    include 'db/DB.php';
                    $db = new DB();
                    $val = $db->selectQuery(Constants::QUERY_AUTH_CHECK_USER_EXIST,array(':email'=>$rec_username), Constants::DB_FETCH_ASSOC);
                    if($val[Constants::DB_ROW_COUNT_KEY] === 0 || $val[Constants::DB_ROW_COUNT_KEY] === -1){
                        $output->error(Constants::ERROR_INVALID_USR_PASSWD, Constants::HTTP_ERROR_UNAUTHORISED);
                    }else{
                        if(strlen($rec_password) === Constants::AUTH_LENGTH_SHA256){
                            $md5 = hash('md5',$rec_password);
                            if(password_verify($md5, $val['password'])){
                                require_once 'handles/Auth.php';
                                $auth = new Auth(); 
                                include 'handles/AuthKeys.php';
                                switch($val['type']){
                                    case Constants::AUTH_TOKEN_ACCESS_USER:
                                        $ty = Constants::AUTH_TOKEN_ACCESS_USER; 
                                        $data = $auth->generateData($val['name'], $ty,  $val['email']);
                                        $tk = $auth->generateToken($prk, $data, Constants::JWT_EXPIRE_IN_14_DAYS);
                                    break;

                                    case Constants::AUTH_TOKEN_ACCESS_CLIENT:
                                        $ty = Constants::AUTH_TOKEN_ACCESS_CLIENT;
                                        $data = $auth->generateData($val['name'], $ty,  $rec_username);
                                        $tk = $auth->generateToken($prk, $data, Constants::JWT_EXPIRE_IN_14_DAYS);
                                    break;

                                    case Constants::AUTH_TOKEN_ACCESS_ADMIN:
                                        $ty = Constants::AUTH_TOKEN_ACCESS_ADMIN;
                                        $data = $auth->generateData($val['name'], $ty,  $rec_username);
                                        $tk = $auth->generateToken($prk, $data, Constants::JWT_EXPIRE_IN_14_DAYS);
                                    break;

                                    default:
                                        $output->error(Constants::ERROR_INVALID_USR_PASSWD, Constants::HTTP_ERROR_BADREQUEST); 
                                        exit();
                                    break;
                                }
                                if($db->InsertUpdateQuery(Constants::QUERY_AUTH_USER_TOKEN_UPDATE,
                                array(':token' => $tk, ':user' => $rec_username), 1)){
                                    $output->success(Constants::SUCCESS_LOGGED_IN, 
                                    array(
                                        Constants::JSON_PROFILE_STATUS => $val['profile_status'],
                                        Constants::JSON_LOGIN_TOKEN_TAG => $tk,
                                        Constants::JSON_PUBLIC_KEY => $puk
                                    ), Constants::HTTP_SUCCESS_CODE_OK);
                                    exit();
                                }else{
                                    $output->error(Constants::ERROR_TECHNICAL_ISSUE."Test 5", Constants::HTTP_ERROR_BADREQUEST);
                                    exit();
                                }
    
                            }else{
                                $output->error(Constants::ERROR_INVALID_USR_PASSWD."Test 4", Constants::HTTP_ERROR_UNAUTHORISED);
                                exit();
                            }
                        }else{
                            $output->error(Constants::ERROR_INVALID_USR_PASSWD."Test 3", Constants::HTTP_ERROR_BADREQUEST);
                            exit();
                        }
                    }
                }   
                
            }
        }else{
            $output->error(Constants::ERROR_INVALID_USR_PASSWD."Test 2", Constants::HTTP_ERROR_BADREQUEST);
            exit();
        }
    }else{
        $output->error(Constants::ERROR_DEF_INVALID_REQUEST."Test 1", Constants::HTTP_ERROR_FORBIDDEN);
        exit();
    }



?>