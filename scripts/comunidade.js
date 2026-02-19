console.log('Script carregando...');

// Primeiro, vamos garantir que o DOM está carregado
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM completamente carregado');
    
    // ======== Storage keys & helpers ========
    const KEY_POSTS='ct_posts_v2', KEY_THREADS='ct_threads_v2', KEY_BLOGS='ct_blogs_v2', KEY_GALLERY='ct_gallery_v2', KEY_XP='ct_xp_v2', KEY_LEAD='ct_lead_v2', KEY_NOTIF='ct_notif_v2', KEY_BADGES='ct_badges_v2', KEY_FOLLOWS='ct_follows_v2';

    function load(k, f){ 
        try{
            return JSON.parse(localStorage.getItem(k)) || f;
        }catch(e){
            return f;
        }
    }
    
    function save(k,v){ 
        localStorage.setItem(k, JSON.stringify(v)); 
    }

    // ======== Utilities ========
    function genId(){ 
        return 'id_'+Math.random().toString(36).slice(2,9); 
    }
    
    function timeAgo(ts){
        const s=Math.floor((Date.now()-ts)/1000);
        if(s<60) return s+'s'; 
        if(s<3600) return Math.floor(s/60)+'m'; 
        if(s<86400) return Math.floor(s/3600)+'h'; 
        return Math.floor(s/86400)+'d';
    }
    
    function escapeHtml(s){ 
        const div = document.createElement('div');
        div.textContent = s;
        return div.innerHTML;
    }

    // ======== Seed sample data (first time) ========
    function seedData() {
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
    }

    // ======== Renderers ========
    function renderFeed(){
        const feed = document.getElementById('feed'); 
        if (!feed) return;
        
        feed.innerHTML='';
        const posts = load(KEY_POSTS, []);
        posts.sort((a,b)=>b.time - a.time);
        
        posts.forEach(p=>{
            const el=document.createElement('div'); 
            el.className='post';
            el.innerHTML=`
                <div class="avatar">
                    <img src="${p.avatar}" style="width:56px;height:56px;border-radius:10px" />
                </div>
                <div style="flex:1">
                    <div style="display:flex;justify-content:space-between;align-items:flex-start">
                        <div>
                            <h5 style="margin:0">${escapeHtml(p.author)}</h5>
                            <div style="font-size:12px;color:var(--muted)">${timeAgo(p.time)}</div>
                        </div>
                        <div class="post-actions">
                            <button class="react-btn btn-ghost" data-id="${p.id}" data-react="like">👍 <span class="count">${p.reacts.like||0}</span></button>
                            <button class="react-btn btn-ghost" data-id="${p.id}" data-react="applause">👏 <span class="count">${p.reacts.applause||0}</span></button>
                            <button class="btn btn-sm btn-outline-light comment-btn" data-id="${p.id}">Comentar</button>
                        </div>
                    </div>
                    <p style="margin-top:8px">${escapeHtml(p.text)}</p>
                    <div id="comments_${p.id}" style="margin-top:8px"></div>
                </div>`;
            feed.appendChild(el);
        });
        
        // Adiciona eventos aos botões
        document.querySelectorAll('.react-btn').forEach(btn=>{
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const react = this.dataset.react;
                toggleReact(id, react);
            });
        });
        
        document.querySelectorAll('.comment-btn').forEach(btn=>{
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                openComments(id);
            });
        });
    }

    function renderForum(){
        const forum = document.getElementById('forum'); 
        if (!forum) return;
        
        forum.innerHTML='';
        const threads = load(KEY_THREADS, []);
        threads.sort((a,b)=>b.time - a.time);
        
        threads.forEach(t=>{
            const el=document.createElement('div'); 
            el.className='thread card p-3 mb-2';
            el.innerHTML=`
                <h5 style="margin:0">${escapeHtml(t.title)}</h5>
                <div style="color:var(--muted);margin:6px 0">${t.replies.length} respostas • por ${escapeHtml(t.author)} • ${timeAgo(t.time)}</div>
                <div style="display:flex;gap:8px">
                    <button class="btn btn-sm btn-outline-light open-thread-btn" data-id="${t.id}">Abrir</button>
                    <button class="btn btn-sm btn-primary reply-thread-btn" data-id="${t.id}">Responder</button>
                </div>`;
            forum.appendChild(el);
        });
        
        // Adiciona eventos
        document.querySelectorAll('.open-thread-btn').forEach(btn=>{
            btn.addEventListener('click', function() {
                openThread(this.dataset.id);
            });
        });
        
        document.querySelectorAll('.reply-thread-btn').forEach(btn=>{
            btn.addEventListener('click', function() {
                replyThreadPrompt(this.dataset.id);
            });
        });
    }

    function renderProfiles(){
        const pr = document.getElementById('profilesGrid'); 
        if (!pr) return;
        
        pr.innerHTML='';
        const sample = [
            {name:'Lucas Silva',img:'https://i.pravatar.cc/150?img=12',role:'Professor'},
            {name:'Maria Eduarda',img:'https://i.pravatar.cc/150?img=13',role:'Aluna'},
            {name:'Pedro Henrique',img:'https://i.pravatar.cc/150?img=14',role:'Professor'}
        ];
        
        sample.forEach(u=>{
            const c=document.createElement('div'); 
            c.className='profile-card card p-3';
            c.style.flex = '1 1 200px';
            c.innerHTML=`
                <img src="${u.img}" width="80" height="80" style="border-radius:10px;object-fit:cover;margin-bottom:10px" />
                <div style="font-weight:700">${escapeHtml(u.name)}</div>
                <div style="font-size:13px;color:var(--muted)">${escapeHtml(u.role)}</div>
                <div style="margin-top:8px">
                    <button class="btn btn-sm btn-outline-light follow-btn" data-name="${escapeHtml(u.name)}">Seguir</button>
                </div>`;
            pr.appendChild(c);
        });
        
        // Adiciona eventos
        document.querySelectorAll('.follow-btn').forEach(btn=>{
            btn.addEventListener('click', function() {
                followUser(this.dataset.name);
            });
        });
    }

    function renderBlog(){
        const blogs = load(KEY_BLOGS, []); 
        const container=document.getElementById('blogList'); 
        if (!container) return;
        
        container.innerHTML='';
        blogs.forEach(b=>{
            const el=document.createElement('div'); 
            el.className='blog-card card p-3 mb-3';
            el.innerHTML=`
                <div style="display:flex;gap:15px">
                    <img src="${b.cover}" style="width:140px;height:90px;object-fit:cover;border-radius:8px" />
                    <div style="flex:1">
                        <h5>${escapeHtml(b.title)}</h5>
                        <p style="color:var(--muted);margin:5px 0">${escapeHtml(b.excerpt)}</p>
                        <div>
                            <button class="btn btn-sm btn-outline-light open-blog-btn" data-id="${b.id}">Ler</button>
                        </div>
                    </div>
                </div>`;
            container.appendChild(el);
        });
        
        // Adiciona eventos
        document.querySelectorAll('.open-blog-btn').forEach(btn=>{
            btn.addEventListener('click', function() {
                openBlog(this.dataset.id);
            });
        });
    }

    function renderGallery(){
        const gallery = load(KEY_GALLERY, []); 
        const g=document.getElementById('galleryGrid'); 
        if (!g) return;
        
        g.innerHTML='';
        gallery.forEach(url=>{
            const img=document.createElement('img'); 
            img.src=url; 
            img.style.cursor = 'pointer';
            img.addEventListener('click', function() {
                openLightbox(url);
            });
            g.appendChild(img);
        });
    }

    function renderRight(){
        const xp = Number(localStorage.getItem(KEY_XP) || 0); 
        const level = Math.floor(xp/100)+1; 
        const xpThis = xp%100;
        
        const xpCountEl = document.getElementById('xpCount');
        const xpBarEl = document.getElementById('xpBar');
        const myXPLabelEl = document.getElementById('myXPLabel');
        
        if (xpCountEl) xpCountEl.textContent = xp + ' XP';
        if (xpBarEl) xpBarEl.style.width = Math.min(100, xpThis) + '%';
        if (myXPLabelEl) myXPLabelEl.textContent = 'XP: ' + xp + ' • Nível ' + level;
        
        // badges
        const badges = load(KEY_BADGES, []); 
        const bs=document.getElementById('badgesSidebar'); 
        if (bs) {
            bs.innerHTML='';
            badges.forEach(b=>{ 
                const e=document.createElement('div'); 
                e.style.padding='6px 8px';
                e.style.background='rgba(255,255,255,0.02)';
                e.style.borderRadius='8px';
                e.style.fontSize='12px';
                e.textContent=b;
                bs.appendChild(e);
            });
        }
        
        // leaderboard
        const lead = load(KEY_LEAD, []); 
        const lb=document.getElementById('leaderboard'); 
        if (lb) {
            lb.innerHTML='';
            lead.forEach((u,i)=>{ 
                const el=document.createElement('div'); 
                el.style.display='flex'; 
                el.style.alignItems='center'; 
                el.style.justifyContent='space-between'; 
                el.style.marginBottom='8px'; 
                el.style.padding = '8px';
                el.style.background = 'rgba(255,255,255,0.02)';
                el.style.borderRadius = '8px';
                el.innerHTML=`
                    <div>
                        <b>${i+1}. ${escapeHtml(u.name)}</b>
                        <div style="font-size:12px;color:var(--muted)">${u.xp} XP</div>
                    </div>`;
                lb.appendChild(el);
            });
        }
        
        // notifications
        const nots = load(KEY_NOTIF, []); 
        const notContainer=document.getElementById('notifications'); 
        const notifCountEl = document.getElementById('notifCount');
        
        if (notContainer) {
            notContainer.innerHTML='';
            if(nots.length){ 
                if (notifCountEl) {
                    notifCountEl.style.display='inline-block'; 
                    notifCountEl.textContent=nots.length;
                }
                nots.slice().reverse().forEach(n=>{ 
                    const el=document.createElement('div'); 
                    el.style.padding='8px'; 
                    el.style.borderBottom='1px solid rgba(255,255,255,0.03)'; 
                    el.style.fontSize='13px'; 
                    el.innerHTML=`
                        <b>${escapeHtml(n.title)}</b>
                        <div style="color:var(--muted)">${escapeHtml(n.timeText)}</div>`;
                    notContainer.appendChild(el); 
                }); 
            } else { 
                if (notifCountEl) notifCountEl.style.display='none'; 
                notContainer.innerHTML='<div style="color:var(--muted)">Sem notificações</div>'; 
            }
        }
    }

    // ======== Interactions ========
    function toggleReact(postId,key){
        const posts = load(KEY_POSTS, []); 
        const p = posts.find(x=>x.id===postId); 
        if(!p) return;
        
        p.reacts[key] = (p.reacts[key]||0)+1; 
        save(KEY_POSTS, posts); 
        renderFeed(); 
        addXP(5); 
        pushNotif('Interação','Você reagiu a um post (+5 XP)');
    }

    // Comments UI
    function openComments(postId){
        const container=document.getElementById('comments_'+postId); 
        const posts=load(KEY_POSTS, []); 
        const p=posts.find(x=>x.id===postId); 
        if(!p) return;
        
        container.innerHTML=''; 
        const list=document.createElement('div'); 
        list.style.display='flex'; 
        list.style.flexDirection='column'; 
        list.style.gap='8px';
        
        (p.comments||[]).forEach(c=>{ 
            const el=document.createElement('div'); 
            el.style.background='rgba(255,255,255,0.02)'; 
            el.style.padding='8px'; 
            el.style.borderRadius='8px'; 
            el.innerHTML=`
                <b>${escapeHtml(c.author)}</b> 
                <div style="color:var(--muted)">${escapeHtml(c.text)}</div>`;
            list.appendChild(el); 
        });
        
        const input=document.createElement('div'); 
        input.style.display='flex'; 
        input.style.gap='8px'; 
        input.style.marginTop='8px';
        
        const txt=document.createElement('input'); 
        txt.placeholder='Escrever comentário...'; 
        txt.style.flex='1'; 
        txt.style.padding='8px'; 
        txt.style.borderRadius='8px'; 
        txt.style.border='1px solid rgba(255,255,255,0.1)'; 
        txt.style.background='rgba(255,255,255,0.02)';
        txt.style.color = '#fff';
        
        const btn=document.createElement('button'); 
        btn.className='btn btn-sm btn-primary'; 
        btn.textContent='Enviar';
        
        btn.addEventListener('click', function() { 
            const author='Você'; 
            if(!txt.value.trim()) return; 
            p.comments=p.comments||[]; 
            p.comments.push({author,text:txt.value,time:Date.now()}); 
            save(KEY_POSTS, posts); 
            renderFeed(); 
            addXP(3); 
            pushNotif('Comentário','Você comentou um post (+3 XP)'); 
        });
        
        input.appendChild(txt); 
        input.appendChild(btn);
        container.appendChild(list); 
        container.appendChild(input);
    }

    // New post/thread/blog (modal)
    function openNew(type){
        const root=document.getElementById('modalRoot'); 
        if (!root) {
            // Cria o modalRoot se não existir
            const modalRoot = document.createElement('div');
            modalRoot.id = 'modalRoot';
            document.body.appendChild(modalRoot);
        }
        
        root.innerHTML='';
        const modal=document.createElement('div'); 
        modal.className='card'; 
        modal.style.position='fixed'; 
        modal.style.left='50%'; 
        modal.style.top='50%'; 
        modal.style.transform='translate(-50%,-50%)'; 
        modal.style.zIndex=9999; 
        modal.style.minWidth='360px';
        modal.style.maxWidth='500px';
        modal.style.background = 'var(--card)';
        modal.style.border = '1px solid var(--border)';
        
        if(type==='post'){
            modal.innerHTML=`
                <h4>Novo Post</h4>
                <textarea id="newPostText" placeholder="O que você está pensando?" style="width:100%;height:120px;margin-top:8px;padding:8px;border-radius:8px;border:1px solid rgba(255,255,255,0.1);background:rgba(255,255,255,0.02);color:#fff"></textarea>
                <div style="display:flex;justify-content:flex-end;gap:8px;margin-top:16px">
                    <button class="btn btn-sm btn-outline-light" id="cancelPostBtn">Cancelar</button>
                    <button class="btn btn-sm btn-primary" id="publishPostBtn">Publicar</button>
                </div>`;
        } else if(type==='thread'){
            modal.innerHTML=`
                <h4>Nova Pergunta</h4>
                <input id="threadTitle" placeholder="Título da pergunta" style="width:100%;padding:8px;border-radius:8px;border:1px solid rgba(255,255,255,0.1);background:rgba(255,255,255,0.02);color:#fff;margin-bottom:8px"/>
                <textarea id="threadText" placeholder="Descreva sua pergunta..." style="width:100%;height:120px;padding:8px;border-radius:8px;border:1px solid rgba(255,255,255,0.1);background:rgba(255,255,255,0.02);color:#fff"></textarea>
                <div style="display:flex;justify-content:flex-end;gap:8px;margin-top:16px">
                    <button class="btn btn-sm btn-outline-light" id="cancelThreadBtn">Cancelar</button>
                    <button class="btn btn-sm btn-primary" id="publishThreadBtn">Criar Pergunta</button>
                </div>`;
        }
        root.appendChild(modal);
        
        // Adiciona eventos aos botões do modal
        if(type==='post'){
            document.getElementById('cancelPostBtn').addEventListener('click', closeModal);
            document.getElementById('publishPostBtn').addEventListener('click', savePost);
        } else if(type==='thread'){
            document.getElementById('cancelThreadBtn').addEventListener('click', closeModal);
            document.getElementById('publishThreadBtn').addEventListener('click', saveThread);
        }
    }
    
    function closeModal(){ 
        const modalRoot = document.getElementById('modalRoot');
        if (modalRoot) modalRoot.innerHTML=''; 
    }

    function savePost(){
        const txtInput = document.getElementById('newPostText');
        if (!txtInput) return;
        
        const txt = txtInput.value.trim(); 
        if(!txt){ alert('Escreva algo'); return; }
        
        const posts=load(KEY_POSTS, []); 
        posts.unshift({ 
            id:genId(), 
            author:'Você', 
            avatar:'https://i.pravatar.cc/150?img=3', 
            text:txt, 
            time:Date.now(), 
            reacts:{like:0,applause:0}, 
            comments:[] 
        });
        save(KEY_POSTS, posts); 
        renderFeed(); 
        addXP(8); 
        pushNotif('Novo Post','Seu post foi publicado (+8 XP)'); 
        closeModal();
    }
    
    function saveThread(){
        const titleInput = document.getElementById('threadTitle');
        if (!titleInput) return;
        
        const t = titleInput.value.trim(); 
        if(!t){ alert('Título obrigatório'); return; }
        
        const threads=load(KEY_THREADS, []); 
        threads.unshift({ 
            id:genId(), 
            title:t, 
            author:'Você', 
            time:Date.now(), 
            replies:[] 
        });
        save(KEY_THREADS, threads); 
        renderForum(); 
        addXP(6); 
        pushNotif('Nova Pergunta','Você criou uma pergunta (+6 XP)'); 
        closeModal();
    }

    // Thread reply
    function openThread(id){
        const threads=load(KEY_THREADS, []); 
        const t=threads.find(x=>x.id===id); 
        if(!t) return;
        
        const ans = prompt('Responder a: '+t.title); 
        if(ans){ 
            t.replies.push({ 
                author:'Você', 
                text:ans, 
                time:Date.now() 
            }); 
            save(KEY_THREADS, threads); 
            renderForum(); 
            addXP(5); 
            pushNotif('Resposta','Você respondeu uma pergunta (+5 XP)'); 
        }
    }
    
    function replyThreadPrompt(id){ 
        openThread(id); 
    }

    // Lightbox
    function openLightbox(url){ 
        const lightboxImg = document.getElementById('lightboxImg');
        const lightbox = document.getElementById('lightbox');
        
        if (lightboxImg && lightbox) {
            lightboxImg.src=url; 
            lightbox.style.display='flex'; 
        }
    }
    
    function closeLightbox() {
        const lightbox = document.getElementById('lightbox');
        if (lightbox) lightbox.style.display='none';
    }

    // Blog
    function openBlog(id){ 
        const blogs=load(KEY_BLOGS,[]); 
        const b=blogs.find(x=>x.id===id); 
        if(!b) return; 
        alert(b.title + '\n\n' + (b.body || b.excerpt)); 
    }

    // XP / Badges / Notifs
    function addXP(n){
        const cur = Number(localStorage.getItem(KEY_XP) || 0) + n; 
        localStorage.setItem(KEY_XP, cur);
        
        const badges = load(KEY_BADGES, []);
        if(cur >= 100 && !badges.includes('Bronze')) {
            badges.push('Bronze');
            pushNotif('Badge','Você ganhou a badge Bronze!');
        }
        if(cur >= 300 && !badges.includes('Prata')) {
            badges.push('Prata');
            pushNotif('Badge','Você ganhou a badge Prata!');
        }
        if(cur >= 700 && !badges.includes('Ouro')) {
            badges.push('Ouro');
            pushNotif('Badge','Você ganhou a badge Ouro!');
        }
        save(KEY_BADGES, badges);
        
        const lead = load(KEY_LEAD, []); 
        const me = lead.find(x=>x.name==='Você');
        if(me) {
            me.xp = Number(localStorage.getItem(KEY_XP));
        } else {
            lead.push({name:'Você',xp:Number(localStorage.getItem(KEY_XP))});
        }
        lead.sort((a,b)=>b.xp-a.xp); 
        save(KEY_LEAD, lead);
        renderRight();
    }
    
    function pushNotif(title,text){ 
        const arr=load(KEY_NOTIF,[]); 
        arr.push({
            id:genId(),
            title,
            text,
            time:Date.now(),
            timeText:timeAgo(Date.now())
        }); 
        save(KEY_NOTIF,arr); 
        renderRight(); 
    }

    // Follow/unfollow
    function followUser(name){ 
        const f=load(KEY_FOLLOWS, {}); 
        f[name]=true; 
        save(KEY_FOLLOWS,f); 
        renderRight(); 
        pushNotif('Seguindo','Você começou a seguir '+name); 
    }

    // ======== Event Listeners ========
    function setupEventListeners() {
        console.log('Configurando event listeners...');
        
        // Botões principais
        const btnNewPost = document.getElementById('btnNewPost');
        const btnNewQuestion = document.getElementById('btnNewQuestion');
        const btnCreateThread = document.getElementById('btnCreateThread');
        const btnNotifications = document.getElementById('btnNotifications');
        const clearNotifs = document.getElementById('clearNotifs');
        const filterFollowed = document.getElementById('filterFollowed');
        const filterAll = document.getElementById('filterAll');
        const btnJoinCall = document.getElementById('btnJoinCall');
        const endCall = document.getElementById('endCall');
        const globalSearch = document.getElementById('globalSearch');
        const lightbox = document.getElementById('lightbox');
        
        // Teste do botão Novo Post
        if (btnNewPost) {
            btnNewPost.addEventListener('click', function() {
                console.log('Botão Novo Post clicado!');
                openNew('post');
            });
        }
        
        if (btnNewQuestion) {
            btnNewQuestion.addEventListener('click', function() {
                openNew('thread');
            });
        }
        
        if (btnCreateThread) {
            btnCreateThread.addEventListener('click', function() {
                openNew('thread');
            });
        }
        
        if (btnNotifications) {
            btnNotifications.addEventListener('click', function() {
                const nots = load(KEY_NOTIF, []);
                if(nots.length===0) {
                    alert('Sem notificações');
                } else {
                    alert(nots.map(n=> n.title + ' — ' + n.timeText).join('\n'));
                }
            });
        }
        
        if (clearNotifs) {
            clearNotifs.addEventListener('click', function() { 
                save(KEY_NOTIF, []); 
                renderRight(); 
            });
        }
        
        if (filterFollowed) {
            filterFollowed.addEventListener('click', function() {
                alert('Funcionalidade "Seguindo" em desenvolvimento');
            });
        }
        
        if (filterAll) {
            filterAll.addEventListener('click', function() {
                renderFeed();
            });
        }
        
        if (btnJoinCall) {
            btnJoinCall.addEventListener('click', async function(){
                const vm = document.getElementById('videoModal'); 
                if (!vm) return;
                
                vm.style.display='flex';
                const local = document.getElementById('localVideo');
                
                try{
                    const stream = await navigator.mediaDevices.getUserMedia({video:true,audio:true});
                    local.srcObject = stream;
                    pushNotif('Chamada','Preview de vídeo ativado (somente local).');
                }catch(err){ 
                    alert('Permissão de câmera/áudio necessária.'); 
                }
            });
        }
        
        if (endCall) {
            endCall.addEventListener('click', function() {
                const vm = document.getElementById('videoModal');
                if (vm) vm.style.display='none';
                
                const local = document.getElementById('localVideo'); 
                if(local && local.srcObject){ 
                    local.srcObject.getTracks().forEach(t=>t.stop()); 
                    local.srcObject=null; 
                }
            });
        }
        
        if (globalSearch) {
            globalSearch.addEventListener('input', function(e){ 
                const q=e.target.value.toLowerCase();
                document.querySelectorAll('.post').forEach(function(p){ 
                    const text=p.innerText.toLowerCase(); 
                    p.style.display = text.includes(q) ? 'flex' : 'none'; 
                });
            });
        }
        
        if (lightbox) {
            lightbox.addEventListener('click', function() {
                closeLightbox();
            });
        }
        
        // Menu navigation
        const viewMap = {
            feed: 'section-feed',
            forum: 'section-forum',
            profiles: 'section-profiles',
            blog: 'section-blog',
            gallery: 'section-gallery'
        };
        
        document.querySelectorAll('.nav-item').forEach(function(item){
            item.addEventListener('click', function(){
                console.log('Menu clicado:', this.dataset.view);
                document.querySelectorAll('.nav-item').forEach(function(n){
                    n.classList.remove('active');
                });
                this.classList.add('active');
                const view = this.dataset.view;
                document.querySelectorAll('.section').forEach(function(s){
                    s.classList.remove('active');
                });
                const id = viewMap[view];
                if(id && document.getElementById(id)) {
                    document.getElementById(id).classList.add('active');
                }
                window.scrollTo({top:0,behavior:'smooth'});
            });
        });
        
        // Shortcut "n" para novo post
        document.addEventListener('keydown', function(e){ 
            if(e.key==='n' && !e.ctrlKey && !e.metaKey) {
                e.preventDefault();
                openNew('post');
            }
        });
        
        console.log('Event listeners configurados');
    }

    // ======== Inicialização ========
    function init() {
        console.log('Inicializando ConnectTI Comunidade...');
        seedData();
        setupEventListeners();
        renderFeed(); 
        renderForum(); 
        renderProfiles(); 
        renderBlog(); 
        renderGallery(); 
        renderRight();
        console.log('ConnectTI Comunidade inicializado com sucesso!');
    }

    // Executar inicialização
    init();
});

// Adiciona também um fallback caso o DOMContentLoaded já tenha ocorrido
if (document.readyState === 'loading') {
    // DOM ainda não carregado
    console.log('DOM ainda carregando...');
} else {
    // DOM já carregado
    console.log('DOM já carregado, executando...');
    // Dispara o evento manualmente
    document.dispatchEvent(new Event('DOMContentLoaded'));
}