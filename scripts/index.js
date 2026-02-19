// ================= 1. CONFIGURAÇÃO INICIAL =================
document.addEventListener('DOMContentLoaded', function() {
    
    // ================= 2. DARK MODE =================
    const darkModeToggle = document.getElementById('darkModeToggle');
    const darkModeIcon = darkModeToggle.querySelector('i');
    
    // Verificar preferência salva
    const isDarkMode = localStorage.getItem('darkMode') === 'true';
    
    if (isDarkMode) {
        document.body.classList.add('dark-mode');
        darkModeIcon.className = 'bi bi-sun-fill';
    }
    
    // Alternar dark mode
    darkModeToggle.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
        
        const isNowDark = document.body.classList.contains('dark-mode');
        localStorage.setItem('darkMode', isNowDark);
        
        // Alterar ícone
        if (isNowDark) {
            darkModeIcon.className = 'bi bi-sun-fill';
        } else {
            darkModeIcon.className = 'bi bi-moon-fill';
        }
    });
    
    // ================= 3. COOKIE CONSENT =================
    const cookieConsent = document.getElementById('cookieConsent');
    const acceptCookieBtn = document.getElementById('acceptCookie');
    const rejectCookieBtn = document.getElementById('rejectCookie');
    const closeCookieBtn = document.getElementById('closeCookie');
    
    // Verificar se já aceitou cookies
    const cookiesAccepted = localStorage.getItem('cookiesAccepted');
    
    if (!cookiesAccepted) {
        // Mostrar após 2 segundos
        setTimeout(() => {
            cookieConsent.style.display = 'block';
        }, 2000);
    }
    
    // Aceitar cookies
    if (acceptCookieBtn) {
        acceptCookieBtn.addEventListener('click', function() {
            localStorage.setItem('cookiesAccepted', 'true');
            localStorage.setItem('cookiesDate', new Date().toISOString());
            cookieConsent.style.display = 'none';
            
            // Inicializar cookies (Google Analytics, etc.)
            initializeCookies();
        });
    }
    
    // Recusar cookies
    if (rejectCookieBtn) {
        rejectCookieBtn.addEventListener('click', function() {
            localStorage.setItem('cookiesAccepted', 'false');
            cookieConsent.style.display = 'none';
        });
    }
    
    // Fechar modal
    if (closeCookieBtn) {
        closeCookieBtn.addEventListener('click', function() {
            cookieConsent.style.display = 'none';
        });
    }
    
    // ================= 4. SCROLL TO TOP =================
    const topoBtn = document.querySelector('.topo');
    
    if (topoBtn) {
        topoBtn.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    
    // ================= 5. MODAIS =================
    // Modal de perfil
    const profileModal = document.getElementById('profileModal');
    const profileForm = document.getElementById('profileForm');
    const profileAvatar = document.getElementById('profileAvatar');
    const profileAvatarPreview = document.getElementById('profileAvatarPreview');
    const removeAvatarBtn = document.getElementById('removeAvatarBtn');
    
    // Preview de imagem
    if (profileAvatar) {
        profileAvatar.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profileAvatarPreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }
    
    // Remover avatar
    if (removeAvatarBtn) {
        removeAvatarBtn.addEventListener('click', function() {
            profileAvatarPreview.src = '../img/Logo ConnectTI.png';
            if (profileAvatar) {
                profileAvatar.value = '';
            }
        });
    }
    
    // Enviar formulário de perfil
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Aqui você enviaria para o backend
            const formData = new FormData(this);
            
            // Simulação de envio
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Salvando...';
            submitBtn.disabled = true;
            
            setTimeout(() => {
                alert('Perfil salvo com sucesso!');
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
                
                // Fechar modal
                const modal = bootstrap.Modal.getInstance(profileModal);
                if (modal) modal.hide();
            }, 1500);
        });
    }
    
    // ================= 6. TRATAMENTO DE ERROS DE IMAGEM =================
    const images = document.querySelectorAll('img');
    
    images.forEach(img => {
        img.addEventListener('error', function() {
            // Se a imagem não carregar, substituir por placeholder
            if (this.src.includes('../img/Logo ConnectTI.png')) {
                return; // Não substituir o logo padrão
            }
            
            // Tentar carregar uma imagem de fallback
            this.src = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI2Y4ZjlmYSIvPjx0ZXh0IHg9IjEwMCIgeT0iMTAwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGRvbWluYW50LWJhc2VsaW5lPSJtaWRkbGUiIGZpbGw9IiM2Yzc1N2QiPkltYWdlbSBuw6NvIGNhcnJlZ2FkYTwvdGV4dD48L3N2Zz4=';
        });
    });
    
    // ================= 7. FUNÇÕES AUXILIARES =================
    function initializeCookies() {
        // Aqui você inicializaria Google Analytics, Facebook Pixel, etc.
        console.log('Cookies inicializados');
        
        // Exemplo: Google Analytics
        // window.dataLayer = window.dataLayer || [];
        // function gtag(){dataLayer.push(arguments);}
        // gtag('js', new Date());
        // gtag('config', 'UA-XXXXX-Y');
    }
});