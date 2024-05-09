<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Painel</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/card.css" rel="stylesheet" />
    <link rel="stylesheet" href="tinymce/skins/light/skin.min.css">
</head>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#!">Painel de Gerenciamento</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="/logout"><?= $_SESSION['nome'] ?></a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="/logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <?php
                    if (!empty($posts)){
                    foreach ($posts as $post):
                    $data = new DateTime($post->data_criacao);
                    ?>
                        <div class="col-lg-4">

                            <div class="dash_content_app_box">
                                <section class="app_blog_home">

                                    <article>
                                        <div class="cover embed radius">
                                            <img src="imagens/<?= $post->image ?>" alt="">
                                        </div>
                                        <h3 class="tittle">
                                            <a target="_blank" href="post/<?= $post->id ?>"><?= $post->titulo ?></a>
                                        </h3>

                                        <div class="info">
                                            <p class="icon-clock-o"> <?= $formatacao->format($data)  ?> </p>
                                            <p class="icon-bookmark"> <?= $post->categoria ?> </p>
                                            <p class="icon-user"> <?= $post->usuario ?> </p>
                                            <p class="icon-bar-chart">P-00<?= $post->id ?></p>
                                        </div>

                                        <div class="actions">
                                        <button type="button" class="btn btn-primary botao" data-whatever="<?= $post->id ?>" data-bs-toggle="modal" data-bs-target="#modalEditar">
                                            Editar
                                        </button> 
                                            <a class="btn btn-danger botao" href="/cadastro/post/excluir/<?=  $post->id ?>" title="">Deletar</a>
                                        </div>
                                    </article>

                                </section>
                            </div>

                        </div>
                    <?php
                    endforeach; 
                        }else{
                            echo "<h1>Não possuir posts criados</h1>";
                        }; 
                    ?>
                </div> 
            </div>
            <!-- Side widgets-->
            <div class="col-lg-4">
                <!-- Search widget-->
                <div class="card mb-4">
                    <div class="card-body ">
                        <div class="input-group d-flex justify-content-center ">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Criar novo Post
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Categories widget-->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between"> Categories
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoria2">
                            +
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        <?php 
                        $categoriasPainel = []; 

                        foreach ($categorias as $resultado) {
                            $categoriasPainel[] = $resultado->nome;
                        } 
                                $divideConsulta = ceil(count($categoriasPainel) / 2);
                                $coluna1 = array_slice($categoriasPainel, 0, $divideConsulta);
                                $coluna2 = array_slice($categoriasPainel, $divideConsulta);  
                            ?>
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    <?php foreach ($coluna1 as $categoria): ?>
                                        <li><a href="#!"><?= htmlspecialchars($categoria) ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    <?php foreach ($coluna2 as $categoria): ?>
                                        <li><a href="#!"><?= htmlspecialchars($categoria) ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nova publicação</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="/cadastro/post" method="POST" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <label for="titulo" class="form-label">Titulo</label>
                            <input type="text" class="form-control" id="titulo" name="titulo">
                        </div>
                        <div class="col-6">
                            <label for="imagem" class="form-label">Imagem</label>
                            <input type="file" name="imagem" class="form-control" id="imagem" placeholder="1234 Main St">
                        </div>
                        <div class="col-6">
                            <label for="categoria" class="form-label">Categoria</label>
                            <select name="categoria" id="categoria" class="form-control">
                                <option value="" selected>Selecione uma categoria</option>
                                <?php foreach ($categorias as $categoria) {  ?>
                                    <option value="<?= $categoria->id ?>"><?= $categoria->nome ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="label">
                                <span class="legend">*Conteúdo:</span>
                                <textarea class="mce" name="conteudo"></textarea>
                            </label>
                        </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Sair</button>
                    <button type="submit" class="btn btn-primary">Publicar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Publicação</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formularioEditar" action="/cadastro/post/atualizar" method="POST" enctype="multipart/form-data"">
                        <div class="row"> 

                        <input type="hidden" name="id" id="id_post">
                        <div class="col-md-12">
                            <label for="titulo" class="form-label">Titulo</label>
                            <input type="text" class="form-control" id="tituloEditar" name="titulo">
                        </div>
                        <div class="col-6 mt-4">
                            <label for="imagem" class="form-label">Imagem</label>
                            <input type="file" name="imagem" class="form-control" id="imagemEditar">
                        </div>
                        <div class="col-6 mt-4">
                            <label for="categoria" class="form-label">Categoria</label>
                            <select name="categoria" id="categoriaEditar" class="form-control">
                                <option value="" selected>Selecione uma categoria</option>
                                <?php foreach ($categorias as $categoria) {  ?>
                                    <option value="<?= $categoria->id ?>"><?= $categoria->nome ?></option>
                                <?php } ?>
                            </select>
                        </div> 
                        <div class="col-md-12 mt-4">
                            <label class="label">
                                <span class="legend">*Conteúdo:</span> 
                            </label>
                            <textarea class="mce" name="conteudo" id="conteudoEditar"> </textarea>
                        </div>
                        </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Sair</button>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="categoria2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Criar Nova Categoria</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/cadastro/categoria" method="post">
                        <div class="col-md-12">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sair</button>
                    <button type="submit" class="btn btn-primary">Criar</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="tinymce/tinymce.min.js"></script>
    <script src="js/scripts.js"></script>
    <script>
        $('#modalEditar').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)  
            var id = button.data('whatever')

            $.get("/consulta/post/"+id, function(resultado){
                const tranformandoResultadoJson = JSON.parse(resultado);
                document.getElementById("id_post").value = tranformandoResultadoJson.id
                document.getElementById("tituloEditar").value = tranformandoResultadoJson.titulo;  
                tinyMCE.get('conteudoEditar').getBody().innerHTML = tranformandoResultadoJson.conteudo; 
            }) 
             
        })
    </script>
</body>

</html>