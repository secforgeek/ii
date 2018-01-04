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
    const DB_FETCH_ASSOC_ALL            = 'FETCH_ASSOC_ALL';
    const DB_FETCH_NUM_ALL              = 'FETCH_NUM_ALL';
    const DB_ROW_COUNT_KEY              = 'crow';
    const DB_EMPTY_VALUE                = 'NULL_ERROR';
    const DB_KEY_VALUE_ALL              = 'KEYVALUE_ALL';
    const DB_PAYMENT_CARD               = 'CCC';
    const DB_PAYMENT_CASH               = 'COD';

    //Header 
    const HEADER_INCOME_METHOD_ALLOWED  = 'application/json';
    const HEADER_CONTENT_TYPE_KEY       = 'content-type';
    
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
    const AUTH_TOKEN_STATUS_HEAD        = 'status';
    const AUTH_TOKEN_STATUS_SUCCESS     = 'success';
    const AUTH_TOKEN_GENERAL_ERROR      = 'gerror';

    //JWT
    const JWT_SIGNATURE_FAILED          = 'SVF';
    const JWT_IAT_FAILED                = 'IATFAIL';
    const JWT_NBF_FAILED                = 'NBFFAIL';
    const JWT_TOKEN_EXPIRED             = 'TKEXPIRED';
    const JWT_EXPIRE_IN_7_DAYS          = '+7 day';
    const JWT_EXPIRE_IN_14_DAYS         = '+14 day';
    const JWT_EXPIRE_IN_30_DAYS         = '+30 day';
    const JWT_EXPIRE_IN_60_DAYS         = '+60 day';
    const JWT_DATA_USR                  = 'usr';
    const JWT_DATA_TYPE                 = 'type';
    const JWT_DATA_EMAIL                = 'email';
    const JWT_DATA_DATA                 = 'data';

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
    const ERROR_INVALID_EMAIL           = 'Please enter valid email';
    const ERROR_INVALID_NAME            = 'Please enter valid name';
    const ERROR_INVALID_ADDRESS         = 'Please enter valid address';
    const ERROR_AUTH_FAILED             = 'Authentication Failed';
    const ERROR_INVALID_CITY            = 'Please enter valid city';
    const ERROR_INVALID_COUNTRY         = 'You are not allowed to access from this country';
    const ERROR_INVALID_POSTCODE        = 'Please enter a valid postcode';

    //Success
    const SUCCESS_LOGGED_IN             = 'Successfully Logged In';
    const SUCCESS_FETCH_MENU            = 'Listed Menu Items';

    //JSON Reply Head
    const JSON_MAIN_RESPONSE_TEXT       = 'response';
    const JSON_HEADING_SUCCESS          = 'success';
    const JSON_HEADING_DATA             = 'data';
    const JSON_HEADING_ERROR            = 'error';
    const JSON_LOGIN_TOKEN_TAG          = 'token';
    const JSON_PROFILE_STATUS           = 'profile_status';
    const JSON_PUBLIC_KEY               = 'public_key';
    const JSON_MAIN_RESPONSE_ACTION     = 'action';
    const JSON_ERROR_CODE_HEAD          = 'code';

    //JSON Action
    const JSON_ACTION_LOGOUT            = 'logout';
    const JSON_ACTION_JOB_DONE          = 'success';

    //API allowed input
    const API_AUTH_ALLOWED_INPUT        = 3;
    const API_CREATE_USER_ALLOWED_INPUT = 4;
    const API_UPDATE_PROFILE_INPUT      = 10;
    const API_FINDSHOP_ALLOWED_INPUT    = 4;
    const API_GETMENU_ALLOWED_INPUT     = 2;
	const API_VERIFYCART_INPUT 			= 2;

    //Rules
    const OTHER_MOBILE_ALLOWED_CHAR     = 10;
    const OTHER_PREG_ONLY_ALBHA         = "/^[a-zA-Z]+$/";
    const OTHER_PREG_ALPHA_SPACE        = "/^[a-zA-Z ]+$/";
    const OTHER_PREG_ALPHA_NUM          = "/^[a-zA-Z0-9]+$/";
    const OTHER_PREG_ALPHA_NUM_SPACE    = "/^[a-zA-Z0-9 ]+$/";

    //Debug Code
    const ERROR_CODE_LEVEL_DEFAULT      = '30000';
    const ERROR_CODE_LEVEL_1            = '30001';
    const ERROR_CODE_LEVEL_2            = '30002';
    const ERROR_CODE_LEVEL_3            = '30003';
    const ERROR_CODE_LEVEL_4            = '30004';
    const ERROR_CODE_LEVEL_5            = '30005';
    const ERROR_CODE_LEVEL_6            = '30006';
    const ERROR_CODE_LEVEL_7            = '30007';
    const ERROR_CODE_LEVEL_8            = '30008';
    const ERROR_CODE_LEVEL_9            = '30009';
    const ERROR_CODE_LEVEL_10           = '30010';
    const ERROR_CODE_LEVEL_11           = '30011';
    const ERROR_CODE_LEVEL_12           = '30012';
    const ERROR_CODE_LEVEL_13           = '30013';
    const ERROR_CODE_LEVEL_14           = '30014';

    //DB Query
    const QUERY_AUTH_CHECK_USER_EXIST       = 'SELECT name, email, password, type, profile_status, fcm FROM users_login WHERE email=:email';
    const QUERY_IF_EMAIL_AND_MOB_EXISTS     = 'SELECT email FROM users_login WHERE email = :email OR mobile = :mobile';
    const QUERY_SELECT_EMAIL_USRSPROFILE    = 'SELECT * FROM users_login WHERE email = :email';
    const QUERY_AUTH_USER_TOKEN_UPDATE      = 'UPDATE users_login SET token=:token, updated_at=NOW() WHERE email=:user';
    const QUERY_AUTH_USER_FCM_TOKEN_UPDATE  = 'UPDATE users_login SET token=:token, updated_at=NOW(), fcm=:fcm WHERE email=:user';
    const QUERY_CREATE_USER                 = "INSERT INTO users_login (joined, type, email, password, mobile) VALUES (NOW(), 'U', :email, :password, :mobile)";
    const QUERY_INSERT_USER_LOGINS          = "INSERT INTO users_login (profile_status, joined, type, name, email, password, last_changed, token, mobile) VALUES ('N', NOW(), 'U', :name, :email, :password, NOW(), :token, :mobile)";
    const QUERY_UPDATE_USER_PROFILE         = 'INSERT INTO user_profile (email, firstname, lastname, mobile, address_one, address_two, city, country, postcode, updated_at) VALUES (
        :email, :firstname, :lastname, :mobile, :address_one, :address_two, :city, :country, :postcode, NOW())';
    const QUERY_SELECT_TOKEN_FROM_EMAIL     = 'SELECT token FROM users_login WHERE email = :email';
    const QUERY_SEL_TOKEN_ACT_FCM_FROM_EML  = 'SELECT token, profile_status, fcm FROM users_login WHERE email = :email';
    const QUERY_SELECT_ALLCLI_LATLNG        = "SELECT client_id, name, profile_img, cuisine, delivery_fee, delivery_dis, min_order, lat, lng FROM client_shop_search WHERE active = 'Y' AND sub_category = :scategory ORDER BY delivery_dis ASC";
    const QUERY_SELECT_CATG_FROM_CLIID      = 'SELECT category_id, category FROM client_shop_category WHERE client_id = :client';
    const QUERY_SELECT_ALLMENU_FROM_CLID    = 'SELECT category_id, item_topic_id, item_topic, item_desc_yn, item_desc, price FROM client_shop_menu WHERE client_id = :client';
    const QUERY_CHECK_SHOP_DELIPRICE        = 'SELECT active, delivery_fee, watznear_charge, min_order FROM client_shop_search WHERE client_id = :client';
    const QUERY_SELECT_ALL_MENU_WITHCLID    = 'SELECT item_topic_id, price FROM client_shop_menu WHERE client_id = :client';
    const QUERY_INSERT_ORDER_BOOK           = "INSERT INTO order_book (order_time, last_update, client_id, email, order_placed, delivery, payment_mode, data) VALUES (NOW(), NOW(), :client, 
        :email, '1', :delivery, :payment_mode, :data)";
    const QUERY_INSERT_ERROR_ORDER_BOOK     = "INSERT INTO error_order_book (type, order_time, last_update, client_id, email, order_placed, delivery, payment_mode, data) VALUES (:type, NOW(), NOW(), :client, 
    :email, '1', :delivery, :payment_mode, :data)";

    //Client
    const QUERY_CLI_SEL_FCM_FROM_SHOPID     = 'SELECT fcm FROM clients_login WHERE client_id=:client';
}

?>