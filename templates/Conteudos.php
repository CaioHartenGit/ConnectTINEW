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

    <!-- CSS externo -->
    <link rel="stylesheet" href="../styles/conteudos.css">
    
    <!-- CSS FORÇADO para garantir a sombra -->
    <style>
        .hero h1, .hero p {
            text-shadow: 3px 3px 8px #000000, 0 0 20px #000000 !important;
        }
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

<!-- TRILHAS -->
<section id="trilhas" class="py-5">
    <div class="container">
        <h2 class="section-title">Trilhas de Estudo</h2>
        <div class="row g-4">
            <!-- Trilha 1 - Dev Início -->
            <div class="col-md-4">
                <div class="card card-content h-100 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1558021212-51b6b1c5c4a2?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Dev Início" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Como começar em Dev</h5>
                        <p class="card-text">Guia completo para iniciantes. Aprenda a programar com passos práticos e exemplos reais.</p>
                        <a href="#" class="btn btn-danger btn-sm"><i class="bi bi-play-circle"></i> Video Aula</a>
                    </div>
                </div>
            </div>

            <!-- Trilha 2 - Segurança -->
            <div class="col-md-4">
                <div class="card card-content h-100 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Segurança" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Segurança em TI</h5>
                        <p class="card-text">Aprenda conceitos essenciais de segurança, proteção de dados e boas práticas.</p>
                        <a href="#" class="btn btn-success btn-sm"><i class="bi bi-book"></i> Tutorial</a>
                    </div>
                </div>
            </div>

            <!-- Trilha 3 - Banco de Dados -->
            <div class="col-md-4">
                <div class="card card-content h-100 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Banco de Dados" style="height: 180px; object-fit: cover;">
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

<!-- CONTEÚDOS SELECIONADOS -->
<section id="conteudos" class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title">Conteúdos Selecionados</h2>
        <div class="row g-4">
            <!-- VÍDEO AULAS (6 cards) -->
            <div class="col-md-4">
                <div class="card card-content h-100 shadow">
                    <img src="https://images.unsplash.com/photo-1581091012184-4f0b55f3f1cd?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="HTML Básico" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Video Aula: HTML Básico</h5>
                        <p class="card-text">Aprenda os fundamentos de HTML de forma prática e visual.</p>
                        <a href="#" class="btn btn-danger btn-sm"><i class="bi bi-play-circle"></i> Assistir</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card card-content h-100 shadow">
                    <img src="https://images.unsplash.com/photo-1612831661077-7c3d69c1078f?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="CSS Avançado" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Video Aula: CSS Avançado</h5>
                        <p class="card-text">Aprenda técnicas avançadas de CSS para criar layouts modernos.</p>
                        <a href="#" class="btn btn-danger btn-sm"><i class="bi bi-play-circle"></i> Assistir</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card card-content h-100 shadow">
                    <img src="https://images.unsplash.com/photo-1611078489745-22f87d56f2d7?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="JavaScript" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Video Aula: JavaScript</h5>
                        <p class="card-text">Introdução ao JavaScript e interatividade na web.</p>
                        <a href="#" class="btn btn-danger btn-sm"><i class="bi bi-play-circle"></i> Assistir</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card card-content h-100 shadow">
                    <img src="https://images.unsplash.com/photo-1633356122102-3fe601e05bd2?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="React" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Video Aula: React</h5>
                        <p class="card-text">Aprenda a criar interfaces com React do zero.</p>
                        <a href="#" class="btn btn-danger btn-sm"><i class="bi bi-play-circle"></i> Assistir</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card card-content h-100 shadow">
                    <img src="https://images.unsplash.com/photo-1627398242454-45a1465c2479?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Node.js" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Video Aula: Node.js</h5>
                        <p class="card-text">Construa APIs poderosas com Node.js e Express.</p>
                        <a href="#" class="btn btn-danger btn-sm"><i class="bi bi-play-circle"></i> Assistir</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card card-content h-100 shadow">
                    <img src="https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Python" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Video Aula: Python</h5>
                        <p class="card-text">Programação em Python para iniciantes.</p>
                        <a href="#" class="btn btn-danger btn-sm"><i class="bi bi-play-circle"></i> Assistir</a>
                    </div>
                </div>
            </div>

            <!-- PDFs (6 cards) -->
            <div class="col-md-4">
                <div class="card card-content h-100 shadow">
                    <img src="https://images.pexels.com/photos/669615/pexels-photo-669615.jpeg?auto=compress&cs=tinysrgb&w=600" class="card-img-top" alt="PDF HTML" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">PDF: Guia HTML</h5>
                        <p class="card-text">PDF completo com exemplos de HTML prontos para estudo.</p>
                        <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-file-earmark-pdf"></i> Baixar PDF</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card card-content h-100 shadow">
                    <img src="https://images.pexels.com/photos/577585/pexels-photo-577585.jpeg?auto=compress&cs=tinysrgb&w=600" class="card-img-top" alt="PDF CSS" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">PDF: Guia CSS</h5>
                        <p class="card-text">Aprenda CSS com exemplos práticos e exercícios.</p>
                        <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-file-earmark-pdf"></i> Baixar PDF</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card card-content h-100 shadow">
                    <img src="https://images.pexels.com/photos/1181671/pexels-photo-1181671.jpeg?auto=compress&cs=tinysrgb&w=600" class="card-img-top" alt="PDF JavaScript" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">PDF: Guia JavaScript</h5>
                        <p class="card-text">Aprenda conceitos e funções de JavaScript com exemplos práticos.</p>
                        <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-file-earmark-pdf"></i> Baixar PDF</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card card-content h-100 shadow">
                    <img src="https://images.pexels.com/photos/248515/pexels-photo-248515.png?auto=compress&cs=tinysrgb&w=600" class="card-img-top" alt="PDF Python" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">PDF: Python</h5>
                        <p class="card-text">Aprenda Python do zero com exemplos práticos.</p>
                        <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-file-earmark-pdf"></i> Baixar PDF</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card card-content h-100 shadow">
                    <img src="https://images.pexels.com/photos/1181263/pexels-photo-1181263.jpeg?auto=compress&cs=tinysrgb&w=600" class="card-img-top" alt="PDF React" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">PDF: React</h5>
                        <p class="card-text">Guia completo para aprender React do básico ao avançado.</p>
                        <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-file-earmark-pdf"></i> Baixar PDF</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card card-content h-100 shadow">
                    <img src="https://images.pexels.com/photos/1181677/pexels-photo-1181677.jpeg?auto=compress&cs=tinysrgb&w=600" class="card-img-top" alt="PDF Node.js" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">PDF: Node.js</h5>
                        <p class="card-text">Aprenda a construir APIs com Node.js e Express.</p>
                        <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-file-earmark-pdf"></i> Baixar PDF</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TUTORIAIS -->
