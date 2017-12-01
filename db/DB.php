<?php

class DB{
    private $pdo;
    public function __construct($host, $dbname, $username, $password){
        $pdo = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8',$username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo = $pdo;
    }

    public function query($query, $params = array()){
        $statement = $this->pdo->prepare($query);
        $statement->execute($params);

        if(explode(' ', $query)[0] == 'SELECT'){
            $data = $statement->fetchColumn();
            return $data;
        }
    }

    public function querySelectOnly($query){
        $statement = $this->pdo->query($query);
        return $statement->fetch(PDO::FETCH_COLUMN);
    }
}

class DBVARS{

    const DB_HOSTNAME='127.0.0.1';
    const DB_DATABASE='workbase';
    const DB_USERNAME='root';
    const DB_PASSWORD='';
}


?>