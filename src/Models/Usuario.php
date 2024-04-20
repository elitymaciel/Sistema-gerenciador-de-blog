<?php
namespace Blog\Faculdade\Models;

use Blog\Faculdade\Core\Database;
use PDO;
use PDOException;

class Usuario {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function criarUsuario($nome, $email, $senha, $endereco, $cidade)
    {
        $conn = $this->db->getConnection();

        try {
            $criarUsuario = $conn->prepare("INSERT INTO usuarios (nome, email, senha, endereco, cidade) VALUES (:nome, :email, :senha, :endereco, :cidade)");
            
            $criarUsuario->bindParam(':username', $nome);
            $criarUsuario->bindParam(':email', $email);
            $criarUsuario->bindParam(':password', $senha);
            $criarUsuario->bindParam(':endereco', $endereco);
            $criarUsuario->bindParam(':cidade', $cidade);
 
            $criarUsuario->execute(); 
            return $conn->lastInsertId();
        } catch(PDOException $e) {
            return $e;
        }
    }

    public function getUsuarioById($usuario_id)
    {
        $conn = $this->db->getConnection();

        try {
            $consulta = $conn->prepare("SELECT * FROM usuarios WHERE id = :id");
 
            $consulta->bindParam(':id', $usuario_id);
 
            $consulta->execute();
 
            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e;
        }
    }
}