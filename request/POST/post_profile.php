<?php
$postBodyRaw = file_get_contents('php://input');
$postBody = json_decode($postBodyRaw);

if (count((array)$postBody) == Constants::API_UPDATE_PROFILE_INPUT) {

	if (isset($postBody->email) && isset($postBody->firstname) && isset($postBody->lastname) 
	&& isset($postBody->mobile) && isset($postBody->address_one) && isset($postBody->address_two) 
	&& isset($postBody->city) && isset($postBody->country) && isset($postBody->postcode) && isset($postBody->token)) {
		include 'handles/AuthKeys.php';
		include 'handles/Auth.php';
		$auth = new Auth();
		$res = $auth -> decodeToken($postBody->token, $puk);
		if ($res[Constants::AUTH_TOKEN_STATUS_HEAD] === Constants::AUTH_TOKEN_STATUS_SUCCESS) {
			if ($res['data'] -> email === $postBody -> email) {
				include 'db/DB.php';
				$db = new DB();
				$query = $db -> selectQuery(Constants::QUERY_SELECT_EMAIL_USRSPROFILE, array(":email" => $res['data'] -> email), Constants::DB_FETCH_ASSOC);
				if ($query[Constants::DB_ROW_COUNT_KEY] === 1) {
					if ($query['mobile'] === $postBody->mobile && is_numeric($postBody->mobile) && strlen($postBody->mobile) === Constants::OTHER_MOBILE_ALLOWED_CHAR) {
						if ($query['name'] === $postBody->firstname) {
							if (preg_match(Constants::OTHER_PREG_ALPHA_SPACE, $postBody->lastname) && (strlen($postBody->lastname) >= 5 && strlen($postBody->lastname) <= 15)) {
								if (preg_match(Constants::OTHER_PREG_ALPHA_NUM_SPACE, $postBody->address_one) && (strlen($postBody->address_one) >= 5 && strlen($postBody->address_one) <= 15)) {
									if (preg_match(Constants::OTHER_PREG_ALPHA_NUM_SPACE, $postBody -> address_two) && (strlen($postBody -> address_two) >= 5 && strlen($postBody -> address_two) <= 15)) {
										if (preg_match(Constants::OTHER_PREG_ONLY_ALBHA, $postBody->city) && (strlen($postBody->city) >= 5 && strlen($postBody->city) <= 15)) {
											include 'handles/GlobalVariables.php';
											if (in_array(ucfirst($postBody->country), $allowed_countries)) {
												if (in_array(strlen($postBody->postcode), $allowed_postcode_length) && is_numeric($postBody->postcode)) {
													if ($query['email'] === $postBody->email) {
														$params = array(
															":email" => $postBody->email, 
															":firstname" => $postBody->firstname, 
															":lastname" => $postBody->lastname, 
															":mobile" => $postBody->mobile, 
															":address_one" => $postBody->address_one, 
															":address_two" => $postBody->address_two, 
															":city" => $postBody->city, 
															":country" => $postBody->country, 
															":postcode" => $postBody->postcode);
														if ($db -> InsertUpdateQuery(Constants::QUERY_UPDATE_USER_PROFILE, $params, 1)) {
															$output -> action(Constants::JSON_ACTION_JOB_DONE);exit();
														}else{$output->error(Constants::ERROR_TECHNICAL_ISSUE, Constants::HTTP_ERROR_BADREQUEST);exit();}	
													} else {$output -> error(Constants::ERROR_INVALID_EMAIL, Constants::HTTP_ERROR_BADREQUEST);exit();}
												} else {$output -> error(Constants::ERROR_INVALID_POSTCODE, Constants::HTTP_ERROR_BADREQUEST);exit();}
											}else {$output -> error(Constants::ERROR_INVALID_COUNTRY, Constants::HTTP_ERROR_BADREQUEST);exit();}
										} else {$output -> error(Constants::ERROR_INVALID_CITY, Constants::HTTP_ERROR_BADREQUEST);exit();}
									} else{$output -> error(Constants::ERROR_INVALID_ADDRESS, Constants::HTTP_ERROR_BADREQUEST);exit();}
								} else{$output -> error(Constants::ERROR_INVALID_ADDRESS, Constants::HTTP_ERROR_BADREQUEST);exit();}
							} else{$output -> error(Constants::ERROR_INVALID_NAME, Constants::HTTP_ERROR_BADREQUEST);exit();}
						} else{$output -> error(Constants::ERROR_INVALID_FIRSTNAME, Constants::HTTP_ERROR_BADREQUEST);exit();}
					} else{$output -> error(Constants::ERROR_INVALID_MOBILE, Constants::HTTP_ERROR_BADREQUEST);exit();}
				} else{$output -> error(Constants::ERROR_INVALID_EMAIL, Constants::HTTP_ERROR_BADREQUEST);exit();}
			} else{$output -> action(Constants::ERROR_INVALID_EMAIL);exit();}
		} else{$output -> action(Constants::JSON_ACTION_LOGOUT);exit();}
	}else{$output -> error(Constants::ERROR_INVALID_REQ_FORMAT, Constants::HTTP_ERROR_BADREQUEST);exit();}
}else{$output -> error(Constants::ERROR_INVALID_REQ_FORMAT, Constants::HTTP_ERROR_BADREQUEST);exit();}
?>