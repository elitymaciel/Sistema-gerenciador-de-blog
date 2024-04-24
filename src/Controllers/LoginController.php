<?php
namespace Blog\Faculdade\Controllers;
 
use Blog\Faculdade\Models\Usuario;
use Blog\Faculdade\Controllers\Controller;

class LoginController extends Controller
{
    public function index() {
         
        require_once APP_ROOT . '/src/Views/login/index.php';
    }

    public function cadastroUsuario()
    { 
        $resultado = $_POST;

        if (!empty($resultado)) {
            $user = new Usuario();
            $user->criarUsuario($resultado['name'], $resultado['email'], $resultado['password'], 'asdfdf', 'asdf', 'administrador');
            
        } 
        

        require_once APP_ROOT . '/src/Views/login/cadastro.php';
    }
}