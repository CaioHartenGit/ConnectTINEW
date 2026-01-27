/* ================== GERADOR ID ================== */
function genId(){
    return "id-" + Math.random().toString(36).substr(2,9);
}

/* ================== CARREGAR DADOS ================== */
function load(key, fallback){
    try { return JSON.parse(localStorage.getItem(key)) || fallback; }
    catch(e){ return fallback; }
}

function save(key, value){
    localStorage.setItem(key, JSON.stringify(value));
}

/* ================== CHAVES ================== */
const KEY_POSTS = 'ct_posts_v2';
const KEY_THREADS = 'ct_threads_v2';
const KEY_BLOGS = 'ct_blogs_v2';
const KEY_GALLERY = 'ct_gallery_v2';
const KEY_XP = 'ct_xp_v2';
const KEY_NOTIF = 'ct_notif_v2';

/* ================== CARREGAR DADOS ================== */
let posts = load(KEY_POSTS, []);
let threads = load(KEY_THREADS, []);
let blogs = load(KEY_BLOGS, []);
let gallery = load(KEY_GALLERY, []);
let xp = load(KEY_XP, 0);
let notifications = load(KEY_NOTIF, []);

/* ================== RENDER FEED ================== */
function renderFeed(){
    const feed = document.getElementById("feed");
    feed.innerHTML = "";

    posts.slice().reverse().forEach(post =>{
        const div = document.createElement("div");
        div.className = "post";
        div.innerHTML = `
            <div class="avatar">
                <img src="${post.avatar}">
            </div>
            <div class="meta">
                <h5>${post.author}</h5>
                <p>${post.text}</p>
                <div class="reactions">
                    <button class="react-btn" onclick="addLike('${post.id}')">
                        👍 ${post.reacts.like}
                    </button>
                    <button class="react-btn" onclick="addApplause('${post.id}')">
                        👏 ${post.reacts.applause}
                    </button>
                </div>
            </div>
        `;
        feed.appendChild(div);
    });
}
renderFeed();

/* ================== REAÇÕES ================== */
function addLike(id){
    const post = posts.find(p => p.id === id);
    post.reacts.like++;
    save(KEY_POSTS, posts);
    renderFeed();
}

function addApplause(id){
    const post = posts.find(p => p.id === id);
    post.reacts.applause++;
    save(KEY_POSTS, posts);
    renderFeed();
}

/* ================== CRIAR POST ================== */
document.getElementById("btnNewPost").onclick = () =>{
    const text = prompt("Digite seu post:");
    if(!text) return;

    posts.push({
        id: genId(),
        author: "Você",
        avatar: "https://i.imgur.com/WY9Z4Do.jpeg",
        text,
        time: Date.now(),
        reacts:{ like:0, applause:0 }
    });

    save(KEY_POSTS, posts);
    renderFeed();
    addXP(5);
    addNotif("Novo post criado!");
};

/* ================== XP ================== */
function addXP(value){
    xp += value;
    save(KEY_XP, xp);
    document.getElementById("xpCount").innerText = xp + " XP";
    let bar = (xp % 100);
    document.getElementById("xpBar").style.width = bar + "%";
}
addXP(0);

/* ================== NOTIFICAÇÕES ================== */
function addNotif(msg){
    notifications.push({
        id: genId(),
        msg,
        time: Date.now()
    });
    save(KEY_NOTIF, notifications);
    renderNotifications();
}

function renderNotifications(){
    const area = document.getElementById("notifications");
    area.innerHTML = "";

    notifications.slice().reverse().forEach(n =>{
        const div = document.createElement("div");
        div.style.padding = "6px 0";
        div.innerHTML = "• " + n.msg;
        area.appendChild(div);
    });

    const badge = document.getElementById("notifCount");
    badge.innerText = notifications.length;
    badge.style.display = notifications.length > 0 ? "inline-block" : "none";
}
renderNotifications();

document.getElementById("clearNotifs").onclick = () =>{
    notifications = [];
    save(KEY_NOTIF, notifications);
    renderNotifications();
};
