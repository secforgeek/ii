<?php
include "router/jsonoutput.php";
include "handles/Constants.php";
$output = new Jsonoutput();
$header = getallheaders();

switch($_SERVER['REQUEST_METHOD']) {
		case "GET" :
				try{
					if($header['content-type'] == 'application/json'){
						switch($_GET['url']){
							case "auth":
								//GET METHOD
							break;
			
							default:
								$output->defaultError(Constants::HTTP_ERROR_BADREQUEST);
							break;
						}
					}else{
						$output->error(Constants::ERROR_INVALID_REQ_FORMAT, Constants::HTTP_ERROR_BADREQUEST);
						exit();
					}
				}catch(Exception $e){
					$output->error(Constants::ERROR_DB_PDO_ERROR, Constants::HTTP_ERROR_BADREQUEST);
					exit();
				}
			break;
	
		case "POST" :
				try{
					if($header['content-type'] == 'application/json'){
						switch($_GET['url']){
							case "auth": //COMPLETED
								include "request/POST/post_auth.php";
							break;

							case "create":
								include "request/POST/post_create.php";
							break;

							default:
								$output->defaultError(Constants::HTTP_ERROR_BADREQUEST);
							break;				
						}
					}else{
						$output->error(Constants::ERROR_INVALID_REQ_FORMAT, Constants::HTTP_ERROR_BADREQUEST);
						exit();
					}
				}catch(Exception $e){
					$output->error(Constants::ERROR_DB_PDO_ERROR, Constants::HTTP_ERROR_BADREQUEST);
					exit();	
				}
			break;
	
		default :		
			$output->defaultError(Constants::HTTP_ERROR_BADREQUEST);
			exit();
		break;
}

?>