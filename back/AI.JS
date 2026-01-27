// ⚠ SUA CHAVE AQUI
const OPENAI_KEY = "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";

document.getElementById("aiChatBtn").onclick = () => {
    const win = document.getElementById("aiChatWindow");
    win.style.display = win.style.display === "flex" ? "none" : "flex";
};

document.getElementById("aiSendBtn").onclick = sendMessage;

async function sendMessage() {
    const input = document.getElementById("aiUserInput");
    const msg = input.value.trim();
    if (msg === "") return;

    addMessage(msg, "user");
    input.value = "";

    const reply = await askAI(msg);
    addMessage(reply, "ai");
}

function addMessage(text, sender) {
    const box = document.getElementById("aiMessages");
    const div = document.createElement("div");
    div.className = sender === "user" ? "msg-user" : "msg-ai";
    div.innerHTML = text;
    box.appendChild(div);
    box.scrollTop = box.scrollHeight;
}

async function askAI(question) {
    const response = await fetch("https://api.openai.com/v1/chat/completions", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Authorization": `Bearer ${OPENAI_KEY}`
        },
        body: JSON.stringify({
            model: "gpt-4o-mini",
            messages: [{ role: "user", content: question }]
        })
    });

    const data = await response.json();
    return data.choices[0].message.content;
}
