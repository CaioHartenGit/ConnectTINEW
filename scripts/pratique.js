/***********************
 * DATA + STORAGE HELPERS
 ***********************/
const ITEMS = [
    {id: 'i1', title: 'Editor HTML/CSS/JS', cat: 'editor', img: 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80', desc: 'Editor integrado para testes rápidos.'},
    {id: 'i2', title: 'Packet Tracer Lite', cat: 'sim', img: 'https://images.unsplash.com/photo-1547658719-da2b51169166?auto=format&fit=crop&w=800&q=80', desc: 'Simulador de redes simplificado.'},
    {id: 'i3', title: 'SQL Playground', cat: 'sim', img: 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=800&q=80', desc: 'Ambiente para rodar queries.'},
    {id: 'i4', title: 'Pentest Lab', cat: 'game', img: 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&w=800&q=80', desc: 'Laboratório seguro para ataques.'},
    {id: 'i5', title: 'Kubernetes Quick', cat: 'sim', img: 'https://images.unsplash.com/photo-1520607162513-77705c0f0d4a?auto=format&fit=crop&w=800&q=80', desc: 'Hands-on com containers.'},
    {id: 'i6', title: 'Mini-Project Fullstack', cat: 'challenge', img: 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&w=800&q=80', desc: 'Desafio prático completo.'}
];

// Quiz questions
const QUIZ = [
    {q: 'Qual comando lista arquivos em Linux?', a: ['ls', 'dir', 'list'], ok: 0},
    {q: 'Qual HTML tag para título?', a: ['<p>', '<h1>', '<title>'], ok: 1},
    {q: 'O que é TCP?', a: ['Protocolo de Transferência de Conteúdo', 'Protocolo orientado à conexão', 'Tipo de conexão sem fio'], ok: 1}
];

// Keys for localStorage
const XP_KEY = 'ct_xp';
const BADGES_KEY = 'ct_badges';
const LEADER_KEY = 'ct_leaderboard';
const SNIPPETS_KEY = 'ct_snippets';

/***********************
 * XP & BADGES FUNCTIONS
 ***********************/
function getXP() {
    return Number(localStorage.getItem(XP_KEY) || 0);
}

function addXP(n) {
    const now = getXP() + n;
    localStorage.setItem(XP_KEY, String(now));
    updateProfileUI();
    return now;
}

function getBadges() {
    return JSON.parse(localStorage.getItem(BADGES_KEY) || '[]');
}

function addBadge(b) {
    const arr = getBadges();
    if (!arr.includes(b)) {
        arr.push(b);
        localStorage.setItem(BADGES_KEY, JSON.stringify(arr));
        updateBadgesUI();
    }
}

/***********************
 * LEADERBOARD
 ***********************/
function saveLeader(name, xp) {
    const raw = JSON.parse(localStorage.getItem(LEADER_KEY) || '[]');
    raw.push({name, xp, date: Date.now()});
    raw.sort((a, b) => b.xp - a.xp);
    raw.splice(10);
    localStorage.setItem(LEADER_KEY, JSON.stringify(raw));
    renderLeaderboard();
}

function renderLeaderboard() {
    const raw = JSON.parse(localStorage.getItem(LEADER_KEY) || '[]');
    const box = document.getElementById('leaderboard');
    if (!box) return;
    
    box.innerHTML = '';
    if (raw.length === 0) {
        box.innerHTML = '<div style="color:var(--muted)">Sem registros</div>';
        return;
    }
    
    raw.forEach((u, idx) => {
        const el = document.createElement('div');
        el.className = 'leader';
        el.innerHTML = `
            <div class="medal">${idx + 1}</div>
            <div style="flex:1">
                <div style="font-weight:700">${u.name}</div>
                <div style="font-size:12px; color:var(--muted)">${u.xp} XP</div>
            </div>
        `;
        box.appendChild(el);
    });
}

/***********************
 * FAVORITES & PROGRESS
 ***********************/
function favKey(id) {
    return 'fav_' + id;
}

function isFav(id) {
    return localStorage.getItem(favKey(id)) === '1';
}

function toggleFav(id) {
    if (isFav(id)) {
        localStorage.removeItem(favKey(id));
    } else {
        localStorage.setItem(favKey(id), '1');
    }
}

function progKey(id) {
    return 'prog_' + id;
}

function getProgress(id) {
    return Number(localStorage.getItem(progKey(id)) || 0);
}

function setProgress(id, val) {
    localStorage.setItem(progKey(id), String(val));
}

/***********************
 * RENDER ROWS
 ***********************/
function makeCard(it) {
    const el = document.createElement('div');
    el.className = 'card-item';
    el.dataset.id = it.id;
    
    el.innerHTML = `
        <div class="poster"><img src="${it.img}" loading="lazy"/></div>
        <h4>${it.title}</h4>
        <p>${it.desc}</p>
        <div class="meta"><span>—</span></div>
        <div class="fav ${isFav(it.id) ? 'active' : ''}" title="Favoritar">❤</div>
        <div class="progress-wrap">
            <div class="progress-track">
                <div class="progress-bar" style="width:${getProgress(it.id)}%"></div>
            </div>
        </div>
    `;
    
    // Interactions
    el.querySelector('.poster').addEventListener('click', () => openDetail(it));
    el.querySelector('h4').addEventListener('click', () => openDetail(it));
    el.querySelector('.fav').addEventListener('click', (e) => {
        e.stopPropagation();
        toggleFav(it.id);
        el.querySelector('.fav').classList.toggle('active');
    });
    
    return el;
}

function renderRows() {
    const rows = {
        'row-destaques': document.getElementById('row-destaques'),
        'row-editors': document.getElementById('row-editors'),
        'row-sims': document.getElementById('row-sims'),
        'row-challenges': document.getElementById('row-challenges')
    };
    
    Object.values(rows).forEach(r => { if (r) r.innerHTML = ''; });
    
    ITEMS.forEach((it, idx) => {
        if (idx < 6 && rows['row-destaques']) {
            rows['row-destaques'].appendChild(makeCard(it));
        }
        if (it.cat === 'editor' && rows['row-editors']) {
            rows['row-editors'].appendChild(makeCard(it));
        }
        if (it.cat === 'sim' && rows['row-sims']) {
            rows['row-sims'].appendChild(makeCard(it));
        }
        if ((it.cat === 'game' || it.cat === 'challenge') && rows['row-challenges']) {
            rows['row-challenges'].appendChild(makeCard(it));
        }
    });
}

/***********************
 * MODAL DETAIL
 ***********************/
const modal = document.getElementById('modal');
const modalImg = document.getElementById('modalImg');
const modalTitle = document.getElementById('modalTitle');
const modalDesc = document.getElementById('modalDesc');
const modalCat = document.getElementById('modalCat');
const modalDur = document.getElementById('modalDur');
const modalProg = document.getElementById('modalProg');

function openDetail(it) {
    if (!modal) return;
    
    modalImg.src = it.img;
    modalTitle.textContent = it.title;
    modalDesc.textContent = it.desc;
    modalCat.textContent = it.cat;
    modalDur.textContent = '—';
    modalProg.style.width = getProgress(it.id) + '%';
    modal.style.display = 'flex';
    
    const modalStart = document.getElementById('modalStart');
    const modalFav = document.getElementById('modalFav');
    
    modalStart.onclick = () => {
        let p = getProgress(it.id);
        p = Math.min(100, p + 20);
        setProgress(it.id, p);
        modalProg.style.width = p + '%';
        addXP(20);
        showToast('+20 XP');
        persistProfile();
        renderRows();
        modal.style.display = 'none';
    };
    
    modalFav.onclick = () => {
        toggleFav(it.id);
        renderRows();
    };
}

/***********************
 * PROFILE UI
 ***********************/
function updateProfileUI() {
    const xp = getXP();
    const level = Math.floor(xp / 100) + 1;
    const xpThisLevel = xp % 100;
    const xpForNext = (level * 100);
    
    const levelText = document.getElementById('levelText');
    const xpBar = document.getElementById('xpBar');
    const xpNow = document.getElementById('xpNow');
    const xpNext = document.getElementById('xpNext');
    
    if (levelText) levelText.textContent = `Nível ${level} • ${xp} XP`;
    if (xpBar) xpBar.style.width = `${xpThisLevel}%`;
    if (xpNow) xpNow.textContent = `${xp} XP`;
    if (xpNext) xpNext.textContent = `${xpForNext} XP`;
}

function updateBadgesUI() {
    const container = document.getElementById('badgesList');
    if (!container) return;
    
    container.innerHTML = '';
    const badges = getBadges();
    
    if (badges.length === 0) {
        container.innerHTML = '<div style="color:var(--muted)">Nenhuma badge ainda</div>';
        return;
    }
    
    badges.forEach(b => {
        const el = document.createElement('div');
        el.style.padding = '6px 8px';
        el.style.background = 'rgba(255,255,255,0.03)';
        el.style.borderRadius = '8px';
        el.textContent = b;
        container.appendChild(el);
    });
}

function persistProfile() {
    saveLeader('Você', getXP());
}

/***********************
 * EDITOR FUNCTIONALITY
 ***********************/
function initEditor() {
    const codeArea = document.getElementById('codeArea');
    const previewFrame = document.getElementById('previewFrame');
    const runBtn = document.getElementById('runBtn');
    const saveSnippet = document.getElementById('saveSnippet');
    const snippets = document.getElementById('snippets');
    
    if (previewFrame && codeArea) {
        const preview = previewFrame.contentWindow.document;
        
        runBtn?.addEventListener('click', () => {
            preview.open();
            preview.write(codeArea.value);
            preview.close();
            addXP(5);
            showToast('+5 XP por testar código');
            persistProfile();
        });
    }
    
    saveSnippet?.addEventListener('click', () => {
        const name = prompt('Nome do snippet:');
        if (!name || !codeArea) return;
        
        const s = JSON.parse(localStorage.getItem(SNIPPETS_KEY) || '{}');
        s[name] = codeArea.value;
        localStorage.setItem(SNIPPETS_KEY, JSON.stringify(s));
        reloadSnippets();
        showToast('Snippet salvo');
    });
    
    snippets?.addEventListener('change', (e) => {
        const s = JSON.parse(localStorage.getItem(SNIPPETS_KEY) || '{}');
        if (!e.target.value || !codeArea) return;
        codeArea.value = s[e.target.value];
        showToast('Snippet carregado');
    });
}

function reloadSnippets() {
    const sel = document.getElementById('snippets');
    if (!sel) return;
    
    sel.innerHTML = '<option value="">Snippets salvos</option>';
    const s = JSON.parse(localStorage.getItem(SNIPPETS_KEY) || '{}');
    
    Object.keys(s).forEach(k => {
        const o = document.createElement('option');
        o.value = k;
        o.textContent = k;
        sel.appendChild(o);
    });
}

/***********************
 * QUIZ GAME
 ***********************/
function openQuiz() {
    const qm = document.getElementById('quizModal');
    if (!qm) return;
    
    qm.style.display = 'flex';
    const area = document.getElementById('quizArea');
    area.innerHTML = '';
    let score = 0;
    
    QUIZ.forEach((q, idx) => {
        const div = document.createElement('div');
        div.style.marginBottom = '12px';
        div.innerHTML = `<div style="font-weight:700">${idx + 1}. ${q.q}</div>`;
        
        q.a.forEach((opt, i) => {
            const b = document.createElement('button');
            b.className = 'small-btn';
            b.style.margin = '6px 6px 0 0';
            b.textContent = opt;
            
            b.addEventListener('click', () => {
                if (i === q.ok) {
                    score += 1;
                    b.style.background = '#06d6a0';
                } else {
                    b.style.background = '#ff6b6b';
                }
                
                setTimeout(() => {
                    if (idx === QUIZ.length - 1) {
                        closeQuiz();
                        addXP(score * 20);
                        addBadgeIfNeeded(score);
                        showToast(`Quiz finalizado: ${score}/${QUIZ.length} - +${score * 20} XP`);
                        persistProfile();
                    }
                }, 700);
            });
            
            div.appendChild(b);
        });
        
        area.appendChild(div);
    });
}

function closeQuiz() {
    const qm = document.getElementById('quizModal');
    if (qm) qm.style.display = 'none';
}

function addBadgeIfNeeded(score) {
    if (score === QUIZ.length) {
        addBadge('Quiz Master');
    }
}

/***********************
 * MEMORY GAME
 ***********************/
function openMemory() {
    const m = document.getElementById('memModal');
    const area = document.getElementById('memArea');
    if (!m || !area) return;
    
    m.style.display = 'flex';
    area.innerHTML = '';
    
    const icons = ['⭐', '🔥', '💻', '🔒', '⚙️', '📦', '🐍', '☁️'];
    const deck = icons.concat(icons).sort(() => Math.random() - 0.5);
    
    let memScore = 0;
    
    deck.forEach((sym, i) => {
        const card = document.createElement('button');
        card.className = 'small-btn';
        card.style.height = '80px';
        card.style.fontSize = '28px';
        card.textContent = '?';
        card.dataset.val = sym;
        card.dataset.open = '0';
        
        card.addEventListener('click', () => {
            if (card.dataset.open === '1') return;
            
            card.textContent = sym;
            card.dataset.open = '1';
            
            const opened = Array.from(area.children).filter(c => 
                c.dataset.open === '1' && !c.dataset.matched
            );
            
            if (opened.length === 2) {
                if (opened[0].dataset.val === opened[1].dataset.val) {
                    opened.forEach(c => c.dataset.matched = '1');
                    memScore += 10;
                    
                    if (memScore >= 80) {
                        addXP(50);
                        addBadge('Memory Champ');
                        showToast('+50 XP por completar Memory');
                        persistProfile();
                    }
                } else {
                    setTimeout(() => {
                        opened.forEach(c => {
                            if (!c.dataset.matched) {
                                c.textContent = '?';
                                c.dataset.open = '0';
                            }
                        });
                    }, 700);
                }
            }
        });
        
        area.appendChild(card);
    });
}

/***********************
 * NETWORK SIMULATOR
 ***********************/
function ipToNum(ip) {
    const parts = ip.split('.').map(Number);
    if (parts.length !== 4 || parts.some(p => isNaN(p) || p < 0 || p > 255)) {
        throw new Error('IP inválido');
    }
    return ((parts[0] << 24) >>> 0) + (parts[1] << 16) + (parts[2] << 8) + parts[3];
}

function numToIp(n) {
    return [(n >>> 24) & 255, (n >>> 16) & 255, (n >>> 8) & 255, n & 255].join('.');
}

function calcNet(ip, mask) {
    const ipn = ipToNum(ip);
    const maskn = ipToNum(mask);
    const network = ipn & maskn;
    const broadcast = (network | (~maskn >>> 0)) >>> 0;
    const hosts = Math.max(0, (broadcast - network - 1));
    
    return {
        network: numToIp(network),
        broadcast: numToIp(broadcast),
        hosts
    };
}

function initNetSim() {
    const calcNetBtn = document.getElementById('calcNet');
    if (!calcNetBtn) return;
    
    calcNetBtn.addEventListener('click', () => {
        const ip = document.getElementById('ns_ip')?.value.trim();
        const mask = document.getElementById('ns_mask')?.value.trim();
        const res = document.getElementById('ns_result');
        
        if (!ip || !mask || !res) return;
        
        try {
            const info = calcNet(ip, mask);
            res.innerHTML = `
                <div>Rede: <b>${info.network}</b></div>
                <div>Broadcast: <b>${info.broadcast}</b></div>
                <div>Hosts válidos: <b>${info.hosts}</b></div>
            `;
            addXP(10);
            showToast('+10 XP por simular rede');
            persistProfile();
        } catch (err) {
            res.textContent = 'Entrada inválida: ' + err.message;
        }
    });
}

/***********************
 * DAILY CHALLENGE
 ***********************/
function showDaily() {
    const d = new Date().toISOString().slice(0, 10);
    const key = 'daily_done_' + d;
    
    if (localStorage.getItem(key)) {
        showToast('Você já completou o desafio de hoje!');
        return;
    }
    
    const q = {q: 'Qual tag cria um link?', opts: ['<a>', '<link>', '<href>'], ok: 0};
    
    if (!modal) return;
    
    modal.style.display = 'flex';
    modalImg.src = 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80';
    modalTitle.textContent = 'Desafio do Dia';
    modalDesc.textContent = q.q;
    modalCat.textContent = 'Diário';
    modalDur.textContent = '1m';
    
    const modalStart = document.getElementById('modalStart');
    modalStart.onclick = () => {
        const ans = prompt(q.q + '\nOpções: 0:' + q.opts.join(', '));
        if (Number(ans) === q.ok) {
            addXP(30);
            addBadge('Daily Champ');
            showToast('+30 XP - Desafio concluído');
            localStorage.setItem(key, '1');
            persistProfile();
            modal.style.display = 'none';
        } else {
            showToast('Resposta incorreta. Tente depois.');
        }
    };
}

/***********************
 * UTILS
 ***********************/
function showToast(msg) {
    const toastRoot = document.getElementById('toastRoot');
    if (!toastRoot) return;
    
    const t = document.createElement('div');
    t.className = 'toast';
    t.textContent = msg;
    toastRoot.appendChild(t);
    
    setTimeout(() => t.remove(), 2600);
}

/***********************
 * EVENT LISTENERS
 ***********************/
function initEventListeners() {
    // Row navigation buttons
    document.querySelectorAll('.nav-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const target = document.getElementById(btn.dataset.target);
            const dir = Number(btn.dataset.dir);
            if (target) {
                const width = target.clientWidth;
                target.scrollBy({left: dir * (width * 0.6), behavior: 'smooth'});
            }
        });
    });
    
    // Search filter
    const searchInput = document.getElementById('searchInput');
    searchInput?.addEventListener('input', (e) => {
        const q = e.target.value.toLowerCase();
        document.querySelectorAll('.card-item').forEach(c => {
            const t = c.querySelector('h4')?.textContent.toLowerCase() || '';
            const p = c.querySelector('p')?.textContent.toLowerCase() || '';
            c.style.display = (t.includes(q) || p.includes(q)) ? 'block' : 'none';
        });
    });
    
    // Close modals
    document.getElementById('closeModal')?.addEventListener('click', () => {
        if (modal) modal.style.display = 'none';
    });
    
    document.getElementById('closeNetSim')?.addEventListener('click', () => {
        document.getElementById('netsim').style.display = 'none';
    });
    
    document.getElementById('closeQuiz')?.addEventListener('click', closeQuiz);
    
    document.getElementById('closeMem')?.addEventListener('click', () => {
        document.getElementById('memModal').style.display = 'none';
    });
    
    // Games
    document.getElementById('startQuiz')?.addEventListener('click', openQuiz);
    document.getElementById('startMemory')?.addEventListener('click', openMemory);
    
    // Restart memory
    document.getElementById('restartMem')?.addEventListener('click', openMemory);
    
    // Network simulator
    document.getElementById('openNetSim')?.addEventListener('click', () => {
        document.getElementById('netsim').style.display = 'flex';
    });
    
    // Daily challenge
    document.getElementById('btnDaily')?.addEventListener('click', showDaily);
    
    // Mini-games shortcut
    document.getElementById('btnGames')?.addEventListener('click', () => {
        document.getElementById('memModal').style.display = 'flex';
    });
    
    // Dev shortcut: double click to clear
    document.getElementById('btnDaily')?.addEventListener('dblclick', () => {
        if (confirm('Limpar todos os dados?')) {
            localStorage.clear();
            location.reload();
        }
    });
}

/***********************
 * INITIALIZATION
 ***********************/
function init() {
    // Initialize localStorage if empty
    if (!localStorage.getItem(XP_KEY)) {
        localStorage.setItem(XP_KEY, '0');
    }
    
    if (!localStorage.getItem(LEADER_KEY)) {
        localStorage.setItem(LEADER_KEY, JSON.stringify([
            {name: 'ProUser', xp: 250},
            {name: 'DevAna', xp: 180},
            {name: 'Você', xp: getXP()}
        ]));
    }
    
    // Render everything
    renderRows();
    updateProfileUI();
    updateBadgesUI();
    renderLeaderboard();
    reloadSnippets();
    
    // Initialize features
    initEditor();
    initNetSim();
    initEventListeners();
}

// Start everything when DOM is ready
document.addEventListener('DOMContentLoaded', init);