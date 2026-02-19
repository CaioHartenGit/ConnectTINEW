// ============================================
// TRILHA CONNECTTI - ESTILO NETFLIX
// JAVASCRIPT COMPLETO E FUNCIONAL
// ============================================

console.log('🎬 Trilha ConnectTI carregando...');

// ============================================
// 1. DADOS DOS CURSOS
// ============================================
const COURSES = [
    // WEB
    { 
        id: 'c1', 
        title: 'CSS Avançado e Layouts', 
        cat: 'web', 
        img: 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=800&q=80', 
        desc: 'Grid, Flexbox, animações e patterns práticos.', 
        duration: '6h' 
    },
    { 
        id: 'c2', 
        title: 'JavaScript Moderno', 
        cat: 'web', 
        img: 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=800&q=80', 
        desc: 'ES6+, módulos, patterns e desempenho.', 
        duration: '8h' 
    },
    { 
        id: 'c3', 
        title: 'React do Zero', 
        cat: 'web', 
        img: 'https://images.unsplash.com/photo-1587620962725-abab7fe55159?auto=format&fit=crop&w=800&q=80', 
        desc: 'Componentes, hooks, roteamento e deploy.', 
        duration: '10h' 
    },
    { 
        id: 'c10', 
        title: 'Certificado Projeto Final', 
        cat: 'web', 
        img: 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80', 
        desc: 'Projeto prático fullstack para certificação.', 
        duration: '12h' 
    },
    
    // FRONT-END
    { 
        id: 'c11', 
        title: 'TypeScript para Front-end', 
        cat: 'frontend', 
        img: 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&w=800&q=80', 
        desc: 'Tipagem, interfaces e integração com React.', 
        duration: '7h' 
    },
    { 
        id: 'c12', 
        title: 'Next.js e SSR', 
        cat: 'frontend', 
        img: 'https://images.unsplash.com/photo-1555066937-4365d14aba8f?auto=format&fit=crop&w=800&q=80', 
        desc: 'Server-side rendering e static generation.', 
        duration: '9h' 
    },
    
    // BACK-END
    { 
        id: 'c4', 
        title: 'Node.js e APIs', 
        cat: 'backend', 
        img: 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80', 
        desc: 'APIs REST, autenticação e testes.', 
        duration: '7h' 
    },
    { 
        id: 'c5', 
        title: 'MySQL e Modelagem', 
        cat: 'backend', 
        img: 'https://images.unsplash.com/photo-1556155092-8707de31f9c4?auto=format&fit=crop&w=800&q=80', 
        desc: 'SQL avançado, índices e otimização.', 
        duration: '6h' 
    },
    { 
        id: 'c13', 
        title: 'MongoDB e Mongoose', 
        cat: 'backend', 
        img: 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80', 
        desc: 'Documentos, aggregations e integração.', 
        duration: '8h' 
    },
    
    // CLOUD
    { 
        id: 'c6', 
        title: 'Docker & Kubernetes', 
        cat: 'cloud', 
        img: 'https://images.unsplash.com/photo-1547658719-da2b51169166?auto=format&fit=crop&w=800&q=80', 
        desc: 'Containerização e orquestração.', 
        duration: '9h' 
    },
    { 
        id: 'c7', 
        title: 'AWS Fundamentals', 
        cat: 'cloud', 
        img: 'https://images.unsplash.com/photo-1508873699372-7ae5b6f4f6b2?auto=format&fit=crop&w=800&q=80', 
        desc: 'Compute, storage e deploy na nuvem.', 
        duration: '5h' 
    },
    
    // SECURITY
    { 
        id: 'c8', 
        title: 'Pentest Básico', 
        cat: 'security', 
        img: 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=800&q=80', 
        desc: 'Conceitos e ferramentas de pentest.', 
        duration: '6h' 
    },
    { 
        id: 'c14', 
        title: 'Segurança Web', 
        cat: 'security', 
        img: 'https://images.unsplash.com/photo-1555949963-aa79dcee981c?auto=format&fit=crop&w=800&q=80', 
        desc: 'OWASP, SQL Injection, XSS e CSRF.', 
        duration: '8h' 
    },
    
    // INFRA
    { 
        id: 'c9', 
        title: 'Redes para Devs', 
        cat: 'infra', 
        img: 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80', 
        desc: 'TCP/IP, NAT, VLANs e troubleshooting.', 
        duration: '4h' 
    },
    { 
        id: 'c15', 
        title: 'Linux para Devs', 
        cat: 'infra', 
        img: 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=800&q=80', 
        desc: 'Terminal, shell script e administração.', 
        duration: '6h' 
    }
];

// ============================================
// 2. UTILIDADES DE STORAGE
// ============================================
function favKey(id) { return 'fav_' + id; }
function progKey(id) { return 'prog_' + id; }

function isFav(id) { 
    return localStorage.getItem(favKey(id)) === '1'; 
}

function setFav(id, val) { 
    if (val) localStorage.setItem(favKey(id), '1'); 
    else localStorage.removeItem(favKey(id)); 
}

function toggleFav(id) {
    const current = isFav(id);
    setFav(id, !current);
    return !current;
}

