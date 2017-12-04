<?php
include 'handles/Validator.php';

if(Validator::jsonContentType($header)){
    $postBody = file_get_contents("php://input");
    //echo $postBody;
    $postBody = json_decode($postBody);
    $rec_username = $postBody->username;
    $rec_password = $postBody->password;

    if(isset($rec_username) && isset($rec_password)){
        if(!filter_var($rec_username, FILTER_VALIDATE_EMAIL)){
            $output->error(Constants::ERROR_INVALID_USR_PASSWD, Constants::HTTP_ERROR_BADREQUEST);
        }else{
            //Validate email and password
            if(empty($rec_username) || !filter_var($rec_username, FILTER_VALIDATE_EMAIL)){
                $output->error(Constants::ERROR_INVALID_USR_FORMAT, Constants::HTTP_ERROR_BADREQUEST);
            }else{
                include 'db/DB.php';
                $db = new DB();
                $val = $db->selectQuery("SELECT email, password, type FROM users WHERE email=:email",array(":email"=>$rec_username), Constants::DB_FETCH_ASSOC);
                if($val == Constants::DB_EMPTY_VALUE){
                    $output->error(Constants::ERROR_INVALID_USR_PASSWD, Constants::HTTP_ERROR_UNAUTHORISED);
                }else{
                    if(strlen($rec_password) == Constants::AUTH_LENGTH_SHA256){
                        $md5 = hash("md5",$rec_password);
                        if(password_verify($md5, $val["password"])){
                            require_once 'handles/Auth.php';
                            $auth = new Auth(); 
                            include 'handles/AuthKeys.php';
                            if($val["type"] == "U"){ 
                                $ty = Constants::AUTH_TOKEN_ACCESS_USER; 
                                $tk = $auth->generateToken($prk, $val["email"],$ty);
                            }else if($val["type"] == "C"){
                                $ty = Constants::AUTH_TOKEN_ACCESS_CLIENT;
                                $tk = $auth->generateToken($prk, $val["email"],$ty);
                            }else if($val["type"] == "A"){
                                $ty = Constants::AUTH_TOKEN_ACCESS_ADMIN;
                                $tk = $auth->generateToken($prk, $val["email"],$ty);                               
                            }else{
                                $output->error(Constants::ERROR_INVALID_USR_PASSWD, Constants::HTTP_ERROR_BADREQUEST); 
                            }

                            if($db->insertQuery("INSERT INTO users (remember_token) VALUES (:token) WHERE username=:user", array(":token" => $tk, ":user" => $rec_username))){
                                $output->success(array("loginToken" => $tk), Constants::HTTP_SUCCESS_CODE_OK);
                            }else{
                                $output->error(Constants::ERROR_TECHNICAL_ISSUE, Constants::HTTP_ERROR_BADREQUEST);
                            }

                        }else{
                            $output->error(Constants::ERROR_INVALID_USR_PASSWD, Constants::HTTP_ERROR_UNAUTHORISED);
                        }
                    }else{
                        $output->error(Constants::ERROR_INVALID_USR_PASSWD, Constants::HTTP_ERROR_BADREQUEST);
                    }
                }
            }   
            
        }
    }else{
        $output->error(Constants::ERROR_INVALID_USR_PASSWD, Constants::HTTP_ERROR_BADREQUEST);
    }

}else{
    $output->error(Constants::ERROR_INVALID_REQ_FORMAT, Constants::HTTP_ERROR_BADREQUEST);
}


?>