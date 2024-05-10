<?php
namespace Blog\Faculdade\Controllers;
 
use DateTime;
use Exception;
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
         
                $destinoSalvaImagem = APP_ROOT . '/public/imagens/' . $novoNomeImagem;
         
                $novaLargura = 900;
                $novaAltura = 400;
         
                $imagemRedimensionada = imagecreatetruecolor($novaLargura, $novaAltura);
                imagefill($imagemRedimensionada, 0, 0, imagecolorallocate($imagemRedimensionada, 255, 255, 255)); // Fundo branco
         
                switch (strtolower($extensao)) {
                    case 'jpg':
                    case 'jpeg':
                        $imagemOriginal = imagecreatefromjpeg($temporario);
                        break;
                    case 'png':
                        $imagemOriginal = imagecreatefrompng($temporario);
                        break;
                    case 'gif':
                        $imagemOriginal = imagecreatefromgif($temporario);
                        break;
                    default:
                        throw new Exception("Tipo de imagem não suportado");
                }
         
                list($larguraOriginal, $alturaOriginal) = getimagesize($temporario);
         
                $proporcaoOriginal = $larguraOriginal / $alturaOriginal;
                $proporcaoNova = $novaLargura / $novaAltura;
        
                if ($proporcaoOriginal > $proporcaoNova) { 
                    $larguraRedimensionada = $novaLargura;
                    $alturaRedimensionada = intval($novaLargura / $proporcaoOriginal);
                    $posY = intval(($novaAltura - $alturaRedimensionada) / 2); 
                    $posX = 0;  
                } else { 
                    $alturaRedimensionada = $novaAltura;
                    $larguraRedimensionada = intval($novaAltura * $proporcaoOriginal);
                    $posX = intval(($novaLargura - $larguraRedimensionada) / 2); 
                    $posY = 0; 
                }
         
                imagecopyresampled($imagemRedimensionada, $imagemOriginal, $posX, $posY, 0, 0, $larguraRedimensionada, $alturaRedimensionada, $larguraOriginal, $alturaOriginal);
         
                switch (strtolower($extensao)) {
                    case 'jpg':
                    case 'jpeg':
                        imagejpeg($imagemRedimensionada, $destinoSalvaImagem, 100);  
                        break;
                    case 'png':
                        imagepng($imagemRedimensionada, $destinoSalvaImagem);
                        break;
                    case 'gif':
                        imagegif($imagemRedimensionada, $destinoSalvaImagem);
                        break;
                }
         
                imagedestroy($imagemRedimensionada);
                imagedestroy($imagemOriginal);
        
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
        $post = Post::excluirPublicacao($post_id);
        if ($post) {
            header("Location:" . "/painel");
        }
    }
}