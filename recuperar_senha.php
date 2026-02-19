<?php
require_once "config/conexao.php";

/* ===============================
   DADOS
================================ */
$email     = $_POST['email'] ?? '';
$codigo    = $_POST['codigo'] ?? '';
$novaSenha = $_POST['nova_senha'] ?? '';

/* ===============================
   1️⃣ GERAR CÓDIGO
================================ */
if ($email && !$codigo && !$novaSenha) {

    $codigoGerado = random_int(100000, 999999);

    $stmt = $conn->prepare("DELETE FROM recuperar_senha WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $stmt = $conn->prepare("
        INSERT INTO recuperar_senha (email, codigo)
        VALUES (?, ?)
    ");
    $stmt->bind_param("si", $email, $codigoGerado);
    $stmt->execute();

    echo "<script>alert('Código gerado: $codigoGerado (simulação)');history.back();</script>";
    exit;
}

/* ===============================
   2️⃣ VALIDAR CÓDIGO
================================ */
if ($email && $codigo && $novaSenha) {

    $stmt = $conn->prepare("
        SELECT 1
        FROM recuperar_senha
        WHERE email = ? AND codigo = ?
        LIMIT 1
    ");
    $stmt->bind_param("si", $email, $codigo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "<script>alert('Código inválido');history.back();</script>";
        exit;
    }

    $hash = password_hash($novaSenha, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("
        UPDATE aluno
        SET senha = ?
        WHERE email = ?
    ");
    $stmt->bind_param("ss", $hash, $email);
    $stmt->execute();

    $stmt = $conn->prepare("
        UPDATE docentes
        SET senha = ?
        WHERE email_profissional = ?
    ");
    $stmt->bind_param("ss", $hash, $email);
    $stmt->execute();

    $stmt = $conn->prepare("DELETE FROM recuperar_senha WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    echo "<script>alert('Senha alterada com sucesso!');window.location='templates/login.php';</script>";
    exit;
}

echo "<script>alert('Dados incompletos');history.back();</script>";