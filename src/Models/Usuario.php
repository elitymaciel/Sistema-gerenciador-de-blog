<?php
namespace Blog\Faculdade\Models;

use Blog\Faculdade\Core\Database;
use PDO;
use PDOException;

class Usuario {
    private $db;

    public function __construct()
    {
        /* uso o metro magico __contruct() para iniciar na variavel minha 
        class Database passando na variavel db para ser usada em qualquer local do meu codigo */
        $this->db = new Database();
    }

    public function criarUsuario($nome, $email, $senha, $endereco, $cidade, $permissao)
    {
        $conn = $this->db->getConnection();

        /* inicio o try catch, para garantir q qualquer execute o codigo exeperado e me retornar qualquer erro q ocorre dentro do try */
        try {
            /* com a conexao com o banco iniciada prepara o insert na variavel criarUsuario com o seguinte cod SQL */
            $criarUsuario = $conn->prepare("INSERT INTO usuarios (nome, email, senha, endereco, cidade, permissao) VALUES (:nome, :email, :senha, :endereco, :cidade, :permissao)");
            
            /* uso um metodo do php para criptografar a senha antes de salvar no banco e armazeno em password */
            $password = password_hash($senha, PASSWORD_DEFAULT);
            
            /* apos prepara a variavel com o cod mysql, pego a função bindParam 
            e passo os cod SQL e as variavel com os dados q ira remontar o codigo SQL com os dados q eu fornecer*/
            $criarUsuario->bindParam(':nome', $nome);
            $criarUsuario->bindParam(':email', $email);
            $criarUsuario->bindParam(':senha', $password);
            $criarUsuario->bindParam(':endereco', $endereco);
            $criarUsuario->bindParam(':cidade', $cidade);
            $criarUsuario->bindParam(':permissao', $permissao);

            /* Apos monta novamente o coddido SQL com os dados q eu quero eu uso a função execute pra percorre no banco de dados */
            $criarUsuario->execute(); 

            /* se executar a corretamente o codigo continua e retorna o resultado para a function o id do cadastro */
            return $conn->lastInsertId();

        } catch(PDOException $e) {
            /* retorna na function o erro q ocorreu no codigo q esta entre o try  */
            return $e->getMessage();
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
            return $e->getMessage();
        }
    }

    static function where($tabela, $parametro, $valor)
    { 
            $database = new Database();
            $conn = $database->getConnection();
        
            try {
                $consulta = $conn->prepare("SELECT * FROM $tabela WHERE $parametro = :$parametro");
                $consulta->bindParam(':' . $parametro, $valor);
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
}