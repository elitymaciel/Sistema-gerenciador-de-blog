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

    static public function consulta()
    { 
        $database = new Database();
        $conn = $database->getConnection();

        $usuario = $_SESSION['usuario_id'];
        
        try {
            $consulta = $conn->prepare("SELECT * FROM `posts` WHERE `usuario_id` = $usuario"); 
            $consulta->execute();
    
            $resultado = $consulta->fetchAll(PDO::FETCH_OBJ); // Obter resultado como objetos
            
            if (count($resultado) > 0) {
                return $resultado; // Retornar o resultado da consulta
            } else {
                return null; // Sem resultados
            }
        } catch (PDOException $e) {
            return $e->getMessage(); // Em caso de exceção
        }
    }
}

