<?php 
    include APP_ROOT . '/src/Views/login/header.php';
?>


<main class="form-signin w-100 m-auto">
    <form action="/cadastro" method="post">
        <h1 class="h3 mb-3 fw-normal text-center">Cadastro de Usuário</h1>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingName" name="name" placeholder="Nome completo" required>
            <label for="floatingName">Nome completo</label>
        </div>

        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingEmail" name="email" placeholder="name@example.com" required>
            <label for="floatingEmail">E-mail</label>
        </div>

        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Senha" required>
            <label for="floatingPassword">Senha</label>
        </div> 

        <button class="btn btn-primary w-100 py-2" type="submit">Cadastrar</button>
        
        <div class="text-start my-3"> 
            <a href="/login">Já tem uma conta? Faça login</a>
        </div>
        
        <p class="mt-5 mb-3 text-body-secondary text-center">&copy; 2024–2024</p>
    </form>
</main>

   
<?php 
    include APP_ROOT . '/src/Views/login/footer.php';
?>