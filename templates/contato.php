<?php
session_start();
$success = $_SESSION['success'] ?? '';
$error   = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ConnectTI — Contato</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="../styles/contato.css">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">ConnectTI</a>
  </div>
</nav>

<header>
    <h1>Fale Conosco</h1>
    <p>Tem dúvidas, sugestões ou quer colaborar? Entre em contato!</p>
</header>

<div class="container-contact">

    <div class="card-contact">
        <h3>Envie uma mensagem</h3>

        <form action="../processa_contato.php" method="POST">
            <input type="text" name="nome" class="form-control mb-3" placeholder="Nome completo" required>
            <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
            <textarea name="mensagem" class="form-control mb-3" rows="5" placeholder="Sua mensagem..." required></textarea>
            <button class="btn btn-primary w-100">Enviar</button>
        </form>

        <div id="successMsg"><?= $success ?></div>
        <div id="errorMsg"><?= $error ?></div>
    </div>

    <div class="card-contact">
        <h3>Informações</h3>
        <div class="contact-info">
            <div><i class="ri-map-pin-line"></i> Recife - PE</div>
            <div><i class="ri-mail-line"></i> contato@connectti.com.br</div>
            <div><i class="ri-phone-line"></i> (81) 99999-9999</div>
            <div><i class="ri-global-line"></i> www.connectti.com.br</div>
        </div>

        <div class="map-container">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3920.0!2d-34.9!3d-8.1!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7ab18f!2sRecife!5e0!3m2!1spt-BR!2sbr!4v1690000000000"
                width="100%" height="100%" style="border:0;" loading="lazy">
            </iframe>
        </div>
    </div>

</div>

<a href="https://wa.me/5581999999999" target="_blank" class="fab-whatsapp">
    <i class="ri-whatsapp-line"></i>
</a>

<script src="../scripts/contato.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>