document.addEventListener("DOMContentLoaded", () => {

    const chatBtn = document.getElementById("aiChatBtn");
    const chatWindow = document.getElementById("aiChatWindow");
    const closeBtn = document.getElementById("aiCloseBtn");
    const messagesBox = document.getElementById("aiMessages");

    // abrir / fechar chat
    chatBtn.addEventListener("click", () => {
        chatWindow.style.display =
            chatWindow.style.display === "flex" ? "none" : "flex";
    });

    closeBtn.addEventListener("click", () => {
        chatWindow.style.display = "none";
    });

    // respostas pré-definidas
    const respostas = {
        trilha:
            "📚 Recomendamos começar pela trilha Front-end se gosta de design e interfaces. Se prefere lógica e servidores, vá de Back-end.",

        comecar:
            "🚀 Clique em um curso e pressione 'Iniciar'. Seu progresso será salvo automaticamente.",

        cursos:
            "❤️ Seus cursos favoritos ficam salvos na aba 'Meus Cursos' no topo da página.",

        estudo:
            "🧠 Estude 30-60 minutos por dia, pratique projetos reais e revise o conteúdo semanalmente."
    };

    // clique nos botões
    document.addEventListener("click", (e) => {
        if (!e.target.classList.contains("ai-option")) return;

        const tipo = e.target.dataset.q;
        const pergunta = e.target.innerText;

        addMessage(pergunta, "user");

        setTimeout(() => {
            addMessage(respostas[tipo], "ai");
        }, 400);
    });

    function addMessage(text, sender) {
        const div = document.createElement("div");

        div.className = sender === "user" ? "msg-user" : "msg-ai";
        div.innerText = text;

        messagesBox.appendChild(div);
        messagesBox.scrollTop = messagesBox.scrollHeight;
    }

});
