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
    const DB_EMPTY_VALUE                = 'EMPTY';

    //Header 
    const HEADER_INCOME_METHOD_ALLOWED  = "application/json";

    //HTTP
    const HTTP_SUCCESS_CODE_OK          = 200;
    const HTTP_SUCCESS_CODE_ACCEPTED    = 202;
    const HTTP_ERROR_BADREQUEST         = 400;
    const HTTP_ERROR_UNAUTHORISED       = 401;
    const HTTP_ERROR_FORBIDDEN          = 403;
    const HTTP_ERROR_METHODNOTALLOWED   = 405;

    //Auth 
    const AUTH_TOKEN_ENCRYPT_METHOD     = "RS256";
    const AUTH_TOKEN_HEADER_ISS         = "gsdroid.com";
    const AUTH_TOKEN_HEADER_AUD         = "gsdroid.com";
    const AUTH_TOKEN_ACCESS_USER        = "user";
    const AUTH_TOKEN_ACCESS_CLIENT      = "client";
    const AUTH_TOKEN_ACCESS_ADMIN       = "admin";
    const AUTH_LENGTH_SHA256            = 64;

    //Errors
    const ERROR_INVALID_USR_PASSWD      = "Incorrect username or password";
    const ERROR_INVALID_USR_FORMAT      = "Please enter valid email address and password";
    const ERROR_INVALID_REQ_FORMAT      = "Invalid request format";
    const ERROR_TECHNICAL_ISSUE         = "Technical Error, Try again later.";
    const ERROR_DEF_INVALID_REQUEST     = "Invalid Request";

    //Success
    const SUCCESS_LOGGED_IN             = "Successfully Logged In";

    //JSON Reply Head
    const JSON_MAIN_RESPONSE_TEXT       = "response";
    const JSON_HEADING_SUCCESS          = "success";
    const JSON_HEADING_DATA             = "data";
    const JSON_HEADING_ERROR            = "error";
    const JSON_LOGIN_TOKEN_TAG          = "token";
    const JSON_WELCOME_NAME             = "welcome_name";


    //API allowed input
    const API_ALLOWED_INPUT             = 2;
}

?>