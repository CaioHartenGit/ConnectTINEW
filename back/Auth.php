<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "connectti");
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

session_start();

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

/* ===============================
   1️⃣ LOGIN COMO ALUNO
================================ */
$sqlAluno = "SELECT * FROM aluno WHERE email = '$email' LIMIT 1";
$resultAluno = $conn->query($sqlAluno);

if ($resultAluno && $resultAluno->num_rows > 0) {

    $aluno = $resultAluno->fetch_assoc();

    if (password_verify($senha, $aluno['senha'])) {

        $_SESSION['id']    = $aluno['id'];
        $_SESSION['nome']  = $aluno['nome'];
        $_SESSION['email'] = $aluno['email'];
        $_SESSION['tipo']  = 'aluno';

        // FOTO NA SESSÃO
        $_SESSION['foto'] = !empty($aluno['foto']) ? $aluno['foto'] : null;

        header("Location: index.php");
        exit;
    }
}

/* ===============================
   2️⃣ LOGIN COMO DOCENTE
================================ */
$sqlDocente = "SELECT * FROM docentes WHERE email_profissional = '$email' LIMIT 1";
$resultDocente = $conn->query($sqlDocente);

if ($resultDocente && $resultDocente->num_rows > 0) {

    $docente = $resultDocente->fetch_assoc();

    if (password_verify($senha, $docente['senha'])) {

        $_SESSION['id']    = $docente['id'];
        $_SESSION['nome']  = $docente['nome_completo'];
        $_SESSION['email'] = $docente['email_profissional'];
        $_SESSION['tipo']  = 'docente';

        // FOTO NA SESSÃO
        $_SESSION['foto'] = !empty($docente['foto']) ? $docente['foto'] : null;

        header("Location: index.php");
        exit;
    }
}

/* ===============================
   ERRO FINAL
================================ */
echo "
<script>
    alert('E-mail ou senha inválidos');
    window.history.back();
</script>
";
exit;
