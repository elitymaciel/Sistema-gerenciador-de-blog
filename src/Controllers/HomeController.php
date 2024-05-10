<?php
namespace Blog\Faculdade\Controllers;

use DateTime;
use IntlDateFormatter;
use Blog\Faculdade\Models\Post;
use Blog\Faculdade\Models\Usuario;
use Blog\Faculdade\Models\Categoria;
use Blog\Faculdade\Controllers\Controller;

class HomeController extends Controller
{
   

    public function index() {
        
        $categorias = [];

        $resultados = Categoria::listaCategoria();

        foreach ($resultados as $resultado) {
            $categorias[] = $resultado->nome;
        } 
        $posts = Post::consultaPostsFront();
        require_once APP_ROOT . '/src/Views/front/index.php';
    }

    public function visualizarPost($postId)
    { 
        $formatacao = new IntlDateFormatter(
            'pt_BR',                
            IntlDateFormatter::LONG,  
            IntlDateFormatter::NONE   
        );
        $post = Post::consultaPost($postId);
        $data = new DateTime($post->data_criacao);

        require_once APP_ROOT . '/src/Views/front/post.php';
    }
}