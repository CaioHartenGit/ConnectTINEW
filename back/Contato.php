<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ConnectTI — Contato</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
<style>
body {
    background-color: #04101b;
    color: #e6f2ff;
    font-family: Inter, "Helvetica Neue", Arial, sans-serif;
}
.navbar {
    background-color: #071026;
}
.nav-link, .navbar-brand {
    color: #e6f2ff !important;
}
.nav-link:hover {
    color: #0d6efd !important;
}
.container {
    padding-top: 80px;
    max-width: 700px;
}
.card {
    background: rgba(255,255,255,0.03);
    border-radius: 12px;
    padding: 20px;
    border: 1px solid rgba(255,255,255,0.04);
}
input, textarea {
    background: rgba(255,255,255,0.02);
    border: none;
    color: #e6f2ff;
}
input:focus, textarea:focus {
    outline: none;
    box-shadow: 0 0 0 2px #0d6efd;
}
.btn-primary {
    background-color: #0d6efd;
    border-color: #0d6efd;
}
#successMsg {
    color: #28c76f;
}
</style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">ConnectTI</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"><i class="ri-menu-line"></i></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="#inicio">Início</a></li>
        <li class="nav-item"><a class="nav-link" href="trilhas.php">Trilhas</a></li>
        <li class="nav-item"><a class="nav-link" href="pratique.php">Pratique</a></li>
        <li class="nav-item"><a class="nav-link" href="comunidade.php">Comunidade</a></li>
        <li class="nav-item"><a class="nav-link active" href="contato.php">Contato</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Conteúdo -->
<div class="container">
    <h2 class="mb-4 text-center">Fale Conosco</h2>
    <div class="card">
        <form id="contactForm">
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" placeholder="Seu nome" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="seu@email.com" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Mensagem</label>
                <textarea class="form-control" id="message" rows="5" placeholder="Escreva sua mensagem..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Enviar</button>
        </form>
        <div id="successMsg" class="mt-3" style="display:none;">Mensagem enviada com sucesso!</div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('contactForm').addEventListener('submit', function(e){
    e.preventDefault();
    document.getElementById('successMsg').style.display = 'block';
    this.reset();
});
</script>
<?php
session_start();
$success = $_SESSION['success'] ?? '';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ConnectTI — Contato Premium</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<style>
/* ===== BODY ===== */
body {
    margin:0;
    font-family:'Inter',sans-serif;
    background: #0a0a0a;
    color: #e6e6e6;
}

/* ===== NAVBAR ===== */
.navbar { background-color:#050505; }
.nav-link, .navbar-brand { color:#fff !important; font-weight:600; }
.nav-link:hover, .nav-link.active { color:#0d6efd !important; }

/* ===== HEADER ===== */
header {
    text-align:center;
    padding:100px 20px 60px;
    background: linear-gradient(135deg,#0d0d0d,#1a1a1a);
    position:relative;
    overflow:hidden;
}
header h1 { font-size:3rem; margin-bottom:15px; font-weight:700; }
header p { font-size:1.2rem; color:#888; }

/* ===== CONTAINER ===== */
.container-contact {
    max-width:1100px;
    margin:auto;
    padding:50px 20px;
    display:flex;
    gap:40px;
    flex-wrap:wrap;
    z-index:1;
    position:relative;
}

/* ===== CARD ===== */
.card-contact {
    flex:1;
    min-width:320px;
    background: #121212;
    border-radius:15px;
    padding:30px;
    box-shadow:0 10px 25px rgba(0,0,0,0.6);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.card-contact:hover {
    transform: translateY(-5px);
    box-shadow:0 15px 35px rgba(0,0,0,0.7);
}
.card-contact h3 { margin-bottom:25px; color:#0d6efd; }

/* ===== FORMULÁRIO ===== */
.form-control, .form-control:focus {
    background-color:#1a1a1a;
    border:1px solid #333;
    color:#fff;
    border-radius:8px;
    padding:12px;
    transition: all 0.3s ease;
}
.form-control:focus { border-color:#0d6efd; box-shadow:0 0 8px rgba(13,110,253,0.5); }
textarea.form-control { resize:none; }

.btn-primary {
    background-color:#0d6efd;
    border:none;
    padding:12px 20px;
    font-weight:600;
    border-radius:8px;
    transition:background 0.3s ease;
}
.btn-primary:hover { background-color:#0062cc; }

/* ===== ALERTS ===== */
#successMsg, #errorMsg {
    margin-top:20px;
    font-weight:600;
    text-align:center;
    padding:10px;
    border-radius:8px;
}
#successMsg { display:<?= $success ? 'block' : 'none' ?>; background:#28c76f; color:#fff; }
#errorMsg { display:<?= $error ? 'block' : 'none' ?>; background:#ff4c4c; color:#fff; }

/* ===== CONTACT INFO ===== */
.contact-info div { display:flex; align-items:center; margin-bottom:15px; gap:15px; }
.contact-info i { font-size:1.5rem; color:#0d6efd; }

/* ===== MAP ===== */
.map-container {
    width:100%;
    height:300px;
    border-radius:15px;
    overflow:hidden;
    margin-top:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.5);
}

/* ===== FAB WHATSAPP ===== */
.fab-whatsapp {
    position:fixed;
    bottom:30px;
    right:30px;
    background-color:#25D366;
    color:#fff;
    width:60px;
    height:60px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:2rem;
    box-shadow:0 5px 15px rgba(0,0,0,0.3);
    transition: transform 0.3s;
    z-index:100;
}
.fab-whatsapp:hover { transform:scale(1.1); }

@media (max-width:768px) {
    .container-contact { flex-direction:column; padding:30px 15px; }
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

<!-- CONTAINER -->
<div class="container-contact">

    <!-- CARD FORMULÁRIO -->
    <div class="card-contact">
        <h3>Envie uma mensagem</h3>
        <form action="processa_contato.php" method="POST">
            <input type="text" name="nome" class="form-control mb-3" placeholder="Nome completo" required>
            <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
            <textarea name="mensagem" class="form-control mb-3" rows="5" placeholder="Escreva sua mensagem..." required></textarea>
            <button type="submit" class="btn btn-primary w-100">Enviar Mensagem</button>
        </form>
        <div id="successMsg"><?= $success ?></div>
        <div id="errorMsg"><?= $error ?></div>
    </div>

    <!-- CARD INFORMAÇÕES -->
    <div class="card-contact">
        <h3>Informações de Contato</h3>
        <div class="contact-info">
            <div><i class="ri-map-pin-line"></i><span>Av. Tecnologia, 123 - Recife, PE</span></div>
            <div><i class="ri-mail-line"></i><span>contato@connectti.com.br</span></div>
            <div><i class="ri-phone-line"></i><span>+55 (81) 99999-9999</span></div>
            <div><i class="ri-global-line"></i><span>www.connectti.com.br</span></div>
        </div>
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3920.0!2d-34.9!3d-8.1!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7ab18f!2sRecife!5e0!3m2!1spt-BR!2sbr!4v1690000000000" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</div>

<!-- FAB WHATSAPP -->
<a href="https://wa.me/5581999999999" target="_blank" class="fab-whatsapp"><i class="ri-whatsapp-line"></i></a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

</body>
</html>

  






