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
                    foreach ($categorias as $categoria): 
                    ?>
                        <div class="col-lg-4">

                            <div class="dash_content_app_box">
                                <section class="app_blog_home">

                                    <article>
                                        <div class="cover embed radius">
                                            <img src="imagens/<?= $categoria->image ?>" alt="">
                                        </div>
                                        <h3 class="tittle">
                                            <a target="_blank" href="../"><?= $categoria->titulo ?></a>
                                        </h3>

                                        <div class="info">
                                            <p class="icon-clock-o"><!-- <?= $categoria->data_criacao ?> --> 22.10.19 às 14h22</p>
                                            <p class="icon-bookmark"><!-- <?= $categoria->categoria_id ?> --> categoria</p>
                                            <p class="icon-user"><?= $_SESSION['nome'] ?> </p>
                                            <p class="icon-bar-chart">P-00<?= $categoria->id ?></p>
                                        </div>

                                        <div class="actions">
                                            <a class="btn btn-primary botao" href="" title="">Editar</a>
                                            <a class="btn btn-danger botao" href="" title="">Deletar</a>
                                        </div>
                                    </article>

                                </section>
                            </div>

                        </div>
                    <?php
                    endforeach
                    ?>
                </div>
                <!-- <card class="app_blog_home">
                        <article>
                            
                        </article>
                    </section> -->
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
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    <li><a href="#!">Web Design</a></li>
                                    <li><a href="#!">HTML</a></li>
                                    <li><a href="#!">Freebies</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    <li><a href="#!">JavaScript</a></li>
                                    <li><a href="#!">CSS</a></li>
                                    <li><a href="#!">Tutorials</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Side widget-->
                <div class="card mb-4">
                    <div class="card-header">Side Widget</div>
                    <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
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
</body>

</html>