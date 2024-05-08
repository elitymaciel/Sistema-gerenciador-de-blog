<?php
namespace Blog\Faculdade\Controllers;
 
use DateTime;
use IntlDateFormatter;
use Blog\Faculdade\Models\Post;
use Blog\Faculdade\Models\Categoria;
use Blog\Faculdade\Controllers\Controller;

class PainelController extends Controller
{
    
    public function index() {
        
         if (!isset($_SESSION['nome'])) {
            header("Location:" . "/login"); 
         }
        
        $categorias = Categoria::listaCategoria();
        $posts = Post::consultaPosts();
        
        $formatacao = new IntlDateFormatter(
            'pt_BR',                
            IntlDateFormatter::LONG,  
            IntlDateFormatter::NONE   
        ); 
        

        require_once APP_ROOT . '/src/Views/painel/index.php';
    }

    public function criarNovoPost()
    { 
         
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST; 
            $novoNomeImagem = '';
            if (isset($_FILES['imagem'])) {
                $nome = $_FILES['imagem']['name'];
                $temporario = $_FILES['imagem']['tmp_name'];

                $extensao = pathinfo($nome, PATHINFO_EXTENSION);
                $novoNomeImagem = uniqid('img_', true) . '.' . $extensao;

                $destinoSalvaImagem = APP_ROOT .'/public/imagens/' . $novoNomeImagem;

                move_uploaded_file($temporario, $destinoSalvaImagem); 
            } 
                $post = new Post(); 
                $post->criarPublicacao($_SESSION['usuario_id'], $data['titulo'], date("Y-m-d"), $novoNomeImagem, $data['conteudo'], intval($data['categoria']));
              
        }
        header("Location:" . "/painel"); 
    }

    public function criarNovaCategoria()
    {
        $resultado = $_POST;

        $categoria = new Categoria();
        $categoria->criarCategoria($resultado['nome']);

        if ($categoria) {
            header("Location:" . "/painel"); 
        } 
    }

    public function getPost($id)
    {
        $posts = Post::consultaPost($id);
        
        echo json_encode($posts);
    }

    public function atualizarPost()
    {
        $resultado = $_POST;

        $image = null;

        if (isset($_FILES['imagem'])) {
            $nome = $_FILES['imagem']['name'];
            $temporario = $_FILES['imagem']['tmp_name'];

            $extensao = pathinfo($nome, PATHINFO_EXTENSION);
            $novoNomeImagem = uniqid('img_', true) . '.' . $extensao;

            $destinoSalvaImagem = APP_ROOT .'/public/imagens/' . $novoNomeImagem;

            move_uploaded_file($temporario, $destinoSalvaImagem); 
        }

        if ($resultado['categoria'] == '') {
            $resultado['categoria'] = '';
        } 

        $post = Post::atualizarPublicacao($resultado['id'], $resultado['titulo'], $resultado['conteudo'], $resultado['categoria']);
         
        if ($post) {
            header("Location:" . "/painel"); 
        } 
    }

    public function deletePost($post_id)
    {
        var_dump($post_id);
    }
}