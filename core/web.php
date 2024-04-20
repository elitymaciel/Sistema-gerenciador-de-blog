<?php

use Blog\Faculdade\Controllers\HomeController;
  
require_once APP_ROOT . '/vendor/autoload.php';
   
$url = $_SERVER['REQUEST_URI'];
$url = strtok($url, '?');
$url = trim($url, '/');
 
switch ($url) {
    case '': 
        $homeController = new HomeController();
        $homeController->index();
        break;
    case 'sobre': 
        echo "Página Sobre";
        break;
    default: 
        http_response_code(404);
        echo "Página não encontrada";
        break;
}