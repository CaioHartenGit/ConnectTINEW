<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "connectti");
if ($conn->connect_error) {
    die("Erro de conexão");
}

$email      = $_POST['email'] ?? '';
$codigo     = $_POST['codigo'] ?? '';
$novaSenha  = $_POST['nova_senha'] ?? '';

/* ===============================
   1️⃣ GERAR CÓDIGO
================================ */
if ($email && !$codigo && !$novaSenha) {

    $codigoGerado = rand(100000, 999999);

    $conn->query("DELETE FROM recuperar_senha WHERE email='$email'");

    $conn->query("
        INSERT INTO recuperar_senha (email, codigo)
        VALUES ('$email', '$codigoGerado')
    ");

    echo "
    <script>
        alert('Código gerado: $codigoGerado (simulação)');
        window.history.back();
    </script>";
    exit;
}

/* ===============================
   2️⃣ VALIDAR CÓDIGO E TROCAR SENHA
================================ */
if ($email && $codigo && $novaSenha) {

    $check = $conn->query("
        SELECT * FROM recuperar_senha
        WHERE email='$email' AND codigo='$codigo'
        LIMIT 1
    ");

    if ($check->num_rows == 0) {
        echo "<script>alert('Código inválido');history.back();</script>";
        exit;
    }

    $hash = password_hash($novaSenha, PASSWORD_DEFAULT);

    // tenta aluno
    $conn->query("UPDATE aluno SET senha='$hash' WHERE email='$email'");

    // tenta docente
    $conn->query("UPDATE docentes SET senha='$hash' WHERE email_profissional='$email'");

    // limpa código
    $conn->query("DELETE FROM recuperar_senha WHERE email='$email'");

    echo "
    <script>
        alert('Senha alterada com sucesso!');
        window.location='login.php';
    </script>";
    exit;
}

echo "<script>alert('Dados incompletos');history.back();</script>";