function getProg(id) { 
    return Number(localStorage.getItem(progKey(id)) || 0); 
}

function setProg(id, val) { 
    localStorage.setItem(progKey(id), String(val)); 
}

function addProgress(id, increment = 15) {
    const cur = getProg(id);
    const next = Math.min(100, cur + increment);
    setProg(id, next);
    return next;
}

function resetProgress() {
    COURSES.forEach(c => localStorage.removeItem(progKey(c.id)));
}

// ============================================
// 3. RENDERIZAÇÃO DE CARDS
// ============================================
function escapeHtml(s) {
    return s.replace(/[&<>"']/g, m => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#39;'
    }[m]));
}

function makeCard(course) {
    const div = document.createElement('div');
    div.className = 'card no-select';
    div.dataset.id = course.id;
    
    const progress = getProg(course.id);
    const favorite = isFav(course.id);
    
    div.innerHTML = `
        <div class="poster">
            <img src="${course.img}" alt="${escapeHtml(course.title)}" loading="lazy">
        </div>
        <h4>${course.title}</h4>
        <p>${course.desc}</p>
        <div class="meta">
            <span>⏱️ ${course.duration}</span>
        </div>
        <div class="fav ${favorite ? 'active' : ''}" title="${favorite ? 'Remover favorito' : 'Adicionar favorito'}">❤️</div>
        <div class="progress-wrap">
            <div class="progress-track">
                <div class="progress-bar" style="width: ${progress}%"></div>
            </div>
        </div>
    `;
    
    // Abrir modal
    div.querySelector('.poster').addEventListener('click', () => openModal(course.id));
    div.querySelector('h4').addEventListener('click', () => openModal(course.id));
    
    // Favoritar
    const favEl = div.querySelector('.fav');
    favEl.addEventListener('click', (e) => {
        e.stopPropagation();
        const newState = toggleFav(course.id);
        favEl.classList.toggle('active');
        favEl.title = newState ? 'Remover favorito' : 'Adicionar favorito';
    });
    
    return div;
}

function updateProgressBars() {
    document.querySelectorAll('.card').forEach(card => {
        const id = card.dataset.id;
        const pb = card.querySelector('.progress-bar');
        if (pb) pb.style.width = getProg(id) + '%';
    });
}

// ============================================
// 4. POPULATE ROWS
// ============================================
function populateRows() {
    const rows = {
        recomendadas: document.getElementById('row-recomendadas'),
        frontend: document.getElementById('row-frontend'),
        backend: document.getElementById('row-backend'),
        cloud: document.getElementById('row-cloud'),
        security: document.getElementById('row-security')
    };
    
    // Limpar rows
    Object.values(rows).forEach(r => { if (r) r.innerHTML = ''; });
    
    // Distribuir cursos
    COURSES.forEach((c, index) => {
        // Recomendadas: primeiros 6 cursos
        if (index < 6 && rows.recomendadas) {
            rows.recomendadas.appendChild(makeCard(c));
        }
        
        // Front-end (web + frontend)
        if ((c.cat === 'web' || c.cat === 'frontend') && rows.frontend) {
            rows.frontend.appendChild(makeCard(c));
        }
        
        // Back-end
        if ((c.cat === 'backend' || c.cat === 'infra') && rows.backend) {
            rows.backend.appendChild(makeCard(c));
        }
        
        // Cloud
        if (c.cat === 'cloud' && rows.cloud) {
            rows.cloud.appendChild(makeCard(c));
        }
        
        // Security
        if (c.cat === 'security' && rows.security) {
            rows.security.appendChild(makeCard(c));
        }
    });
    
    // Atualizar contadores
    updateCounters();
}

function updateCounters() {
    const counts = {
        recomendadas: document.getElementById('count-recomendadas'),
        frontend: document.getElementById('count-frontend'),
        backend: document.getElementById('count-backend'),
        cloud: document.getElementById('count-cloud'),
        security: document.getElementById('count-security')
    };
    
    if (counts.recomendadas && document.getElementById('row-recomendadas')) {
        counts.recomendadas.textContent = document.getElementById('row-recomendadas').children.length + ' cursos';
    }
    if (counts.frontend && document.getElementById('row-frontend')) {
        counts.frontend.textContent = document.getElementById('row-frontend').children.length + ' cursos';
    }
    if (counts.backend && document.getElementById('row-backend')) {
        counts.backend.textContent = document.getElementById('row-backend').children.length + ' cursos';
    }
    if (counts.cloud && document.getElementById('row-cloud')) {
        counts.cloud.textContent = document.getElementById('row-cloud').children.length + ' cursos';
    }
    if (counts.security && document.getElementById('row-security')) {
        counts.security.textContent = document.getElementById('row-security').children.length + ' cursos';
    }
}

// ============================================
// 5. MODAL
// ============================================
const modal = document.getElementById('modal');
let currentCourseId = null;

