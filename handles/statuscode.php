<?php

class StatusCode{

public function _status_methodnotfound(){
    return http_response_code(405);
}

public function _status_successrequest(){
    return http_response_code(200);
}

}

?>