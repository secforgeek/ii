<?php
include 'handles/Includes.php';
Includes::autoload(Constants::IMPORT_FOR_index);

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
					$output->defaultError();
				break;
			}
		break;

	case "POST" :
			switch($_GET['url']){
				case "auth":
					
				break;
				default:
					$output->defaultError();
				break;				
			}
		break;

	default :			
			$nw->_status_methodnotfound();
		break;
}
?>