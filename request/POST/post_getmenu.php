<?php
    $postBodyRaw = file_get_contents('php://input');
    $postBody = json_decode($postBodyRaw);
    if(count((array)$postBody) === Constants::API_GETMENU_ALLOWED_INPUT){
        if(isset($postBody->token) && isset($postBody->restid)){
            if(strlen($postBody->restid) === 32){
                include 'handles/AuthKeys.php';
                include 'handles/Auth.php';
                $auth = new Auth();
                $res = $auth -> decodeToken($postBody->token, $puk);
                if ($res[Constants::AUTH_TOKEN_STATUS_HEAD] === Constants::AUTH_TOKEN_STATUS_SUCCESS) {
                    include 'db/DB.php';
                    $db = new DB();
                    $dbres = $db->selectQuery(Constants::QUERY_SELECT_TOKEN_FROM_EMAIL, array(":email" => $res['data']->email), Constants::DB_FETCH_ASSOC);
                    if($dbres[Constants::DB_ROW_COUNT_KEY] === 1){
                        if($dbres['token'] === $postBody->token){
                          $categories = $db->selectQuery(Constants::QUERY_SELECT_CATG_FROM_CLIID, array(":client" => $postBody->restid), Constants::DB_FETCH_ASSOC_ALL);
                          if($categories[Constants::DB_ROW_COUNT_KEY] > 0){
                            unset($categories[Constants::DB_ROW_COUNT_KEY]); 
                            $menu = $db->selectQuery(Constants::QUERY_SELECT_ALLMENU_FROM_CLID, array(":client" => $postBody->restid), Constants::DB_FETCH_ASSOC_ALL);
                            if($menu[Constants::DB_ROW_COUNT_KEY] > 0){
                                unset($menu[Constants::DB_ROW_COUNT_KEY]); 
                                $return_array = array();
                                foreach($categories as $catg){     
                                    $r = array();
                                    foreach($menu as $menu_item){
                                        if($menu_item['category_id'] === $catg['category_id']){
                                            $r[] = $menu_item;
                                        }
                                    }
                                    $return_array[] = array($catg['category'] => $r);
                                }
                                $output->success(Constants::SUCCESS_FETCH_MENU, $return_array, Constants::HTTP_SUCCESS_CODE_OK);
                                exit();
                            }else{
                                $output->error(Constants::ERROR_INVALID_INPUT_FORMAT, Constants::ERROR_CODE_LEVEL_5 ,Constants::HTTP_ERROR_BADREQUEST);
                                exit();
                            }    
                          }else{
                            $output->error(Constants::ERROR_INVALID_INPUT_FORMAT, Constants::ERROR_CODE_LEVEL_4 ,Constants::HTTP_ERROR_BADREQUEST);
                            exit();
                          }
                        }else{
                            $output -> action(Constants::JSON_ACTION_LOGOUT);
                            exit();                           
                        }
                    }else{
                        $output -> action(Constants::JSON_ACTION_LOGOUT);
                        exit();
                    }
                } else{
                    $output -> action(Constants::JSON_ACTION_LOGOUT);
                    exit();
                }
            }else{
                $output->error(Constants::ERROR_DEF_INVALID_REQUEST, Constants::ERROR_CODE_LEVEL_3 ,Constants::HTTP_ERROR_FORBIDDEN);
                exit();
            }
        }else{
            $output->error(Constants::ERROR_DEF_INVALID_REQUEST, Constants::ERROR_CODE_LEVEL_2 ,Constants::HTTP_ERROR_FORBIDDEN);
            exit();
        }
    }else{
        $output->error(Constants::ERROR_DEF_INVALID_REQUEST, Constants::ERROR_CODE_LEVEL_1 ,Constants::HTTP_ERROR_FORBIDDEN);
        exit();
    }
?>