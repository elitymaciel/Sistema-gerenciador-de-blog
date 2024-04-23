<?php
namespace Blog\Faculdade\Controllers;
 
use Blog\Faculdade\Controllers\Controller;

class LoginController extends Controller
{
    public function index() {
         
        require_once APP_ROOT . '/src/Views/login/index.php';
    }

    public function cadastroUsuario()
    {
        require_once APP_ROOT . '/src/Views/login/cadastro.php';
    }
}