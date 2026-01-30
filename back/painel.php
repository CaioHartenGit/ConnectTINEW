<?php
session_start();

if (!isset($_SESSION['nome']) || !isset($_SESSION['tipo'])) {
    header("Location: login.php");
    exit;
}

$tipo = $_SESSION['tipo'];

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Painel - ConnectTI</title>
</head>
<body class="p-4">

<h2>Bem-vindo, <?php echo $_SESSION['nome']; ?>!</h2>

<?php if ($tipo === 'aluno'): ?>
    <p>Você está logado como <strong>Aluno</strong></p>
<?php else: ?>
    <p>Você está logado como <strong>Docente</strong></p>
<?php endif; ?>

<a href="index.php" class="btn btn-danger mt-3">Voltar ao início</a>

</body>
</html>
