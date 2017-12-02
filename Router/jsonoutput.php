<?php

class Jsonoutput{

    function error($sending_data, $ecode){
        $data = array(
            'error' => $sending_data
        );
        $this->send($data);
        http_response_code($ecode);
    }

    function success($sending_data, $ecode){
        $data = array(
            'success' => $sending_data
        );
        $this->send($data);
        http_response_code($ecode);
    }

    function defaultError($ecode){
        $this->error("Invalid Request", $ecode);
    }

    //Send Output
    function send($data){
        $reply = array(
            'response' => $data
        );
        header('Content-Type: application/json');        
        echo json_encode($reply);
    }

}


?>