function openModal(id) {
    const c = COURSES.find(x => x.id === id);
    if (!c) return;
    
    currentCourseId = id;
    
    document.getElementById('modalImg').src = c.img;
    document.getElementById('modalTitle').textContent = c.title;
    document.getElementById('modalDesc').textContent = c.desc;
    document.getElementById('modalCat').textContent = c.cat.toUpperCase();
    document.getElementById('modalDur').textContent = c.duration;
    
    const progress = getProg(id);
    document.getElementById('modalProgress').style.width = progress + '%';
    document.getElementById('modalProgressText').textContent = progress + '%';
    
    const favBtn = document.getElementById('modalFavorite');
    favBtn.innerHTML = isFav(id) ? '❤️ Remover' : '❤️ Favoritar';
    
    modal.style.display = 'flex';
}

function closeModal() {
    modal.style.display = 'none';
}

// Eventos do modal
document.addEventListener('DOMContentLoaded', () => {
    const closeBtn = document.getElementById('closeModal');
    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    
    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });
    
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal.style.display === 'flex') {
            closeModal();
        }
    });
    
    // Botões do modal
    document.getElementById('modalStart').onclick = () => {
        if (!currentCourseId) return;
        const next = addProgress(currentCourseId, 15);
        updateProgressBars();
        document.getElementById('modalProgress').style.width = next + '%';
        document.getElementById('modalProgressText').textContent = next + '%';
        showToast('✅ Progresso atualizado para ' + next + '%');
    };
    
    document.getElementById('modalPreview').onclick = () => {
        showToast('👁️ Prévia do curso');
    };
    
    document.getElementById('modalFavorite').onclick = () => {
        if (!currentCourseId) return;
        const newState = toggleFav(currentCourseId);
        const btn = document.getElementById('modalFavorite');
        btn.innerHTML = newState ? '❤️ Remover' : '❤️ Favoritar';
        
        // Atualizar card
        const card = document.querySelector(`.card[data-id="${currentCourseId}"]`);
        if (card) {
            const favEl = card.querySelector('.fav');
            favEl.classList.toggle('active');
        }
        
        showToast(newState ? '❤️ Adicionado aos favoritos' : '💔 Removido dos favoritos');
    };
});

// ============================================
// 6. FILTROS E BUSCA
// ============================================
function filterBy(filter) {
    if (filter === 'all') {
        document.querySelectorAll('.card').forEach(c => c.style.display = 'block');
        return;
    }
    
    document.querySelectorAll('.card').forEach(c => {
        const id = c.dataset.id;
        const course = COURSES.find(x => x.id === id);
        if (!course) return;
        
        const map = {
            'web': ['web', 'frontend'],
            'frontend': ['frontend', 'web'],
            'backend': ['backend', 'infra'],
            'infra': ['infra', 'backend'],
            'cloud': ['cloud'],
            'security': ['security']
        };
        
        const ok = (map[filter] || [filter]).includes(course.cat);
        c.style.display = ok ? 'block' : 'none';
    });
}

function searchCourses(term) {
    term = term.toLowerCase().trim();
    
    document.querySelectorAll('.card').forEach(card => {
        const title = card.querySelector('h4').textContent.toLowerCase();
        const desc = card.querySelector('p').textContent.toLowerCase();
        card.style.display = (title.includes(term) || desc.includes(term)) ? 'block' : 'none';
    });
}

function showFavorites() {
    document.querySelectorAll('.card').forEach(card => {
        const id = card.dataset.id;
        card.style.display = isFav(id) ? 'block' : 'none';
    });
}

// ============================================
// 7. TOAST NOTIFICATION
// ============================================
function showToast(message) {
    const toast = document.createElement('div');
    toast.className = 'toast-notification';
    toast.textContent = message;
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// ============================================
// 8. EVENT LISTENERS
// ============================================
function initEventListeners() {
    // Filtros
    document.querySelectorAll('[data-filter]').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('[data-filter]').forEach(b => 
                b.classList.remove('active')
            );
            this.classList.add('active');
            filterBy(this.dataset.filter);
        });
    });
    
    // Busca
    const searchInput = document.getElementById('searchInput');
    let searchTimeout;
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            searchCourses(this.value);
        }, 300);
    });
    
    // Favoritos
    document.getElementById('showFavs').addEventListener('click', showFavorites);
    
    // Reset progresso
    document.getElementById('resetProgress').addEventListener('click', () => {
        if (confirm('Resetar todo o progresso salvo localmente?')) {
            resetProgress();
            updateProgressBars();
            showToast('🔄 Progresso resetado');
        }
    });
    
    // Hero buttons
    document.getElementById('startHero').addEventListener('click', () => {
        document.querySelector('.cards-row').scrollIntoView({ behavior: 'smooth' });
    });
    
    document.getElementById('exploreHero').addEventListener('click', () => {
        filterBy('all');
        document.querySelector('[data-filter="all"]').classList.add('active');
    });
    
    // Meus Cursos
    document.getElementById('meusCursosBtn').addEventListener('click', () => {
        showToast('📚 Seus cursos serão exibidos em breve');
    });
}

// ============================================
// 9. INICIALIZAÇÃO
// ============================================
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Inicializando Trilha ConnectTI...');
    
    populateRows();
    updateProgressBars();
    initEventListeners();
    
    console.log('✅ Trilha ConnectTI inicializada com sucesso!');
});