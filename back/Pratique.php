<!doctype html>
<html lang="pt-BR">
<head>

      <!-- Se for PNG -->
<link rel="icon" type="image/png" href="Logo ConnectTI.png">

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>ConnectTI — Pratique (Pro)</title>

  <!-- Bootstrappy utilities (opcional) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
  /* ========== THEME ========== */
  :root{
    --bg:#05060a; --panel:#0d1318; --muted:#9aa4b2; --accent:#ff3b30; --glass: rgba(255,255,255,0.03);
  }
  *{box-sizing:border-box}
  body{margin:0;background:var(--bg);color:#e7f3ff;font-family:Inter,system-ui,Arial,sans-serif}
  a{color:inherit}

  /* ===== TOPBAR ===== */
  .topbar{height:68px;display:flex;align-items:center;padding:0 20px;background:linear-gradient(180deg, rgba(0,0,0,0.2), transparent);gap:12px}
  .brand{font-weight:800;font-size:20px;color:#fff;margin-right:12px}
  .search {margin-left:auto; width:360px}
  .search input{width:100%;padding:8px 12px;border-radius:8px;border:0;background:#081018;color:#dbeaff}
  .small-btn{background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.04);padding:8px 12px;border-radius:8px;color:#dbeaff;cursor:pointer}

  /* ===== CONTAINER ===== */
  .container-main{padding:18px 22px 80px}

  /* ===== HERO ===== */
  .hero{
    background:linear-gradient(90deg, rgba(0,0,0,0.6), rgba(0,0,0,0.2)), url('https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;
    border-radius:10px;padding:28px;display:flex;align-items:flex-end;gap:18px;margin-bottom:18px;
  }
  .hero h1{font-size:28px;margin:0}
  .hero p{color:var(--muted);margin:6px 0 0}

  /* ===== ROWS - Netflix style ===== */
  .row-title{display:flex;align-items:center;justify-content:space-between;margin:12px 0}
  .row-title h3{margin:0;font-size:18px}
  .cards-row{display:flex;gap:12px;overflow:auto;padding:10px 2px 18px;scroll-behavior:smooth}
  .cards-row::-webkit-scrollbar{height:8px}
  .cards-row::-webkit-scrollbar-thumb{background:rgba(255,255,255,0.05);border-radius:10px}

  .card-item{min-width:220px;width:220px;background:var(--panel);border-radius:10px;padding:8px;position:relative;transition:transform .18s, box-shadow .18s;cursor:pointer}
  .card-item:hover{transform:translateY(-10px);box-shadow:0 18px 50px rgba(0,0,0,0.6)}
  .poster{height:130px;border-radius:8px;overflow:hidden;background:#000}
  .poster img{width:100%;height:100%;object-fit:cover}
  .card-item h4{font-size:15px;margin:8px 0 4px}
  .card-item p{font-size:13px;color:var(--muted);margin:0 0 12px}
  .meta{display:flex;gap:8px;font-size:12px;color:var(--muted)}
  .fav{position:absolute;top:10px;right:10px;font-size:18px;color:rgba(255,255,255,0.36);transition:transform .12s}
  .fav.active{color:#ffd1da;transform:scale(1.08)}

  .progress-wrap{position:absolute;left:10px;right:10px;bottom:10px}
  .progress-track{height:8px;background:rgba(255,255,255,0.04);border-radius:999px;overflow:hidden}
  .progress-bar{height:8px;background:var(--accent);width:0;transition:width .25s ease}

  .nav-btn{background:transparent;border:1px solid rgba(255,255,255,0.04);padding:8px;border-radius:8px;color:#cfe3ff;cursor:pointer}

  /* ===== EDITOR ===== */
  .editor-wrap{display:flex;gap:12px; margin-top:18px}
  .editor-panel{width:48%;display:flex;flex-direction:column;gap:8px}
  .editor-panel textarea{flex:1;min-height:340px;background:#071018;color:#9ef6ff;border:0;padding:14px;border-radius:10px;font-family:monospace;resize:vertical}
  .preview-panel{width:52%;background:#fff;border-radius:10px;overflow:hidden}
  .preview-iframe{width:100%;height:100%;border:0;min-height:340px}

  .run-controls{display:flex;gap:8px;align-items:center;margin-top:6px}
  .btn-primary-ghost{background:var(--accent);color:#fff;border:0;padding:8px 14px;border-radius:8px;cursor:pointer}

  /* ===== MINI GAMES / CHALLENGES ===== */
  .challenge-card{background:linear-gradient(180deg,#0e1720,#071019);padding:18px;border-radius:12px}
  .btn-challenge{background:#06d6a0;border:0;color:#042; padding:8px 12px;border-radius:8px;cursor:pointer}

  /* ===== RANKING (sidebar style floating) ===== */
  .ranking {
    position:fixed; right:18px; top:88px; width:260px; max-height:70vh; overflow:auto;
    background:linear-gradient(180deg,#07101a, #061018); border-radius:10px; padding:12px; box-shadow:0 14px 40px rgba(0,0,0,.6);
  }
  .ranking h4{margin:0 0 10px}
  .leader {display:flex;align-items:center;gap:10px;padding:8px;border-radius:8px}
  .medal{width:36px;height:36px;border-radius:8px;background:#112;display:flex;align-items:center;justify-content:center;font-weight:700;color:#ffd700}

  /* ===== MODAL (daily challenge / course detail) ===== */
  .modal-bg{position:fixed;inset:0;background:rgba(0,0,0,0.7);display:none;align-items:center;justify-content:center;z-index:9999}
  .modal-card{width:min(920px,95%);background:linear-gradient(180deg,#07101a,#06101a);border-radius:12px;padding:18px;display:flex;gap:18px;color:#eaf3ff;position:relative}
  .modal-poster{width:380px;height:220px;border-radius:8px;overflow:hidden}
  .modal-right{flex:1}
  .close-btn{position:absolute;right:12px;top:8px;background:transparent;border:0;color:#cfe3ff;font-size:20px;cursor:pointer}

  /* ===== TOAST ===== */
  .toast{position:fixed;left:18px;bottom:18px;background:#07101a;padding:10px 14px;border-radius:8px;color:#dbe8ff;box-shadow:0 8px 30px rgba(0,0,0,.6)}

  /* responsive tweaks */
  @media (max-width:1000px){
    .editor-wrap{flex-direction:column}
    .editor-panel, .preview-panel{width:100%}
    .ranking{display:none}
  }
  </style>
</head>
<body>

  <!-- TOPBAR -->
  <div class="topbar">
    <div class="brand">ConnectTI</div>
    <div style="display:flex;gap:8px">
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
      <div style="display:flex;gap:18px;align-items:flex-start">
        <div style="flex:1">
          <h3 style="margin:0 0 12px">Editor de Código Ao Vivo</h3>
          <div class="editor-wrap">
            <div class="editor-panel">
              <label style="font-size:13px;color:var(--muted)">HTML / CSS / JS (edite abaixo)</label>
              <textarea id="codeArea"><!DOCTYPE html>
<html><head><style>body{font-family:Arial;color:#222}h1{color:#0077cc}</style></head><body><h1>Olá, ConnectTI!</h1><p>Edite e clique em Executar.</p></body></html></textarea>
              <div class="run-controls">
                <button class="btn-primary-ghost" id="runBtn">Executar</button>
                <button class="small-btn" id="saveSnippet">Salvar Snippet</button>
                <select id="snippets" style="background:#071018;color:#dbeaff;border-radius:8px;padding:6px;border:0">
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
          <div style="background:var(--panel);padding:12px;border-radius:10px">
            <h4 style="margin:0 0 8px">Perfil de Prática</h4>
            <div style="display:flex;align-items:center;gap:12px">
              <div style="width:64px;height:64px;border-radius:10px;background:#08101a;display:flex;align-items:center;justify-content:center;font-weight:700">V</div>
              <div>
                <div id="profileName" style="font-weight:700">Você</div>
                <div id="levelText" style="color:var(--muted);font-size:13px">Nível 1 • 0 XP</div>
              </div>
            </div>

            <div style="margin-top:12px">
              <div style="font-size:13px;color:var(--muted)">XP</div>
              <div style="height:12px;background:rgba(255,255,255,0.04);border-radius:999px;margin-top:6px;overflow:hidden">
                <div id="xpBar" style="height:12px;width:0;background:var(--accent)"></div>
              </div>
              <div style="display:flex;justify-content:space-between;font-size:12px;color:var(--muted);margin-top:6px">
                <span id="xpNow">0 XP</span><span id="xpNext">100 XP</span>
              </div>
            </div>

            <div style="margin-top:12px">
              <div style="font-size:13px;color:var(--muted);margin-bottom:8px">Badges</div>
              <div id="badgesList" style="display:flex;gap:8px;flex-wrap:wrap"></div>
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
      <div style="display:flex;gap:12px;flex-wrap:wrap;margin-top:10px">
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

  <!-- MODAL -->
  <div id="modal" class="modal-bg">
    <div class="modal-card">
      <button class="close-btn" id="closeModal">✕</button>
      <div class="modal-poster"><img id="modalImg" src="" style="width:100%;height:100%;object-fit:cover"/></div>
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
          <div style="font-size:13px;color:var(--muted)">Progresso</div>
          <div style="height:8px;background:rgba(255,255,255,0.04);border-radius:999px;margin-top:8px;overflow:hidden">
            <div id="modalProg" style="width:0;height:8px;background:var(--accent)"></div>
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
        <div style="display:flex;gap:8px;margin-top:10px">
          <input id="ns_ip" placeholder="Ex: 192.168.1.10" style="flex:1;padding:8px;border-radius:8px;border:0;background:#071018;color:#dbeaff"/>
          <input id="ns_mask" placeholder="Ex: 255.255.255.0" style="width:160px;padding:8px;border-radius:8px;border:0;background:#071018;color:#dbeaff"/>
          <button class="btn-primary-ghost" id="calcNet">Calcular</button>
        </div>
        <div id="ns_result" style="margin-top:12px;color:var(--muted)"></div>
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
        <div id="memArea" style="display:grid;grid-template-columns:repeat(4,1fr);gap:8px;margin-top:12px"></div>
        <div style="margin-top:10px"><button class="btn-primary-ghost" id="restartMem">Reiniciar</button></div>
      </div>
    </div>
  </div>

  <!-- TOAST AREA (simple) -->
  <div id="toastRoot"></div>

  <script>
  /***********************
    DATA + STORAGE HELPERS
  ***********************/
  const ITEMS = [
    {id:'i1', title:'Editor HTML/CSS/JS', cat:'editor', img:'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80', desc:'Editor integrado para testes rápidos.'},
    {id:'i2', title:'Packet Tracer Lite', cat:'sim', img:'https://images.unsplash.com/photo-1547658719-da2b51169166?auto=format&fit=crop&w=800&q=80', desc:'Simulador de redes simplificado.'},
    {id:'i3', title:'SQL Playground', cat:'sim', img:'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=800&q=80', desc:'Ambiente para rodar queries.'},
    {id:'i4', title:'Pentest Lab', cat:'game', img:'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&w=800&q=80', desc:'Laboratório seguro para ataques.'},
    {id:'i5', title:'Kubernetes Quick', cat:'sim', img:'https://images.unsplash.com/photo-1520607162513-77705c0f0d4a?auto=format&fit=crop&w=800&q=80', desc:'Hands-on com containers.'},
    {id:'i6', title:'Mini-Project Fullstack', cat:'challenge', img:'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&w=800&q=80', desc:'Desafio prático completo.'}
  ];

  const XP_KEY = 'ct_xp';
  const BADGES_KEY = 'ct_badges';
  const LEADER_KEY = 'ct_leaderboard'; // array of objects

  function getXP(){ return Number(localStorage.getItem(XP_KEY) || 0) }
  function addXP(n){
    const now = getXP()+n; localStorage.setItem(XP_KEY, String(now)); updateProfileUI();
  }
  function getBadges(){ return JSON.parse(localStorage.getItem(BADGES_KEY) || '[]') }
  function addBadge(b){ const arr = getBadges(); if(!arr.includes(b)){ arr.push(b); localStorage.setItem(BADGES_KEY, JSON.stringify(arr)); updateBadgesUI(); }}
  function saveLeader(name,xp){ // simplistic: push then sort
    const raw = JSON.parse(localStorage.getItem(LEADER_KEY) || '[]'); raw.push({name, xp, date:Date.now()}); raw.sort((a,b)=>b.xp-a.xp); raw.splice(10); localStorage.setItem(LEADER_KEY, JSON.stringify(raw)); renderLeaderboard();
  }

  /***********************
    RENDER ROWS
  ***********************/
  function makeCard(it){
    const el = document.createElement('div'); el.className='card-item'; el.dataset.id = it.id;
    el.innerHTML = `
      <div class="poster"><img src="${it.img}"/></div>
      <h4>${it.title}</h4>
      <p>${it.desc}</p>
      <div class="meta"><span>—</span></div>
      <div class="fav ${isFav(it.id)?'active':''}" title="Favoritar">❤</div>
      <div class="progress-wrap"><div class="progress-track"><div class="progress-bar" style="width:${getProgress(it.id)}%"></div></div></div>
    `;
    // interactions
    el.querySelector('.poster').addEventListener('click', ()=> openDetail(it));
    el.querySelector('h4').addEventListener('click', ()=> openDetail(it));
    el.querySelector('.fav').addEventListener('click', (e)=>{
      e.stopPropagation(); toggleFav(it.id); el.querySelector('.fav').classList.toggle('active');
    });
    return el;
  }

  function renderRows(){
    const rows = {
      'row-destaques': document.getElementById('row-destaques'),
      'row-editors': document.getElementById('row-editors'),
      'row-sims': document.getElementById('row-sims'),
      'row-challenges': document.getElementById('row-challenges')
    };
    Object.values(rows).forEach(r=> r.innerHTML='');
    ITEMS.forEach((it, idx)=>{
      if(idx < 6) rows['row-destaques'].appendChild(makeCard(it));
      if(it.cat==='editor') rows['row-editors'].appendChild(makeCard(it));
      if(it.cat==='sim') rows['row-sims'].appendChild(makeCard(it));
      if(it.cat==='game' || it.cat==='challenge') rows['row-challenges'].appendChild(makeCard(it));
    });
  }

  /***********************
    FAVORITES & PROGRESS
  ***********************/
  function favKey(id){ return 'fav_'+id }
  function isFav(id){ return localStorage.getItem(favKey(id))==='1' }
  function toggleFav(id){ if(isFav(id)) localStorage.removeItem(favKey(id)); else localStorage.setItem(favKey(id),'1') }

  function progKey(id){ return 'prog_'+id }
  function getProgress(id){ return Number(localStorage.getItem(progKey(id)) || 0) }
  function setProgress(id,val){ localStorage.setItem(progKey(id), String(val)) }

  /***********************
    ROW NAV BUTTONS
  ***********************/
  document.querySelectorAll('.nav-btn').forEach(btn=>{
    btn.addEventListener('click', ()=>{
      const target = document.getElementById(btn.dataset.target); const dir = Number(btn.dataset.dir);
      const width = target.clientWidth; target.scrollBy({ left: dir * (width * 0.6), behavior:'smooth' });
    });
  });

  /***********************
    MODAL DETAIL
  ***********************/
  const modal = document.getElementById('modal');
  const modalImg = document.getElementById('modalImg');
  const modalTitle = document.getElementById('modalTitle');
  const modalDesc = document.getElementById('modalDesc');
  const modalCat = document.getElementById('modalCat');
  const modalDur = document.getElementById('modalDur');
  const modalProg = document.getElementById('modalProg');
  document.getElementById('closeModal').addEventListener('click', ()=> modal.style.display='none');
  function openDetail(it){
    modalImg.src = it.img; modalTitle.textContent = it.title; modalDesc.textContent = it.desc; modalCat.textContent = it.cat; modalDur.textContent = '—';
    modalProg.style.width = getProgress(it.id)+'%';
    modal.style.display = 'flex';
    document.getElementById('modalStart').onclick = ()=>{
      // increment progress & give XP
      let p = getProgress(it.id); p = Math.min(100, p + 20); setProgress(it.id, p); modalProg.style.width = p+'%';
      addXP(20); showToast('+'+20+' XP'); persistProfile();
      renderRows();
      modal.style.display = 'none';
    };
    document.getElementById('modalFav').onclick = ()=>{ toggleFav(it.id); renderRows(); }
  }

  /***********************
    PROFILE / XP / BADGES
  ***********************/
  function updateProfileUI(){
    const xp = getXP();
    const level = Math.floor(xp / 100) + 1;
    const xpForNext = (level * 100);
    const xpThisLevel = xp % 100;
    document.getElementById('levelText').textContent = `Nível ${level} • ${xp} XP`;
    document.getElementById('xpBar').style.width = `${(xpThisLevel)}%`;
    document.getElementById('xpNow').textContent = `${xp} XP`;
    document.getElementById('xpNext').textContent = `${xpForNext} XP`;
  }

  function updateBadgesUI(){
    const container = document.getElementById('badgesList'); container.innerHTML='';
    const badges = getBadges();
    if(badges.length ===0) container.innerHTML = '<div style="color:var(--muted)">Nenhuma badge ainda</div>';
    badges.forEach(b=>{
      const el = document.createElement('div'); el.style.padding='6px 8px'; el.style.background='rgba(255,255,255,0.03)'; el.style.borderRadius='8px'; el.textContent = b;
      container.appendChild(el);
    });
  }

  function persistProfile(){
    // add to leaderboard (for demo we add with name "Você")
    saveLeader('Você', getXP());
  }

  /***********************
    LEADERBOARD
  ***********************/
  function renderLeaderboard(){
    const raw = JSON.parse(localStorage.getItem(LEADER_KEY) || '[]');
    const box = document.getElementById('leaderboard'); box.innerHTML='';
    if(raw.length===0) { box.innerHTML='<div style="color:var(--muted)">Sem registros</div>'; return; }
    raw.forEach((u, idx)=>{
      const el = document.createElement('div'); el.className='leader'; el.innerHTML = `<div class="medal">${idx+1}</div><div style="flex:1"><div style="font-weight:700">${u.name}</div><div style="font-size:12px;color:var(--muted)">${u.xp} XP</div></div>`;
      box.appendChild(el);
    });
  }

  /***********************
    EDITOR FUNCTIONALITY
  ***********************/
  const codeArea = document.getElementById('codeArea');
  const previewFrame = document.getElementById('previewFrame').contentWindow.document;
  document.getElementById('runBtn').addEventListener('click', ()=>{
    previewFrame.open(); previewFrame.write(codeArea.value); previewFrame.close();
    addXP(5); showToast('+5 XP por testar código'); persistProfile();
  });

  // snippets save/load
  document.getElementById('saveSnippet').addEventListener('click', ()=>{
    const name = prompt('Nome do snippet:'); if(!name) return;
    const s = JSON.parse(localStorage.getItem('ct_snippets')||'{}'); s[name]=codeArea.value; localStorage.setItem('ct_snippets', JSON.stringify(s)); reloadSnippets();
    showToast('Snippet salvo');
  });
  function reloadSnippets(){
    const sel = document.getElementById('snippets'); sel.innerHTML='<option value="">Snippets salvos</option>';
    const s = JSON.parse(localStorage.getItem('ct_snippets')||'{}'); Object.keys(s).forEach(k=>{ const o = document.createElement('option'); o.value=k; o.textContent=k; sel.appendChild(o); });
  }
  document.getElementById('snippets').addEventListener('change', (e)=>{ const s = JSON.parse(localStorage.getItem('ct_snippets')||'{}'); if(!e.target.value) return; codeArea.value = s[e.target.value]; showToast('Snippet carregado'); });

  /***********************
    MINI-GAMES
  ***********************/
  // QUIZ
  const QUIZ = [
    {q:'Qual comando lista arquivos em Linux?', a:['ls','dir','list'], ok:0},
    {q:'Qual HTML tag para título?', a:['<p>','<h1>','<title>'], ok:1},
    {q:'O que é TCP?', a:['Protocolo de Transferência de Conteúdo','Protocolo orientado à conexão','Tipo de conexão sem fio'], ok:1}
  ];
  document.getElementById('startQuiz').addEventListener('click', ()=> openQuiz());
  function openQuiz(){
    const qm = document.getElementById('quizModal'); qm.style.display='flex';
    const area = document.getElementById('quizArea'); area.innerHTML=''; let score=0;
    QUIZ.forEach((q, idx)=>{
      const div = document.createElement('div'); div.style.marginBottom='12px';
      div.innerHTML = `<div style="font-weight:700">${idx+1}. ${q.q}</div>`;
      q.a.forEach((opt, i)=>{ const b = document.createElement('button'); b.className='small-btn'; b.style.margin='6px 6px 0 0'; b.textContent=opt; b.addEventListener('click', ()=>{
        if(i===q.ok){ score+=1; b.style.background='#06d6a0'; } else { b.style.background='#ff6b6b'; }
        setTimeout(()=>{ if(idx===QUIZ.length-1){ closeQuiz(); addXP(score*20); addBadgeIfNeeded(score); showToast('Quiz finalizado: '+score+'/'+QUIZ.length+' - +' + (score*20) + ' XP'); persistProfile(); } }, 700);
      }); div.appendChild(b); });
      area.appendChild(div);
    });
    document.getElementById('closeQuiz').onclick = ()=> qm.style.display='none';
  }
  function closeQuiz(){ document.getElementById('quizModal').style.display='none'; }

  function addBadgeIfNeeded(score){
    if(score===QUIZ.length){ addBadge('Quiz Master'); }
  }

  // MEMORY GAME
  document.getElementById('startMemory').addEventListener('click', ()=> openMemory());
  document.getElementById('startMemory').addEventListener('click', ()=> openMemory()); // double bind safe
  function openMemory(){
    const m = document.getElementById('memModal'); m.style.display='flex';
    const area = document.getElementById('memArea'); area.innerHTML='';
    const icons = ['⭐','🔥','💻','🔒','⚙️','📦','🐍','☁️'];
    const deck = icons.concat(icons).sort(()=>Math.random()-0.5);
    deck.forEach((sym, i)=>{
      const card = document.createElement('button'); card.className='small-btn'; card.style.height='80px'; card.style.fontSize='28px';
      card.textContent='?'; card.dataset.val = sym; card.dataset.open='0';
      card.addEventListener('click', ()=>{
        if(card.dataset.open==='1') return;
        card.textContent = sym; card.dataset.open='1';
        const opened = Array.from(area.children).filter(c=>c.dataset.open==='1' && !c.dataset.matched);
        if(opened.length===2){
          if(opened[0].dataset.val === opened[1].dataset.val){ opened.forEach(c=>c.dataset.matched='1'); scoreMemory(); } else {
            setTimeout(()=> opened.forEach(c=>{ if(!c.dataset.matched){ c.textContent='?'; c.dataset.open='0' } }), 700);
          }
        }
      });
      area.appendChild(card);
    });
    document.getElementById('closeMem').onclick = ()=> m.style.display='none';
    document.getElementById('restartMem').onclick = ()=> openMemory();
    let memScore = 0;
    function scoreMemory(){ memScore += 10; if(memScore>=80){ addXP(50); addBadge('Memory Champ'); showToast('+50 XP por completar Memory'); persistProfile(); } }
  }

  /***********************
    NETWORK SIMULATOR
  ***********************/
  document.getElementById('openNetSim').addEventListener('click', ()=> document.getElementById('netsim').style.display='flex');
  document.getElementById('closeNetSim').addEventListener('click', ()=> document.getElementById('netsim').style.display='none');
  document.getElementById('calcNet').addEventListener('click', ()=>{
    const ip = document.getElementById('ns_ip').value.trim();
    const mask = document.getElementById('ns_mask').value.trim();
    const res = document.getElementById('ns_result');
    try{
      const info = calcNet(ip, mask);
      res.innerHTML = `<div>Rede: <b>${info.network}</b></div><div>Broadcast: <b>${info.broadcast}</b></div><div>Hosts válidos: <b>${info.hosts}</b></div>`;
      addXP(10); showToast('+10 XP por simular rede'); persistProfile();
    } catch(err){ res.textContent = 'Entrada inválida: ' + err.message; }
  });

  // simple network calc: expects dotted IP and dotted mask (e.g., 255.255.255.0)
  function ipToNum(ip){
    const parts = ip.split('.').map(Number); if(parts.length!==4 || parts.some(p=>isNaN(p) || p<0 || p>255)) throw new Error('IP inválido');
    return ((parts[0]<<24)>>>0) + (parts[1]<<16) + (parts[2]<<8) + parts[3];
  }
  function numToIp(n){
    return [(n>>>24)&255, (n>>>16)&255, (n>>>8)&255, n&255].join('.');
  }
  function calcNet(ip, mask){
    const ipn = ipToNum(ip); const maskn = ipToNum(mask);
    const network = ipn & maskn; const broadcast = (network | (~maskn >>>0))>>>0;
    const hosts = Math.max(0, (broadcast - network - 1));
    return { network: numToIp(network), broadcast: numToIp(broadcast), hosts };
  }

  /***********************
    DAILY CHALLENGE
  ***********************/
  document.getElementById('btnDaily').addEventListener('click', ()=> showDaily());
  function showDaily(){
    const d = new Date().toISOString().slice(0,10);
    const key = 'daily_done_'+d;
    if(localStorage.getItem(key)){ showToast('Você já completou o desafio de hoje!'); return; }
    // simple daily task: small quiz
    const q = {q:'Qual tag cria um link?', opts:['<a>','<link>','<href>'], ok:0};
    const modalQ = document.getElementById('modal'); modalQ.style.display='flex';
    modalImg.src = 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80';
    modalTitle.textContent = 'Desafio do Dia';
    modalDesc.textContent = q.q;
    modalCat.textContent = 'Diário';
    modalDur.textContent = '1m';
    document.getElementById('modalStart').onclick = ()=> {
      const ans = prompt(q.q + '\\nOpções: 0:' + q.opts.join(', ')); if(Number(ans)===q.ok){ addXP(30); addBadge('Daily Champ'); showToast('+30 XP - Desafio concluído'); localStorage.setItem(key,'1'); persistProfile(); modal.style.display='none'; } else { showToast('Resposta incorreta. Tente depois.'); }
    };
  }

  /***********************
    UTILS: toast + init
  ***********************/
  function showToast(msg){
    const t = document.createElement('div'); t.className='toast'; t.textContent = msg; document.getElementById('toastRoot').appendChild(t);
    setTimeout(()=> t.remove(), 2600);
  }

  // search filter
  document.getElementById('searchInput').addEventListener('input', (e)=>{
    const q = e.target.value.toLowerCase();
    document.querySelectorAll('.card-item').forEach(c=>{
      const t = c.querySelector('h4').textContent.toLowerCase(); const p = c.querySelector('p').textContent.toLowerCase();
      c.style.display = (t.includes(q) || p.includes(q)) ? 'block' : 'none';
    });
  });

  /***********************
    BOOTSTRAP: init everything
  ***********************/
  function init(){
    renderRows(); updateProgressUI(); updateProfileUI(); updateBadgesUI(); renderLeaderboard(); reloadSnippets();
    // row buttons already bound
    document.getElementById('btnGames').addEventListener('click', ()=> document.getElementById('memModal').style.display='flex');
    document.getElementById('btnDaily').addEventListener('dblclick', ()=> { localStorage.clear(); location.reload(); });
  }
  function updateProgressUI(){
    document.querySelectorAll('.progress-bar').forEach(pb=>{
      const id = pb.closest('.card-item').dataset.id; pb.style.width = getProgress(id)+'%';
    });
  }

  // profile xp init if empty
  if(!localStorage.getItem(XP_KEY)) localStorage.setItem(XP_KEY, '0');
  if(!localStorage.getItem(LEADER_KEY)) localStorage.setItem(LEADER_KEY, JSON.stringify([{name:'ProUser', xp:250},{name:'DevAna', xp:180},{name:'Você', xp: getXP()}]));
  init();

  </script>
</body>
</html>

