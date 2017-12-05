<?php

class DB{
    private $pdo;
    public function __construct($host = Constants::DB_HOSTNAME, $dbname = Constants::DB_DATABASE, $username = Constants::DB_USERNAME, $password = Constants::DB_PASSWORD){
        $pdo = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8',$username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //EXCEPTION
        $this->pdo = $pdo;
    }

    public function selectQuery($query, $params = array(), $returntype){
        try{
            $statement = $this->pdo->prepare($query);
            $statement->execute($params);
            $c = $statement->rowCount();
            switch($returntype){
                case Constants::DB_FETCH_ASSOC:   
                    $data = $statement->fetch(PDO::FETCH_ASSOC);
                break;
    
                case Constants::DB_FETCH_NUM:
                    $data = $statement->fetch(PDO::FETCH_NUM);
                break;
            }
            if($data == NULL){
                return Constants::DB_EMPTY_VALUE;
            }else{
                return $data;
            }
        }catch(PDOException $e){
            return Constants::DB_EMPTY_VALUE;
        }
    }

    public function InsertUpdateQuery($query, $params = array(), $resultCount){
       // try{
            $statement = $this->pdo->prepare($query);
            $statement->execute($params);
            if($statement->rowCount() == $resultCount){
                return true;
            }else{
                return false;
            } 
     //   }catch(PDOException $e){
       //     return false;
       // }     
    }

}


?>