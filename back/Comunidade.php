<!doctype html>
<html lang="pt-BR">
<head>
    <!-- Se for PNG -->
<link rel="icon" type="image/png" href="Logo ConnectTI.png">
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>ConnectTI — Comunidade Pro (Tudo em 1)</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">

<style>
/* ============= THEME (compact) ============= */
:root{
  --bg:#071026; --panel:rgba(255,255,255,0.04); --muted:#9fb0c8;
  --accent:#0d6efd; --accent-2:#9d4bff; --glass:rgba(255,255,255,0.03);
  --card-radius:12px; --gap:18px;
}
*{box-sizing:border-box}
body{margin:0;background:linear-gradient(180deg,#04101b,#071026 60%);color:#e6f2ff;font-family:Inter,system-ui,Arial;min-height:100vh;}
a{color:var(--accent);text-decoration:none}

/* Topbar */
.topbar{height:72px;display:flex;align-items:center;padding:0 22px;background:linear-gradient(90deg, rgba(13,110,253,0.12), rgba(157,75,255,0.06));border-bottom:1px solid rgba(255,255,255,0.02)}
.brand{font-weight:800;font-size:20px;color:#fff;margin-right:12px; text-decoration:none;}
.top-actions{margin-left:auto;display:flex;gap:10px;align-items:center}

/* Layout */
.app{display:grid;grid-template-columns:260px 1fr 360px;gap:18px;padding:18px;min-height:calc(100vh - 72px)}
.sidebar{background:var(--panel);border-radius:var(--card-radius);padding:16px;height:calc(100vh - 110px);overflow:auto;border:1px solid rgba(255,255,255,0.03)}
.nav-item{display:flex;align-items:center;gap:12px;padding:10px;border-radius:10px;color:var(--muted);cursor:pointer}
.nav-item.active,.nav-item:hover{background:rgba(13,110,253,0.06);color:#fff}

/* Main */
.main{min-height:calc(100vh - 110px);padding:8px;overflow:auto}
.card{background:var(--glass);border-radius:12px;padding:14px;margin-bottom:16px;border:1px solid rgba(255,255,255,0.04);box-shadow:0 10px 30px rgba(3,6,14,0.6)}

/* Simple responsive */
@media(max-width:1100px){.app{grid-template-columns:1fr;padding:14px}.rightcol{display:none}}
/* content sections */
.section{display:none}
.section.active{display:block}

/* small utility */
.btn-ghost{background:transparent;border:1px solid rgba(255,255,255,0.06);color:#fff;padding:6px 10px;border-radius:8px}
.input-ghost{background:rgba(255,255,255,0.02);border:none;padding:8px;border-radius:8px;color:#e6f2ff;width:100%}
.post{display:flex;gap:12px;align-items:flex-start;padding:12px;border-radius:12px;background:linear-gradient(180deg, rgba(255,255,255,0.01), rgba(255,255,255,0.00))}
.post .avatar{width:56px;height:56px;border-radius:10px;overflow:hidden;flex-shrink:0}
.post .avatar img{width:100%;height:100%;object-fit:cover}
.gallery-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:8px}
.gallery-grid img{width:100%;height:140px;object-fit:cover;border-radius:8px;cursor:pointer;transition:transform .12s}
.gallery-grid img:hover{transform:scale(1.03)}
.thread{padding:12px;border-radius:10px;background:linear-gradient(180deg, rgba(255,255,255,0.01), rgba(255,255,255,0.00))}
.profile-card{width:120px;padding:10px;border-radius:10px;text-align:center;background:linear-gradient(180deg, rgba(255,255,255,0.01), rgba(255,255,255,0.00))}
.profile-card img{width:80px;height:80px;object-fit:cover;border-radius:10px;margin-bottom:8px}
.blog-card{display:flex;gap:12px;align-items:flex-start}
.blog-card img{width:140px;height:90px;object-fit:cover;border-radius:8px}
</style>
</head>
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

<!-- SCRIPTS -->
<script>
/* ======== Storage keys & helpers ======== */
const KEY_POSTS='ct_posts_v2', KEY_THREADS='ct_threads_v2', KEY_BLOGS='ct_blogs_v2', KEY_GALLERY='ct_gallery_v2', KEY_XP='ct_xp_v2', KEY_LEAD='ct_lead_v2', KEY_NOTIF='ct_notif_v2', KEY_BADGES='ct_badges_v2', KEY_FOLLOWS='ct_follows_v2';

function load(k, f){ try{return JSON.parse(localStorage.getItem(k))||f}catch(e){return f} }
function save(k,v){ localStorage.setItem(k, JSON.stringify(v)); }

/* ======== Seed sample data (first time) ======== */
if(!localStorage.getItem(KEY_POSTS)){
  const samplePosts = [
    { id: genId(), author:'Maria Eduarda', avatar:'https://i.imgur.com/WY9Z4Do.jpeg', text:'Consegui deployar meu primeiro projeto. Obrigada, turma! 🎉', time:Date.now()-1000*60*60, reacts:{like:4,applause:1}, comments:[] },
    { id: genId(), author:'Thiago', avatar:'https://i.imgur.com/2DhmtJ4.jpeg', text:'Alguém recomenda um curso de Docker prático?', time:Date.now()-1000*60*30, reacts:{like:2,applause:0}, comments:[] }
  ];
  save(KEY_POSTS, samplePosts);
}
if(!localStorage.getItem(KEY_THREADS)){
  const sampleThreads = [
    { id: genId(), title:'Erro de conexão MySQL', author:'Ana', time:Date.now()-1000*60*60*10, replies:[{author:'Pedro',text:'Você testou o usuário e senha?',time:Date.now()-1000*60*60}] },
    { id: genId(), title:'Como iniciar no React?', author:'Lucas', time:Date.now()-1000*60*60*24, replies:[] }
  ];
  save(KEY_THREADS, sampleThreads);
}
if(!localStorage.getItem(KEY_BLOGS)){
  const sampleBlogs = [
    { id: genId(), title:'5 Projetos para praticar Front-End', author:'Equipe ConnectTI', cover:'https://picsum.photos/seed/blog1/1200/600', excerpt:'Projetos reais para levar seu portfólio adiante', body:'<p>Comece com pequenos projetos: ...</p>' }
  ];
  save(KEY_BLOGS, sampleBlogs);
}
if(!localStorage.getItem(KEY_GALLERY)){
  const gallery = [
    'https://picsum.photos/id/1011/1000/700',
    'https://picsum.photos/id/1025/1000/700',
    'https://picsum.photos/id/1003/1000/700',
    'https://picsum.photos/id/1050/1000/700',
    'https://picsum.photos/id/1069/1000/700',
    'https://picsum.photos/id/1040/1000/700'
  ];
  save(KEY_GALLERY, gallery);
}
if(!localStorage.getItem(KEY_XP)) save(KEY_XP, 0);
if(!localStorage.getItem(KEY_LEAD)) save(KEY_LEAD, [{name:'ProUser',xp:450},{name:'DevAna',xp:300},{name:'Você',xp:Number(localStorage.getItem(KEY_XP)||0)}]);
if(!localStorage.getItem(KEY_NOTIF)) save(KEY_NOTIF, []);
if(!localStorage.getItem(KEY_BADGES)) save(KEY_BADGES, []);
if(!localStorage.getItem(KEY_FOLLOWS)) save(KEY_FOLLOWS, {});

/* ======== Utilities ======== */
function genId(){ return 'id_'+Math.random().toString(36).slice(2,9); }
function timeAgo(ts){
  const s=Math.floor((Date.now()-ts)/1000);
  if(s<60) return s+'s'; if(s<3600) return Math.floor(s/60)+'m'; if(s<86400) return Math.floor(s/3600)+'h'; return Math.floor(s/86400)+'d';
}
function escapeHtml(s){ return String(s).replace(/[&<>"']/g,m=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m])); }

/* ======== Renderers ======== */
function renderFeed(){
  const feed = document.getElementById('feed'); feed.innerHTML='';
  const posts = load(KEY_POSTS, []);
  posts.sort((a,b)=>b.time - a.time);
  posts.forEach(p=>{
    const el=document.createElement('div'); el.className='post';
    el.innerHTML=`
      <div class="avatar"><img src="${p.avatar}" style="width:56px;height:56px;border-radius:10px" /></div>
      <div style="flex:1">
        <div style="display:flex;justify-content:space-between;align-items:flex-start">
          <div><h5 style="margin:0">${escapeHtml(p.author)}</h5><div style="font-size:12px;color:var(--muted)">${timeAgo(p.time)}</div></div>
          <div class="post-actions">
            <button class="react-btn btn-ghost" data-id="${p.id}" data-react="like">👍 <span class="count">${p.reacts.like||0}</span></button>
            <button class="react-btn btn-ghost" data-id="${p.id}" data-react="applause">👏 <span class="count">${p.reacts.applause||0}</span></button>
            <button class="btn btn-sm btn-outline-light" data-id="${p.id}" onclick="openComments('${p.id}')">Comentar</button>
          </div>
        </div>
        <p style="margin-top:8px">${escapeHtml(p.text)}</p>
        <div id="comments_${p.id}" style="margin-top:8px"></div>
      </div>`;
    feed.appendChild(el);
  });
  bindReacts();
}

function renderForum(){
  const forum = document.getElementById('forum'); forum.innerHTML='';
  const threads = load(KEY_THREADS, []);
  threads.sort((a,b)=>b.time - a.time);
  threads.forEach(t=>{
    const el=document.createElement('div'); el.className='thread';
    el.innerHTML=`<h5 style="margin:0">${escapeHtml(t.title)}</h5><div style="color:var(--muted);margin:6px 0">${t.replies.length} respostas • por ${escapeHtml(t.author)} • ${timeAgo(t.time)}</div>
      <div style="display:flex;gap:8px"><button class="btn btn-sm btn-outline-light" onclick='openThread("${t.id}")'>Abrir</button> <button class="btn btn-sm btn-primary" onclick='replyThreadPrompt("${t.id}")'>Responder</button></div>`;
    forum.appendChild(el);
  });
}

function renderProfiles(){
  const pr = document.getElementById('profilesGrid'); pr.innerHTML='';
  const sample = [{name:'Lucas Silva',img:'https://i.pravatar.cc/150?img=12',role:'Professor'},{name:'Maria Eduarda',img:'https://i.pravatar.cc/150?img=13',role:'Aluna'},{name:'Pedro Henrique',img:'https://i.pravatar.cc/150?img=14',role:'Professor'}];
  sample.forEach(u=>{
    const c=document.createElement('div'); c.className='profile-card';
    c.innerHTML=`<img src="${u.img}" width="80" height="80" style="border-radius:10px;object-fit:cover" /><div style="font-weight:700">${escapeHtml(u.name)}</div><div style="font-size:13px;color:var(--muted)">${escapeHtml(u.role)}</div><div style="margin-top:8px"><button class="btn btn-sm btn-outline-light" onclick='followUser("${escapeHtml(u.name)}")'>Seguir</button></div>`;
    pr.appendChild(c);
  });
}

function renderBlog(){
  const blogs = load(KEY_BLOGS, []); const container=document.getElementById('blogList'); container.innerHTML='';
  blogs.forEach(b=>{
    const el=document.createElement('div'); el.className='blog-card card p-2 mb-2';
    el.innerHTML=`<img src="${b.cover}" style="width:140px;height:90px;object-fit:cover;border-radius:8px;margin-right:12px;float:left" /><div><h5>${escapeHtml(b.title)}</h5><p style="color:var(--muted)">${escapeHtml(b.excerpt)}</p><div><button class="btn btn-sm btn-outline-light" onclick='openBlog("${b.id}")'>Ler</button></div></div><div style="clear:both"></div>`;
    container.appendChild(el);
  });
}

function renderGallery(){
  const gallery = load(KEY_GALLERY, []); const g=document.getElementById('galleryGrid'); g.innerHTML='';
  gallery.forEach(url=>{
    const img=document.createElement('img'); img.src=url; img.onclick=()=>openLightbox(url);
    g.appendChild(img);
  });
}

function renderRight(){
  const xp = Number(localStorage.getItem(KEY_XP) || 0); const level = Math.floor(xp/100)+1; const xpThis = xp%100;
  document.getElementById('xpCount').textContent = xp + ' XP';
  document.getElementById('xpBar').style.width = Math.min(100, xpThis) + '%';
  document.getElementById('myXPLabel').textContent = 'XP: ' + xp + ' • Nível ' + level;
  // badges
  const badges = load(KEY_BADGES, []); const bs=document.getElementById('badgesSidebar'); bs.innerHTML='';
  badges.forEach(b=>{ const e=document.createElement('div'); e.style.padding='6px 8px';e.style.background='rgba(255,255,255,0.02)';e.style.borderRadius='8px';e.style.fontSize='12px';e.textContent=b;bs.appendChild(e);});
  // leaderboard
  const lead = load(KEY_LEAD, []); const lb=document.getElementById('leaderboard'); lb.innerHTML='';
  lead.forEach((u,i)=>{ const el=document.createElement('div'); el.style.display='flex'; el.style.alignItems='center'; el.style.justifyContent='space-between'; el.style.marginBottom='8px'; el.innerHTML=`<div><b>${i+1}. ${escapeHtml(u.name)}</b><div style="font-size:12px;color:var(--muted)">${u.xp} XP</div></div>`; lb.appendChild(el);});
  // notifications
  const nots = load(KEY_NOTIF, []); const notContainer=document.getElementById('notifications'); notContainer.innerHTML='';
  if(nots.length){ document.getElementById('notifCount').style.display='inline-block'; document.getElementById('notifCount').textContent=nots.length; nots.slice().reverse().forEach(n=>{ const el=document.createElement('div'); el.style.padding='8px'; el.style.borderBottom='1px solid rgba(255,255,255,0.03)'; el.style.fontSize='13px'; el.innerHTML=`<b>${escapeHtml(n.title)}</b><div style="color:var(--muted)">${escapeHtml(n.timeText)}</div>`; notContainer.appendChild(el); }); } else { document.getElementById('notifCount').style.display='none'; notContainer.innerHTML='<div style="color:var(--muted)">Sem notificações</div>'; }
}

/* ======== Bind helpers ======== */
function bindReacts(){
  document.querySelectorAll('.react-btn').forEach(btn=>{
    btn.onclick = ()=>{ const id=btn.dataset.id; const r=btn.dataset.react; toggleReact(id,r); };
  });
}

/* ======== Interactions ======== */
function toggleReact(postId,key){
  const posts = load(KEY_POSTS, []); const p = posts.find(x=>x.id===postId); if(!p) return;
  p.reacts[key] = (p.reacts[key]||0)+1; save(KEY_POSTS, posts); renderFeed(); addXP(5); pushNotif('Interação','Você reagiu a um post (+5 XP)');
}

/* Comments UI */
function openComments(postId){
  const container=document.getElementById('comments_'+postId); const posts=load(KEY_POSTS, []); const p=posts.find(x=>x.id===postId); if(!p) return;
  container.innerHTML=''; const list=document.createElement('div'); list.style.display='flex'; list.style.flexDirection='column'; list.style.gap='8px';
  (p.comments||[]).forEach(c=>{ const el=document.createElement('div'); el.style.background='rgba(255,255,255,0.02)'; el.style.padding='8px'; el.style.borderRadius='8px'; el.innerHTML=`<b>${escapeHtml(c.author)}</b> <div style="color:var(--muted)">${escapeHtml(c.text)}</div>`; list.appendChild(el); });
  const input=document.createElement('div'); input.style.display='flex'; input.style.gap='8px'; input.style.marginTop='8px';
  const txt=document.createElement('input'); txt.placeholder='Escrever comentário...'; txt.style.flex='1'; txt.style.padding='8px'; txt.style.borderRadius='8px'; txt.style.border='none'; txt.style.background='rgba(255,255,255,0.02)';
  const btn=document.createElement('button'); btn.className='btn btn-sm btn-primary'; btn.textContent='Enviar';
  btn.onclick=()=>{ const author='Você'; if(!txt.value.trim()) return; p.comments=p.comments||[]; p.comments.push({author,text:txt.value,time:Date.now()}); save(KEY_POSTS, posts); renderFeed(); addXP(3); pushNotif('Comentário','Você comentou um post (+3 XP)'); };
  input.appendChild(txt); input.appendChild(btn);
  container.appendChild(list); container.appendChild(input);
}

/* New post/thread/blog (modal) */
document.getElementById('btnNewPost').onclick = ()=> openNew('post');
document.getElementById('btnNewQuestion').onclick = ()=> openNew('thread');
document.getElementById('btnCreateThread').onclick = ()=> openNew('thread');

function openNew(type){
  const root=document.getElementById('modalRoot'); root.innerHTML='';
  const modal=document.createElement('div'); modal.className='card'; modal.style.position='fixed'; modal.style.left='50%'; modal.style.top='50%'; modal.style.transform='translate(-50%,-50%)'; modal.style.zIndex=9999; modal.style.minWidth='360px';
  if(type==='post'){
    modal.innerHTML=`<h4>Novo Post</h4><textarea id="newPostText" style="width:100%;height:120px;margin-top:8px;padding:8px;border-radius:8px;border:none;background:rgba(255,255,255,0.02);color:#e6f2ff"></textarea><div style="display:flex;justify-content:flex-end;gap:8px;margin-top:8px"><button class="btn btn-sm btn-outline-light" onclick="closeModal()">Cancelar</button><button class="btn btn-sm btn-primary" onclick="savePost()">Publicar</button></div>`;
  } else if(type==='thread'){
    modal.innerHTML=`<h4>Nova Pergunta</h4><input id="threadTitle" placeholder="Título" style="width:100%;padding:8px;border-radius:8px;border:none;background:rgba(255,255,255,0.02);color:#e6f2ff"/><textarea id="threadText" style="width:100%;height:120px;margin-top:8px;padding:8px;border-radius:8px;border:none;background:rgba(255,255,255,0.02);color:#e6f2ff"></textarea><div style="display:flex;justify-content:flex-end;gap:8px;margin-top:8px"><button class="btn btn-sm btn-outline-light" onclick="closeModal()">Cancelar</button><button class="btn btn-sm btn-primary" onclick="saveThread()">Criar Pergunta</button></div>`;
  } else if(type==='blog'){
    modal.innerHTML=`<h4>Novo Post do Blog</h4><input id="blogTitle" placeholder="Título" style="width:100%;padding:8px;border-radius:8px;border:none;background:rgba(255,255,255,0.02);color:#e6f2ff"/><input id="blogCover" placeholder="URL da imagem de capa" style="width:100%;padding:8px;border-radius:8px;border:none;background:rgba(255,255,255,0.02);margin-top:8px;color:#e6f2ff"/><textarea id="blogBody" style="width:100%;height:160px;margin-top:8px;padding:8px;border-radius:8px;border:none;background:rgba(255,255,255,0.02);color:#e6f2ff"></textarea><div style="display:flex;justify-content:flex-end;gap:8px;margin-top:8px"><button class="btn btn-sm btn-outline-light" onclick="closeModal()">Cancelar</button><button class="btn btn-sm btn-primary" onclick="saveBlog()">Publicar</button></div>`;
  }
  root.appendChild(modal);
}
function closeModal(){ document.getElementById('modalRoot').innerHTML=''; }

function savePost(){
  const txt=document.getElementById('newPostText').value.trim(); if(!txt){ alert('Escreva algo'); return; }
  const posts=load(KEY_POSTS, []); posts.unshift({ id:genId(), author:'Você', avatar:'https://i.pravatar.cc/150?img=3', text:txt, time:Date.now(), reacts:{like:0,applause:0}, comments:[] });
  save(KEY_POSTS, posts); renderFeed(); addXP(8); pushNotif('Novo Post','Seu post foi publicado (+8 XP)'); closeModal();
}
function saveThread(){
  const t=document.getElementById('threadTitle').value.trim(); if(!t){ alert('Titulo obrigatório'); return; }
  const threads=load(KEY_THREADS, []); threads.unshift({ id:genId(), title:t, author:'Você', time:Date.now(), replies:[] });
  save(KEY_THREADS, threads); renderForum(); addXP(6); pushNotif('Nova Pergunta','Você criou uma pergunta (+6 XP)'); closeModal();
}
function saveBlog(){
  const title=document.getElementById('blogTitle').value.trim(); const body=document.getElementById('blogBody').value.trim(); const cover=document.getElementById('blogCover').value.trim();
  if(!title || !body){ alert('Preencha título e corpo'); return; }
  const blogs=load(KEY_BLOGS, []); blogs.unshift({ id:genId(), title, author:'Você', cover: cover || 'https://picsum.photos/seed/new/1200/600', excerpt: body.slice(0,120)+'...', body });
  save(KEY_BLOGS, blogs); renderBlog(); addXP(12); pushNotif('Blog publicado','Você publicou um post no blog (+12 XP)'); closeModal();
}

/* Thread reply (prompt) */
function openThread(id){
  const threads=load(KEY_THREADS, []); const t=threads.find(x=>x.id===id); if(!t) return;
  const ans = prompt('Responder a: '+t.title); if(ans){ t.replies.push({ author:'Você', text:ans, time:Date.now() }); save(KEY_THREADS, threads); renderForum(); addXP(5); pushNotif('Resposta','Você respondeu uma pergunta (+5 XP)'); }
}
function replyThreadPrompt(id){ openThread(id); }

/* Lightbox */
function openLightbox(url){ document.getElementById('lightboxImg').src=url; document.getElementById('lightbox').style.display='flex'; }
document.getElementById('lightbox').onclick = ()=> document.getElementById('lightbox').style.display='none';

/* XP / Badges / Notifs */
function addXP(n){
  const cur = Number(localStorage.getItem(KEY_XP) || 0) + n; localStorage.setItem(KEY_XP, cur);
  const badges = load(KEY_BADGES, []);
  if(cur >= 100 && !badges.includes('Bronze')) badges.push('Bronze'), pushNotif('Badge','Você ganhou a badge Bronze!');
  if(cur >= 300 && !badges.includes('Prata')) badges.push('Prata'), pushNotif('Badge','Você ganhou a badge Prata!');
  if(cur >= 700 && !badges.includes('Ouro')) badges.push('Ouro'), pushNotif('Badge','Você ganhou a badge Ouro!');
  save(KEY_BADGES, badges);
  const lead = load(KEY_LEAD, []); const me = lead.find(x=>x.name==='Você');
  if(me) me.xp = Number(localStorage.getItem(KEY_XP)); else lead.push({name:'Você',xp:Number(localStorage.getItem(KEY_XP))});
  lead.sort((a,b)=>b.xp-a.xp); save(KEY_LEAD, lead);
  renderRight();
}
function pushNotif(title,text){ const arr=load(KEY_NOTIF,[]); arr.push({id:genId(),title,text,time:Date.now(),timeText:timeAgo(Date.now())}); save(KEY_NOTIF,arr); renderRight(); }

/* Follow/unfollow */
function followUser(name){ const f=load(KEY_FOLLOWS, {}); f[name]=true; save(KEY_FOLLOWS,f); renderRight(); pushNotif('Seguindo','Você começou a seguir '+name); }
function unfollowUser(name){ const f=load(KEY_FOLLOWS, {}); delete f[name]; save(KEY_FOLLOWS,f); renderRight(); pushNotif('Seguindo','Você deixou de seguir '+name); }

/* Search */
document.getElementById('globalSearch').addEventListener('input', (e)=> {
  const q=e.target.value.toLowerCase();
  document.querySelectorAll('.post').forEach(p=>{ const text=p.innerText.toLowerCase(); p.style.display = text.includes(q) ? 'flex' : 'none'; });
});

/* Notifications UI */
document.getElementById('btnNotifications').onclick = ()=> {
  const nots = load(KEY_NOTIF, []);
  if(nots.length===0) alert('Sem notificações');
  else alert(nots.map(n=> n.title + ' — ' + n.timeText).join('\\n'));
};
document.getElementById('clearNotifs').onclick = ()=> { save(KEY_NOTIF, []); renderRight(); };

/* Filters (demo) */
document.getElementById('filterFollowed').onclick = ()=> {
  const f = load(KEY_FOLLOWS, {}); const posts = load(KEY_POSTS, []);
  const filtered = posts.filter(p=> f[p.author] );
  if(filtered.length===0) return alert('Nenhum post de perfis que você segue (demo).');
  const feed = document.getElementById('feed'); feed.innerHTML=''; filtered.forEach(p=>{/* reuse render style */ const el=document.createElement('div'); el.className='post'; el.innerHTML=`<div class="avatar"><img src="${p.avatar}" style="width:56px;height:56px;border-radius:10px" /></div><div style="flex:1"><div style="display:flex;justify-content:space-between"><div><h5>${escapeHtml(p.author)}</h5><div style="font-size:12px;color:var(--muted)">${timeAgo(p.time)}</div></div><div class="post-actions"><button class="react-btn btn-ghost" data-id="${p.id}" data-react="like">👍 <span class="count">${p.reacts.like||0}</span></button><button class="react-btn btn-ghost" data-id="${p.id}" data-react="applause">👏 <span class="count">${p.reacts.applause||0}</span></button><button class="btn btn-sm btn-outline-light" data-id="${p.id}" onclick="openComments('${p.id}')">Comentar</button></div></div><p style="margin-top:8px">${escapeHtml(p.text)}</p><div id="comments_${p.id}" style="margin-top:8px"></div></div>`; feed.appendChild(el);}); bindReacts();
};
document.getElementById('filterAll').onclick = ()=> renderFeed();

/* Video call (preview local only) */
document.getElementById('btnJoinCall').onclick = async ()=>{
  const vm = document.getElementById('videoModal'); vm.style.display='flex';
  const local = document.getElementById('localVideo');
  try{
    const stream = await navigator.mediaDevices.getUserMedia({video:true,audio:true});
    local.srcObject = stream;
    pushNotif('Chamada','Preview de vídeo ativado (somente local).');
  }catch(err){ alert('Permissão de câmera/áudio necessária.'); }
};
document.getElementById('endCall').onclick = ()=> {
  document.getElementById('videoModal').style.display='none';
  const local = document.getElementById('localVideo'); if(local.srcObject){ local.srcObject.getTracks().forEach(t=>t.stop()); local.srcObject=null; }
};

/* Open blog / profile */
function openBlog(id){ const blogs=load(KEY_BLOGS,[]); const b=blogs.find(x=>x.id===id); if(!b) return; alert(b.title + '\\n\\n' + (b.body || b.excerpt)); }
function openProfile(name){ alert('Abrindo perfil de ' + name + ' (demo)'); }

/* ======== Simple view switch (sidebar menu) ======== */
const viewMap = {
  feed: 'section-feed',
  forum: 'section-forum',
  profiles: 'section-profiles',
  blog: 'section-blog',
  gallery: 'section-gallery'
};
document.querySelectorAll('.nav-item').forEach(item=>{
  item.addEventListener('click', ()=>{
    document.querySelectorAll('.nav-item').forEach(n=>n.classList.remove('active'));
    item.classList.add('active');
    const view = item.dataset.view;
    document.querySelectorAll('.section').forEach(s=>s.classList.remove('active'));
    const id = viewMap[view];
    if(id) document.getElementById(id).classList.add('active');
    window.scrollTo({top:0,behavior:'smooth'});
  });
});

/* ======== Initial renders ======== */
renderFeed(); renderForum(); renderProfiles(); renderBlog(); renderGallery(); renderRight();

/* Quick profiles in main (already handled via renderProfiles) */

/* Shortcut new post via "n" */
document.addEventListener('keydown',(e)=>{ if(e.key==='n') openNew('post'); });
</script>

</body>
</html>
