<?php
    $postBodyRaw = file_get_contents('php://input');
    $postBody = json_decode($postBodyRaw);
    if(count((array)$postBody) === Constants::API_CLI_GET_MENU_INPUT){
        include 'handles/AuthKeys.php';
        include 'handles/Auth.php';
        $auth = new Auth();
        $res = $auth->decodeToken($postBody->token, $puk);
        if ($res[Constants::AUTH_TOKEN_STATUS_HEAD] === Constants::AUTH_TOKEN_STATUS_SUCCESS) {
            if(filter_var($res[Constants::JWT_DATA_DATA]->email, FILTER_VALIDATE_EMAIL)){
                include 'db/Db.php';
                $db = new DB();
                $dbres = $db->selectQuery(Constants::QUERY_CLI_SELECT_TOKEN_FROM_EMAIL, array(":email" => $res[Constants::JWT_DATA_DATA]->email), Constants::DB_FETCH_ASSOC);
                if($dbres[Constants::DB_ROW_COUNT_KEY] === 1 && $dbres['token'] === $postBody->token){
                    $datares = $db->selectQuery(Constants::QUERY_CLI_SELECT_ORDER_TO_ACCEPT, array(":shopid" => $dbres['client_id']), Constants::DB_FETCH_ASSOC_ALL);
                    if($datares[Constants::DB_ROW_COUNT_KEY] > 0){
                        unset($datares[Constants::DB_ROW_COUNT_KEY]); 
                        $output->custom("complete", $datares);
                    }else{
                        $output->custom("nodata", "No Order Found");
                    }
                }else{
                    $output->action(Constants::JSON_ACTION_LOGOUT, Constants::ERROR_CODE_LEVEL_4);
                    exit();
                }
            }else{
                $output->action(Constants::JSON_ACTION_LOGOUT, Constants::ERROR_CODE_LEVEL_3);
                exit();
            }
        }else{
            $output->action(Constants::JSON_ACTION_LOGOUT, Constants::ERROR_CODE_LEVEL_2);
            exit();
        }
    }else{
        $output->error(Constants::ERROR_DEF_INVALID_REQUEST, Constants::ERROR_CODE_LEVEL_1, Constants::HTTP_ERROR_FORBIDDEN);
        exit();
    }
?>