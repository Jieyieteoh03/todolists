<?php

// open class
class DB
{
    // attributes
    public $host = 'devkinsta_db';
    public $dbname = 'todolist';
    public $dbuser = 'root';
    public $dbpassword = 'LrJHyxBK8VE6Afq8';
    public $db;

    // method (functions/actions)
    public function __construct()
    {
        $this->db = new PDO(
        "mysql:host=$this->host;dbname=$this->dbname",
        $this->dbuser,
        $this->dbpassword
        );
    }

    public function fetch($sql , $data = [])
    {
        $query = $this->db->prepare($sql);
        $query -> execute($data);
        return $query -> fetch();

    }

    public function fetchAll($sql , $data = [])
    {
        $query = $this->db->prepare($sql);
        $query -> execute($data);
        return $query->fetchAll();
    }

    public function insert($sql , $data = [])
    {
        $query = $this->db->prepare($sql);
        $query -> execute($data);
       
    }

    public function update($sql , $data = [])
    {
        $query = $this->db->prepare($sql);
        $query -> execute($data);
       
    }

    public function delete($sql , $data = [])
    {
        $query = $this->db->prepare($sql);
        $query -> execute($data);
       
    }

}


?>