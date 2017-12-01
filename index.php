<?php
include 'db/DB.php';
include 'handles/statuscode.php';
$db = new DB(DBVARS::DB_HOSTNAME, DBVARS::DB_DATABASE,DBVARS::DB_USERNAME,DBVARS::DB_PASSWORD);
$nw = new StatusCode();

switch($_SERVER['REQUEST_METHOD']) {

	case "GET" :
			switch($_GET['url']){
				case "auth":
					return json_encode($db->query("SELECT * FROM users"));
					$nw->_status_successrequest();
				break;

				case "users":

				break;
			}
		break;

	case "POST" :
			switch($_GET['url']){
				case "auth":
					$postBody = file_get_contents("php://input");
					$postBody = json_decode($postBody);

					$username = $postBody->username;
					$password = $postBody->password;

					if($db->query('SELECT username FROM users WHERE username=:username',array(':username'=>$username))){
						$cstrong = True;
						$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
						echo '{"Gate":"'.$token.'"}';
					}else{
						http_response_code(401);
					}
					
				break;
			}
		break;

	default :			
			$nw->_status_methodnotfound();
		break;
}
?>