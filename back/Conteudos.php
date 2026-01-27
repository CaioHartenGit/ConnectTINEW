<!doctype html>
<html lang="pt-BR">
<head>
    <!-- Se for PNG -->
<link rel="icon" type="image/png" href="Logo ConnectTI.png">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ConnectaTI — Plataforma de Aprendizado</title>

<!-- Bootstrap e ícones -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

<style>
  body { font-family: 'Roboto', sans-serif; scroll-behavior: smooth; background-color:#f8f9fa; }

  /* Hero */
  .hero {
    background: url('https://images.unsplash.com/photo-1581091012184-4f0b55f3f1cd?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;
    height: 90vh; display: flex; align-items: center; justify-content: center;
    color: white; text-align: center; text-shadow: 2px 2px 10px rgba(0,0,0,0.7);
  }
  .hero h1 { font-size: 4rem; font-weight: 700; animation: fadeInDown 1s ease-in-out; }
  .hero p { font-size: 1.5rem; margin-top: 20px; animation: fadeInUp 1s ease-in-out; }
  .btn-cta { border-radius: 50px; padding: 0.7rem 2rem; font-weight: 500; }

  @keyframes fadeInDown { from { opacity:0; transform:translateY(-50px);} to{opacity:1; transform:translateY(0);} }
  @keyframes fadeInUp { from {opacity:0; transform:translateY(50px);} to{opacity:1; transform:translateY(0);} }

  /* Cards */
  .card-content { transition: transform 0.3s, box-shadow 0.3s; border-radius:15px; overflow:hidden; }
  .card-content:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.3); }

  /* Section titles */
  .section-title { font-weight: 700; margin-bottom: 2rem; text-align: center; color:#343a40; }

  /* Rodapé */
  footer { background-color: #1f1f1f; color: white; padding: 2rem 0; }
</style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">ConnectTI</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="conteudos.php">Início</a></li>
        <li class="nav-item"><a class="nav-link" href="#trilhas">Trilhas</a></li>
        <li class="nav-item"><a class="nav-link" href="#conteudos">Conteúdos</a></li>
        <li class="nav-item"><a class="nav-link" href="contato.php">Contato</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero -->
<section id="inicio" class="hero">
  <div class="container">
    <h1>Aprenda, Pratique e Cresça em TI</h1>
    <p>Vídeos, PDFs e tutoriais ilustrados para se tornar um profissional de destaque</p>
    <a href="#conteudos" class="btn btn-danger btn-lg btn-cta mt-3"><i class="bi bi-play-circle"></i> Comece Agora</a>
  </div>
</section>

<!-- Trilhas -->
<section id="trilhas" class="py-5">
  <div class="container">
    <h2 class="section-title">Trilhas de Estudo</h2>
    <div class="row g-4">
  <!-- Trilhas exemplo -->
<div class="col-md-4">
  <div class="card card-content h-100 shadow-sm" style="max-height: 300px;">
    <!-- Se tiver imagem, coloque aqui; senão, use uma imagem genérica ou um banner "Ao vivo" -->
    <img src="https://images.unsplash.com/photo-1558021212-51b6b1c5c4a2?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Dev Início" style="height: 140px; object-fit: cover;">

    <div class="card-body p-2">
      <h6 class="card-title mb-1">Como começar em Dev</h6>
      <p class="card-text mb-2" style="font-size: 0.85rem;">Guia completo para iniciantes. Aprenda a programar com passos práticos e exemplos reais.</p>
      <a href="#" class="btn btn-danger btn-sm btn-block" style="font-size: 0.75rem;"><i class="bi bi-play-circle"></i> Video Aula</a>
    </div>
  </div>
</div>


      <div class="col-md-4">
        <div class="card card-content h-100 shadow-sm">
          <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Segurança">
          <div class="card-body">
            <h5 class="card-title">Segurança em TI</h5>
            <p class="card-text">Aprenda conceitos essenciais de segurança, proteção de dados e boas práticas.</p>
            <a href="#" class="btn btn-success btn-sm"><i class="bi bi-book"></i> Tutorial</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card card-content h-100 shadow-sm">
          <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Banco de Dados">
          <div class="card-body">
            <h5 class="card-title">Banco de dados em 1 semana</h5>
            <p class="card-text">Plano de estudos para dominar SQL e NoSQL rapidamente.</p>
            <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-file-earmark-pdf"></i> PDF</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Conteúdos -->
<section id="conteudos" class="py-5 bg-light">
  <div class="container">
    <h2 class="section-title">Conteúdos Selecionados</h2>
    <div class="row g-4">
      <!-- 12 conteúdos -->
      <!-- Vídeos -->
      <div class="col-md-4">
        <div class="card card-content h-100 shadow">
          <img src="https://images.unsplash.com/photo-1581091012184-4f0b55f3f1cd?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Video Aula 1">
          <div class="card-body">
            <h5 class="card-title">Video Aula: HTML Básico</h5>
            <p class="card-text">Aprenda os fundamentos de HTML de forma prática e visual.</p>
            <a href="#" class="btn btn-danger btn-sm"><i class="bi bi-play-circle"></i> Assistir</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-content h-100 shadow">
          <img src="https://images.unsplash.com/photo-1612831661077-7c3d69c1078f?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Video Aula 2">
          <div class="card-body">
            <h5 class="card-title">Video Aula: CSS Avançado</h5>
            <p class="card-text">Aprenda técnicas avançadas de CSS para criar layouts modernos.</p>
            <a href="#" class="btn btn-danger btn-sm"><i class="bi bi-play-circle"></i> Assistir</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-content h-100 shadow">
          <img src="https://images.unsplash.com/photo-1611078489745-22f87d56f2d7?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Video Aula 3">
          <div class="card-body">
            <h5 class="card-title">Video Aula: JavaScript</h5>
            <p class="card-text">Introdução ao JavaScript e interatividade na web.</p>
            <a href="#" class="btn btn-danger btn-sm"><i class="bi bi-play-circle"></i> Assistir</a>
          </div>
        </div>
      </div>

      <!-- PDFs -->
      <div class="col-md-4">
        <div class="card card-content h-100 shadow">
          <img src="https://images.unsplash.com/photo-1555421689-6b3d8328f36b?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="PDF 1">
          <div class="card-body">
            <h5 class="card-title">PDF: Guia HTML</h5>
            <p class="card-text">PDF completo com exemplos de HTML prontos para estudo.</p>
            <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-file-earmark-pdf"></i> Baixar PDF</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-content h-100 shadow">
          <img src="https://images.unsplash.com/photo-1603791452906-7cce4b7a8c39?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="PDF 2">
          <div class="card-body">
            <h5 class="card-title">PDF: Guia CSS</h5>
            <p class="card-text">Aprenda CSS com exemplos práticos e exercícios.</p>
            <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-file-earmark-pdf"></i> Baixar PDF</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-content h-100 shadow">
          <img src="https://images.unsplash.com/photo-1612831455547-c4cf44bfc7b5?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="PDF 3">
          <div class="card-body">
            <h5 class="card-title">PDF: Guia JavaScript</h5>
            <p class="card-text">Aprenda conceitos e funções de JavaScript com exemplos práticos.</p>
            <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-file-earmark-pdf"></i> Baixar PDF</a>
          </div>
        </div>
      </div>

     <!-- Tutoriais Compactos -->
<section id="tutoriais" class="py-5 bg-light">
  <div class="container">
    <h2 class="section-title">Tutoriais</h2>
    <div class="row g-3">

      <!-- Tutorial 1 -->
      <div class="col-md-4">
        <div class="card card-content h-100 shadow" style="max-height: 300px;">
          <img src="https://images.unsplash.com/photo-1627308595229-7830a5c91f9f?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Tutorial 1" style="height: 140px; object-fit: cover;">
          <div class="card-body p-2">
            <h6 class="card-title mb-1">Tutorial: Git e GitHub</h6>
            <p class="card-text mb-2" style="font-size: 0.85rem;">Aprenda a versionar projetos e colaborar com Git e GitHub.</p>
            <a href="#" class="btn btn-success btn-sm btn-block" style="font-size: 0.75rem;"><i class="bi bi-book"></i> Ler Tutorial</a>
          </div>
        </div>
      </div>

      <!-- Tutorial 2 -->
      <div class="col-md-4">
        <div class="card card-content h-100 shadow" style="max-height: 300px;">
          <img src="https://images.unsplash.com/photo-1633345992147-58a2f4a0f0d6?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Tutorial 2" style="height: 140px; object-fit: cover;">
          <div class="card-body p-2">
            <h6 class="card-title mb-1">Tutorial: SQL Básico</h6>
            <p class="card-text mb-2" style="font-size: 0.85rem;">Aprenda a criar e consultar bancos de dados relacionais.</p>
            <a href="#" class="btn btn-success btn-sm btn-block" style="font-size: 0.75rem;"><i class="bi bi-book"></i> Ler Tutorial</a>
          </div>
        </div>
      </div>

      <!-- Tutorial 3 -->
      <div class="col-md-4">
        <div class="card card-content h-100 shadow" style="max-height: 300px;">
          <img src="https://images.unsplash.com/photo-1605902711622-cfb43c4436a7?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Tutorial 3" style="height: 140px; object-fit: cover;">
          <div class="card-body p-2">
            <h6 class="card-title mb-1">Tutorial: Segurança Web</h6>
            <p class="card-text mb-2" style="font-size: 0.85rem;">Aprenda boas práticas de segurança para aplicações web.</p>
            <a href="#" class="btn btn-success btn-sm btn-block" style="font-size: 0.75rem;"><i class="bi bi-book"></i> Ler Tutorial</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Rodapé -->
<footer class="text-center">
  <div class="container">
    <p class="mb-0">&copy; 2025 ConnectaTI — Todos os direitos reservados</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
