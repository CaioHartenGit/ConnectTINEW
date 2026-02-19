<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - ConnectTI</title>

    <link rel="icon" type="image/png" href="../img/Logo ConnectTI.png">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="../styles/cadastro.css">
</head>

<body class="bg-light">

<div class="container mt-5 col-md-4">
    <h3 class="text-center mb-4">Criar Conta</h3>

    <form action="../Backend.php" method="POST" class="card p-4 shadow">

        <!-- ALUNO -->
        <div id="alunoFields">
            <input type="text" name="nome" class="form-control mb-3" placeholder="Seu nome">
            <input type="email" name="email" class="form-control mb-3" placeholder="Seu e-mail">
            <input type="password" name="senha_aluno" class="form-control mb-3" placeholder="Senha">
            <input type="date" name="data_nascimento" class="form-control mb-3">
        </div>

        <!-- DOCENTE CHECK -->
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="docenteCheck" name="docente">
            <label class="form-check-label fw-semibold">Você é docente?</label>
        </div>

        <!-- DOCENTE -->
        <div id="docenteFields" style="display:none;">
            <hr>

            <input type="text" name="nome_completo" class="form-control mb-3" placeholder="Nome completo">
            <input type="password" name="senha_docente" class="form-control mb-3" placeholder="Senha">
            <input type="text" name="formacao" class="form-control mb-3" placeholder="Formação acadêmica">
            <input type="email" name="email_profissional" id="emailProfissional" class="form-control mb-3" placeholder="E-mail profissional">
            <input type="text" name="registro" id="registro" class="form-control mb-3" placeholder="Registro acadêmico">
            <input type="text" name="instituicao" class="form-control mb-3" placeholder="Instituição">
        </div>

        <button class="btn btn-primary w-100 mt-2">Cadastrar</button>
    </form>

    <p class="text-center mt-3">
        Já tem conta? <a href="login.php">Entrar</a>
    </p>
</div>

<script src="../scripts/cadastro.js"></script>
</body>
</html>