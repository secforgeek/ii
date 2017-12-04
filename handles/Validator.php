<?php

class Validator{


    public static function jsonContentType($header){
        if($header["content-type"] == "application/json"){
            return true;
        }else{
            return false;
        }
    }

}

?>