<?php
use \Firebase\JWT\JWT;
require __DIR__ . '../vendor/autoload.php';
include 'handles/Includes.php';
Includes::autoload(Constants::IMPORT_FOR_Auth);

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