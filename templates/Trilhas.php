<?php
session_start();

// Verificar se usuário está logado
if (!isset($_SESSION['id'], $_SESSION['tipo'])) {
    header("Location: login.php");
    exit;
}

$tipo = $_SESSION['tipo'];
$nome = $_SESSION['nome'] ?? 'Usuário';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- Ícone -->
    <link rel="icon" type="image/png" href="../img/Logo ConnectTI.png">

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ConnectTI — Trilhas de Aprendizado</title>

    <!-- Bootstrap (utilitários) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS da Trilha -->
    <link rel="stylesheet" href="../styles/trilhas.css">
    
    <!-- CSS do Chat IA -->
    <link rel="stylesheet" href="../styles/ai.css">
</head>
<body>

    <!-- TOPBAR -->
    <div class="topbar">
        <a href="index.php" class="brand">ConnectTI</a>

        <div class="controls">
            <div class="chip">Trilhas</div>
            <div class="chip" id="meusCursosBtn">Meus Cursos</div>
            <div class="chip">👤 <?= htmlspecialchars($nome) ?></div>
        </div>

        <div class="search">
            <input id="searchInput" placeholder="Pesquisar trilhas ou cursos..." />
        </div>
    </div>

    <div class="container-main">

        <!-- HERO -->
        <section class="hero">
            <div class="info">
                <h1>Trilha Pro — Web & Infra</h1>
                <p>Curadoria com cursos práticos, projetos e certificação. Comece pela trilha que mais combina com você.</p>
                <div>
                    <button class="btn-cta" id="startHero">Continuar Trilha</button>
                    <button class="btn-outline" id="exploreHero">Explorar Trilhas</button>
                </div>
            </div>
            <div style="flex:1"></div>
        </section>

        <!-- Filtragem rápida -->
        <div class="filters-bar">
            <button class="chip no-select active" data-filter="all">Todos</button>
            <button class="chip no-select" data-filter="web">Web</button>
            <button class="chip no-select" data-filter="frontend">Front-end</button>
            <button class="chip no-select" data-filter="backend">Back-end</button>
            <button class="chip no-select" data-filter="infra">Infra</button>
            <button class="chip no-select" data-filter="cloud">Cloud</button>
            <button class="chip no-select" data-filter="security">Security</button>
            
            <div style="margin-left:auto; display:flex; gap:10px;">
                <div class="icon-btn" id="showFavs">
                    <span>❤️</span> Favoritos
                </div>
                <div class="icon-btn" id="resetProgress">
                    <span>🔄</span> Reset
                </div>
            </div>
        </div>

        <!-- Rows (cada linha é uma categoria com scroller estilo Netflix) -->
        <section class="trilhas-section">
            
            <!-- Recomendadas -->
            <div class="row-header">
                <h3>🔥 Recomendadas para você</h3>
                <span class="row-count" id="count-recomendadas">0 cursos</span>
            </div>
            <div id="row-recomendadas" class="cards-row"></div>

            <!-- Front-end -->
            <div class="row-header">
                <h3>🎨 Front-end</h3>
                <span class="row-count" id="count-frontend">0 cursos</span>
            </div>
            <div id="row-frontend" class="cards-row"></div>

            <!-- Back-end -->
            <div class="row-header">
                <h3>⚙️ Back-end & BD</h3>
                <span class="row-count" id="count-backend">0 cursos</span>
            </div>
            <div id="row-backend" class="cards-row"></div>

            <!-- Cloud & DevOps -->
            <div class="row-header">
                <h3>☁️ Cloud & DevOps</h3>
                <span class="row-count" id="count-cloud">0 cursos</span>
            </div>
            <div id="row-cloud" class="cards-row"></div>

            <!-- Segurança -->
            <div class="row-header">
                <h3>🔒 Segurança</h3>
                <span class="row-count" id="count-security">0 cursos</span>
            </div>
            <div id="row-security" class="cards-row"></div>
            
        </section>

    </div>

    <!-- MODAL DETALHE -->
    <div id="modal" class="modal-bg">
        <div class="modal-card">
            <button class="close-btn" id="closeModal">✕</button>
            <div class="modal-poster">
                <img id="modalImg" src="" alt="Curso">
            </div>
            <div class="modal-right">
                <h2 id="modalTitle"></h2>
                <p id="modalDesc"></p>
                
                <div class="modal-meta">
                    <span class="chip" id="modalCat"></span>
                    <span class="chip" id="modalDur"></span>
                </div>
                
                <div class="modal-progress">
                    <span>Progresso:</span>
                    <div class="progress-track" style="width: 100%;">
                        <div class="progress-bar" id="modalProgress" style="width: 0%;"></div>
                    </div>
                    <span id="modalProgressText">0%</span>
                </div>
                
                <div style="display:flex; gap:10px; margin-top:20px;">
                    <button class="btn-cta" id="modalStart">▶ Iniciar</button>
                    <button class="btn-outline" id="modalPreview">👁️ Visualizar</button>
                    <button class="btn-outline" id="modalFavorite">❤️ Favoritar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- BOTÃO DO CHAT IA -->
    <button id="aiChatBtn">🤖</button>

    <!-- JANELA DO CHAT IA -->
    <div id="aiChatWindow">

        <div class="ai-header">
            <img src="https://cdn-icons-png.flaticon.com/512/4712/4712103.png" class="ai-avatar">
            <h3>Assistente ConnectTI</h3>
            <button id="aiCloseBtn">✕</button>
        </div>

        <!-- IMPORTANTE: vazio -->
        <div id="aiMessages"></div>

        <div class="ai-input-area">
            <input type="text" id="aiUserInput" placeholder="Digite sua dúvida...">
            <button id="aiSendBtn">Enviar</button>
        </div>

    </div>

    <!-- Dados PHP para JS -->
    <script>
        window.userData = {
            id: <?= json_encode($_SESSION['id']) ?>,
            tipo: <?= json_encode($tipo) ?>,
            nome: <?= json_encode($nome) ?>
        };
    </script>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../scripts/trilhas.js"></script>
    <script src="../scripts/ai.js"></script>

</body>
</html>