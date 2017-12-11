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
            switch($returntype){
                case Constants::DB_FETCH_ASSOC:   
                    $data = $statement->fetch(PDO::FETCH_ASSOC);
                break;
    
                case Constants::DB_FETCH_NUM:
                    $data = $statement->fetch(PDO::FETCH_NUM);
                break;

                case Constants::DB_FETCH_ASSOC_ALL:
                $data = $statement->fetchAll(PDO::FETCH_ASSOC);
                break;

            }
            $row = $statement->rowCount();
            if($row == 0){
                return array(Constants::DB_ROW_COUNT_KEY => $row);
                $this->reset();
            }else{
                return array_merge(array(Constants::DB_ROW_COUNT_KEY => $row), $data);
                $this->reset();
            }
        }catch(PDOException $e){
            return array(Constants::DB_ROW_COUNT_KEY => -1);
            $this->reset();
        }
    }

    public function InsertUpdateQuery($query, $params = array(), $resultCount){
       try{
            $statement = $this->pdo->prepare($query);
            $statement->execute($params);
            if($statement->rowCount() == $resultCount){
                return true;
                $this->reset();
            }else{
                return false;
                $this->reset();
            } 
        }catch(PDOException $e){
            return false;
            $this->reset();
        }     
    }

    public function reset(){
        $this->pdo = null;
    }
}


?>