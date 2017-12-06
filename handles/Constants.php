<?php

class Constants{
    //DB Variables
    const DB_HOSTNAME                   = '127.0.0.1';
    const DB_DATABASE                   = 'restro';
    const DB_USERNAME                   = 'root';
    const DB_PASSWORD                   = '';

    //DB Type
    const DB_FETCH_ASSOC                = 'FETCH_ASSOC';
    const DB_FETCH_NUM                  = 'FETCH_NUM';
    const DB_ROW_COUNT_KEY              = 'crow';

    //Header 
    const HEADER_INCOME_METHOD_ALLOWED  = 'application/json';

    //HTTP
    const HTTP_SUCCESS_CODE_OK          = 200;
    const HTTP_SUCCESS_CODE_ACCEPTED    = 202;
    const HTTP_ERROR_BADREQUEST         = 400;
    const HTTP_ERROR_UNAUTHORISED       = 401;
    const HTTP_ERROR_FORBIDDEN          = 403;
    const HTTP_ERROR_METHODNOTALLOWED   = 405;

    //Auth 
    const AUTH_TOKEN_ENCRYPT_METHOD     = 'RS256';
    const AUTH_TOKEN_HEADER_ISS         = 'gsdroid.com';
    const AUTH_TOKEN_HEADER_AUD         = 'gsdroid.com';
    const AUTH_TOKEN_ACCESS_USER        = 'U';
    const AUTH_TOKEN_ACCESS_CLIENT      = 'C';
    const AUTH_TOKEN_ACCESS_ADMIN       = 'A';
    const AUTH_LENGTH_SHA256            = 64;

    //Errors
    const ERROR_INVALID_USR_PASSWD      = 'Incorrect username or password';
    const ERROR_INVALID_USR_FORMAT      = 'Please enter valid email address and password';
    const ERROR_INVALID_REQ_FORMAT      = 'Invalid request format';
    const ERROR_TECHNICAL_ISSUE         = 'Technical Error, Try again later.';
    const ERROR_DEF_INVALID_REQUEST     = 'Invalid Request';
    const ERROR_DB_PDO_ERROR            = 'Technical Error, Please try again later';
    const ERROR_INVALID_INPUT_FORMAT    = 'Invalid Input Format';
    const ERROR_CREATE_EMAIL_EXISTS     = 'You have already registered';
    const ERROR_INVALID_USERNAME        = 'Please enter valid username';
    const ERROR_INVALID_MOBILE          = 'Please enter valid mobile number';
    const ERROR_INVALID_PASSWORD        = 'Please enter valid password';
    const ERROR_INVALID_FIRSTNAME       = 'Please enter valid firstname';

    //Success
    const SUCCESS_LOGGED_IN             = 'Successfully Logged In';

    //JSON Reply Head
    const JSON_MAIN_RESPONSE_TEXT       = 'response';
    const JSON_HEADING_SUCCESS          = 'success';
    const JSON_HEADING_DATA             = 'data';
    const JSON_HEADING_ERROR            = 'error';
    const JSON_LOGIN_TOKEN_TAG          = 'token';
    const JSON_WELCOME_NAME             = 'welcome_name';

    //API allowed input
    const API_AUTH_ALLOWED_INPUT        = 2;
    const API_CREATE_USER_ALLOWED_INPUT = 4;

    //others
    const OTHER_MOBILE_ALLOWED_CHAR     = 10;

    //DB Query
    const QUERY_AUTH_CHECK_USER_EXIST   = 'SELECT name, email, password, type FROM users_login WHERE email=:email';
    const QUERY_AUTH_USER_TOKEN_UPDATE  = 'UPDATE users_login SET token=:token, updated_at=NOW() WHERE email=:user';
    const QUERY_CREATE_USER             = "INSERT INTO users_login (joined, type, email, password, mobile) VALUES (NOW(), 'U', :email, :password, :mobile)";
    const QUERY_IF_EMAIL_AND_MOB_EXISTS = 'SELECT email FROM users_login WHERE email = :email OR mobile = :mobile';
    const QUERY_INSERT_USER_LOGINS      = "INSERT INTO users_login (profile_status, joined, type, name, email, password, last_changed, token, mobile) VALUES ('N', NOW(), 'U', :name, :email, :password, NOW(), :token, :mobile)";


}

?>