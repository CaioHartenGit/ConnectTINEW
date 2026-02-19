// ============================================
// PAINEL DE PERFIL - CONNECTTI
// JAVASCRIPT COMPLETO E FUNCIONAL
// ============================================

console.log('Script carregando...');

// Aguardar DOM carregar
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM completamente carregado');
    
    // ========================================
    // 1. VARIÁVEIS GLOBAIS DO PHP
    // ========================================
    // Estas variáveis são injetadas pelo PHP no HTML
    // cursosTI e instituicoesTI vêm do <?php json_encode(...) ?>
    
    // ========================================
    // 2. CLASSE DE AUTOCOMPLETE
    // ========================================
    class AutocompleteManager {
        constructor(inputId, popupId, clearBtnId, dataList, options = {}) {
            this.input = document.getElementById(inputId);
            this.popup = document.getElementById(popupId);
            this.clearBtn = document.getElementById(clearBtnId);
            this.dataList = dataList || [];
            this.options = {
                minChars: 2,
                maxResults: 15,
                ...options
            };
            
            if (!this.input || !this.popup) {
                console.warn(`Autocomplete: ${inputId} ou ${popupId} não encontrado`);
                return;
            }
            
            this.init();
        }
        
        init() {
            // Eventos
            this.input.addEventListener('input', this.handleInput.bind(this));
            this.input.addEventListener('focus', this.handleFocus.bind(this));
            this.input.addEventListener('keydown', this.handleKeydown.bind(this));
            
            // Botão limpar
            if (this.clearBtn) {
                this.clearBtn.addEventListener('click', this.handleClear.bind(this));
                this.toggleClearButton();
            }
            
            // Fechar ao clicar fora
            document.addEventListener('click', this.handleClickOutside.bind(this));
            
            // Fechar ao pressionar ESC
            this.popup.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') this.hide();
            });
            
            console.log(`✅ Autocomplete inicializado: ${this.input.id}`);
        }
        
        // Mostrar todas as opções
        showAll() {
            if (!this.dataList || this.dataList.length === 0) {
                this.showEmptyState();
                return;
            }
            
            const icon = this.input.id.includes('curso') ? 'cpu' : 'building';
            const title = this.input.id.includes('curso') ? 'Cursos de Tecnologia' : 'Instituições de Ensino';
            
            let html = `
                <div class="suggestion-item suggestion-header">
                    <i class="ri-${icon}-line"></i>
                    <span class="fw-bold">${title} (${this.dataList.length})</span>
                    <span class="suggestion-category">TI</span>
                </div>
            `;
            
            this.dataList.forEach(item => {
                html += this.renderItem(item, icon);
            });
            
            this.popup.innerHTML = html;
            this.show();
        }
        
        // Filtrar itens
        filterItems(termo) {
            termo = termo.toLowerCase().trim();
            
            if (termo.length === 0) {
                this.hide();
                return;
            }
            
            if (termo.length < this.options.minChars) {
                this.showEmptyState(`Digite pelo menos ${this.options.minChars} caracteres`, 'ri-information-line');
                return;
            }
            
            const filtrados = this.dataList.filter(item => 
                item.toLowerCase().includes(termo)
            );
            
            if (filtrados.length === 0) {
                this.showEmptyState(`Nenhum resultado para "${termo}"`, 'ri-error-warning-line');
                return;
            }
            
            const icon = this.input.id.includes('curso') ? 'cpu' : 'building';
            
            let html = `
                <div class="suggestion-item suggestion-result-header">
                    <i class="ri-search-line"></i>
                    <span>Resultados para <strong>"${termo}"</strong> (${filtrados.length})</span>
                </div>
            `;
            
            // Limitar resultados
            filtrados.slice(0, this.options.maxResults).forEach(item => {
                // Destacar termo
                const regex = new RegExp(`(${termo})`, 'gi');
                const textoDestacado = item.replace(regex, '<span class="suggestion-highlight">$1</span>');
                
                html += this.renderItem(textoDestacado, icon, item);
            });
            
            if (filtrados.length > this.options.maxResults) {
                html += `
                    <div class="suggestion-item text-muted more-results">
                        <i class="ri-more-line"></i>
                        <span>... e mais ${filtrados.length - this.options.maxResults} resultados</span>
                    </div>
                `;
            }
            
            this.popup.innerHTML = html;
            this.show();
        }
        
        // Renderizar item
        renderItem(texto, icon, valorReal = null) {
            const valor = valorReal || texto.replace(/<[^>]*>/g, ''); // Remove HTML para o valor real
            const textoLimpo = valorReal ? texto : texto; // Já vem com highlight
            
            return `
                <div class="suggestion-item" onclick="window.selecionarItem('${this.input.id}', '${this.popup.id}', '${this.clearBtn?.id || ''}', '${this.escapeJS(valor)}')">
                    <i class="ri-${icon}-line"></i>
                    <span>${textoLimpo}</span>
                </div>
            `;
        }
        
        // Estado vazio
        showEmptyState(mensagem = 'Nenhum resultado', icone = 'ri-search-line') {
            this.popup.innerHTML = `
                <div class="suggestion-item disabled">
                    <i class="${icone}"></i>
                    <span>${mensagem}</span>
                </div>
            `;
            this.show();
        }
        
        // Handlers
        handleInput(e) {
            const valor = e.target.value.trim();
            this.filterItems(valor);
            this.toggleClearButton();
        }
        
        handleFocus() {
            const valor = this.input.value.trim();
            if (valor.length === 0) {
                this.showAll();
            } else if (valor.length >= this.options.minChars) {
                this.filterItems(valor);
            }
        }
        
        handleKeydown(e) {
            if (e.key === 'Escape') {
                this.hide();
            }
            
            // Navegação com setas (opcional)
            if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
                e.preventDefault();
                // Implementar navegação se desejar
            }
        }
        
        handleClear(e) {
            e.preventDefault();
            e.stopPropagation();
            this.input.value = '';
            this.hide();
            this.toggleClearButton();
            this.input.focus();
            
            // Disparar evento change
            this.input.dispatchEvent(new Event('change', { bubbles: true }));
        }
        
        handleClickOutside(e) {
            if (!this.input.contains(e.target) && !this.popup.contains(e.target)) {
                this.hide();
            }
        }
        
        // Utilitários
        show() {
            this.popup.classList.add('show');
        }
        
        hide() {
            this.popup.classList.remove('show');
        }
        
        toggleClearButton() {
            if (this.clearBtn) {
                this.clearBtn.style.display = this.input.value.length > 0 ? 'flex' : 'none';
            }
        }
        
        escapeJS(str) {
            return str.replace(/'/g, "\\'").replace(/"/g, '&quot;');
        }
    }
    
    // ========================================
    // 3. FUNÇÃO GLOBAL PARA SELECIONAR ITEM
    // ========================================
    window.selecionarItem = function(inputId, popupId, clearBtnId, valor) {
        const input = document.getElementById(inputId);
        const popup = document.getElementById(popupId);
        const clearBtn = document.getElementById(clearBtnId);
        
        if (input) {
            input.value = valor;
            input.dispatchEvent(new Event('input', { bubbles: true }));
            input.dispatchEvent(new Event('change', { bubbles: true }));
        }
        
        if (popup) {
            popup.classList.remove('show');
        }
        
        if (clearBtn) {
            clearBtn.style.display = 'flex';
        }
        
        console.log(`✅ Item selecionado: ${valor}`);
    };
    
    // ========================================
    // 4. GERENCIADOR DE FOTO
    // ========================================
    class PhotoManager {
        constructor() {
            this.fotoInput = document.getElementById('foto');
            this.profilePreview = document.getElementById('profilePreview');
            this.validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            this.maxSize = 2 * 1024 * 1024; // 2MB
            
            if (this.fotoInput && this.profilePreview) {
                this.init();
            }
        }
        
        init() {
            this.fotoInput.addEventListener('change', this.handlePhotoChange.bind(this));
            console.log('✅ Gerenciador de foto inicializado');
        }
        
        handlePhotoChange(e) {
            const file = e.target.files[0];
            
            if (!file) return;
            
            // Validar tipo
            if (!this.validTypes.includes(file.type)) {
                alert('❌ Tipo de arquivo inválido. Use JPG, PNG, GIF ou WebP.');
                this.fotoInput.value = '';
                return;
            }
            
            // Validar tamanho
            if (file.size > this.maxSize) {
                alert('❌ Arquivo muito grande. Máximo 2MB.');
                this.fotoInput.value = '';
                return;
            }
            
            // Preview
            const reader = new FileReader();
            reader.onload = (e) => {
                this.profilePreview.src = e.target.result;
                console.log('✅ Foto atualizada com sucesso');
            };
            reader.readAsDataURL(file);
        }
    }
    
    // ========================================
    // 5. GERENCIADOR DE SENHA
    // ========================================
    class PasswordManager {
        constructor() {
            this.toggleButtons = document.querySelectorAll('.toggle-password');
            
            if (this.toggleButtons.length > 0) {
                this.init();
            }
        }
        
        init() {
            this.toggleButtons.forEach(btn => {
                btn.addEventListener('click', this.handleToggle.bind(this));
            });
            console.log('✅ Gerenciador de senha inicializado');
        }
        
        handleToggle(e) {
            const btn = e.currentTarget;
            const targetName = btn.dataset.target;
            const input = document.querySelector(`input[name="${targetName}"]`);
            const icon = btn.querySelector('i');
            
            if (!input || !icon) return;
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('ri-eye-line');
                icon.classList.add('ri-eye-off-line');
            } else {
                input.type = 'password';
                icon.classList.remove('ri-eye-off-line');
                icon.classList.add('ri-eye-line');
            }
        }
    }
    
    // ========================================
    // 6. GERENCIADOR DE FORMULÁRIO
    // ========================================
    class FormManager {
        constructor() {
            this.form = document.getElementById('profileForm');
            this.formModified = false;
            
            if (this.form) {
                this.init();
            }
        }
        
        init() {
            // Validação no submit
            this.form.addEventListener('submit', this.handleSubmit.bind(this));
            
            // Detectar modificações
            this.form.addEventListener('input', () => {
                this.formModified = true;
            });
            
            this.form.addEventListener('change', () => {
                this.formModified = true;
            });
            
            // Confirmar saída
            window.addEventListener('beforeunload', this.handleBeforeUnload.bind(this));
            
            console.log('✅ Gerenciador de formulário inicializado');
        }
        
        handleSubmit(e) {
            const inputs = this.form.querySelectorAll('input[required]');
            let isValid = true;
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    input.classList.add('is-invalid');
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                alert('❌ Por favor, preencha todos os campos obrigatórios.');
                return;
            }
            
            this.formModified = false;
            console.log('✅ Formulário enviado com sucesso');
        }
        
        handleBeforeUnload(e) {
            if (this.formModified) {
                e.preventDefault();
                e.returnValue = 'Há alterações não salvas. Deseja realmente sair?';
                return e.returnValue;
            }
        }
    }
    
    // ========================================
    // 7. GERENCIADOR DE ALERTAS
    // ========================================
    class AlertManager {
        constructor() {
            this.alerts = document.querySelectorAll('.alert');
            
            if (this.alerts.length > 0) {
                this.init();
            }
        }
        
        init() {
            // Auto-fechar após 5 segundos
            setTimeout(() => {
                this.alerts.forEach(alert => {
                    const closeBtn = alert.querySelector('.btn-close');
                    if (closeBtn) {
                        closeBtn.click();
                    }
                });
            }, 5000);
            
            console.log('✅ Gerenciador de alertas inicializado');
        }
    }
    
    // ========================================
    // 8. GERENCIADOR DE TOOLTIPS
    // ========================================
    class TooltipManager {
        constructor() {
            if (typeof bootstrap === 'undefined') {
                console.warn('⚠️ Bootstrap JS não encontrado');
                return;
            }
            
            this.init();
        }
        
        init() {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            
            tooltipTriggerList.map(tooltipTriggerEl => {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            console.log(`✅ ${tooltipTriggerList.length} tooltips inicializados`);
        }
    }
    
    // ========================================
    // 9. GERENCIADOR DE DATA
    // ========================================
    class DateManager {
        constructor() {
            this.dataInput = document.querySelector('input[type="date"]');
            
            if (this.dataInput) {
                this.init();
            }
        }
        
        init() {
            // Definir data máxima como hoje
            if (!this.dataInput.value) {
                const today = new Date().toISOString().split('T')[0];
                this.dataInput.max = today;
            }
            
            console.log('✅ Gerenciador de data inicializado');
        }
    }
    
    // ========================================
    // 10. INICIALIZAR TUDO
    // ========================================
    function initApp() {
        console.log('🚀 Inicializando ConnectTI Painel...');
        
        // Verificar se as listas existem
        if (typeof cursosTI !== 'undefined') {
            console.log(`📚 Cursos carregados: ${cursosTI.length}`);
        } else {
            console.warn('⚠️ cursosTI não definido');
        }
        
        if (typeof instituicoesTI !== 'undefined') {
            console.log(`🏛️ Instituições carregadas: ${instituicoesTI.length}`);
        } else {
            console.warn('⚠️ instituicoesTI não definido');
        }
        
        // Inicializar autocompletes
        if (typeof cursosTI !== 'undefined') {
            window.cursoAutocomplete = new AutocompleteManager(
                'cursoInput', 
                'cursoPopup', 
                'clearCurso', 
                cursosTI,
                { minChars: 2, maxResults: 15 }
            );
        }
        
        if (typeof instituicoesTI !== 'undefined') {
            window.instituicaoAutocomplete = new AutocompleteManager(
                'instituicaoInput', 
                'instituicaoPopup', 
                'clearInstituicao', 
                instituicoesTI,
                { minChars: 2, maxResults: 15 }
            );
        }
        
        // Inicializar outros gerenciadores
        window.photoManager = new PhotoManager();
        window.passwordManager = new PasswordManager();
        window.formManager = new FormManager();
        window.alertManager = new AlertManager();
        window.tooltipManager = new TooltipManager();
        window.dateManager = new DateManager();
        
        console.log('✅ ConnectTI Painel inicializado com sucesso!');
    }
    
    // Iniciar tudo
    initApp();
});

console.log('Script carregado com sucesso!');