const express = require("express");
const path = require("path");
const mongoose = require("mongoose");
const session = require("express-session");
const MongoStore = require("connect-mongo");
const bodyParser = require("body-parser");

const app = express();

// MIDDLEWARES
app.use(bodyParser.urlencoded({ extended: true }));
app.use(express.static(path.join(__dirname, "public")));

// MONGODB
mongoose.connect("mongodb://localhost:27017/connectati")
  .then(() => console.log("MongoDB conectado!"))
  .catch(err => console.log(err));

// SESSÕES
app.use(
  session({
    secret: "chave-super-secreta",
    resave: false,
    saveUninitialized: false,
    store: MongoStore.create({ mongoUrl: "mongodb://localhost:27017/connectati" }),
  })
);

// MODEL USUÁRIO
const UserSchema = new mongoose.Schema({
  nome: String,
  email: { type: String, unique: true },
  senha: String,
});

const User = mongoose.model("User", UserSchema);

// ROTAS PÁGINAS
app.get("/", (req, res) => res.sendFile(path.join(__dirname, "views/index.html")));
app.get("/trilhas", (req, res) => res.sendFile(path.join(__dirname, "views/trilhas.html")));
app.get("/pratique", (req, res) => res.sendFile(path.join(__dirname, "views/pratique.html")));
app.get("/comunidade", (req, res) => res.sendFile(path.join(__dirname, "views/comunidade.html")));
app.get("/conteudos", (req, res) => res.sendFile(path.join(__dirname, "views/conteudos.html")));
app.get("/contato", (req, res) => res.sendFile(path.join(__dirname, "views/contato.html")));
app.get("/login", (req, res) => res.sendFile(path.join(__dirname, "views/login.html")));
app.get("/cadastro", (req, res) => res.sendFile(path.join(__dirname, "views/cadastro.html")));

// CADASTRO
const bcrypt = require("bcryptjs");

app.post("/cadastro", async (req, res) => {
  const { nome, email, senha } = req.body;

  const senhaHash = await bcrypt.hash(senha, 10);

  try {
    await User.create({ nome, email, senha: senhaHash });
    return res.redirect("/login");
  } catch (err) {
    return res.send("Erro: Email já cadastrado.");
  }
});

// LOGIN
app.post("/login", async (req, res) => {
  const { email, senha } = req.body;

  const usuario = await User.findOne({ email });

  if (!usuario) return res.send("Usuário não encontrado");

  const senhaCorreta = await bcrypt.compare(senha, usuario.senha);

  if (!senhaCorreta) return res.send("Senha incorreta");

  req.session.userId = usuario._id;
  return res.redirect("/painel");
});

// PAINEL DO USUÁRIO
app.get("/painel", (req, res) => {
  if (!req.session.userId) return res.redirect("/login");
  res.send("<h1>Bem-vindo ao seu painel, usuário!</h1>");
});

// SERVIDOR
app.listen(3000, () => console.log("Servidor rodando em http://localhost:3000"));
