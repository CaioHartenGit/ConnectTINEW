<!DOCTYPE html>
<html lang="pt-BR">
<head>
         <!-- Se for PNG -->
<link rel="icon" type="image/png" href="Logo ConnectTI.png">
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cadastro - ConnectTI</title>
</head>
<body class="bg-light">

<div class="container mt-5 col-md-4">
    <h3 class="text-center mb-3">Criar Conta</h3>

 

    <form action="Backend.php" method="POST" class="card p-4 shadow">
        <input type="text" name="nome" class="form-control mb-3" placeholder="Seu nome" required>
        <input type="email" name="email" class="form-control mb-3" placeholder="Seu e-mail" required>
        <input type="password" name="senha" class="form-control mb-3" placeholder="Senha" required>
        <input type="date" name="data_nascimento" class="form-control mb-3" required>
        <button class="btn btn-primary w-100">Cadastrar</button>
    </form>

    <p class="text-center mt-3">
        Já tem conta? <a href="login.php">Entrar</a>
    </p>
</div>

</body>
</html>