<!doctype html>
<html lang="pt-BR">
<head>
    <!-- Se for PNG - ajuste o caminho -->
    <link rel="icon" type="image/png" href="../Logo ConnectTI.png">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>ConnectTI — Comunidade Pro (Tudo em 1)</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">

    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="../styles/comunidade.css">
</head>
<body>
<body>

<!-- TOPBAR -->
<div class="topbar">
  <a href="index.php" class="brand">ConnectTI <span style="color:var(--accent-2);font-weight:700;margin-left:8px">Comunidade Pro</span></a>
  <div style="display:flex;gap:10px;align-items:center;width:100%;max-width:720px">
    <input id="globalSearch" placeholder="Pesquisar posts, usuários, grupos..." class="input-ghost" />
  </div>
  <div class="top-actions">
    <button id="btnNotifications" class="btn btn-sm btn-outline-light"><i class="ri-notification-3-line"></i> Notificações <span id="notifCount" style="background:#ff4757;border-radius:999px;padding:2px 6px;margin-left:6px;font-size:12px;display:none">0</span></button>
    <button id="btnNewPost" class="btn btn-sm btn-primary">Novo Post</button>
  </div>
</div>

<!-- APP LAYOUT -->
<div class="app">

  <!-- LEFT SIDEBAR -->
  <aside class="sidebar">
    <h4 style="margin:0 0 12px 0">Menu</h4>
    <div class="nav-item active" data-view="feed"><i class="ri-home-line"></i> Feed</div>
    <div class="nav-item" data-view="forum"><i class="ri-question-answer-line"></i> Fórum / Mural</div>
    <div class="nav-item" data-view="profiles"><i class="ri-user-3-line"></i> Perfis</div>
    <div class="nav-item" data-view="blog"><i class="ri-book-open-line"></i> Blog</div>
    <div class="nav-item" data-view="gallery"><i class="ri-image-line"></i> Galeria</div>
    <hr style="border-color:rgba(255,255,255,0.03)" />
    <h4 style="margin-top:6px">Conexões</h4>
    <div style="display:flex;flex-direction:column;gap:8px;margin-top:8px">
      <a class="btn btn-discord" href="#" id="linkDiscord" style="background:#5865F2;color:#fff;padding:8px;border-radius:8px;text-align:center"><i class="ri-discord-fill"></i> Discord</a>
      <a class="btn btn-whatsapp" href="#" id="linkWhats" style="background:#25D366;color:#fff;padding:8px;border-radius:8px;text-align:center"><i class="ri-whatsapp-fill"></i> WhatsApp</a>
      <a class="btn btn-telegram" href="#" id="linkTelegram" style="background:#1C98E8;color:#fff;padding:8px;border-radius:8px;text-align:center"><i class="ri-telegram-fill"></i> Telegram</a>
    </div>
  </aside>

  <!-- MAIN CONTENT -->
  <main class="main">

    <!-- HERO -->
    <div class="card hero">
      <div class="hero-left">
        <h2>Bem-vindo à Comunidade ConnectTI</h2>
        <p style="color:var(--muted)">Discutir, praticar, ensinar e crescer — encontre professores, alunos e conteúdo.</p>
        <div style="margin-top:10px;display:flex;gap:10px">
          <button id="btnJoinCall" class="btn btn-outline-light btn-sm"><i class="ri-vidicon-line"></i> Iniciar Video Call</button>
          <button id="btnCreateThread" class="btn btn-primary btn-sm">Criar Tópico</button>
        </div>
      </div>
      <div class="hero-right" style="text-align:right">
        <div class="note">Última atividade: <b id="lastActivity">agora</b></div>
        <div class="note" id="myXPLabel">XP: 0 • Nível 1</div>
      </div>
    </div>

    <!-- Sections (Feed / Forum / Profiles / Blog / Gallery) -->
    <!-- FEED -->
    <section id="section-feed" class="section active">
      <div class="card">
        <div style="display:flex;justify-content:space-between;align-items:center">
          <h4>Feed da Comunidade</h4>
          <div style="display:flex;gap:8px">
            <button id="filterFollowed" class="btn btn-sm btn-outline-light">Seguindo</button>
            <button id="filterAll" class="btn btn-sm btn-outline-light">Todos</button>
          </div>
        </div>
        <div id="feed" class="feed-list" style="margin-top:12px"></div>
      </div>
    </section>

    <!-- FORUM -->
    <section id="section-forum" class="section">
      <div class="card">
        <div style="display:flex;justify-content:space-between;align-items:center">
          <h4>Mural de Dúvidas</h4>
          <button id="btnNewQuestion" class="btn btn-sm btn-primary">Nova Pergunta</button>
        </div>
        <div id="forum" class="forum" style="margin-top:10px"></div>
      </div>
    </section>

    <!-- PROFILES -->
    <section id="section-profiles" class="section">
      <div class="card">
        <h4>Perfis em destaque</h4>
        <div id="profilesGrid" style="display:flex;gap:12px;flex-wrap:wrap;margin-top:12px"></div>
      </div>
    </section>

    <!-- BLOG -->
    <section id="section-blog" class="section">
      <div class="card">
        <h4>Blog</h4>
        <div id="blogList" class="blog-list" style="margin-top:12px"></div>
      </div>
    </section>

    <!-- GALLERY -->
    <section id="section-gallery" class="section">
      <div class="card">
        <h4>Galeria</h4>
        <div id="galleryGrid" class="gallery-grid" style="margin-top:12px"></div>
      </div>
    </section>

  </main>

  <!-- RIGHT COLUMN -->
  <aside class="rightcol">
    <div class="card">
      <div style="display:flex;gap:12px;align-items:center">
        <img id="myAvatar" src="https://i.imgur.com/WY9Z4Do.jpeg" style="width:64px;height:64px;border-radius:10px;object-fit:cover" />
        <div>
          <div id="myName" style="font-weight:700">Você</div>
          <div style="color:var(--muted);font-size:13px">Aluno • Front-End</div>
        </div>
      </div>

      <div style="margin-top:12px">
        <div style="display:flex;justify-content:space-between;font-size:13px;color:var(--muted)"><span>XP</span><span id="xpCount">0 XP</span></div>
        <div class="xp" style="margin-top:8px">
          <div class="xp-bar" style="flex:1"><div id="xpBar" class="xp-progress" style="width:0%"></div></div>
        </div>
        <div style="margin-top:8px;display:flex;gap:8px;flex-wrap:wrap" id="badgesSidebar"></div>
      </div>
    </div>

    <div class="card" style="margin-top:12px">
      <h4>Ranking</h4>
      <div id="leaderboard" style="margin-top:10px"></div>
    </div>

    <div class="card" style="margin-top:12px">
      <h4>Notificações</h4>
      <div id="notifications" class="notif-list" style="margin-top:8px"></div>
      <button id="clearNotifs" class="btn btn-sm btn-outline-light" style="margin-top:8px">Limpar</button>
    </div>
  </aside>

