<!DOCTYPE html>
<html lang="pt-BR">
<head>
         <!-- Se for PNG -->
<link rel="icon" type="image/png" href="Logo ConnectTI.png">
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login - ConnectTI</title>
</head>
<body class="bg-light">

<div class="container mt-5 col-md-4">
    <h3 class="text-center mb-3">Entrar</h3>

    <form action="Auth.php" method="POST" class="card p-4 shadow">
        <input type="email" name="email" class="form-control mb-3" placeholder="E-mail" required>
        <input type="password" name="senha" class="form-control mb-3" placeholder="Senha" required>
        <button class="btn btn-success w-100">Login</button>
    </form>

    <p class="text-center mt-3">
        Não tem conta? <a href="cadastro.php">Criar conta</a>
    </p>
</div>

</body>
</html>

