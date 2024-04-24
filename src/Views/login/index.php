<?php 
    include APP_ROOT . '/src/Views/login/header.php';
?>


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
   
<?php 
    include APP_ROOT . '/src/Views/login/footer.php';
?>