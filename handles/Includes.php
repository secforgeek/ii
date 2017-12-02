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

            case Constants::IMPORT_FOR_Auth:
                $include = [
                    "../handles/AuthKeys.php"
                ];
            break;
        }

        for($i = 0; $i<count($include);$i++){
            require_once $include[$i].'.php';
        }
        
    }
}

?>