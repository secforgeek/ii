<?php

class Constants{
    //File Names
    const IMPORT_FOR_index              = "index";
    const IMPORT_FOR_jsonoutput         = "jsonoutput";
    const IMPORT_FOR_Auth               = "Auth";


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
}

?>