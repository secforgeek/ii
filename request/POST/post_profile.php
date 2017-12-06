<?php
 $postBodyRaw = file_get_contents('php://input');
 $postBody = json_decode($postBodyRaw);
 if(count((array)$postBody) == Constants::API_UPDATE_PROFILE_INPUT){
     if(
         isset($postBody->email) &&
         isset($postBody->firstname) &&
         isset($postBody->lastname) &&
         isset($postBody->mobile) &&
         isset($postBody->address_one) &&
         isset($postBody->address_two) &&
         isset($postBody->city) &&
         isset($postBody->country) &&
         isset($postBody->postcode) &&
         isset($postBody->token)
         ){
            include 'handles/AuthKeys.php';
            include 'handles/Auth.php';
            $auth = new Auth();
            $res = $auth->decodeToken($postBody->token, $puk);
            if($res[Constants::AUTH_TOKEN_STATUS_HEAD] === Constants::AUTH_TOKEN_STATUS_SUCCESS){
               if($res['data']->email === $postBody->email){
                //Check if email exits in login_user
                //Fetch all detail from login-user db
                //
               }else{
                    $output->action(Constants::JSON_ACTION_LOGOUT);
                    exit();
               }
            }else{
                $output->action(Constants::JSON_ACTION_LOGOUT);
                exit();
            }
     }else{
        $output->error(Constants::ERROR_INVALID_REQ_FORMAT, Constants::HTTP_ERROR_BADREQUEST);
        exit(); 
     }
}else{
    $output->error(Constants::ERROR_INVALID_INPUT_FORMAT, Constants::HTTP_ERROR_FORBIDDEN);
    exit();
}
?>