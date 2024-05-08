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

    static public function consultaPost($postId)
    {
        $database = new Database();
        $conn = $database->getConnection();
 
        try {
            $consulta = $conn->prepare("SELECT U.nome as usuario, C.nome as categoria, P.*
                                        FROM `posts` as P
                                        JOIN usuarios as U ON P.usuario_id = U.id
                                        JOIN categorias as C ON P.categoria_id = C.id
                                        WHERE P.id = $postId "); 
            $consulta->execute();
    
            $resultado = $consulta->fetchAll(PDO::FETCH_OBJ); // Obter resultado como objetos
            
            if (count($resultado) > 0) {
                return $resultado[0]; // Retornar o resultado da consulta
            } else {
                return null; // Sem resultados
            }
        } catch (PDOException $e) {
            return $e->getMessage(); // Em caso de exceção
        }
    }

    static function atualizarPublicacao($post_id, $titulo, $conteudo, $categoria_id)
    {
        $database = new Database();
        $conn = $database->getConnection();
        /* UPDATE `posts` SET  `titulo`='Temporal nod',`data_criacao`=null ,`image`=null,`conteudo`='asasdf',`categoria_id`=null WHERE id = 5*/
        try {  
            $criarNovaPublicacao = $conn->prepare("UPDATE posts
                                                SET  titulo = :titulo, conteudo = :conteudo , categoria_id = :categoria_id
                                                WHERE id = :id"); 
            $criarNovaPublicacao->execute(array(
                ':id'   => $post_id,
                ':titulo' => $titulo,
                ':conteudo'	 => $conteudo,
                ':categoria_id'	 => $categoria_id
              ));
            
            echo $criarNovaPublicacao->rowCount();

        } catch(PDOException $e) { 
            return $e->getMessage();
        }
    }

    static function excluirPublicacao($post_id)
    {
        $database = new Database();
        $conn = $database->getConnection();

        try {  
            $excluirPublicacao = $conn->prepare("DELETE FROM posts WHERE id = :id"); 
            $excluirPublicacao->execute(array(
                ':id'   => $post_id, 
              )); 
            echo $excluirPublicacao->rowCount();

        } catch(PDOException $e) { 
            return $e->getMessage();
        }
    }
}

