<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conexão com o banco
$conn = new mysqli("localhost", "root", "", "connectti");

// Verifica conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Recebe dados do formulário
$nome  = $_POST['nome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$data_nascimento = $_POST['data_nascimento'];

// SQL de inserção
$sql = "INSERT INTO usuarios (nome, email, senha, data_nascimento)
        VALUES ('$nome', '$email', '$senha', '$data_nascimento')";

// Executa
if ($conn->query($sql) === TRUE) {
    header("Location: login.php");
    exit();
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}
?>