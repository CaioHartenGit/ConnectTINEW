<!doctype html>
<html lang="pt-BR">
<head>
    <!-- Se for PNG -->
    <link rel="icon" type="image/png" href="Logo ConnectTI.png">
    
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ConnectTI — Pratique (Pro)</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- CSS Principal -->
    <link rel="stylesheet" href="../styles/pratique.css">
</head>
<body>

    <!-- TOPBAR -->
    <div class="topbar">
        <a href="index.php" class="brand">ConnectTI</a>
        <div style="display:flex; gap:8px">
            <button class="small-btn" id="btnDaily">Desafio do Dia</button>
            <button class="small-btn" id="btnGames">Mini-Jogos</button>
        </div>
        <div class="search">
            <input id="searchInput" placeholder="Procurar simuladores, desafios, editores..." />
        </div>
    </div>

    <div class="container-main">

        <!-- HERO -->
        <section class="hero">
            <div>
                <h1>Pratique como um profissional</h1>
                <p>Editor integrado, labs, simuladores de redes, mini-jogos, ranking e gamificação — tudo em um só lugar.</p>
            </div>
            <div style="flex:1"></div>
        </section>

        <!-- Rows -->
        <div class="row-title" style="margin-top:14px">
            <h3>Destaques</h3>
            <div>
                <button class="nav-btn" data-target="row-destaques" data-dir="-1">◀</button>
                <button class="nav-btn" data-target="row-destaques" data-dir="1">▶</button>
            </div>
        </div>
        <div id="row-destaques" class="cards-row"></div>

        <div class="row-title" style="margin-top:18px">
            <h3>Editores & IDEs</h3>
            <div>
                <button class="nav-btn" data-target="row-editors" data-dir="-1">◀</button>
                <button class="nav-btn" data-target="row-editors" data-dir="1">▶</button>
            </div>
        </div>
        <div id="row-editors" class="cards-row"></div>

        <div class="row-title" style="margin-top:18px">
            <h3>Simuladores & Labs</h3>
            <div>
                <button class="nav-btn" data-target="row-sims" data-dir="-1">◀</button>
                <button class="nav-btn" data-target="row-sims" data-dir="1">▶</button>
            </div>
        </div>
        <div id="row-sims" class="cards-row"></div>

        <div class="row-title" style="margin-top:18px">
            <h3>Desafios Rápidos</h3>
            <div>
                <button class="nav-btn" data-target="row-challenges" data-dir="-1">◀</button>
                <button class="nav-btn" data-target="row-challenges" data-dir="1">▶</button>
            </div>
        </div>
        <div id="row-challenges" class="cards-row"></div>

        <!-- Editor ao vivo + painel -->
        <section style="margin-top:28px">
            <div style="display:flex; gap:18px; align-items:flex-start">
                <div style="flex:1">
                    <h3 style="margin:0 0 12px">Editor de Código Ao Vivo</h3>
                    <div class="editor-wrap">
                        <div class="editor-panel">
                            <label style="font-size:13px; color:var(--muted)">HTML / CSS / JS (edite abaixo)</label>
                            <textarea id="codeArea"><!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial; color: #222; }
        h1 { color: #0077cc; }
    </style>
</head>
<body>
    <h1>Olá, ConnectTI!</h1>
    <p>Edite e clique em Executar.</p>
</body>
</html></textarea>
                            <div class="run-controls">
                                <button class="btn-primary-ghost" id="runBtn">Executar</button>
                                <button class="small-btn" id="saveSnippet">Salvar Snippet</button>
                                <select id="snippets" class="snippet-select">
                                    <option value="">Snippets salvos</option>
                                </select>
                            </div>
                        </div>
                        <div class="preview-panel">
                            <iframe id="previewFrame" class="preview-iframe"></iframe>
                        </div>
                    </div>
                </div>

                <!-- Gamification summary -->
                <aside style="width:300px">
                    <div style="background:var(--panel); padding:12px; border-radius:10px">
                        <h4 style="margin:0 0 8px">Perfil de Prática</h4>
                        <div style="display:flex; align-items:center; gap:12px">
                            <div class="profile-avatar">V</div>
                            <div>
                                <div id="profileName" style="font-weight:700">Você</div>
                                <div id="levelText" style="color:var(--muted); font-size:13px">Nível 1 • 0 XP</div>
                            </div>
                        </div>

                        <div style="margin-top:12px">
                            <div style="font-size:13px; color:var(--muted)">XP</div>
                            <div class="xp-track">
                                <div id="xpBar" class="xp-bar"></div>
                            </div>
                            <div style="display:flex; justify-content:space-between; font-size:12px; color:var(--muted); margin-top:6px">
                                <span id="xpNow">0 XP</span>
                                <span id="xpNext">100 XP</span>
                            </div>
                        </div>

                        <div style="margin-top:12px">
                            <div style="font-size:13px; color:var(--muted); margin-bottom:8px">Badges</div>
                            <div id="badgesList" style="display:flex; gap:8px; flex-wrap:wrap"></div>
                        </div>
                    </div>

                    <!-- Ranking -->
                    <div class="ranking" id="rankingBox" style="margin-top:12px">
                        <h4>Ranking</h4>
                        <div id="leaderboard"></div>
                    </div>
                </aside>
            </div>
        </section>

        <!-- Mini-games area -->
        <section style="margin-top:28px">
            <h3>Mini-Jogos Interativos</h3>
            <div style="display:flex; gap:12px; flex-wrap:wrap; margin-top:10px">
                <div style="width:300px" class="challenge-card">
                    <h4>Quiz Rápido (JS)</h4>
                    <p>Responda corretamente para ganhar XP.</p>
                    <button class="btn-challenge" id="startQuiz">Começar Quiz</button>
                </div>

                <div style="width:300px" class="challenge-card">
                    <h4>Memory Game (Cards)</h4>
                    <p>Combine pares — pontuação por tempo.</p>
                    <button class="btn-challenge" id="startMemory">Jogar</button>
                </div>

                <div style="width:300px" class="challenge-card">
                    <h4>Simulador de Redes</h4>
                    <p>Digite IP/máscara e calcule rede/broadcast.</p>
                    <button class="btn-challenge" id="openNetSim">Abrir Simulador</button>
                </div>
            </div>
        </section>

    </div> <!-- /container-main -->

    <!-- MODAL Detalhes -->
    <div id="modal" class="modal-bg">
        <div class="modal-card">
            <button class="close-btn" id="closeModal">✕</button>
            <div class="modal-poster">
                <img id="modalImg" src="" style="width:100%; height:100%; object-fit:cover"/>
            </div>
            <div class="modal-right">
                <h2 id="modalTitle">Título</h2>
                <p id="modalDesc">Descrição</p>
                <div style="margin-top:8px">
                    <span class="small-btn" id="modalCat">Categoria</span>
                    <span class="small-btn" id="modalDur" style="margin-left:8px">Duração</span>
                </div>
                <div style="margin-top:12px" class="modal-actions">
                    <button class="btn-primary-ghost" id="modalStart">Iniciar</button>
                    <button class="small-btn" id="modalFav">Favoritar</button>
                </div>
                <div style="margin-top:12px;">
                    <div style="font-size:13px; color:var(--muted)">Progresso</div>
                    <div class="xp-track" style="margin-top:8px">
                        <div id="modalProg" class="modal-progress-bar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- NETWORK SIMULATOR MODAL -->
    <div id="netsim" class="modal-bg">
        <div class="modal-card" style="max-width:720px">
            <button class="close-btn" id="closeNetSim">✕</button>
            <div style="flex:1">
                <h3>Simulador de Redes</h3>
                <p style="color:var(--muted)">Insira um IP e máscara para calcular endereço de rede e broadcast.</p>
                <div style="display:flex; gap:8px; margin-top:10px">
                    <input id="ns_ip" placeholder="Ex: 192.168.1.10" class="net-input" />
                    <input id="ns_mask" placeholder="Ex: 255.255.255.0" class="net-input" style="width:160px" />
                    <button class="btn-primary-ghost" id="calcNet">Calcular</button>
                </div>
                <div id="ns_result" style="margin-top:12px; color:var(--muted)"></div>
            </div>
        </div>
    </div>

    <!-- QUIZ MODAL -->
    <div id="quizModal" class="modal-bg">
        <div class="modal-card" style="max-width:720px">
            <button class="close-btn" id="closeQuiz">✕</button>
            <div style="flex:1">
                <h3>Quiz Rápido</h3>
                <div id="quizArea"></div>
            </div>
        </div>
    </div>

    <!-- MEMORY MODAL -->
    <div id="memModal" class="modal-bg">
        <div class="modal-card" style="max-width:760px">
            <button class="close-btn" id="closeMem">✕</button>
            <div style="flex:1">
                <h3>Memory Game</h3>
                <div id="memArea" class="memory-grid"></div>
                <div style="margin-top:10px">
                    <button class="btn-primary-ghost" id="restartMem">Reiniciar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- TOAST AREA -->
    <div id="toastRoot"></div>

    <!-- JavaScript Principal -->
    <script src="../scripts/pratique.js"></script>
</body>
</html>