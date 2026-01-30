<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - ConnectTI</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="Logo ConnectTI.png">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5 col-md-4">
    <h3 class="text-center mb-4">Criar Conta</h3>

    <form action="Backend.php" method="POST" class="card p-4 shadow">

        <!-- =====================
             DADOS DO ALUNO
        ====================== -->
        <div id="alunoFields">

            <input type="text"
                   name="nome"
                   class="form-control mb-3"
                   placeholder="Seu nome">

            <input type="email"
                   name="email"
                   class="form-control mb-3"
                   placeholder="Seu e-mail">

            <input type="password"
                   name="senha_aluno"
                   class="form-control mb-3"
                   placeholder="Senha">

            <input type="date"
                   name="data_nascimento"
                   class="form-control mb-3">
        </div>

        <!-- Checkbox docente -->
        <div class="form-check mb-3">
            <input class="form-check-input"
                   type="checkbox"
                   id="docenteCheck"
                   name="docente">
            <label class="form-check-label fw-semibold" for="docenteCheck">
                Você é docente?
            </label>
        </div>

        <!-- =====================
             DADOS DO DOCENTE
        ====================== -->
        <div id="docenteFields" style="display: none;">

            <hr>

            <input type="text"
                   name="nome_completo"
                   class="form-control mb-3"
                   placeholder="Nome completo">

            <input type="password"
                   name="senha_docente"
                   class="form-control mb-3"
                   placeholder="Senha">

            <input type="text"
                   name="formacao"
                   class="form-control mb-3"
                   placeholder="Formação acadêmica">

            <input type="email"
                   name="email_profissional"
                   id="emailProfissional"
                   class="form-control mb-3"
                   placeholder="E-mail profissional">

            <input type="text"
                   name="registro"
                   id="registro"
                   class="form-control mb-3"
                   placeholder="Registro acadêmico (8 dígitos)">

            <input type="text"
                   name="instituicao"
                   class="form-control mb-3"
                   placeholder="Instituição que ensina">
        </div>

        <button class="btn btn-primary w-100 mt-2">
            Cadastrar
        </button>
    </form>

    <p class="text-center mt-3">
        Já tem conta? <a href="login.php">Entrar</a>
    </p>
</div>

<!-- =====================
     JAVASCRIPT
====================== -->
<script>
    const docenteCheck   = document.getElementById('docenteCheck');
    const docenteFields  = document.getElementById('docenteFields');
    const alunoFields    = document.getElementById('alunoFields');
    const emailProf      = document.getElementById('emailProfissional');
    const registro       = document.getElementById('registro');

    docenteCheck.addEventListener('change', () => {

        if (docenteCheck.checked) {
            docenteFields.style.display = 'block';
            alunoFields.style.display   = 'none';

            emailProf.required = true;
            registro.required  = true;
        } else {
            docenteFields.style.display = 'none';
            alunoFields.style.display   = 'block';

            emailProf.required = false;
            registro.required  = false;
        }
    });
</script>

</body>
</html>