<?php

$postBodyRaw = file_get_contents('php://input');
$postBody = json_decode($postBodyRaw);
if(count((array)$postBody) === Constants::API_VERIFYCART_INPUT){
    if(isset($postBody->token) && isset($postBody->data)){
		include 'handles/AuthKeys.php';
		include 'handles/Auth.php';
		$auth = new Auth();
		$res = $auth->decodeToken($postBody->token, $puk);
		if ($res[Constants::AUTH_TOKEN_STATUS_HEAD] === Constants::AUTH_TOKEN_STATUS_SUCCESS) {
			include 'db/Db.php';
			$db = new DB();
			$dbres = $db->selectQuery(Constants::QUERY_SELECT_TOKEN_FROM_EMAIL, array(":email" => $res[Constants::JWT_DATA_DATA]->email), Constants::DB_FETCH_ASSOC);
			if($dbres[Constants::DB_ROW_COUNT_KEY] === 1 && $dbres['token'] === $postBody->token){
				$data = json_decode($postBody->data);
				$db_shop = $db->selectQuery(Constants::QUERY_CHECK_SHOP_DELIPRICE, array(":client" => $data->shopid), Constants::DB_FETCH_ASSOC);
				if($db_shop[Constants::DB_ROW_COUNT_KEY] === 1){
					if($db_shop['active'] === "Y"){
						if($data->price->total >= $db_shop['min_order']){
							$t = $db_shop['watznear_charge'] + $db_shop['delivery_fee'];
							if($t === $data->price->charges){
								$db_menu = $db->selectQuery(Constants::QUERY_SELECT_ALL_MENU_WITHCLID, array(":client" => $data->shopid), Constants::DB_FETCH_ASSOC_ALL);
								if($db_menu[Constants::DB_ROW_COUNT_KEY] > 0){
									unset($db_menu[Constants::DB_ROW_COUNT_KEY]); 
									$counter = 0;
									$TotalAmountCheck = 0;
									foreach($data->item as $item){
										if(in_array(array("item_topic_id" => $item->item_id, "price"=> $item->price), $db_menu)){
											$TotalAmountCheck += $item->quantity * $item->price;
											$counter++;
										}
									}
									if((count($data->item) === $counter)){
										$Total = $TotalAmountCheck + $t; 
										if($Total === $data->price->total){
											$output->success("Success", null);
										}else{
											$output->error(Constants::ERROR_DEF_INVALID_REQUEST, Constants::ERROR_CODE_LEVEL_11); //unable to match total price
											exit();		
										}
									}else{
										$output->error(Constants::ERROR_DEF_INVALID_REQUEST, Constants::ERROR_CODE_LEVEL_10); //unable to find the product 
										exit();										
									}
								
								}else{
									$output->error(Constants::ERROR_DEF_INVALID_REQUEST, Constants::ERROR_CODE_LEVEL_9); //menu items not availble 
									exit();	
								}
							}else{
								$output->error(Constants::ERROR_DEF_INVALID_REQUEST, Constants::ERROR_CODE_LEVEL_8); //charges doesnt match 
								exit();								
							}
						}else{
							$output->error(Constants::ERROR_DEF_INVALID_REQUEST, Constants::ERROR_CODE_LEVEL_7); //min_order 
							exit();							
						}
					}else{
						$output->error(Constants::ERROR_DEF_INVALID_REQUEST, Constants::ERROR_CODE_LEVEL_6); //Store not active
						exit();						
					}
				}else{
					$output->error(Constants::ERROR_DEF_INVALID_REQUEST, Constants::ERROR_CODE_LEVEL_5); //Shopid doesnt exists
					exit();	
				}
				//$output->success($data->item, null);
			}else{
				$output->action(Constants::JSON_ACTION_LOGOUT, Constants::ERROR_CODE_LEVEL_4);
				exit();
			}
		}else{
			$output->action(Constants::JSON_ACTION_LOGOUT, Constants::ERROR_CODE_LEVEL_3);
			exit();
		}
	}else{
	    $output->error(Constants::ERROR_DEF_INVALID_REQUEST, Constants::ERROR_CODE_LEVEL_2);
    	exit();	
	}
}else{
    $output->error(Constants::ERROR_DEF_INVALID_REQUEST, Constants::ERROR_CODE_LEVEL_1);
    exit();
}

//$data = json_decode($postBody->data);
?>
