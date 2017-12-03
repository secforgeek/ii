<?php
use \Firebase\JWT\JWT;
include "AuthKeys.php";
require __DIR__ . '../vendor/autoload.php';


class Auth{
    

    public function generateToken($username, $acctype){
        $token = array(
            "iss" => Constants::AUTH_TOKEN_HEADER_ISS,
            "aud" => Constants::AUTH_TOKEN_HEADER_AUD,
            "usr" => $username,
            "type" => $acctype
        );

        return JWT::encode($token, $puk, Constants::AUTH_TOKEN_ENCRYPT_METHOD);
    }

}







?>