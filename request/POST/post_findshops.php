<?php
    $postBodyRaw = file_get_contents('php://input');
    $postBody = json_decode($postBodyRaw);
    if(count((array)$postBody) === Constants::API_FINDSHOP_ALLOWED_INPUT){
        if(isset($postBody->lat) && isset($postBody->lng) && isset($postBody->token) && isset($postBody->scat)){
            if(is_float(floatval($postBody->lat)) && ($postBody->lat >= -90 && $postBody->lat <= 90)){ //lat -90 to 90 and long = -180 to 180
                if(is_float(floatval($postBody->lng)) && ($postBody->lng >= -180 && $postBody->lng <= 180)){ //lat -90 to 90 and long = -180 to 180
                    include_once 'handles/GlobalVariables.php';
                    if(in_array($postBody->scat, $allowed_category)){
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
                                    $dbres = $db->selectQuery(Constants::QUERY_SELECT_ALLCLI_LATLNG, array(":scategory" => $postBody->scat), Constants::DB_FETCH_ASSOC_ALL);
                                        if($dbres[Constants::DB_ROW_COUNT_KEY] > 0){
                                            include 'handles/IncludeClasses.php';
                                            $calc = new DistanceCalc();
                                            $return_array = array();
                                            foreach($dbres as $key){
                                                if(isset($key['lat']) && isset($key['lng'])){
                                                    $km = $calc->CalculateDistance($postBody->lat, $postBody->lng, $key['lat'], $key['lng']);
                                                    if($km <= $key['delivery_dis']){
                                                        $jreturn = array(
                                                            "shopid" => $key['client_id'],
                                                            "name" => $key['name'],
                                                            "logo" => $key['profile_img'],
                                                            "cuisine" => $key['cuisine'],
                                                            "delivery_fee" => $key['delivery_fee'],
                                                            "distance" => $km,
                                                            "minimum_order" => $key['min_order']
                                                        );
                                                        $return_array[] = $jreturn;
                                                    }
                                                }
                                            }
                                            $output->success("Restaurants Found", $return_array, Constants::HTTP_SUCCESS_CODE_OK);
                                            exit();                                            
                                        }else{
                                            $output->success("No Restaurants Found", null, Constants::HTTP_SUCCESS_CODE_OK);
                                            exit();
                                        }
                                    }else{
                                        $output->action(Constants::JSON_ACTION_LOGOUT, Constants::ERROR_CODE_LEVEL_8);
                                        exit();
                                    }

                                }else{
                                    $output->action(Constants::JSON_ACTION_LOGOUT, Constants::ERROR_CODE_LEVEL_7);
                                    exit();
                                }
                            }else{
                                $output->action(Constants::JSON_ACTION_LOGOUT, Constants::ERROR_CODE_LEVEL_6);
                                exit();
                            }
                    }else{
                        $output->action(Constants::JSON_ACTION_LOGOUT, Constants::ERROR_CODE_LEVEL_5);
                        exit();                        
                    }
                }else{
                    $output->error(Constants::ERROR_DEF_INVALID_REQUEST, Constants::ERROR_CODE_LEVEL_4, Constants::HTTP_ERROR_FORBIDDEN);
                    exit();               
                }
            }else{
                $output->error(Constants::ERROR_DEF_INVALID_REQUEST, Constants::ERROR_CODE_LEVEL_3, Constants::HTTP_ERROR_FORBIDDEN);
                exit();               
            }
        }else{
            $output->error(Constants::ERROR_DEF_INVALID_REQUEST, Constants::ERROR_CODE_LEVEL_2, Constants::HTTP_ERROR_FORBIDDEN);
            exit();
        }
    }else{
        $output->error(Constants::ERROR_DEF_INVALID_REQUEST, Constants::ERROR_CODE_LEVEL_1, Constants::HTTP_ERROR_FORBIDDEN);
        exit();
    }
?>