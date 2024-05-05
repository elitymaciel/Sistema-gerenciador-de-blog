<?php
namespace Blog\Faculdade\Controllers;
 
use Blog\Faculdade\Models\Usuario; 

class LoginController
{

    public $title = "";
    public $message = "";
    public $footer = "";

    public function __construct()
    {
        $this->title = "login";
        $this->message = "Noticias e tecnologia";
        $this->footer = "Paper UNIASSELVI -  Análise e Desenvolvimento de Sistemas (5016105)";
    }
    public function index() {
         
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['senha'];

            $usuario = Usuario::where('usuarios', 'email', $email);
             
             
            if ($usuario && password_verify($password, $usuario->senha)) { 
                $_SESSION['usuario_id'] = $usuario->id;
                $_SESSION['nome'] = $usuario->nome;

                header("Location: " . '/painel');
            } else {
                echo "E-mail ou senha incorretos.";
            }
        }

        require_once APP_ROOT . '/src/Views/login/index.php';
    }

    public function cadastroUsuario()
    { 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            /* Pega os inputs enviado via post e armazena na variavel resultados */
            $resultado = $_POST;

            /* Instancia a class Usuario e chama a função criaUsuario e  passa os 
            paramentro na ordem para criar um novo usuario e seta com permisao visitante */
            $user = new Usuario();
            $user->criarUsuario($resultado['name'], $resultado['email'], $resultado['password'], 'asdfdf', 'asdf', 'visitante');
            
            header("Location:" . "/login");
        }

        /* caso n entre na condição do if, e quando recebe um metodo post abre a pagina de cadastro */
        require_once APP_ROOT . '/src/Views/login/cadastro.php';
    }

    public function logout()
    { 
        /* usa o comando destroy para garantir q seja limpo todos so dados */
        session_destroy();

        /* redireciona para a rota login se tudo ocorre com sucesso */
        header("Location:" . "/login"); 
    }
 
}