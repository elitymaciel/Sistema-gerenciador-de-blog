<?php

namespace Blog\Faculdade\Models;

use Blog\Faculdade\Core\Database;
use PDO;
use PDOException;

class Categoria {
    private $db;

    public function __construct()
    { 
        $this->db = new Database();
    }

    public function criarCategoria($nome)
    {
        $conn = $this->db->getConnection();
 
        try {  
            $criarCategoria = $conn->prepare("INSERT INTO categorias (nome) VALUES (:nome)");
               
            $criarCategoria->bindParam(':nome', $nome);  
            $criarCategoria->execute(); 
 
            return true;

        } catch(PDOException $e) { 
            return $e->getMessage();
        }
    }

    
}

