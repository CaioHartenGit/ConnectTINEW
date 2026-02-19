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

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (empty($email) || empty($senha)) {
    echo "
    <script>
        alert('Preencha e-mail e senha');
        window.history.back();
    </script>
    ";
    exit;
}

/* ===============================
   1️⃣ LOGIN COMO ALUNO
================================ */
$stmtAluno = $conn->prepare("SELECT id, nome, email, senha, foto FROM Aluno WHERE email = ? LIMIT 1");
$stmtAluno->bind_param("s", $email);
$stmtAluno->execute();
$resultAluno = $stmtAluno->get_result();

if ($resultAluno && $resultAluno->num_rows === 1) {

    $aluno = $resultAluno->fetch_assoc();

    if (!empty($aluno['senha']) && password_verify($senha, $aluno['senha'])) {

        $_SESSION['id']    = $aluno['id'];
        $_SESSION['nome']  = $aluno['nome'];
        $_SESSION['email'] = $aluno['email'];
        $_SESSION['tipo']  = 'aluno';
        $_SESSION['foto']  = $aluno['foto'] ?? '';

        header("Location: templates/index.php");
        exit;
    }
}

/* ===============================
   2️⃣ LOGIN COMO DOCENTE
================================ */
$stmtDocente = $conn->prepare("SELECT id, nome_completo, email_profissional, senha, foto FROM docentes WHERE email_profissional = ? LIMIT 1");
$stmtDocente->bind_param("s", $email);
$stmtDocente->execute();
$resultDocente = $stmtDocente->get_result();

if ($resultDocente && $resultDocente->num_rows === 1) {

    $docente = $resultDocente->fetch_assoc();

    if (!empty($docente['senha']) && password_verify($senha, $docente['senha'])) {

        $_SESSION['id']    = $docente['id'];
        $_SESSION['nome']  = $docente['nome_completo'];
        $_SESSION['email'] = $docente['email_profissional'];
        $_SESSION['tipo']  = 'docente';
        $_SESSION['foto']  = $docente['foto'] ?? '';

        header("Location: templates/index.php");
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
