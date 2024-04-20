<?php
namespace Blog\Faculdade\Controllers;

use Blog\Faculdade\Models\Usuario;

class HomeController {
    public function index() {
        $title = "Página Inicial";
        $message = "Bem-vindo à Página Inicial!";
        /* $user = new Usuario();
        print_r($user->getUsuarioById(1)); */

        require_once APP_ROOT . '/src/Views/front/index.php';
    }
}