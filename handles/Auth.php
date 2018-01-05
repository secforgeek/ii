<?php
use \Firebase\JWT\JWT;

require __DIR__ . '../../vendor/autoload.php';
require 'AuthKeys.php';

class Auth{

    public function generateToken($privateKey, $data, $expire){
        date_default_timezone_set('UTC');
        $token = array(
            "iat" => time(),
            "exp" => time() + strtotime($expire, time()), //(7 * 24 * 60 * 60),
            "iss" => Constants::AUTH_TOKEN_HEADER_ISS,
            "data" => $data
        );
        return JWT::encode($token, $privateKey, Constants::AUTH_TOKEN_ENCRYPT_METHOD);
    }

    public function decodeToken($jwt, $publicKey){
        $decoded = JWT::decode($jwt, $publicKey, array('RS256'));
        try{
            return array_merge(array(Constants::AUTH_TOKEN_STATUS_HEAD => Constants::AUTH_TOKEN_STATUS_SUCCESS), $decoded_array = (array) $decoded);
        }catch(Exception $e){
            switch($e->getMessage()){
                case Constants::JWT_IAT_FAILED:
                    return array(Constants::AUTH_TOKEN_STATUS_HEAD => Constants::JWT_IAT_FAILED);
                break;

                case Constants::JWT_NBF_FAILED:
                    return array(Constants::AUTH_TOKEN_STATUS_HEAD => Constants::JWT_NBF_FAILED);
                break;

                case Constants::JWT_SIGNATURE_FAILED:
                    return array(Constants::AUTH_TOKEN_STATUS_HEAD => Constants::JWT_SIGNATURE_FAILED);
                break;

                case Constants::JWT_TOKEN_EXPIRED:
                    return array(Constants::AUTH_TOKEN_STATUS_HEAD => Constants::JWT_TOKEN_EXPIRED);
                break;

                default:
                    return array(Constants::AUTH_TOKEN_STATUS_HEAD => Constants::AUTH_TOKEN_GENERAL_ERROR);
                break;

            }
        }    
    }

    public function generateData($wname, $type, $email){
        return $data = array(
            Constants::JWT_DATA_USR => $wname,
            Constants::JWT_DATA_TYPE => $type,
            Constants::JWT_DATA_EMAIL => $email
        );
    }

}





?>