<?php
    $postBodyRaw = file_get_contents('php://input');
    $postBody = json_decode($postBodyRaw);
    if(count((array)$postBody) == Constants::API_FINDSHOP_ALLOWED_INPUT){
        if(isset($postBody->lat) && isset($postBody->lng)){
            if(is_float(floatval($postBody->lat)) && ($postBody->lat >= -90 && $postBody->lat <= 90)){ //lat -90 to 90 and long = -180 to 180
                if(is_float(floatval($postBody->lng)) && ($postBody->lng >= -180 && $postBody->lng <= 180)){ //lat -90 to 90 and long = -180 to 180
                    include 'handles/AuthKeys.php';
                    include 'handles/Auth.php';
                    $auth = new Auth();
                    $res = $auth->decodeToken($postBody->token, $puk);
                    if ($res[Constants::AUTH_TOKEN_STATUS_HEAD] === Constants::AUTH_TOKEN_STATUS_SUCCESS) {
                        if(filter_var($res[Constants::JWT_DATA_DATA]->email, FILTER_VALIDATE_EMAIL)){
                            include 'db/Db.php';
                            $db = new DB();
                            $dbres = $db->selectQuery(Constants::QUERY_SELECT_TOKEN_FROM_EMAIL, array(":email" => $res[Constants::JWT_DATA_DATA]->email), Constants::DB_FETCH_ASSOC);
                            if($dbres[Constants::DB_ROW_COUNT_KEY] === 1 && $dbres['token'] === $postBody->token){
                                $dbres = $db->selectQuery(Constants::QUERY_SELECT_ALLCLI_LATLNG, null, Constants::DB_FETCH_ASSOC_ALL);
                                if($dbres[Constants::DB_ROW_COUNT_KEY] > 0){
                                    include 'handles/IncludeClasses.php';
                                    $calc = new DistanceCalc();
                                    foreach($dbres as $key){
                                       echo $key['client_id'].print_r($calc->CalculateDistance($postBody->lat, $postBody->lng, $key['lat'], $key['lng']), true);
                                    }
                                }else{
                                    $output->success("No Restaurants Found", Constants::HTTP_SUCCESS_CODE_OK);
                                    exit();
                                }
                            }else{
                                $output->action(Constants::JSON_ACTION_LOGOUT."Test 7");
                                exit();
                            }

                        }else{
                            $output->action(Constants::JSON_ACTION_LOGOUT."Test 6");
                            exit();
                        }
                    }else{
                        $output->action(Constants::JSON_ACTION_LOGOUT."Test 5");
                        exit();
                    }
                }else{
                    $output->error(Constants::ERROR_DEF_INVALID_REQUEST."Test 4", Constants::HTTP_ERROR_FORBIDDEN);
                    exit();               
                }
            }else{
                $output->error(Constants::ERROR_DEF_INVALID_REQUEST."Test 3", Constants::HTTP_ERROR_FORBIDDEN);
                exit();               
            }
        }else{
            $output->error(Constants::ERROR_DEF_INVALID_REQUEST."Test 2", Constants::HTTP_ERROR_FORBIDDEN);
            exit();
        }
    }else{
        $output->error(Constants::ERROR_DEF_INVALID_REQUEST."Test 1", Constants::HTTP_ERROR_FORBIDDEN);
        exit();
    }
?>