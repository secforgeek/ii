<?php

$postBody = file_get_contents("php://input");
$postBody = json_decode($postBody);
$username = $postBody->username;
$password = $postBody->password;

if(!filter_var($username, FILTER_VALIDATE_EMAIL)){
    $output->error(Constants::ERROR_INVALID_USR_PASSWD, Constants::HTTP_ERROR_BADREQUEST);
}else{
    //Validate email and password
    require_once 'handles/Auth.php';
    $auth = new Auth();
    return $auth->generateToken("r.gajendran3@gmail.com",Constants::AUTH_TOKEN_ACCESS_USER);
}

?>