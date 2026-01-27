function sendMessage() {
    const input = document.getElementById("chatInput");
    const body = document.getElementById("chatBody");

    if (input.value.trim() === "") return;

    body.innerHTML += `<div class="msg">${input.value}</div>`;
    input.value = "";

    body.scrollTop = body.scrollHeight;
}
