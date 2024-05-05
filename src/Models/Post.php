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
}

