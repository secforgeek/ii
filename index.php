<?php
include "router/jsonoutput.php";
include "handles/Constants.php";

$output = new Jsonoutput();
switch($_SERVER['REQUEST_METHOD']) {

	case "GET" :
			switch($_GET['url']){
				case "auth":
					$output->success("HelloWorldSuccess", Constants::HTTP_SUCCESS_CODE_OK);
				break;

				case "users":
					$output->error("ErrorWOrls", Constants::HTTP_ERROR_UNAUTHORISED);
				break;

				default:
					$output->defaultError(Constants::HTTP_ERROR_BADREQUEST);
				break;
			}
		break;

	case "POST" :
			switch($_GET['url']){
				case "auth":
					include "request/POST/post_auth.php";
				break;
				default:
					$output->defaultError(Constants::HTTP_ERROR_BADREQUEST);
				break;				
			}
		break;

	default :			
			$nw->_status_methodnotfound();
		break;
}
?>