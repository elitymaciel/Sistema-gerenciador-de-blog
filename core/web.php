<?php
namespace Blog\Faculdade\Core; 

use Blog\Faculdade\Controllers\HomeController;
use Blog\Faculdade\Controllers\LoginController;
use Blog\Faculdade\Controllers\PainelController;
  
   
$url = $_SERVER['REQUEST_URI'];
$url = strtok($url, '?');
$url = trim($url, '/');
$frontBlog = new HomeController();
$painel = new PainelController();
$login = new LoginController();

switch ($url) {
    case '':       
        $frontBlog->index();
        break;
    case 'sobre': 
        echo "Página Sobre";
        break;
    case 'login': 
        $login->index();
        break; 
    case 'logout':
        $login->logout();
        break; 
    case 'cadastro': 
        $login->cadastroUsuario();
        break; 
    case 'painel':  
        $painel->index();
        break;
    case 'cadastro/post':  
        $painel->criarNovoPost();
        break;
    case 'cadastro/categoria':  
        $painel->criarNovaCategoria();
        break;
    default: 
        http_response_code(404);
        echo "Página não encontrada";
        break;
}