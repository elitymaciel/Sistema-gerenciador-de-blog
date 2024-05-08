<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $this->title ?></title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/post.css" rel="stylesheet" />

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#!"><?= $this->title ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">Recentes</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="/login">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <?php   
                    foreach ($posts as $post):
                ?>
                <div class="post-body" style=" color: red;">
                    <div class="img_post embed">
                        <img src="imagens/<?= $post->image ?>" alt="">
                    </div>
                    <div class="titulo">
                        <h2>
                            <a href="post/<?= $post->id ?>" class="">
                                <p><?=  substr($post->titulo, 0, 45 - 3) . " ..." ?></p>
                            </a>
                        </h2>
                        <div class="categoria mt-4">
                            <?= $post->categoria ?>
                        </div>
                        <div class="date mt-3 ">
                            <?= $post->usuario ?> - <?=  $post->data_criacao  ?>
                        </div>
                    </div>
                </div>
                <hr>
                <?php 
                    endforeach;
                ?>
                <!-- <section class="mb-5">
                        <div class="card bg-light">
                            <div class="card-body">
                                 <form class="mb-4"><textarea class="form-control" rows="3" placeholder="Join the discussion and leave a comment!"></textarea></form>
                                 <div class="d-flex mb-4">
                                    <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                    <div class="ms-3">
                                        <div class="fw-bold">Commenter Name</div>
                                        If you're going to lead a space frontier, it has to be government; it'll never be private enterprise. Because the space frontier is dangerous, and it's expensive, and it has unquantified risks.
                                          <div class="d-flex mt-4">
                                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                            <div class="ms-3">
                                                <div class="fw-bold">Commenter Name</div>
                                                And under those conditions, you cannot establish a capital-market evaluation of that enterprise. You can't get investors.
                                            </div>
                                        </div>
                                         <div class="d-flex mt-4">
                                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                            <div class="ms-3">
                                                <div class="fw-bold">Commenter Name</div>
                                                When you put money directly to a problem, it makes a good headline.
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="d-flex">
                                    <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                    <div class="ms-3">
                                        <div class="fw-bold">Commenter Name</div>
                                        When I look at the universe and all the ways the universe wants to kill us, I find it hard to reconcile that with statements of beneficence.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section> -->
            </div>
            <div class="col-lg-4"> 
                <div class="card mb-4">
                    <div class="card-header">Categories</div>
                    <div class="card-body">
                        <div class="row">
                            <?php 
                                $divideConsulta = ceil(count($categorias) / 2);
                                $coluna1 = array_slice($categorias, 0, $divideConsulta);
                                $coluna2 = array_slice($categorias, $divideConsulta);  
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
                <div class="card mb-4">
                    <div class="card-header">Criadores</div>
                    <div class="card-body">
                        usuarios
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; <?= $this->footer ?> - 2024</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>