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

<style>
body {
    margin: 0;
    font-family: 'Inter', sans-serif;
    background: #0a0a0a;
    color: #e6e6e6;
}

/* NAVBAR */
.navbar {
    background-color: #050505;
}
.navbar-brand,
.nav-link {
    color: #fff !important;
    font-weight: 600;
}
.nav-link:hover,
.nav-link.active {
    color: #0d6efd !important;
}

/* HEADER */
header {
    text-align: center;
    padding: 110px 20px 60px;
    background: linear-gradient(135deg, #0d0d0d, #1a1a1a);
}
header h1 {
    font-size: 3rem;
    font-weight: 700;
}
header p {
    color: #999;
}

/* CONTAINER */
.container-contact {
    max-width: 1100px;
    margin: auto;
    padding: 50px 20px;
    display: flex;
    gap: 40px;
    flex-wrap: wrap;
}

/* CARDS */
.card-contact {
    flex: 1;
    min-width: 320px;
    background: #121212;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 10px 25px rgba(0,0,0,.6);
}
.card-contact h3 {
    color: #0d6efd;
    margin-bottom: 25px;
}

/* FORM */
.form-control {
    background:rgb(232, 226, 226);
    border: 1px solid #333;
    color: #fff;
    border-radius: 8px;
    padding: 12px;
}
.form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 8px rgba(13,110,253,.4);
}
textarea {
    resize: none;
}
.btn-primary {
    background: #0d6efd;
    border: none;
    padding: 12px;
    font-weight: 600;
    border-radius: 8px;
}
.btn-primary:hover {
    background: #005edc;
}

/* ALERTAS */
#successMsg,
#errorMsg {
    margin-top: 20px;
    padding: 12px;
    border-radius: 8px;
    font-weight: 600;
    text-align: center;
}
#successMsg {
    background: #28c76f;
    display: <?= $success ? 'block' : 'none' ?>;
}
#errorMsg {
    background: #ff4c4c;
    display: <?= $error ? 'block' : 'none' ?>;
}

/* INFO */
.contact-info div {
    display: flex;
    gap: 15px;
    margin-bottom: 15px;
}
.contact-info i {
    color: #0d6efd;
    font-size: 1.5rem;
}

/* MAP */
.map-container {
    height: 300px;
    border-radius: 15px;
    overflow: hidden;
    margin-top: 20px;
}

/* WHATSAPP */
.fab-whatsapp {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 60px;
    height: 60px;
    background: #25D366;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 2rem;
    z-index: 100;
}
.fab-whatsapp:hover {
    transform: scale(1.1);
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">ConnectTI</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"><i class="ri-menu-line"></i></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="contato.php">Início</a></li>
        <li class="nav-item"><a class="nav-link" href="trilhas.php">Trilhas</a></li>
        <li class="nav-item"><a class="nav-link" href="pratique.php">Pratique</a></li>
        <li class="nav-item"><a class="nav-link" href="comunidade.php">Comunidade</a></li>
        <li class="nav-item"><a class="nav-link active" href="contato.php">Contato</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- HEADER -->
<header>
    <h1>Fale Conosco</h1>
    <p>Tem dúvidas, sugestões ou quer colaborar? Entre em contato!</p>
</header>

<!-- CONTEÚDO -->
<div class="container-contact">

    <!-- FORM -->
    <div class="card-contact">
        <h3>Envie uma mensagem</h3>
        <form action="processa_contato.php" method="POST">
            <input type="text" name="nome" class="form-control mb-3" placeholder="Nome completo" required>
            <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
            <textarea name="mensagem" class="form-control mb-3" rows="5" placeholder="Sua mensagem..." required></textarea>
            <button class="btn btn-primary w-100">Enviar</button>
        </form>

        <div id="successMsg"><?= $success ?></div>
        <div id="errorMsg"><?= $error ?></div>
    </div>

    <!-- INFO -->
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

<!-- WHATSAPP -->
<a href="https://wa.me/5581999999999" target="_blank" class="fab-whatsapp">
    <i class="ri-whatsapp-line"></i>
</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>