</div>

<!-- MODALS / LIGHTBOX -->
<div id="modalRoot"></div>

<div id="lightbox" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.85);align-items:center;justify-content:center;z-index:9999">
  <img id="lightboxImg" src="" style="max-width:90%;max-height:85%;border-radius:8px" />
</div>

<div id="videoModal" style="display:none;position:fixed;inset:0;align-items:center;justify-content:center;background:rgba(0,0,0,0.7);z-index:10000">
  <div style="width:900px;max-width:95%;" class="card">
    <div style="display:flex;justify-content:space-between;align-items:center">
      <b>Chamada de Vídeo (preview local)</b>
      <button id="endCall" class="btn btn-sm btn-danger">Encerrar</button>
    </div>
    <div style="display:flex;gap:8px;margin-top:12px">
      <div style="flex:1;background:#000;border-radius:8px;display:flex;align-items:center;justify-content:center"><video id="localVideo" autoplay muted playsinline style="width:100%;height:100%;object-fit:cover"></video></div>
      <div style="flex:1;background:#000;border-radius:8px;display:flex;align-items:center;justify-content:center"><video id="remoteVideo" autoplay playsinline style="width:100%;height:100%;object-fit:cover"></video></div>
    </div>
  </div>
</div>

<!-- JavaScript - caminho correto -->
<script src="../scripts/comunidade.js"></script>

</body>
</html>