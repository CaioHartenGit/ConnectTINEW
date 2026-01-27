<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Painel - ConnectTI</title>
</head>
<body class="p-4">

<h2>Bem-vindo, <?php echo $_SESSION['user']; ?>!</h2>
<a href="logout.php" class="btn btn-danger mt-3">Sair</a>

</body>
</html>

