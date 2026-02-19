<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = strip_tags(trim($_POST['nome']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $mensagem = htmlspecialchars(trim($_POST['mensagem']));

    if (empty($nome)  empty($email)  empty($mensagem)) {
        $_SESSION['error'] = "Por favor, preencha todos os campos!";
        header("Location: contato.php");
        exit;
    }

    $to = "seuemail@connectti.com.br"; // Troque pelo seu email
    $subject = "Nova mensagem do site ConnectTI";
    $body = "Nome: $nome\nEmail: $email\n\nMensagem:\n$mensagem";
    $headers = "From: $nome <$email>\r\nReply-To: $email\r\n";

    if (mail($to, $subject, $body, $headers)) {
        $_SESSION['success'] = "Mensagem enviada com sucesso!";
    } else {
        $_SESSION['error'] = "Erro ao enviar a mensagem. Tente novamente.";
    }

    header("Location: contato.php");
    exit;
}
?>