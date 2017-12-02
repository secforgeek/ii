<?php
require_once 'handles/Constants.php';
class Includes{
    
    public static function autoload($filename){
        
        switch($filename){
            case Constants::IMPORT_FOR_index:
                $include = [
                    "Router/jsonoutput"
                ];
            break;

            case Constants::IMPORT_FOR_jsonoutput:
                $include = [
                    "../handles/Constants"
                ];
            break;
        }
    
        for($i = 0; $i<count($include);$i++){
        	include $include[$i].'.php';
        }  
    }
}

?>