<section id="tutoriais" class="py-5">
    <div class="container">
        <h2 class="section-title">Tutoriais</h2>
        <div class="row g-4">
            <!-- Tutorial 1 - Git -->
            <div class="col-md-4">
                <div class="card card-content h-100 shadow">
                    <img src="https://images.unsplash.com/photo-1627308595229-7830a5c91f9f?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Git Tutorial" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Tutorial: Git e GitHub</h5>
                        <p class="card-text">Aprenda a versionar projetos e colaborar com Git e GitHub.</p>
                        <a href="#" class="btn btn-success btn-sm"><i class="bi bi-book"></i> Ler Tutorial</a>
                    </div>
                </div>
            </div>

            <!-- Tutorial 2 - SQL -->
            <div class="col-md-4">
                <div class="card card-content h-100 shadow">
                    <img src="https://images.unsplash.com/photo-1633345992147-58a2f4a0f0d6?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="SQL Tutorial" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Tutorial: SQL Básico</h5>
                        <p class="card-text">Aprenda a criar e consultar bancos de dados relacionais.</p>
                        <a href="#" class="btn btn-success btn-sm"><i class="bi bi-book"></i> Ler Tutorial</a>
                    </div>
                </div>
            </div>

            <!-- Tutorial 3 - Segurança -->
            <div class="col-md-4">
                <div class="card card-content h-100 shadow">
                    <img src="https://images.unsplash.com/photo-1605902711622-cfb43c4436a7?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Segurança Tutorial" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Tutorial: Segurança Web</h5>
                        <p class="card-text">Aprenda boas práticas de segurança para aplicações web.</p>
                        <a href="#" class="btn btn-success btn-sm"><i class="bi bi-book"></i> Ler Tutorial</a>
                    </div>
                </div>
            </div>

            <!-- Tutorial 4 - Docker -->
            <div class="col-md-4">
                <div class="card card-content h-100 shadow">
                    <img src="https://images.unsplash.com/photo-1605745341112-85968b19335b?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Docker Tutorial" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Tutorial: Docker</h5>
                        <p class="card-text">Aprenda a criar containers e gerenciar ambientes com Docker.</p>
                        <a href="#" class="btn btn-success btn-sm"><i class="bi bi-book"></i> Ler Tutorial</a>
                    </div>
                </div>
            </div>

            <!-- Tutorial 5 - AWS -->
            <div class="col-md-4">
                <div class="card card-content h-100 shadow">
                    <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="AWS Tutorial" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Tutorial: AWS Básico</h5>
                        <p class="card-text">Introdução aos serviços da Amazon Web Services.</p>
                        <a href="#" class="btn btn-success btn-sm"><i class="bi bi-book"></i> Ler Tutorial</a>
                    </div>
                </div>
            </div>

            <!-- Tutorial 6 - MongoDB -->
            <div class="col-md-4">
                <div class="card card-content h-100 shadow">
                    <img src="https://images.unsplash.com/photo-1544383835-bda2bc66a55d?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="MongoDB Tutorial" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Tutorial: MongoDB</h5>
                        <p class="card-text">Aprenda bancos de dados NoSQL com MongoDB.</p>
                        <a href="#" class="btn btn-success btn-sm"><i class="bi bi-book"></i> Ler Tutorial</a>
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

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../scripts/conteudos.js"></script>
</body>
</html>