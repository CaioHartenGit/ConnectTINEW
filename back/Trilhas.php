<!DOCTYPE html>
<html lang="pt-BR">
<head>
      <!-- Se for PNG -->
<link rel="icon" type="image/png" href="../img/Logo ConnectTI.png">

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>ConnectTI — Trilhas (estilo Netflix)</title>

<!-- Bootstrap (somente para utilitários) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="ai.css">

<style>
  :root{
    --bg:#0b0f17; --card:#0f1720; --accent:#e50914; --muted:#9aa4b2;
  }
  body{background:var(--bg); color:#e6eef6; font-family:Inter, system-ui, Arial, sans-serif; margin:0;}
  .topbar{height:68px; display:flex; align-items:center; padding:0 28px; gap:20px; background:linear-gradient(180deg, rgba(0,0,0,0.25), transparent);}
  .brand{font-weight:800; color:white; font-size:22px; text-decoration:none;}
  .search {margin-left:auto; width:320px;}
  .search input{width:100%; padding:8px 12px; border-radius:8px; border:none; background:#0b1117; color:#cfe3ff;}
  .container-main{padding:22px 34px 60px;}
  .hero{
    background:linear-gradient(90deg, rgba(0,0,0,0.6), rgba(0,0,0,0.2)), url('https://images.unsplash.com/photo-1515879218367-8466d910aaa4?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;
    border-radius:12px; padding:46px; margin-bottom:26px; display:flex; gap:30px; align-items:end;
  }
  .hero .info{max-width:60%;}
  .hero h1{font-size:36px; margin:0 0 8px;}
  .hero p{color:var(--muted); margin:0 0 16px;}
  .btn-cta{background:var(--accent); border:none; padding:10px 18px; color:#fff; border-radius:8px; font-weight:600; margin-right:12px;}
  .btn-outline{background:transparent; border:1px solid rgba(255,255,255,0.08); color:#dbe8ff; padding:9px 16px; border-radius:8px;}

  /* rows */
  .row-title{display:flex; align-items:center; justify-content:space-between; margin:18px 0 10px;}
  .row-title h3{margin:0; font-size:18px;}
  .cards-row{display:flex; gap:12px; overflow:auto; padding-bottom:10px; scroll-behavior:smooth;}
  .cards-row::-webkit-scrollbar{height:8px}
  .cards-row::-webkit-scrollbar-thumb{background:rgba(255,255,255,0.06); border-radius:6px;}

  .card{
    min-width:220px; width:220px; background:var(--card); border-radius:10px; padding:8px; position:relative; cursor:pointer; transition: transform .18s ease, box-shadow .18s;
  }
  .card:hover{transform:translateY(-10px); box-shadow:0 18px 50px rgba(0,0,0,0.6)}
  .poster{height:130px; border-radius:8px; overflow:hidden; background:#111;}
  .poster img{width:100%; height:100%; object-fit:cover; display:block;}
  .card h4{font-size:15px; margin:8px 0 4px; color:#fff;}
  .card p{font-size:13px; color:var(--muted); margin:0 0 8px;}
  .meta{display:flex; align-items:center; gap:8px; font-size:12px; color:var(--muted);}

  /* badge progress + fav */
  .progress-wrap{position:absolute; left:10px; bottom:10px; right:10px;}
  .progress-track{background:rgba(255,255,255,0.06); height:8px; border-radius:999px; overflow:hidden;}
  .progress-bar{height:8px; background:var(--accent); width:0; transition:width .25s ease;}

  .fav{position:absolute; top:10px; right:10px; font-size:18px; color:rgba(255,255,255,0.4); transition:transform .15s;}
  .fav.active{color:#ffd1da; transform:scale(1.1);}

  /* modal */
  .modal-bg{position:fixed; inset:0; background:rgba(0,0,0,0.6); display:none; align-items:center; justify-content:center; z-index:9999;}
  .modal-card{width:min(920px,95%); background:#07101a; border-radius:12px; padding:20px; display:flex; gap:18px; color:#eaf3ff;}
  .modal-poster{width:360px; height:200px; border-radius:8px; overflow:hidden;}
  .modal-right h2{margin-top:0;}
  .modal-right p{color:var(--muted)}
  .close-btn{background:transparent; border:0; color:#cddff7; font-size:20px; cursor:pointer; position:absolute; right:18px; top:18px;}

  /* small screens */
  @media (max-width:900px){
    .hero{flex-direction:column; align-items:flex-start}
    .hero .info{max-width:100%;}
    .cards-row{gap:10px}
    .card{min-width:170px;width:170px}
    .poster{height:110px}
    .modal-card{flex-direction:column}
    .modal-poster{width:100%; height:220px}
  }

  /* utilities */
  .chip{display:inline-block; padding:6px 10px; border-radius:999px; background:rgba(255,255,255,0.04); color:var(--muted); font-size:13px}
  .controls{display:flex; gap:8px; align-items:center}
  .icon-btn{background:rgba(255,255,255,0.02); padding:8px; border-radius:8px; border:1px solid rgba(255,255,255,0.03); color:#cfe3ff}
  .no-select{user-select:none}
</style>
</head>
<body>

  <!-- TOPBAR -->
  <div class="topbar">
    <a href="index.php" class="brand">ConnectTI</a>

    <div class="controls">
      <div class="chip">Trilhas</div>
      <div class="chip">Meus Cursos</div>
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
    <div style="display:flex; gap:12px; align-items:center; margin:16px 0;">
      <button class="chip no-select" data-filter="all">Todos</button>
      <button class="chip no-select" data-filter="web">Web</button>
      <button class="chip no-select" data-filter="infra">Infra</button>
      <button class="chip no-select" data-filter="cloud">Cloud</button>
      <button class="chip no-select" data-filter="security">Security</button>
      <div style="margin-left:auto; display:flex; gap:10px;">
        <div class="icon-btn" id="showFavs">Favoritos</div>
        <div class="icon-btn" id="resetProgress">Reset Progresso</div>
      </div>
    </div>

    <!-- Rows (cada linha é uma categoria com scroller estilo Netflix) -->
    <section>
      <div class="row-title">
        <h3>Recomendadas</h3>
      </div>
      <div id="row-recomendadas" class="cards-row"></div>

      <div class="row-title" style="margin-top:20px">
        <h3>Front-end</h3>
      </div>
      <div id="row-frontend" class="cards-row"></div>

      <div class="row-title" style="margin-top:20px">
        <h3>Back-end & BD</h3>
      </div>
      <div id="row-backend" class="cards-row"></div>

      <div class="row-title" style="margin-top:20px">
        <h3>Cloud & DevOps</h3>
      </div>
      <div id="row-cloud" class="cards-row"></div>

      <div class="row-title" style="margin-top:20px">
        <h3>Segurança</h3>
      </div>
      <div id="row-security" class="cards-row"></div>
    </section>

  </div>

  <!-- MODAL DETALHE -->
  <div id="modal" class="modal-bg">
    <div class="modal-card">
      <button class="close-btn" id="closeModal">✕</button>
      <div class="modal-poster"><img id="modalImg" src="" style="width:100%; height:100%; object-fit:cover; display:block;"/></div>
      <div class="modal-right">
        <h2 id="modalTitle"></h2>
        <p id="modalDesc"></p>
        <div style="margin:12px 0">
          <span class="chip" id="modalCat"></span>
          <span class="chip" id="modalDur" style="margin-left:8px"></span>
        </div>
        <div style="display:flex; gap:10px; margin-top:10px;">
          <button class="btn-cta" id="modalStart">Iniciar</button>
          <button class="btn-outline" id="modalPreview">Visualizar Aula</button>
        </div>
      </div>
    </div>
  </div>

<script>
/* ===== Dados de exemplo (adiciona quantos quiser) ===== */
const COURSES = [
  { id: 'c1', title:'CSS Avançado e Layouts', cat:'web', img:'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=800&q=80', desc:'Grid, Flexbox, animações e patterns práticos.', duration:'6h' },
  { id: 'c2', title:'JavaScript Moderno', cat:'web', img:'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=800&q=80', desc:'ES6+, módulos, patterns e desempenho.', duration:'8h' },
  { id: 'c3', title:'React do Zero', cat:'web', img:'https://images.unsplash.com/photo-1587620962725-abab7fe55159?auto=format&fit=crop&w=800&q=80', desc:'Componentes, hooks, roteamento e deploy.', duration:'10h' },
  { id: 'c4', title:'Node.js e APIs', cat:'backend', img:'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80', desc:'APIs REST, autenticação e testes.', duration:'7h' },
  { id: 'c5', title:'MySQL e Modelagem', cat:'backend', img:'https://images.unsplash.com/photo-1556155092-8707de31f9c4?auto=format&fit=crop&w=800&q=80', desc:'SQL avançado, índices e otimização.', duration:'6h' },
  { id: 'c6', title:'Docker & Kubernetes', cat:'cloud', img:'https://images.unsplash.com/photo-1547658719-da2b51169166?auto=format&fit=crop&w=800&q=80', desc:'Containerização e orquestração.', duration:'9h' },
  { id: 'c7', title:'AWS Fundamentals', cat:'cloud', img:'https://images.unsplash.com/photo-1508873699372-7ae5b6f4f6b2?auto=format&fit=crop&w=800&q=80', desc:'Compute, storage e deploy na nuvem.', duration:'5h' },
  { id: 'c8', title:'Pentest Básico', cat:'security', img:'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=800&q=80', desc:'Conceitos e ferramentas de pentest.', duration:'6h' },
  { id: 'c9', title:'Redes para Devs', cat:'infra', img:'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80', desc:'TCP/IP, NAT, VLANs e troubleshooting.', duration:'4h' },
  { id: 'c10', title:'Certificado Projeto Final', cat:'web', img:'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80', desc:'Projeto prático fullstack para certificação.', duration:'12h' }
];

/* ===== utilidades de storage ===== */
function favKey(id){ return 'fav_'+id }
function progKey(id){ return 'prog_'+id }
function isFav(id){ return localStorage.getItem(favKey(id)) === '1' }
function setFav(id, val){ if(val) localStorage.setItem(favKey(id),'1'); else localStorage.removeItem(favKey(id)) }
function getProg(id){ return Number(localStorage.getItem(progKey(id))||0) }
function setProg(id,val){ localStorage.setItem(progKey(id), String(val)) }

/* ===== render rows dinamicamente ===== */
function makeCard(course){
  const div = document.createElement('div'); div.className='card no-select';
  div.dataset.id=course.id;
  div.innerHTML=`
    <div class="poster"><img src="${course.img}" alt="${escapeHtml(course.title)}"/></div>
    <h4>${course.title}</h4>
    <p>${course.desc}</p>
    <div class="meta"><span>${course.duration}</span></div>
    <div class="fav ${isFav(course.id)?'active':''}" title="Favoritar">❤</div>
    <div class="progress-wrap"><div class="progress-track"><div class="progress-bar" style="width:${getProg(course.id)}%"></div></div></div>
  `;
  // clique abre modal
  div.querySelector('.poster').addEventListener('click', ()=> openModal(course.id));
  div.querySelector('h4').addEventListener('click', ()=> openModal(course.id));
  // fav
  const favEl = div.querySelector('.fav');
  favEl.addEventListener('click', (e)=>{ e.stopPropagation(); const newState=!favEl.classList.contains('active'); favEl.classList.toggle('active'); setFav(course.id,newState); });
  return div;
}

/* populate specific row by filter key */
function populateRows(){
  const rows = {
    recomendadas: document.getElementById('row-recomendadas'),
    frontend: document.getElementById('row-frontend'),
    backend: document.getElementById('row-backend'),
    cloud: document.getElementById('row-cloud'),
    security: document.getElementById('row-security'),
  };
  // clear
  Object.values(rows).forEach(r=> r.innerHTML='');
  // simple distribution by category
  COURSES.forEach(c=>{
    // recomendadas: first 6
    if(COURSES.indexOf(c)<6) rows.recomendadas.appendChild(makeCard(c));
    if(c.cat==='web') rows.frontend.appendChild(makeCard(c));
    if(c.cat==='backend') rows.backend.appendChild(makeCard(c));
    if(c.cat==='cloud') rows.cloud.appendChild(makeCard(c));
    if(c.cat==='security') rows.security.appendChild(makeCard(c));
    if(c.cat==='infra') rows.backend.appendChild(makeCard(c));
  });
}

/* modal */
const modal = document.getElementById('modal');
function openModal(id){
  const c = COURSES.find(x=>x.id===id);
  if(!c) return;
  document.getElementById('modalImg').src = c.img;
  document.getElementById('modalTitle').textContent = c.title;
  document.getElementById('modalDesc').textContent = c.desc;
  document.getElementById('modalCat').textContent = c.cat.toUpperCase();
  document.getElementById('modalDur').textContent = c.duration;
  modal.style.display='flex';
  // start button handler
  document.getElementById('modalStart').onclick = ()=> {
    // increase progress by 15% on start (demo)
    const cur = getProg(id); const next = Math.min(100, cur+15); setProg(id,next); updateProgressBars(); modal.style.display='none';
    alert('Progresso atualizado para '+next+'% (simulação)');
  };
  document.getElementById('modalPreview').onclick = ()=> { alert('Abrir prévia — aqui você pode integrar vídeo/aula.'); };
}
document.getElementById('closeModal').onclick = ()=> modal.style.display='none';
modal.addEventListener('click', (e)=>{ if(e.target===modal) modal.style.display='none'; });

/* progress update */
function updateProgressBars(){
  document.querySelectorAll('.card').forEach(card=>{
    const id = card.dataset.id; const pb = card.querySelector('.progress-bar');
    if(pb) pb.style.width = getProg(id)+'%';
  });
}

/* search */
document.getElementById('searchInput').addEventListener('input', (e)=>{
  const q = e.target.value.toLowerCase();
  document.querySelectorAll('.card').forEach(card=>{
    const t = card.querySelector('h4').textContent.toLowerCase();
    card.style.display = t.includes(q) ? 'block' : 'none';
  });
});

/* chip filter */
document.querySelectorAll('[data-filter]').forEach(btn=>{
  btn.addEventListener('click', ()=>{
    const f = btn.dataset.filter;
    filterBy(f);
  });
});
function filterBy(filter){
  // if show all, show all cards
  if(filter==='all'){ document.querySelectorAll('.card').forEach(c=>c.style.display='block'); return; }
  document.querySelectorAll('.card').forEach(c=>{
    const id = c.dataset.id; const course = COURSES.find(x=>x.id===id);
    if(!course) return;
    // map categories
    const map = {web:['web'], infra:['infra','backend'], cloud:['cloud'], security:['security'], backend:['backend']};
    const ok = (map[filter] || [filter]).includes(course.cat);
    c.style.display = ok ? 'block' : 'none';
  });
}

/* show favorites */
document.getElementById('showFavs').addEventListener('click', ()=>{
  document.querySelectorAll('.card').forEach(c=>{
    const id = c.dataset.id; if(isFav(id)) c.style.display='block'; else c.style.display='none';
  });
});

/* reset progress */
document.getElementById('resetProgress').addEventListener('click', ()=>{
  if(!confirm('Resetar todo o progresso salvo localmente?')) return;
  COURSES.forEach(c=> localStorage.removeItem(progKey(c.id)));
  updateProgressBars();
});

/* helper */
function escapeHtml(s){ return s.replace(/[&<>"']/g, m=>({ '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;' }[m])); }

/* inicialização */
populateRows();
updateProgressBars();

/* keyboard: ESC fecha modal */
document.addEventListener('keydown', e=>{ if(e.key==='Escape') modal.style.display='none' });

</script>


<!-- Scripts -->
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/ai.js"></script>

<script>
new Swiper('.trilhas-swiper', {
  slidesPerView: 1.3,
  spaceBetween: 15,
  breakpoints: { 768: { slidesPerView: 3 } }
});
</script>

<!-- Botão Flutuante -->
<button id="aiChatBtn">
    🤖
</button>

<!-- Janela do Chat -->
<div id="aiChatWindow">
    <div class="ai-header">
        <img src="https://cdn-icons-png.flaticon.com/512/4712/4712103.png" class="ai-avatar">
        <h3>Assistente ConnectTI</h3>
    </div>

    <div id="aiMessages"></div>

    <div class="ai-input-area">
        <input type="text" id="aiUserInput" placeholder="Digite sua dúvida...">
        <button id="aiSendBtn">Enviar</button>
    </div>
</div>

<script src="ai.js"></script>
<link rel="stylesheet" href="ai.css">


</body>
</html>



