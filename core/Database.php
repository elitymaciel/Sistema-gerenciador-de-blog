<?php
namespace Blog\Faculdade\Core;

use PDO;
use PDOException; 

class Database {
    private $host;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    public function __construct() {   
        $this->host = '172.16.238.10';
        $this->username = 'root';
        $this->password = '_G[AbpOOHXh5NtBP';
        $this->dbname = 'blog';
 
        $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            echo "Erro de conexão: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}