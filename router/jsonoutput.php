<?php

class Jsonoutput{

    function error($sending_data, $debugcode){
        $data = array(
            Constants::JSON_HEADING_ERROR => $sending_data,
            Constants::JSON_ERROR_CODE_HEAD => $debugcode
        );
        $this->send($data);
    }

    function success($sending_data, $recdata, $ecode = Constants::HTTP_SUCCESS_CODE_OK){
        if($recdata != NULL){
            $data = array(
                Constants::JSON_HEADING_SUCCESS => $sending_data,
                Constants::JSON_HEADING_DATA =>$recdata
            );
        }else{
            $data = array(
                Constants::JSON_HEADING_SUCCESS => $sending_data
            );
        }

        $this->send($data);
        http_response_code($ecode);
    }

    function custom($customTag, $customVal){
        $data = array(
            $customTag => $customVal
        );
        $this->send($data);
    }

    function action($sending_data, $ecode){
        $data = array(
            Constants::JSON_MAIN_RESPONSE_ACTION => $sending_data,
            Constants::JSON_ERROR_CODE_HEAD => $ecode
        );
        $this->send($data);
        http_response_code(Constants::HTTP_SUCCESS_CODE_OK);
    }   

    function defaultError($ecode){
        $this->error(Constants::ERROR_DEF_INVALID_REQUEST, Constants::ERROR_CODE_LEVEL_DEFAULT, $ecode);
    }

    //Send Output
    function send($data){
        $reply = array(
            Constants::JSON_MAIN_RESPONSE_TEXT => $data
        );
        header('Content-Type: application/json');        
        echo json_encode($reply);
    }

}


?>