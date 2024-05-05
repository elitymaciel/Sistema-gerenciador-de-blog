<?php

namespace Blog\Faculdade\Models;

use Blog\Faculdade\Core\Database;
use PDO;
use PDOException;

class Post {
    private $db;

    public function __construct()
    { 
        $this->db = new Database();
    }

    public function criarPublicacao($usuario_id, $titulo, $data_criacao, $image, $conteudo, $categoria_id)
    {
        $conn = $this->db->getConnection();
 
        try {  
            $criarNovaPublicacao = $conn->prepare("INSERT INTO posts (usuario_id, titulo, data_criacao, image, conteudo, categoria_id) 
                                            VALUES (:usuario_id, :titulo, :data_criacao, :image, :conteudo, :categoria_id)");
               
            $criarNovaPublicacao->bindParam(':usuario_id', $usuario_id);
            $criarNovaPublicacao->bindParam(':titulo', $titulo);
            $criarNovaPublicacao->bindParam(':data_criacao', $data_criacao);
            $criarNovaPublicacao->bindParam(':image', $image);
            $criarNovaPublicacao->bindParam(':conteudo', $conteudo);
            $criarNovaPublicacao->bindParam(':categoria_id', $categoria_id);
             
            $criarNovaPublicacao->execute(); 
 
            return $conn->lastInsertId();

        } catch(PDOException $e) { 
            return $e->getMessage();
        }
    }
    static public function consultaPosts()
    { 
        $database = new Database();
        $conn = $database->getConnection();
 
        try {
            $consulta = $conn->prepare("SELECT U.nome as usuario, C.nome as categoria, P.*
                                        FROM `posts` as P
                                        JOIN usuarios as U ON P.usuario_id = U.id
                                        JOIN categorias as C ON P.categoria_id = C.id
                                        "); 
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

