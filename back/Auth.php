<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conexão com o banco
$conn = new mysqli("localhost", "root", "", "connectti");

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Recebe dados do formulário
$email = $_POST['email'];
$senha = $_POST['senha'];

// Busca usuário pelo email
$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $usuario = $result->fetch_assoc();

    // Verifica senha
    if (password_verify($senha, $usuario['senha'])) {

        // Inicia sessão
        session_start();
        $_SESSION['user'] = $usuario['nome'];

        // Redireciona para o painel
        header("Location: painel.php");
        exit();

    } else {
        echo "Senha incorreta";
    }
} else {
    echo "Usuário não encontrado";
}
?>