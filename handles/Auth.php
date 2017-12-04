<?php
use \Firebase\JWT\JWT;

require __DIR__ . '../../vendor/autoload.php';
require 'AuthKeys.php';

class Auth{

    public function generateToken($privateKey, $username, $acctype){
        $token = array(
            "iss" => Constants::AUTH_TOKEN_HEADER_ISS,
            "aud" => Constants::AUTH_TOKEN_HEADER_AUD,
            "usr" => $username,
            "type" => $acctype
        );
        return JWT::encode($token, $privateKey, Constants::AUTH_TOKEN_ENCRYPT_METHOD);
    }

    public function decodeToken($jwt, $publicKey){
        JWT::decode($jwt, $publicKey, Constants::AUTH_TOKEN_ENCRYPT_METHOD);
    }
}





?>