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

<style>
    /* ================= COOKIE CONSENT ================= */
.cookie-consent {
    position: fixed;
    bottom: 20px;
    left: 20px;
    max-width: 420px;
    background: #ffffff;
    border-radius: 14px;
    padding: 20px;
    z-index: 9999;
    display: none;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

body.dark-mode .cookie-consent {
    background: #1e1e1e;
    color: #f8f9fa;
}

.cookie-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.cookie-header h5 {
    color: #28a745;
    font-weight: 700;
}

.cookie-box {
    border: 1px solid #ced4da;
    border-radius: 8px;
    padding: 10px;
    font-size: 0.9rem;
    margin: 10px 0;
}

.cookie-links a {
    color: #28a745;
    font-weight: 500;
    text-decoration: none;
}

.cookie-links a:hover {
    text-decoration: underline;
}

.cookie-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 15px;
}

.cookie-actions button {
    border-radius: 25px;
    padding: 6px 20px;
}
    
body {
    font-family: 'Roboto', sans-serif;
    padding-top: 70px;
    background-color: #f8f9fa;
    transition: background-color 0.3s ease, color 0.3s ease;
}
body.dark-mode {
    background-color: #121212;
    color: #f8f9fa;
}

/* Navbar */
.navbar-brand img { object-fit: contain; }

/* Hero */
.hero {
    background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;
    padding: 120px 0;
    color: #fff;
    text-shadow: 0 2px 10px rgba(0,0,0,0.6);
    transition: all 0.3s ease;
}
.hero h1 { font-size: 3rem; font-weight: 700; }
.hero p { font-size: 1.25rem; }

/* Cards */
.card { border: none; border-radius: 10px; transition: transform 0.3s ease, box-shadow 0.3s ease; }
.card:hover { transform: translateY(-8px); box-shadow: 0 12px 24px rgba(0,0,0,0.15); }
.card img { height: 180px; object-fit: cover; border-radius: 10px 10px 0 0; }

