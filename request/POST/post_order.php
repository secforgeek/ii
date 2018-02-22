<?php
												$allow = false;
												if($data->payment === Constants::DB_PAYMENT_CASH){
													$allow = true;
												}else{
													$allow = false;
												}
												if($allow){
													$bsv = json_encode($sender);
													$result = $db->InsertUpdateQuery(Constants::QUERY_INSERT_ORDER_BOOK, 
													array(
														":client" => $data->shopid, 
														":email" => $res[Constants::JWT_DATA_DATA]->email,
														":delivery" => $data->del_method, 
														":payment_mode" => "CCC", 
														":stotal" => number_format($subtotal, 2),
														":dcharge" => number_format($db_shop['delivery_fee'], 2),
														":scharge" => number_format($db_shop['watznear_charge'], 2),
														":total" => number_format($Total, 2),
														":data" => $bsv), 
														1);
													if($result){
														$cl_db = $db->selectQuery(Constants::QUERY_CLI_SEL_FCM_FROM_SHOPID, array(":client" => $data->shopid), Constants::DB_FETCH_ASSOC);
														if($cl_db[Constants::DB_ROW_COUNT_KEY] === 1){
															include 'request/CURL/fcm.php';
															$fcm = new fcm();
															if($fcm->sendShopsNotification($cl_db['fcm'])){
																//SUCCESS
																$output->custom("done", "Order placed");
															}else{
																$fcm_failed = $db->InsertUpdateQuery(Constants::QUERY_INSERT_ERROR_ORDER_BOOK, 
																array(":client" => $data->shopid, 
																":email" => $res[Constants::JWT_DATA_DATA]->email,
																":delivery" => $data->del_method, 
																":payment_mode" => "CCC", 
																":data" => $bsv, 
																":type" => "N"), 1);
																if($fcm_failed){
																	//ERROR_SUCCESS
																	$output->custom("part_done","Order placed, wait for the confirmation");
																	exit();
																}else{
																	$output->error(Constants::ERROR_DEF_INVALID_REQUEST.print_r($fcm_failed), Constants::ERROR_CODE_LEVEL_14);
																	exit();	
																}
															}
														}else{
															$fcm_failed = $db->InsertUpdateQuery(Constants::QUERY_INSERT_ERROR_ORDER_BOOK, 
															array(":client" => $data->shopid, 
															":email" => $res[Constants::JWT_DATA_DATA]->email,
															":delivery" => $data->del_method, 
															":payment_mode" => "CCC", 
															":data" => $bsv, 
															":type" => "E"), 1);
															if($fcm_failed){
																//ERROR_SUCCESS
																$output->custom("part_done","Insert Success");
																exit();
															}else{
																$output->error(Constants::ERROR_DEF_INVALID_REQUEST, Constants::ERROR_CODE_LEVEL_13);
																exit();	
															}
														}
													}else{
														$output->error(Constants::ERROR_DEF_INVALID_REQUEST, Constants::ERROR_CODE_LEVEL_12);
														exit();	
													}
												}else{
													$output->error(Constants::ERROR_DEF_INVALID_REQUEST, Constants::ERROR_CODE_LEVEL_11); //unable to match total price
													exit();	
												}
?>