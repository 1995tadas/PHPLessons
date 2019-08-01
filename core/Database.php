<?php

namespace Core;

class Database
 {
     private $pdo;
     private  $sql;
     public function connect() {
        $host = '127.0.0.1';
        $db = 'blog';
        $user = 'username';
        $pass = '+Password123';
        $pdo = null;
        try {
            $pdo = new \PDO("mysql:host=$host; dbname=$db;charset=utf8",$user,$pass);

        } catch(PDOException $e){
            echo 'Conection failed:'.$e->getMessage().'\n';
        }
        $this->pdo=$pdo;
    }

    public function select($fields = '*'){
         $this->sql .= 'SELECT '.$fields;
         return $this;
    }
    public function from ($table){
         $this->sql.= ' FROM '.$table;
        return $this;
    }
    public function insert($table, $tableFields, $values){
        $this->sql .= " INSERT INTO ".$table." (".$tableFields.")"." VALUES "."(".$values.")";
        return $this;

    }

    public function update($table,$setContent){
        $this->sql .= " UPDATE $table SET $setContent";
        return $this;
    }
    public function set($fieldName, $value){
        $this->sql .= ' SET '.$fieldName.' = '.$value;
        return $this;
    }
    public function andWhere($fieldName, $value){
        $this->sql .= " AND $fieldName = '$value'";
        return $this;
    }
    public function delete(){
        $this->sql .= ' DELETE ';
        return $this;
    }

    public  function  execute(){
        $this->connect();
        $sql = $this->sql;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $this->sql = '';
        return $stmt;
    }
    public function getAll(){
         $stmt = $this->execute();
         $data = [];
        while($row = $stmt->fetchObject())
        {
            $data[] = $row;
        }
        return $data;

    }

    public  function get(){
         $stmt = $this->execute();
         return $stmt->fetchObject();
    }

    public function where($fieldname, $value){
        $this->sql .= " WHERE $fieldname = '$value'";
        return $this;
    }
    public function whereLike($fieldname, $value){
        $this->sql .= " WHERE $fieldname LIKE '%$value%'";
        return $this;
    }
}