/* Section Titles */
.section-title { font-weight: 700; text-align: center; margin-bottom: 50px; color: #0d6efd; }

/* Steps Icon */
.steps-icon { font-size: 50px; color: #0d6efd; }

/* Area Acesso */
.area-acesso .card-acesso { transition: transform 0.3s ease, box-shadow 0.3s ease; }
.area-acesso .card-acesso:hover { transform: translateY(-6px); box-shadow: 0 10px 20px rgba(0,0,0,0.15); }

/* Footer */
footer { background-color: #212529; color: #ccc; }
footer a { color: #0d6efd; text-decoration: none; }
footer a:hover { text-decoration: underline; }

/* Avatar */
.avatar-img { width: 38px; height: 38px; object-fit: cover; border-radius: 50%; cursor: pointer; }

/* Profile Modal */
.modal-body label { font-weight: 500; }
</style>
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow">
<div class="container">
    <a class="navbar-brand d-flex align-items-center fw-bold" href="index.php">
        <img src="Logo ConnectTI.png" alt="Logo ConnectTI" width="60" height="60" class="me-2">
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
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userMenu" role="button" data-bs-toggle="dropdown">
                    <img src="/mnt/data/Logo ConnectTI.png" class="avatar-img me-2" id="navAvatar" alt="Avatar">
                    <span id="navUserName">Convidado</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userMenu">
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal"><i class="bi bi-person-circle me-2"></i>Meu Perfil</a></li>
                    <li><a class="dropdown-item" href="configuracoes.html"><i class="bi bi-gear me-2"></i>Configurações</a></li>
                    <li><a class="dropdown-item" href="painel.html"><i class="bi bi-speedometer2 me-2"></i>Painel</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="#" id="logoutBtn"><i class="bi bi-box-arrow-right me-2"></i>Sair</a></li>
                </ul>
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
                <a href="trilhas.html" class="btn btn-outline-primary">Ver trilhas</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm">
            <img src="https://images.unsplash.com/photo-1556155092-8707de31f9c4?auto=format&fit=crop&w=800&q=80" alt="">
            <div class="card-body text-center">
                <h4 class="fw-bold">Prática</h4>
                <p>Desafios reais para fixar os conteúdos na prática.</p>
                <a href="pratique.html" class="btn btn-outline-primary">Praticar</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm">
            <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=800&q=80" alt="">
            <div class="card-body text-center">
                <h4 class="fw-bold">Comunidade</h4>
                <p>Interaja com alunos, troque dicas e tire suas dúvidas.</p>
                <a href="comunidade.html" class="btn btn-outline-primary">Entrar</a>
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


<style>
    .footer-connectiti {
      background: #000000;
      color: white;
      padding: 40px 20px 60px;
      position: relative;
      font-family: Arial, sans-serif;
    }

    .footer-container {
      max-width: 1200px;
      margin: auto;
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
      justify-content: space-between;
    }

    .footer-col {
      display: flex;
      flex-direction: column;
      gap: 12px;
      min-width: 220px;
    }

    .email {
      font-weight: bold;
    }

    .btn-site {
      border: 2px solid white;
      padding: 10px 15px;
      color: white;
      text-decoration: none;
      width: fit-content;
      border-radius: 4px;
    }

    .btn-site:hover {
      background: white;
      color: #000000;
    }

    .social a,
    .footer-col a {
      color: white;
      text-decoration: none;
      font-size: 14px;
    }

    .social {
      display: flex;
      gap: 15px;
    }

    .footer-col h3 {
      font-size: 22px;
      margin: 0;
    }

    .topo {
      position: absolute;
      top: -18px;
      left: 50%;
      transform: translateX(-50%);
      background: #00a1f2;
      border: none;
      color: white;
      padding: 8px 16px;
      border-radius: 6px;
      cursor: pointer;
    }

    .topo:hover {
      background: #000000;
    }
  </style>
</head>
<body>

  <!-- Conteúdo da página aqui -->

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

  <script>
    document.querySelector(".topo").addEventListener("click", function() {
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  </script>


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
                    <img src="/mnt/data/Logo ConnectTI.png" id="profileAvatarPreview" class="avatar-img mb-2" style="width:100px;height:100px;">
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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Dark Mode
const toggleBtn = document.getElementById('darkModeToggle');
toggleBtn.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');
});

// Profile Handling
const profileForm = document.getElementById('profileForm');
const profileAvatar = document.getElementById('profileAvatar');
const profileAvatarPreview = document.getElementById('profileAvatarPreview');
const profileName = document.getElementById('profileName');
const navAvatar = document.getElementById('navAvatar');
const navUserName = document.getElementById('navUserName');
const removeAvatarBtn = document.getElementById('removeAvatarBtn');

profileAvatar.addEventListener('change', (e) => {
    const file = e.target.files[0];
    if(file){
        const reader = new FileReader();
        reader.onload = () => {
            profileAvatarPreview.src = reader.result;
        }
        reader.readAsDataURL(file);
    }
});

removeAvatarBtn.addEventListener('click', () => {
    profileAvatarPreview.src = '/mnt/data/Logo ConnectTI.png';
    profileAvatar.value = '';
});

profileForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const avatarSrc = profileAvatarPreview.src;
    const nome = profileName.value.trim() || 'Convidado';
    localStorage.setItem('avatar', avatarSrc);
    localStorage.setItem('nome', nome);
    navAvatar.src = avatarSrc;
    navUserName.textContent = nome;
    bootstrap.Modal.getInstance(document.getElementById('profileModal')).hide();
});

/* Simulate login (n precisa mais)
document.getElementById('loginSimulate').addEventListener('click', () => {
    const avatarSrc = '/mnt/data/Logo ConnectTI.png';
    const nome = 'Aluno Teste';
    localStorage.setItem('avatar', avatarSrc);
    localStorage.setItem('nome', nome);
    navAvatar.src = avatarSrc;
    navUserName.textContent = nome;
    document.getElementById('loginModal').querySelector('.btn-close').click();
});*/

// Logout
document.getElementById('logoutBtn').addEventListener('click', () => {
    localStorage.removeItem('avatar');
    localStorage.removeItem('nome');
    navAvatar.src = '/mnt/data/Logo ConnectTI.png';
    navUserName.textContent = 'Convidado';
});
</script>
</body>
</html>
