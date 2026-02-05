<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

/* ===============================
   CONEXÃO
================================ */
$conn = new mysqli("localhost", "root", "", "connectti");
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

/* ===============================
   PROTEÇÃO
================================ */
if (!isset($_SESSION['id'], $_SESSION['tipo'])) {
    header("Location: login.php");
    exit;
}

$id   = (int)$_SESSION['id'];
$tipo = $_SESSION['tipo'];

/* ===============================
   BUSCAR USUÁRIO
================================ */
$tabela = ($tipo === 'aluno') ? 'aluno' : 'docentes';
$result = $conn->query("SELECT * FROM $tabela WHERE id = $id");

if (!$result || $result->num_rows === 0) {
    die("Usuário não encontrado");
}

$user = $result->fetch_assoc();

/* ===============================
   SALVAR PERFIL
================================ */
if (isset($_POST['salvar_perfil'])) {

    /* ===== FOTO ===== */
    if (!empty($_FILES['foto']['name'])) {

        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $permitidas = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($ext, $permitidas)) {

            $nomeArquivo = "{$tipo}_{$id}." . $ext;
            $caminhoRelativo = "img/perfis/" . $nomeArquivo;
            $caminhoFisico = __DIR__ . "/../" . $caminhoRelativo;

            move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoFisico);

            $conn->query("UPDATE $tabela SET foto='$caminhoRelativo' WHERE id=$id");
            $_SESSION['foto'] = $caminhoRelativo;
        }
    }

    /* ===== DADOS ===== */
    if ($tipo === 'aluno') {

        $nome  = $_POST['nome'];
        $email = $_POST['email'];
        $data  = $_POST['data_nascimento'];

        $conn->query("
            UPDATE aluno SET
                nome='$nome',
                email='$email',
                data_nascimento='$data'
            WHERE id=$id
        ");

        $_SESSION['nome']  = $nome;
        $_SESSION['email'] = $email;

    } else {

        $nome        = $_POST['nome_completo'];
        $email       = $_POST['email_profissional'];
        $formacao    = $_POST['formacao_academica'];
        $instituicao = $_POST['instituicao'];

        $conn->query("
            UPDATE docentes SET
                nome_completo='$nome',
                email_profissional='$email',
                formacao_academica='$formacao',
                instituicao='$instituicao'
            WHERE id=$id
        ");

        $_SESSION['nome']  = $nome;
        $_SESSION['email'] = $email;
    }

    header("Location: painel.php");
    exit;
}

/* ===============================
   ALTERAR SENHA
================================ */
if (isset($_POST['alterar_senha'])) {

    if (password_verify($_POST['senha_atual'], $user['senha'])) {

        $hash = password_hash($_POST['nova_senha'], PASSWORD_DEFAULT);
        $conn->query("UPDATE $tabela SET senha='$hash' WHERE id=$id");
        $msg = "Senha alterada com sucesso!";

    } else {
        $erro = "Senha atual incorreta!";
    }
}

/* ===============================
   FOTO ATUAL
================================ */
$fotoAtual = !empty($user['foto']) ? "../" . $user['foto'] : "../img/Logo ConnectTI.png";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Painel</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">
<div class="card shadow mx-auto" style="max-width:720px">
<div class="card-body p-4 position-relative">

<a href="index.php" class="btn btn-sm btn-outline-secondary position-absolute top-0 end-0 m-3">✕</a>

<h3 class="mb-4">Editar Perfil</h3>

<form method="post" enctype="multipart/form-data">
<input type="hidden" name="salvar_perfil">

<div class="text-center mb-4">
    <img src="<?= $fotoAtual ?>" class="rounded-circle mb-2"
         style="width:120px;height:120px;object-fit:cover">
    <input type="file" name="foto" class="form-control mt-2">
</div>

<?php if ($tipo === 'aluno'): ?>

<div class="mb-3">
<label>Nome</label>
<input type="text" name="nome" class="form-control" value="<?= $user['nome'] ?>">
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" value="<?= $user['email'] ?>">
</div>

<div class="mb-3">
<label>Data de nascimento</label>
<input type="date" name="data_nascimento" class="form-control" value="<?= $user['data_nascimento'] ?>">
</div>

<?php else: ?>

<div class="mb-3">
<label>Nome completo</label>
<input type="text" name="nome_completo" class="form-control" value="<?= $user['nome_completo'] ?>">
</div>

<div class="mb-3">
<label>Email profissional</label>
<input type="email" name="email_profissional" class="form-control" value="<?= $user['email_profissional'] ?>">
</div>

<div class="mb-3">
<label>Formação acadêmica</label>
<input type="text" name="formacao_academica" class="form-control" value="<?= $user['formacao_academica'] ?>">
</div>

<div class="mb-3">
<label>Instituição</label>
<input type="text" name="instituicao" class="form-control" value="<?= $user['instituicao'] ?>">
</div>

<div class="mb-3">
<label>Registro acadêmico</label>
<input type="text" class="form-control" value="<?= $user['registro_academico'] ?>" disabled>
</div>

<?php endif; ?>

<button class="btn btn-primary w-100">Salvar alterações</button>
</form>

<hr>

<button class="btn btn-outline-danger w-100" data-bs-toggle="modal" data-bs-target="#senhaModal">
Alterar senha
</button>

<?php if(isset($msg)): ?>
<div class="alert alert-success mt-3"><?= $msg ?></div>
<?php endif; ?>

<?php if(isset($erro)): ?>
<div class="alert alert-danger mt-3"><?= $erro ?></div>
<?php endif; ?>

</div>
</div>
</div>

<!-- MODAL SENHA -->
<div class="modal fade" id="senhaModal">
<div class="modal-dialog">
<div class="modal-content">

<form method="post">
<input type="hidden" name="alterar_senha">

<div class="modal-header">
<h5>Alterar senha</h5>
<button class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
<input type="password" name="senha_atual" class="form-control mb-2" placeholder="Senha atual" required>
<input type="password" name="nova_senha" class="form-control" placeholder="Nova senha" required>
</div>

<div class="modal-footer">
<button class="btn btn-primary w-100">Salvar</button>
</div>

</form>

</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
