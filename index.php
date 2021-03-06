<?php
header("Access-Control-Allow-Origin: *");
header('Allow: GET, POST');
header('Access-Control-Allow-Headers: Origin, Content-Type');

include "router/jsonoutput.php";
include "handles/Constants.php";
$output = new Jsonoutput();
$header = getallheaders();

switch($_SERVER['REQUEST_METHOD']) {
		case "GET" :
				try{
					if(isset($header[Constants::HEADER_CONTENT_TYPE_KEY])){
						if($header[Constants::HEADER_CONTENT_TYPE_KEY] == Constants::HEADER_INCOME_METHOD_ALLOWED){
							switch($_GET['url']){
								case "findshops":
									include 'request/GET/findshops.php';
								break;
				
								default:
									$output->defaultError(Constants::HTTP_ERROR_BADREQUEST);
									exit();
								break;
							}
						}else{
							$output->error(Constants::ERROR_INVALID_REQ_FORMAT, Constants::ERROR_CODE_LEVEL_3, Constants::HTTP_ERROR_BADREQUEST);
							exit();
						}
					}else{
						$output->error(Constants::ERROR_DB_PDO_ERROR, Constants::ERROR_CODE_LEVEL_2 ,Constants::HTTP_ERROR_BADREQUEST);
						exit();						
					}
				}catch(Exception $e){
					$output->error(Constants::ERROR_DB_PDO_ERROR, Constants::ERROR_CODE_LEVEL_1 ,Constants::HTTP_ERROR_BADREQUEST);
					exit();
				}
			break;
	
		case "POST" :
				try{
					if(isset($header['content-type'])){
						if($header['content-type'] == 'application/json'){
							switch($_GET['url']){
								case 'auth':
									include 'request/POST/post_auth.php';
								break;

								case 'authclient':
									include 'request/POST/post_client_auth.php';
								break;

								case 'create':
									include 'request/POST/post_create.php';
								break;

								case 'profile':
									include 'request/POST/post_profile.php';
								break;

								case 'findshops':
									include 'request/POST/post_findshops.php';
								break;

								case 'getmenu':
                                    include 'request/POST/post_getmenu.php';
								break;
								
								case 'verifycart':
									include 'request/POST/post_verifycart.php';	
								break;

								case 'getorders':
									include 'request/POST/post_cli_getorder.php';
								break;

								default:
									$output->defaultError(Constants::HTTP_ERROR_BADREQUEST);
									exit();
								break;				
							}
						}else{
							$output->error(Constants::ERROR_INVALID_REQ_FORMAT, Constants::ERROR_CODE_LEVEL_3 ,Constants::HTTP_ERROR_BADREQUEST);
							exit();
						}
					}else{
						$output->error(Constants::ERROR_DB_PDO_ERROR, Constants::ERROR_CODE_LEVEL_2 ,Constants::HTTP_ERROR_BADREQUEST);
						exit();						
					}
				}catch(Exception $e){
					$output->error(Constants::ERROR_DB_PDO_ERROR, Constants::ERROR_CODE_LEVEL_1 ,Constants::HTTP_ERROR_BADREQUEST);
					exit();	
				}
			break;
	
		default :		
			$output->defaultError(Constants::HTTP_ERROR_METHODNOTALLOWED);
			exit();
		break;
}

?>