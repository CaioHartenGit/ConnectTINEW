console.log("🤖 Chat ConnectTI iniciado");

document.addEventListener("DOMContentLoaded", () => {

    const chatBtn = document.getElementById("aiChatBtn");
    const chatWindow = document.getElementById("aiChatWindow");
    const closeBtn = document.getElementById("aiCloseBtn");
    const messagesBox = document.getElementById("aiMessages");
    const sendBtn = document.getElementById("aiSendBtn");
    const userInput = document.getElementById("aiUserInput");

    // Verificar se todos os elementos existem
    if (!chatBtn || !chatWindow || !closeBtn || !messagesBox || !sendBtn || !userInput) {
        console.error("❌ Erro: Elementos não encontrados!");
        return;
    }

    console.log("✅ Elementos encontrados!");

    // ================= RESPOSTAS =================
    const respostas = {
        trilha: "📚 **Front-end:** HTML, CSS, JavaScript, React\n\n⚙️ **Back-end:** PHP, Python, Node.js, Banco de Dados\n\n☁️ **Cloud & DevOps:** AWS, Docker, Kubernetes\n\nQual área mais te interessa?",
        comecar: "🚀 Para começar:\n1️⃣ Escolha uma trilha\n2️⃣ Clique em qualquer curso\n3️⃣ Aperte 'Iniciar'\n\nSeu progresso é salvo automaticamente!",
        cursos: "❤️ **Meus Cursos** fica no topo da página.\nLá você encontra:\n• Cursos em andamento\n• Cursos favoritos\n• Histórico",
        estudo: "🧠 **Dicas de estudo:**\n• 30-60 minutos por dia\n• Pratique com projetos reais\n• Faça anotações\n• Revise semanalmente\n• Participe da comunidade",
        ola: "👋 Olá! Sou o assistente da ConnectTI.\n\nEscolha uma opção abaixo ou digite sua dúvida:",
        menu: "📋 **Menu Principal**\n\nEscolha o que deseja saber:",
        default: "Não entendi 🤔. Clique no botão '📋 Menu' para ver as opções:"
    };

    // ================= FUNÇÕES =================
    function addMessage(text, type) {
        const div = document.createElement("div");
        div.className = type === "user" ? "msg-user" : "msg-ai";
        div.style.whiteSpace = "pre-line";
        div.textContent = text;
        messagesBox.appendChild(div);
        messagesBox.scrollTop = messagesBox.scrollHeight;
    }

    function showOptions() {
        const oldOptions = messagesBox.querySelector(".ai-options");
        if (oldOptions) oldOptions.remove();

        const options = document.createElement("div");
        options.className = "ai-options";

        options.innerHTML = `
            <button class="ai-option" data-q="trilha">📚 Qual trilha escolher?</button>
            <button class="ai-option" data-q="comecar">🚀 Como começar?</button>
            <button class="ai-option" data-q="cursos">❤️ Meus cursos</button>
            <button class="ai-option" data-q="estudo">🧠 Dicas de estudo</button>
            <button class="ai-option" data-q="menu">📋 Voltar ao menu</button>
        `;

        messagesBox.appendChild(options);
    }

    function responder(msg) {
        msg = msg.toLowerCase();

        if (msg.includes("trilha") || msg.includes("qual")) return respostas.trilha;
        if (msg.includes("começar") || msg.includes("iniciar") || msg.includes("primeiro")) return respostas.comecar;
        if (msg.includes("curso") || msg.includes("favorito") || msg.includes("meus")) return respostas.cursos;
        if (msg.includes("estudo") || msg.includes("dica") || msg.includes("aprender") || msg.includes("estudar")) return respostas.estudo;
        if (msg.includes("menu") || msg.includes("voltar") || msg.includes("opção") || msg.includes("início")) return respostas.menu;
        if (msg.includes("oi") || msg.includes("olá") || msg.includes("ola") || msg.includes("boa")) return respostas.ola;

        return respostas.default;
    }

    function iniciarChat() {
        messagesBox.innerHTML = "";
        addMessage(respostas.ola, "ai");
        showOptions();
    }

    // ================= EVENTOS =================
    
    // Abrir/fechar chat
    chatBtn.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();
        console.log("Botão clicado!");
        
        if (chatWindow.style.display === "flex") {
            chatWindow.style.display = "none";
            console.log("Fechando chat");
        } else {
            chatWindow.style.display = "flex";
            console.log("Abrindo chat");
            
            if (messagesBox.children.length === 0) {
                iniciarChat();
            }
        }
    });

    // Fechar com botão X
    closeBtn.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();
        console.log("Fechando com X");
        chatWindow.style.display = "none";
    });

    // Enviar mensagem
    sendBtn.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();
        const text = userInput.value.trim();
        if (!text) return;

        console.log("Enviando:", text);
        addMessage(text, "user");
        userInput.value = "";

        const options = messagesBox.querySelector(".ai-options");
        if (options) options.remove();

        setTimeout(() => {
            const resposta = responder(text);
            addMessage(resposta, "ai");

            if (resposta === respostas.default || resposta === respostas.menu) {
                showOptions();
            }
        }, 400);
    });

    // Enter no input
    userInput.addEventListener("keypress", e => {
        if (e.key === "Enter") {
            e.preventDefault();
            e.stopPropagation();
            sendBtn.click();
        }
    });

    // Clique nas opções (com stopPropagation para não fechar)
    messagesBox.addEventListener("click", (e) => {
        const btn = e.target.closest(".ai-option");
        if (!btn) return;

        e.preventDefault();
        e.stopPropagation(); // IMPEDE O FECHAMENTO
        
        const pergunta = btn.textContent.replace(/[📚🚀❤️🧠📋]/g, '').trim();
        const tipo = btn.dataset.q;

        console.log("Opção clicada:", tipo);

        const optionsContainer = btn.closest(".ai-options");
        if (optionsContainer) optionsContainer.remove();

        addMessage(pergunta, "user");

        setTimeout(() => {
            if (tipo === "menu") {
                addMessage(respostas.menu, "ai");
                showOptions();
            } else if (respostas[tipo]) {
                addMessage(respostas[tipo], "ai");
                setTimeout(() => {
                    showOptions();
                }, 200);
            } else {
                addMessage("Desculpe, erro na resposta.", "ai");
                showOptions();
            }
        }, 400);
    });

    // Fechar se clicar fora (AGORA VERIFICA SE NÃO É NO CHAT OU BOTÃO)
    document.addEventListener("click", (e) => {
        // SÓ FECHA SE O CLIQUE FOR FORA DO CHAT E FORA DO BOTÃO
        if (chatWindow.style.display === "flex" && 
            !chatWindow.contains(e.target) && 
            e.target !== chatBtn &&
            !chatBtn.contains(e.target)) {
            console.log("Fechando por clique fora");
            chatWindow.style.display = "none";
        }
    });

    console.log("🎯 Chat pronto!");
});