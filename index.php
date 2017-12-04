<?php
include "router/jsonoutput.php";
$output = new Jsonoutput();
$header = getallheaders();

switch($_SERVER['REQUEST_METHOD']) {
		case "GET" :
				switch($_GET['url']){
					case "auth":
						//GET METHOD
					break;
	
					default:
						include "handles/Constants.php";
						$output->defaultError(Constants::HTTP_ERROR_BADREQUEST);
					break;
				}
			break;
	
		case "POST" :
				switch($_GET['url']){
					case "auth":
						include "handles/Constants.php";
						include "request/POST/post_auth.php";
					break;
					default:
						include "handles/Constants.php";
						$output->defaultError(Constants::HTTP_ERROR_BADREQUEST);
					break;				
				}
			break;
	
		default :	
			include "handles/Constants.php";		
			$output->defaultError(Constants::HTTP_ERROR_BADREQUEST);
		break;
}

?>