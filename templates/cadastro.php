<?php

// ================================
// CURSOS DE TECNOLOGIA
// ================================
$cursos_tecnologia = [
    "Ciência da Computação",
    "Sistemas de Informação",
    "Engenharia de Software",
    "Engenharia da Computação",
    "Análise e Desenvolvimento de Sistemas",
    "Banco de Dados",
    "Redes de Computadores",
    "Segurança da Informação",
    "Inteligência Artificial",
    "Ciência de Dados",
    "DevOps",
    "Cloud Computing",
    "Arquitetura de Software",
    "Tecnologia da Informação",
    "Sistemas Computacionais"
];

sort($cursos_tecnologia);

// ================================
// INSTITUIÇÕES
// ================================
$instituicoes_ensino = [
    "CIn/UFPE - Centro de Informática da UFPE",
    "CESAR School - Centro de Estudos e Sistemas Avançados",
    "UPE - Universidade de Pernambuco",
    "IFPE - Campus Recife",
    "UNICAP - Ciência da Computação",
    "UNINASSAU - Tecnologia da Informação",
    "FICR - Sistemas de Informação",
    "USP - ICMC",
    "UNICAMP - Instituto de Computação",
    "UFMG - DCC",
    "MIT - Computer Science",
    "Stanford - Computer Science"
];

sort($instituicoes_ensino);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - ConnectTI</title>

    <link rel="icon" type="image/png" href="../img/Logo ConnectTI.png">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="../styles/cadastro.css">
    <style>
    .autocomplete-container{
        position:relative;
    }

    .suggestions-popup{
        position:absolute;
        width:100%;
        background:#fff;
        border:1px solid #ddd;
        border-radius:8px;
        max-height:250px;
        overflow-y:auto;
        display:none;
        z-index:999;
    }

    .suggestion-item{
        padding:10px;
        cursor:pointer;
    }

    .suggestion-item:hover{
        background:#f1f5ff;
    }
    </style>
</head>

<body class="bg-light">

<div class="container mt-5 col-md-4">
    <h3 class="text-center mb-4">Criar Conta</h3>

    <form action="../Backend.php" method="POST" class="card p-4 shadow">

        <!-- ALUNO -->
        <div id="alunoFields">
            <input type="text" name="nome" class="form-control mb-3" placeholder="Seu nome">
            <input type="email" name="email" class="form-control mb-3" placeholder="Seu e-mail">
            <input type="password" name="senha_aluno" class="form-control mb-3" placeholder="Senha">
            <input type="date" name="data_nascimento" class="form-control mb-3">
        </div>

        <!-- DOCENTE CHECK -->
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="docenteCheck" name="docente">
            <label class="form-check-label fw-semibold">Você é docente?</label>
        </div>

        <!-- DOCENTE -->
        <div id="docenteFields" style="display:none;">
            <hr>

            <input type="text" name="nome_completo" class="form-control mb-3" placeholder="Nome completo">
            <input type="password" name="senha_docente" class="form-control mb-3" placeholder="Senha">
            <input type="email" name="email_profissional" id="emailProfissional" class="form-control mb-3" placeholder="E-mail profissional">
            <input type="text" name="registro" id="registro" class="form-control mb-3" placeholder="Registro acadêmico">

            <!-- FORMAÇÃO -->
            <div class="autocomplete-container mb-3">
                <input type="text"
                    name="formacao"
                    id="cursoInput"
                    class="form-control"
                    placeholder="Selecione sua formação"
                    autocomplete="off">

                <div class="suggestions-popup" id="cursoPopup"></div>
            </div>

            <!-- INSTITUIÇÃO -->
            <div class="autocomplete-container mb-3">
                <input type="text"
                    name="instituicao"
                    id="instituicaoInput"
                    class="form-control"
                    placeholder="Selecione a instituição"
                    autocomplete="off">

                <div class="suggestions-popup" id="instituicaoPopup"></div>
            </div>
        </div>

        <button class="btn btn-primary w-100 mt-2">Cadastrar</button>
    </form>

    <p class="text-center mt-3">
        Já tem conta? <a href="login.php">Entrar</a>
    </p>
</div>

<script src="../scripts/cadastro.js"></script>
<script>
    const cursosTI = <?= json_encode($cursos_tecnologia) ?>;
    const instituicoesTI = <?= json_encode($instituicoes_ensino) ?>;

    function setupAutocomplete(inputId, popupId, dataList){

        const input = document.getElementById(inputId);
        const popup = document.getElementById(popupId);

        function mostrar(lista){
            popup.innerHTML = "";

            lista.forEach(item=>{
                const div = document.createElement("div");
                div.className = "suggestion-item";
                div.textContent = item;

                div.onclick = ()=>{
                    input.value = item;
                    popup.style.display = "none";
                };

                popup.appendChild(div);
            });

            popup.style.display = "block";
        }

        input.addEventListener("input", ()=>{
            const termo = input.value.toLowerCase();

            const filtrados = dataList.filter(item =>
                item.toLowerCase().includes(termo)
            );

            if(termo.length === 0){
                mostrar(dataList);
            }else{
                mostrar(filtrados);
            }
        });

        input.addEventListener("focus", ()=> mostrar(dataList));

        document.addEventListener("click", e=>{
            if(!input.contains(e.target) && !popup.contains(e.target)){
                popup.style.display = "none";
            }
        });
    }

    // iniciar
    setupAutocomplete("cursoInput","cursoPopup", cursosTI);
    setupAutocomplete("instituicaoInput","instituicaoPopup", instituicoesTI);
</script>
</body>
</html>