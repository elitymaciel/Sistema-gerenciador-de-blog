<?php
namespace Blog\Faculdade\Core; 

use Blog\Faculdade\Controllers\HomeController;
use Blog\Faculdade\Controllers\LoginController;
use Blog\Faculdade\Controllers\PainelController;
  
   
$url = $_SERVER['REQUEST_URI'];
$url = strtok($url, '?');
$url = trim($url, '/');

$url_parts = explode('/', trim($url, '/')); // Divide a URL pelo '/', removendo '/' do início/fim
$main_part = isset($url_parts[0]) ? $url_parts[0] : '';
 

$frontBlog = new HomeController();
$painel = new PainelController();
$login = new LoginController();
 
switch ($main_part) {
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
    
    case 'painel':  
        $painel->index();
        break;
    case 'cadastro':
        if (isset($url_parts[1])) {
            if ($url_parts[1] == 'post') {
                if (isset($url_parts[2])) {
                    if ($url_parts[2] == 'atualizar') { 
                        $painel->atualizarPost();
                    } elseif ($url_parts[2] == 'excluir') {
                        $post_id = (int) $url_parts[3];
                        $painel->deletePost($post_id);
                    } 
                } 
                $painel->criarNovoPost();
            } elseif ($url_parts[1] == 'categoria') {
                $painel->criarNovaCategoria();
            } elseif ($url_parts[1] == 'usuario') {
                 $login->cadastroUsuario();   
            }
        } 
        break;
    case 'post':
        if (isset($url_parts[1])) {
           
            $post_id = (int) $url_parts[1];
            $frontBlog->visualizarPost($post_id);
        } else {
            http_response_code(404);
            echo "Post não encontrado";
        }
        break;
    case 'consulta':
        if (isset($url_parts[1])) {
            if ($url_parts[1] == 'post') { 
                $painel->getPost($url_parts[2]);
            }
        }
        break;
    default: 
        http_response_code(404);
        echo "Página não encontrada";
        break;
}