<!doctype html>
<html lang="en" data-bs-theme="auto">

<head> 

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistema gerenciador de blog">
    <meta name="author" content="Maciel, Gabriel, Jhonnata, Saulo, Gabriel"> 
    <title><?= $this->title ?></title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sign-in.css" rel="stylesheet">
  
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signin w-100 m-auto">
        <form> 
            <h1 class="h3 mb-3 fw-normal text-center ">LOGIN</h1>

            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Digite seu e-mail</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Digite sua senha</label>
            </div> 
            <button class="btn btn-primary w-100 py-2" type="submit">Entrar</button>
            <div class="text-start my-3"> 
                 <a href="/cadastro">Fazer cadastro</a>
            </div>
            <p class="mt-5 mb-3 text-body-secondary text-center">&copy; 2024–2024</p>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>