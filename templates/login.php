<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - ConnectTI</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../img/Logo ConnectTI.png">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS externo -->
    <link rel="stylesheet" href="../styles/login.css">
</head>

<body class="bg-light">

<div class="container mt-5 col-md-4">
    <h3 class="text-center mb-3">Entrar</h3>

    <form action="../Auth.php" method="POST" class="card p-4 shadow">
        <input type="email" name="email" class="form-control mb-3" placeholder="E-mail" required>
        <input type="password" name="senha" class="form-control mb-3" placeholder="Senha" required>

        <button class="btn btn-success w-100">Login</button>
    </form>

    <div class="text-center mt-3">
        <a href="#" data-bs-toggle="modal" data-bs-target="#emailModal">
            Esqueci minha senha
        </a>
    </div>

    <p class="text-center mt-3">
        Não tem conta? <a href="cadastro.php">Criar conta</a>
    </p>
</div>

<!-- MODAL EMAIL -->
<div class="modal fade" id="emailModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form id="formEmail">
                <div class="modal-header">
                    <h5 class="modal-title">Recuperar senha</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <label class="form-label">Digite seu e-mail</label>
                    <input type="email" id="emailRecuperacao" class="form-control" required>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary w-100">Enviar código</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- MODAL CÓDIGO -->
<div class="modal fade" id="codigoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="../recuperar_senha.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Nova senha</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" name="email" id="emailHidden">

                    <div class="mb-3">
                        <label>Código recebido</label>
                        <input type="text" name="codigo" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Nova senha</label>
                        <input type="password" name="nova_senha" class="form-control" required minlength="6">
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-success w-100">Alterar senha</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- JS externo -->
<script src="../scripts/recuperarSenha.js"></script>

</body>
</html>