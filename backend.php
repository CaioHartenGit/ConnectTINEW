<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conexão
$conn = new mysqli("localhost", "root", "", "connectti");
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$isDocente = isset($_POST['docente']);

/* ===============================
   SE FOR DOCENTE
================================ */
if ($isDocente) {

    $nome_completo      = $_POST['nome_completo'];
    $formacao           = $_POST['formacao'];
    $email_profissional = $_POST['email_profissional'];
    $registro           = $_POST['registro'];
    $instituicao        = $_POST['instituicao'];
    $senha              = password_hash($_POST['senha_docente'], PASSWORD_DEFAULT);

    /* VALIDA REGISTRO DOCENTE */
    $sqlRegistro = "
        SELECT 1 
        FROM registro_docente 
        WHERE codigo = '$registro'
    ";

    $result = $conn->query($sqlRegistro);

    if (!$result || $result->num_rows === 0) {
        echo "
        <script>
            alert('Registro docente inválido!');
            window.history.back();
        </script>
        ";
        exit;
    }

    /* INSERE DOCENTE */
    $sqlDocente = "
        INSERT INTO docentes
        (nome_completo, formacao_academica, email_profissional, senha, registro_academico, instituicao)
        VALUES
        ('$nome_completo', '$formacao', '$email_profissional', '$senha', '$registro', '$instituicao')
    ";

    if (!$conn->query($sqlDocente)) {
        echo 'Erro ao cadastrar docente: ' . $conn->error;
        exit;
    }

    header("Location: templates/login.php");
    exit;
}

/* ===============================
   SE FOR ALUNO
================================ */
$nome            = $_POST['nome'];
$email           = $_POST['email'];
$data_nascimento = $_POST['data_nascimento'];
$senha           = password_hash($_POST['senha_aluno'], PASSWORD_DEFAULT);

$sqlAluno = "
    INSERT INTO Aluno
    (nome, email, senha, data_nascimento)
    VALUES
    ('$nome', '$email', '$senha', '$data_nascimento')
";

if (!$conn->query($sqlAluno)) {
    echo "Erro ao cadastrar aluno: " . $conn->error;
    exit;
}

header("Location: templates/login.php");
exit;