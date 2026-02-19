<?php
session_start();

/* =============================
   FOTO DO USUÁRIO (CORRETA)
============================= */
$fotoUsuario = '../img/Logo ConnectTI.png';

if (!empty($_SESSION['foto'])) {
    $fotoUsuario = '../' . $_SESSION['foto'];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ConnectTI - Home</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

<!-- Seu CSS Personalizado -->
<link rel="stylesheet" href="../styles/index.css">
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow">
<div class="container">
    <a class="navbar-brand d-flex align-items-center fw-bold" href="index.php">
        <img src="../img/Logo ConnectTI.png" alt="Logo ConnectTI" width="60" height="60" class="me-2">
        ConnectTI
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" href="index.php">Início</a></li>
            <li class="nav-item"><a class="nav-link" href="trilhas.php">Trilhas</a></li>
            <li class="nav-item"><a class="nav-link" href="pratique.php">Pratique</a></li>
            <li class="nav-item"><a class="nav-link" href="comunidade.php">Comunidade</a></li>
            <li class="nav-item"><a class="nav-link" href="conteudos.php">Conteúdos</a></li>
            <li class="nav-item"><a class="nav-link" href="contato.php">Contato</a></li>

            <!-- Dark Mode Toggle -->
            <li class="nav-item ms-3">
                <button class="btn btn-outline-light btn-sm" id="darkModeToggle"><i class="bi bi-moon-fill"></i></button>
            </li>

            <!-- Avatar Dropdown -->
            <li class="nav-item dropdown ms-3">
            <?php if (isset($_SESSION['nome'])): ?>
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                    <img 
                    src="<?= $fotoUsuario ?>"
                    onerror="this.src='../img/Logo ConnectTI.png'"
                    class="avatar-img me-2" 
                    alt="Foto de perfil do usuário"
                    >
                    <span><?php echo $_SESSION['nome']; ?></span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li class="dropdown-item text-muted">
                        Tipo: <?php echo ucfirst($_SESSION['tipo']); ?>
                    </li>
                    <li><a class="dropdown-item" href="painel.php">Painel</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item text-danger" href="../logout.php">Sair</a>
                    </li>
                </ul>
            <?php else: ?>
                <a class="nav-link d-flex align-items-center" href="login.php">
                    <img src="../img/Logo ConnectTI.png" class="avatar-img me-2" alt="Avatar">
                    <span>Convidado</span>
                </a>
            <?php endif; ?>
            </li>
        </ul>
    </div>
</div>
</nav>

<!-- Hero -->
<section class="hero text-center">
<div class="container">
    <h1 class="display-4 fw-bold">Conecte-se ao Futuro da Tecnologia</h1>
    <p class="lead mt-3">Aprenda programação, redes, banco de dados e muito mais em um só lugar.</p>
    <button class="btn btn-primary btn-lg mt-3" data-bs-toggle="modal" data-bs-target="#loginModal">Começar Agora</button>
</div>
</section>

<!-- Como Funciona -->
<section class="container my-5">
<h2 class="section-title">Como Funciona</h2>
<div class="row text-center g-4">
    <div class="col-md-4">
        <i class="steps-icon bi bi-mortarboard-fill"></i>
        <h4 class="mt-3">Escolha sua trilha</h4>
        <p>Trilhas completas do básico ao avançado para você dominar tecnologia.</p>
    </div>
    <div class="col-md-4">
        <i class="steps-icon bi bi-laptop-fill"></i>
        <h4 class="mt-3">Pratique de verdade</h4>
        <p>Exercícios, desafios e simulados para aprender fazendo.</p>
    </div>
    <div class="col-md-4">
        <i class="steps-icon bi bi-people-fill"></i>
        <h4 class="mt-3">Entre na comunidade</h4>
        <p>Tire dúvidas, participe e cresça junto com outros estudantes.</p>
    </div>
</div>
</section>

<!-- Cards -->
<div class="container my-5">
<h2 class="section-title">Aprenda do Seu Jeito</h2>
<div class="row g-4">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <img src="https://images.unsplash.com/photo-1526378722484-bd91ca387e72?auto=format&fit=crop&w=800&q=80" alt="">
            <div class="card-body text-center">
                <h4 class="fw-bold">Trilhas de Estudo</h4>
                <p>Acesse trilhas completas e vá do zero ao avançado.</p>
                <a href="trilhas.php" class="btn btn-outline-primary">Ver trilhas</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm">
            <img src="https://images.unsplash.com/photo-1556155092-8707de31f9c4?auto=format&fit=crop&w=800&q=80" alt="">
            <div class="card-body text-center">
                <h4 class="fw-bold">Prática</h4>
                <p>Desafios reais para fixar os conteúdos na prática.</p>
                <a href="pratique.php" class="btn btn-outline-primary">Praticar</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm">
            <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=800&q=80" alt="">
            <div class="card-body text-center">
                <h4 class="fw-bold">Comunidade</h4>
                <p>Interaja com alunos, troque dicas e tire suas dúvidas.</p>
                <a href="comunidade.php" class="btn btn-outline-primary">Entrar</a>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Área de Acesso -->
<div class="container area-acesso my-5">
  <h2 class="section-title">Acesso Rápido</h2>

  <div class="row justify-content-center g-4">

    <div class="col-md-4">
      <div class="card card-acesso shadow p-4 text-center">
        <h3 class="mb-3">Entrar</h3>
        <p>Acesse sua conta e continue seus estudos.</p>

        <!-- LOGIN -->
        <a href="login.php" class="btn btn-primary w-100">
          Fazer Login
        </a>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card card-acesso shadow p-4 text-center">
        <h3 class="mb-3">Criar Conta</h3>
        <p>Não tem conta? Cadastre-se e comece agora.</p>

        <!-- CADASTRO -->
        <a href="cadastro.php" class="btn btn-success w-100">
          Cadastrar
        </a>
      </div>
    </div>

  </div>
</div>

<!-- Nossa História -->
<section class="container my-5">
    <h2 class="section-title">Nossa História</h2>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm p-4">
                <p>
                    O <strong>ConnectTI</strong> nasceu a partir das experiências e desafios vividos por um grupo de estudantes
                    da área de Tecnologia da Informação ao longo de sua jornada acadêmica. Durante esse percurso,
                    percebemos a dificuldade em encontrar conteúdos realmente organizados, confiáveis e completos
                    sobre os diversos temas da área de TI.
                </p>

                <p>
                    Muitas vezes, o aprendizado exigia o uso de várias plataformas diferentes, além de ferramentas externas,
                    tornando o processo cansativo e pouco eficiente. Além disso, grande parte dos sites que oferecem
                    conteúdos aprofundados são pagos, o que limita o acesso de muitos estudantes.
                </p>

                <p>
                    Diante dessa realidade, criamos o <strong>ConnectTI</strong>, uma plataforma gratuita, acessível e completa,
                    que une teoria e prática em um único ambiente. Nosso objetivo é proporcionar uma experiência de
                    aprendizado dinâmica, interativa e personalizada.
                </p>

                <p>
                    A plataforma oferece tutoriais, artigos, vídeos e exercícios práticos sobre temas como programação,
                    desenvolvimento web, redes de computadores, segurança da informação, bancos de dados e
                    inteligência artificial, além de ambientes de simulação que facilitam a prática.
                </p>

                <p>
                    Com perfis personalizados, acompanhamento de progresso, professores especializados, comunidade
                    ativa e recursos de Inteligência Artificial, o ConnectTI promove o aprendizado colaborativo e contínuo.
                </p>

                <p class="fw-bold text-center mt-4 text-primary">
                    Nosso propósito é transformar dificuldades em oportunidades e conectar estudantes
                    ao conhecimento e ao futuro da Tecnologia da Informação. 🚀
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer-connectiti">
    <button class="topo">Voltar ao topo</button>

    <div class="footer-container">
        <div class="footer-col">
            <p class="email">contato@connectTI.com</p>
            <a href="#" class="btn-site">SITE DA ConnectTI</a>

            <div class="social">
                <a href="#">Facebook</a>
                <a href="#">LinkedIn</a>
                <a href="#">YouTube</a>
            </div>
        </div>

        <div class="footer-col">
            <a href="#">Política de Privacidade</a>
            <a href="#">Controle de Privacidade</a>
            <a href="#">Canal de Denúncias</a>
        </div>

        <div class="footer-col">
            <h3>ConnectTI</h3>
            <p>Tecnologia que conecta</p>
        </div>
    </div>
</footer>

<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Meu Perfil</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <form id="profileForm">
                <div class="mb-3 text-center">
                    <img src="../img/Logo ConnectTI.png" id="profileAvatarPreview" class="avatar-img mb-2" style="width:100px;height:100px;">
                    <input class="form-control" type="file" id="profileAvatar" accept="image/*">
                    <button type="button" class="btn btn-danger btn-sm mt-2" id="removeAvatarBtn">Remover Foto</button>
                </div>
                <div class="mb-3">
                    <label for="profileName" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="profileName" placeholder="Digite seu nome">
                </div>
                <button type="submit" class="btn btn-primary w-100">Salvar</button>
            </form>
        </div>
    </div>
</div>
</div>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login / Cadastro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <a href="login.php" class="btn btn-primary w-100 mb-2">
                    Fazer Login
                </a>
                <a href="cadastro.php" class="btn btn-success w-100">
                    Cadastrar
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Cookie Consent -->
<div class="cookie-consent" id="cookieConsent">
    <div class="cookie-header">
        <h5>Configurações de Cookies</h5>
        <button type="button" class="btn-close" id="closeCookie"></button>
    </div>
    <div class="cookie-box">
        Usamos cookies para melhorar sua experiência. Ao continuar navegando, você concorda com nossa política.
    </div>
    <div class="cookie-links">
        <a href="#" data-bs-toggle="modal" data-bs-target="#cookiePolicyModal">Política de Cookies</a>
    </div>
    <div class="cookie-actions">
        <button class="btn btn-outline-secondary" id="rejectCookie">Recusar</button>
        <button class="btn btn-success" id="acceptCookie">Aceitar Todos</button>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Seu JavaScript -->
<script src="../scripts/index.js"></script>

</body>
</html>