<?php
namespace Blog\Faculdade\Controllers;

class HomeController {
    public function index() {
        $title = "Página Inicial";
        $message = "Bem-vindo à Página Inicial!";

        require_once APP_ROOT . '/src/Views/front/index.php';
    }
}