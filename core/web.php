<?php
namespace Blog\Faculdade\Core;
require_once APP_ROOT . '/vendor/autoload.php';

use Blog\Faculdade\Controllers\HomeController;
use Blog\Faculdade\Controllers\PainelController;
  
   
$url = $_SERVER['REQUEST_URI'];
$url = strtok($url, '?');
$url = trim($url, '/');
$frontBlog = new HomeController();
$painel = new PainelController();

switch ($url) {
    case '':         
        $frontBlog->index();
        break;
    case 'sobre': 
        echo "Página Sobre";
        break;
    case 'painel':  
        $painel->index();
        break;
    default: 
        http_response_code(404);
        echo "Página não encontrada";
        break;
}