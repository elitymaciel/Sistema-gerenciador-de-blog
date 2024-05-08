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

    static function listaCategoria()
    {
        $database = new Database();
        $conn = $database->getConnection();
        
        try {
            $consulta = $conn->prepare("SELECT * FROM categorias");
            $consulta->execute(); 
            
            $resultado = $consulta->fetchAll(PDO::FETCH_OBJ); 
            
            if (count($resultado) > 0) {
                return $resultado; 
            } else {
                return null; 
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    
}

