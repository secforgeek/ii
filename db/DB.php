<?php

class DB{
    private $pdo;
    public function __construct($host = Constants::DB_HOSTNAME, $dbname = Constants::DB_DATABASE, $username = Constants::DB_USERNAME, $password = Constants::DB_PASSWORD){
        $pdo = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8',$username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo = $pdo;
    }

    public function selectQuery($query, $params = array(), $returntype){
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
    }

    public function insertQuery($query, $params = array()){
        $statement = $this->pdo->prepare($query);
        if($statement->execute($params)){
            return true;
        }else{
            return false;
        }
    }

}


?>