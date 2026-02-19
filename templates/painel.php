<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

/* ===============================
   CONEXÃO
================================ */
$conn = new mysqli("localhost", "root", "", "connectti");
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

/* ===============================
   PROTEÇÃO
================================ */
if (!isset($_SESSION['id'], $_SESSION['tipo'])) {
    header("Location: login.php");
    exit;
}

$id   = $_SESSION['id'];
$tipo = $_SESSION['tipo'];

/* ===============================
   BUSCA DADOS
================================ */
if ($tipo === 'aluno') {
    $sql = "SELECT * FROM aluno WHERE id = $id";
} else {
    $sql = "SELECT * FROM docentes WHERE id = $id";
}

$result = $conn->query($sql);
$user = $result->fetch_assoc();

/* ===============================
   FORMAÇÃO ACADÊMICA - DOCENTES
================================ */

// === CURSOS DE TECNOLOGIA ===
$cursos_tecnologia = [
    // BACHARELADOS
    "Ciência da Computação",
    "Sistemas de Informação",
    "Engenharia de Software",
    "Engenharia da Computação",
    "Engenharia de Sistemas",
    "Computação",
    
    // TECNÓLOGOS
    "Análise e Desenvolvimento de Sistemas",
    "Gestão da Tecnologia da Informação",
    "Banco de Dados",
    "Redes de Computadores",
    "Segurança da Informação",
    "Defesa Cibernética",
    "Jogos Digitais",
    "Sistemas para Internet",
    "Desenvolvimento Web",
    "Desenvolvimento Mobile",
    "Computação em Nuvem",
    "Big Data",
    "Inteligência Artificial",
    "Internet das Coisas",
    "DevOps",
    "Ciência de Dados",
    
    // ÁREAS MODERNAS
    "Engenharia de Dados",
    "Machine Learning",
    "Cibersegurança",
    "Cloud Computing",
    "Arquitetura de Software",
    "Robótica",
    "Automação",
    
    // GESTÃO
    "Governança de TI",
    "Gestão de Projetos de TI",
    
    // LICENCIATURAS
    "Licenciatura em Computação",
    
    // OUTROS
    "Tecnologia da Informação",
    "Sistemas Computacionais"
];

sort($cursos_tecnologia);

// ============================================
// ✅ INSTITUIÇÕES DE TI - FOCO PERNAMBUCO
// ============================================
$instituicoes_ensino = [

    // ===== 🟢 PERNAMBUCO - TI (DESTAQUE) =====
    "CIn/UFPE - Centro de Informática da UFPE",
    "CESAR School - Centro de Estudos e Sistemas Avançados",
    "UPE - Universidade de Pernambuco (Tecnologia)",
    "IFPE - Campus Recife (Tecnologia em TI)",
    "IF Sertão - Campus Petrolina (Tecnologia)",
    "ETE Porto Digital - Escola Técnica Estadual",
    "UNICAP - Ciência da Computação",
    "UNINASSAU - Tecnologia da Informação",
    "UNINABUCO - Análise e Desenvolvimento",
    "FBV - Ciência da Computação",
    "FICR - Sistemas de Informação",
    "FATEC-PE - Faculdade de Tecnologia",
    "Armazém da Criatividade - Caruaru",
    "UFRPE - Bacharelado em Computação",
    "UNIVASF - Engenharia de Computação",
    "UFAPE - Ciência da Computação",
    "FACOL - Sistemas para Internet",
    "FADIRE - Tecnologia em Redes",
    "ETE Cícero Dias - Informática",
    "ETE Jurandir Bezerra - Desenvolvimento",
    "ETE Luiz Alves - Redes",
    "ETE Professor Lucilo - TI",
    
    // ===== 🟢 NORDESTE - TI =====
    "UFC - Computação (Campus Quixadá)",
    "UFRN - IMD (Instituto Metrópole Digital)",
    "UFBA - Ciência da Computação",
    "UFPB - Informática",
    "UFAL - Computação",
    "UFS - Ciência da Computação",
    "UEPB - Computação",
    "UNIFOR - Ciência da Computação",
    
    // ===== 🟢 SUDESTE - TI =====
    "USP - ICMC (São Carlos)",
    "UNICAMP - Instituto de Computação",
    "UFMG - DCC",
    "UFRJ - Engenharia da Computação",
    "ITA - Engenharia da Computação",
    "IME - Engenharia da Computação",
    "UFSCar - Computação",
    "UNESP - Rio Claro (Computação)",
    
    // ===== 🟢 SUL - TI =====
    "UFRGS - Informática",
    "UFSC - CTC",
    "UFPR - Informática",
    "PUC-RS - Computação",
    
    // ===== 🟢 PRIVADAS DESTAQUE - TI =====
    "FIAP - Tecnologia",
    "Impacta - Tecnologia",
    "Mackenzie - Computação",
    "PUC-SP - Tecnologia",
    "PUC-Rio - Informática",
    "INSPER - Engenharia da Computação",
    "FEI - Engenharia da Computação",
    "SENAI - Tecnologia da Informação",
    "SENAC - TI",
    "FATEC - Tecnologia em TI",
    "ETEC - Informática",
    "IFSP - Computação",
    
    // ===== 🌍 INTERNACIONAIS - TI =====
    "MIT - Computer Science",
    "Stanford - Computer Science",
    "Harvard - Computer Science",
    "Carnegie Mellon - Computer Science",
    "Caltech - Computer Science",
    "UC Berkeley - Computer Science",
    "Georgia Tech - Computing",
    "Cambridge - Computer Science",
    "Oxford - Computer Science",
    "Imperial College - Computing",
    "UCL - Computer Science",
    "ETH Zurich - Computer Science",
    "EPFL - Computer Science",
    "TU Munich - Informatics",
    "University of Toronto - CS",
    "University of Waterloo - CS",
    "UBC - Computer Science",
    "McGill - Computer Science",
    "University of Washington - CS",
    "University of Illinois - CS",
    "University of Texas - CS",
    "University of Michigan - CS"
];

sort($instituicoes_ensino);

// Níveis de formação
$niveis_formacao = [
    'tecnico' => 'Curso Técnico',
    'graduacao' => 'Graduação',
    'tecnologo' => 'Tecnólogo',
    'pos_graduacao' => 'Pós-graduação',
    'mba' => 'MBA'
];

// Status da formação
$status_formacao = [
    'em_andamento' => 'Em andamento',
    'concluida' => 'Concluída',
    'trancada' => 'Trancada'
];

/* ===============================
   CONFIGURAÇÕES DE UPLOAD
================================ */
$uploadDir = '../img/perfis/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
$maxFileSize = 2 * 1024 * 1024;

/* ===============================
   SALVAR PERFIL
================================ */
$msg = '';
$erro = '';

if (isset($_POST['salvar_perfil'])) {
    $foto = $user['foto'];
    
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['foto'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        if (!in_array($fileExt, $allowedTypes)) {
            $erro = "Tipo de arquivo não permitido. Use JPG, PNG, GIF ou WebP.";
        } elseif ($fileSize > $maxFileSize) {
            $erro = "Arquivo muito grande. Máximo 2MB.";
        } else {
            $newFileName = 'perfil_' . $id . '_' . time() . '.' . $fileExt;
            $fileDestination = $uploadDir . $newFileName;
            
            if (move_uploaded_file($fileTmpName, $fileDestination)) {
                if (!empty($user['foto']) && file_exists('../' . $user['foto']) && 
                    strpos($user['foto'], 'perfil_') !== false) {
                    unlink('../' . $user['foto']);
                }
                
                $foto = 'img/perfis/' . $newFileName;
                $_SESSION['foto'] = $foto;
            } else {
                $erro = "Erro ao fazer upload da foto.";
            }
        }
    }
    
    if (empty($erro)) {
        if ($tipo === 'aluno') {
            $nome  = $conn->real_escape_string(trim($_POST['nome']));
            $email = $conn->real_escape_string(trim($_POST['email']));
            $data  = $conn->real_escape_string($_POST['data_nascimento'] ?? '');

            $sql = "UPDATE aluno SET nome = '$nome', email = '$email', data_nascimento = '$data', foto = '$foto' WHERE id = $id";

            $_SESSION['nome']  = $nome;
            $_SESSION['email'] = $email;

        } else {
            $nome        = $conn->real_escape_string(trim($_POST['nome_completo']));
            $email       = $conn->real_escape_string(trim($_POST['email_profissional']));
            $formacao    = $conn->real_escape_string(trim($_POST['formacao_academica'] ?? ''));
            $instituicao = $conn->real_escape_string(trim($_POST['instituicao_ensino'] ?? ''));

            $sql = "UPDATE docentes SET 
                    nome_completo = '$nome', 
                    email_profissional = '$email', 
                    formacao_academica = '$formacao', 
                    instituicao = '$instituicao', 
                    foto = '$foto' 
                    WHERE id = $id";

            $_SESSION['nome']  = $nome;
            $_SESSION['email'] = $email;
        }

        if ($conn->query($sql)) {
            $msg = "Perfil atualizado com sucesso!";
            $result = $conn->query("SELECT * FROM " . ($tipo === 'aluno' ? 'aluno' : 'docentes') . " WHERE id = $id");
            $user = $result->fetch_assoc();
        } else {
            $erro = "Erro ao atualizar perfil: " . $conn->error;
        }
    }
}

/* ===============================
   ALTERAR SENHA
================================ */
if (isset($_POST['alterar_senha'])) {
    $senhaAtual = $_POST['senha_atual'];
    $novaSenha  = $_POST['nova_senha'];

    if (password_verify($senhaAtual, $user['senha'])) {
        $hash = password_hash($novaSenha, PASSWORD_DEFAULT);

        if ($tipo === 'aluno') {
            $sql = "UPDATE aluno SET senha='$hash' WHERE id=$id";
        } else {
            $sql = "UPDATE docentes SET senha='$hash' WHERE id=$id";
        }

        if ($conn->query($sql)) {
            $msg = "Senha alterada com sucesso!";
        } else {
            $erro = "Erro ao alterar senha.";
        }
    } else {
        $erro = "Senha atual incorreta!";
    }
}

// Caminho para exibir a foto
$default_photo = '../img/perfis/default.png';
$foto_url = !empty($user['foto']) && file_exists('../' . $user['foto']) ? '../' . $user['foto'] : $default_photo;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil - ConnectTI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #7209b7;
            --success: #06d6a0;
            --danger: #ef476f;
            --warning: #ffd166;
            --light: #f8f9fa;
            --dark: #212529;
            --border: #dee2e6;
        }
        
        body {
            background: linear-gradient(145deg, #f6f9fc 0%, #edf2f9 100%);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        
        .card {
            border: none;
            border-radius: 24px;
            box-shadow: 0 20px 35px -8px rgba(0,0,0,0.07);
            transition: all 0.2s;
        }
        
        .profile-photo-wrapper {
            position: relative;
            width: 140px;
            height: 140px;
            margin: 0 auto;
        }
        
        .profile-photo {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }
        
        .profile-photo-edit {
            position: absolute;
            bottom: 5px;
            right: 5px;
            width: 38px;
            height: 38px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: 3px solid white;
            transition: all 0.2s;
        }
        
        .profile-photo-edit:hover {
            background: var(--primary-dark);
            transform: scale(1.05);
        }
        
        /* ===== POPUP DE SUGESTÕES ===== */
        .suggestions-popup {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            max-height: 350px;
            overflow-y: auto;
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 16px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.12);
            z-index: 9999;
            margin-top: 6px;
            display: none;
        }
        
        .suggestions-popup.show {
            display: block;
            animation: fadeInUp 0.2s ease;
        }
        
        .suggestion-item {
            padding: 12px 18px;
            cursor: pointer;
            border-bottom: 1px solid #f1f3f5;
            transition: all 0.15s;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
        }
        
        .suggestion-item:last-child {
            border-bottom: none;
        }
        
        .suggestion-item:hover {
            background: #f0f7ff;
            color: var(--primary);
        }
        
        .suggestion-item i {
            margin-right: 12px;
            color: var(--primary);
            font-size: 1.1rem;
        }
        
        .suggestion-highlight {
            font-weight: 600;
            color: var(--primary);
        }
        
        .suggestion-category {
            font-size: 0.75rem;
            color: #6c757d;
            margin-left: 8px;
            background: #e9ecef;
            padding: 2px 8px;
            border-radius: 20px;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .autocomplete-container {
            position: relative;
            width: 100%;
        }
        
        .clear-suggestion {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #adb5bd;
            display: none;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 5;
            padding: 6px;
            border-radius: 50%;
        }
        
        .clear-suggestion:hover {
            background: #f1f3f5;
            color: var(--danger);
        }
        
        .input-group {
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid #e9ecef;
            transition: all 0.2s;
        }
        
        .input-group:focus-within {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
        }
        
        .input-group-text {
            border: none;
            background: #f8f9fa;
            padding: 0 18px;
        }
        
        .form-control {
            border: none;
            padding: 0.75rem 1rem;
            font-size: 1rem;
        }
        
        .form-control:focus {
            box-shadow: none;
        }
        
        .btn {
            border-radius: 40px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            transition: all 0.2s;
        }
        
        .btn-primary {
            background: var(--primary);
            border: none;
        }
        
        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(67, 97, 238, 0.3);
        }
        
        .modal-content {
            border-radius: 24px;
            border: none;
        }
        
        .badge {
            padding: 0.5rem 1.2rem;
            border-radius: 40px;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                <div class="card">
                    <!-- Header -->
                    <div class="card-header bg-white py-4 px-4 border-0">
                        <div class="d-flex align-items-center">
                            <a href="index.php" class="btn btn-light rounded-circle p-2 me-3 shadow-sm">
                                <i class="ri-arrow-left-line"></i>
                            </a>
                            <div>
                                <h4 class="fw-bold mb-1">Editar Perfil</h4>
                                <p class="text-muted mb-0 small">Atualize suas informações acadêmicas</p>
                            </div>
                            <span class="badge bg-<?= $tipo === 'aluno' ? 'primary' : 'success' ?>-subtle text-<?= $tipo === 'aluno' ? 'primary' : 'success' ?> ms-auto">
                                <i class="ri-<?= $tipo === 'aluno' ? 'user' : 'graduation-cap' ?>-line me-1"></i>
                                <?= $tipo === 'aluno' ? 'Aluno' : 'Professor' ?>
                            </span>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <!-- Alertas -->
                        <?php if($msg): ?>
                        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                            <i class="ri-checkbox-circle-fill me-2 fs-5"></i>
                            <span><?= htmlspecialchars($msg) ?></span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php endif; ?>

                        <?php if($erro): ?>
                        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                            <i class="ri-error-warning-fill me-2 fs-5"></i>
                            <span><?= htmlspecialchars($erro) ?></span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php endif; ?>

                        <form method="post" enctype="multipart/form-data">
                            <!-- Foto -->
                            <div class="text-center mb-5">
                                <div class="profile-photo-wrapper">
                                    <img src="<?= htmlspecialchars($foto_url) ?>" id="profilePreview" class="rounded-circle profile-photo">
                                    <label for="foto" class="profile-photo-edit">
                                        <i class="ri-camera-fill"></i>
                                    </label>
                                    <input type="file" id="foto" name="foto" accept="image/*" class="d-none">
                                </div>
                                <p class="text-muted small mt-3">Clique no ícone para alterar sua foto</p>
                            </div>

                            <?php if ($tipo === 'aluno'): ?>
                            <!-- ALUNO -->
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Nome completo</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="ri-user-line"></i></span>
                                        <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($user['nome']) ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">E-mail</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="ri-mail-line"></i></span>
                                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Data de nascimento</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="ri-calendar-line"></i></span>
                                        <input type="date" name="data_nascimento" class="form-control" value="<?= htmlspecialchars($user['data_nascimento']) ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Matrícula</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="ri-id-card-line"></i></span>
                                        <input type="text" class="form-control bg-light" value="<?= htmlspecialchars($user['matricula'] ?? '') ?>" disabled>
                                    </div>
                                </div>
                            </div>

                            <?php else: ?>
                            <!-- PROFESSOR - CURSOS E INSTITUIÇÕES -->
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Nome completo</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="ri-user-line"></i></span>
                                        <input type="text" name="nome_completo" class="form-control" value="<?= htmlspecialchars($user['nome_completo']) ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">E-mail profissional</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="ri-mail-line"></i></span>
                                        <input type="email" name="email_profissional" class="form-control" value="<?= htmlspecialchars($user['email_profissional']) ?>" required>
                                    </div>
                                </div>

                                <!-- CAMPO 1: FORMAÇÃO ACADÊMICA -->
                                <div class="col-12">
                                    <label class="form-label fw-medium">
                                        <i class="ri-graduation-cap-line text-primary me-1"></i>
                                        Formação Acadêmica
                                    </label>
                                    <div class="autocomplete-container">
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text"><i class="ri-cpu-line"></i></span>
                                            <input type="text" 
                                                   name="formacao_academica" 
                                                   class="form-control" 
                                                   id="cursoInput"
                                                   value="<?= htmlspecialchars($user['formacao_academica'] ?? '') ?>"
                                                   placeholder="Digite sua formação (ex: Ciência da Computação)"
                                                   autocomplete="off">
                                            <button type="button" class="clear-suggestion" id="clearCurso" style="display: none;">
                                                <i class="ri-close-line"></i>
                                            </button>
                                        </div>
                                        
                                        <!-- POPUP CURSOS -->
                                        <div class="suggestions-popup" id="cursoPopup">
                                            <div class="suggestion-item disabled text-muted">
                                                <i class="ri-search-line"></i>
                                                <span>Digite para buscar cursos de tecnologia</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- CAMPO 2: INSTITUIÇÃO DE ENSINO (CORRIGIDO) -->
                                <div class="col-12">
                                    <label class="form-label fw-medium">
                                        <i class="ri-building-line text-primary me-1"></i>
                                        Instituição de Ensino
                                    </label>
                                    <div class="autocomplete-container">
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text"><i class="ri-community-line"></i></span>
                                            <input type="text" 
                                                   name="instituicao_ensino" 
                                                   class="form-control" 
                                                   id="instituicaoInput"
                                                   value="<?= htmlspecialchars($user['instituicao'] ?? '') ?>"
                                                   placeholder="Digite o nome da instituição"
                                                   autocomplete="off">
                                            <button type="button" class="clear-suggestion" id="clearInstituicao" style="display: none;">
                                                <i class="ri-close-line"></i>
                                            </button>
                                        </div>
                                        
                                        <!-- POPUP INSTITUIÇÕES (COM FOCO EM PE) -->
                                        <div class="suggestions-popup" id="instituicaoPopup">
                                            <div class="suggestion-item disabled text-muted">
                                                <i class="ri-search-line"></i>
                                                <span>Digite para buscar instituições de TI</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-text mt-2">
                                        <i class="ri-information-line text-primary me-1"></i>
                                        <strong>Dica:</strong> Instituições de Pernambuco em destaque
                                    </div>
                                </div>

                                <!-- CAMPOS INFORMATIVOS -->
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Registro acadêmico</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="ri-fingerprint-line"></i></span>
                                        <input type="text" class="form-control bg-light" 
                                               value="<?= htmlspecialchars($user['registro_academico'] ?? 'Não informado') ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Membro desde</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                        <input type="text" class="form-control bg-light" 
                                               value="<?= isset($user['data_cadastro']) ? date('d/m/Y', strtotime($user['data_cadastro'])) : '' ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>

                            <!-- BOTÕES -->
                            <div class="d-flex gap-3 mt-5 pt-4 border-top">
                                <button type="submit" name="salvar_perfil" class="btn btn-primary btn-lg px-5 flex-grow-1">
                                    <i class="ri-save-line me-2"></i>Salvar alterações
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-lg px-4" data-bs-toggle="modal" data-bs-target="#senhaModal">
                                    <i class="ri-key-2-line me-2"></i>Senha
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Senha -->
    <div class="modal fade" id="senhaModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold"><i class="ri-key-2-line me-2 text-primary"></i>Alterar senha</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="post">
                    <input type="hidden" name="alterar_senha">
                    <div class="modal-body py-4">
                        <div class="mb-4">
                            <label class="form-label fw-medium">Senha atual</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="ri-lock-line"></i></span>
                                <input type="password" name="senha_atual" class="form-control" required>
                                <button type="button" class="btn btn-light toggle-password" data-target="senha_atual">
                                    <i class="ri-eye-line"></i>
                                </button>
                            </div>
                        </div>
                        <div>
                            <label class="form-label fw-medium">Nova senha</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="ri-key-line"></i></span>
                                <input type="password" name="nova_senha" class="form-control" required minlength="6">
                                <button type="button" class="btn btn-light toggle-password" data-target="nova_senha">
                                    <i class="ri-eye-line"></i>
                                </button>
                            </div>
                            <div class="form-text mt-2">Mínimo de 6 caracteres</div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary px-4">Alterar senha</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ============================================
        // LISTAS COMPLETAS
        // ============================================
        const cursosTI = <?= json_encode($cursos_tecnologia) ?>;
        const instituicoesTI = <?= json_encode($instituicoes_ensino) ?>;

        // ============================================
        // FUNÇÃO GENÉRICA DE AUTOCOMPLETE
        // ============================================
        function setupAutocomplete(inputId, popupId, clearBtnId, dataList, placeholderText) {
            const input = document.getElementById(inputId);
            const popup = document.getElementById(popupId);
            const clearBtn = document.getElementById(clearBtnId);
            
            if (!input || !popup) return;

            // Mostrar todas as opções
            function mostrarTodas() {
                let html = `<div class="suggestion-item" style="background: #f0f7ff; border-bottom: 2px solid #e2e8f0;">
                            <i class="ri-${inputId.includes('curso') ? 'cpu' : 'building'}-line"></i>
                            <span class="fw-bold">Todas as opções (${dataList.length})</span>
                            <span class="suggestion-category">TI</span>
                        </div>`;
                
                dataList.forEach(item => {
                    html += `<div class="suggestion-item" onclick="selecionarItem('${inputId}', '${popupId}', '${clearBtnId}', '${item.replace(/'/g, "\\'")}')">
                            <i class="ri-${inputId.includes('curso') ? 'cpu' : 'building'}-line"></i>
                            <span>${item}</span>
                        </div>`;
                });
                
                popup.innerHTML = html;
                popup.classList.add('show');
            }

            // Filtrar itens
            function filtrarItens(termo) {
                termo = termo.toLowerCase();
                
                if (termo.length < 2) {
                    popup.classList.remove('show');
                    return;
                }
                
                const filtrados = dataList.filter(item => 
                    item.toLowerCase().includes(termo)
                );
                
                if (filtrados.length === 0) {
                    popup.innerHTML = `<div class="suggestion-item disabled text-muted">
                                        <i class="ri-error-warning-line"></i>
                                        <span>Nenhum resultado para "${termo}"</span>
                                    </div>`;
                    popup.classList.add('show');
                    return;
                }
                
                let html = `<div class="suggestion-item" style="background: #f8f9fa;">
                            <i class="ri-search-line"></i>
                            <span>Resultados (${filtrados.length})</span>
                        </div>`;
                
                filtrados.slice(0, 15).forEach(item => {
                    const regex = new RegExp(`(${termo})`, 'gi');
                    const textoDestacado = item.replace(regex, '<span class="suggestion-highlight">$1</span>');
                    
                    html += `<div class="suggestion-item" onclick="selecionarItem('${inputId}', '${popupId}', '${clearBtnId}', '${item.replace(/'/g, "\\'")}')">
                            <i class="ri-${inputId.includes('curso') ? 'cpu' : 'building'}-line"></i>
                            <span>${textoDestacado}</span>
                        </div>`;
                });
                
                popup.innerHTML = html;
                popup.classList.add('show');
            }

            // Eventos
            input.addEventListener('input', function() {
                const valor = this.value.trim();
                filtrarItens(valor);
                if (clearBtn) {
                    clearBtn.style.display = valor.length > 0 ? 'flex' : 'none';
                }
            });

            input.addEventListener('focus', function() {
                const valor = this.value.trim();
                if (valor.length === 0) {
                    mostrarTodas();
                } else if (valor.length >= 2) {
                    filtrarItens(valor);
                }
            });

            input.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    popup.classList.remove('show');
                }
            });

            if (clearBtn) {
                clearBtn.addEventListener('click', function() {
                    input.value = '';
                    this.style.display = 'none';
                    popup.classList.remove('show');
                    input.focus();
                });
                
                if (input.value.length > 0) {
                    clearBtn.style.display = 'flex';
                }
            }

            // Fechar ao clicar fora
            document.addEventListener('click', function(e) {
                if (!input.contains(e.target) && !popup.contains(e.target)) {
                    popup.classList.remove('show');
                }
            });
        }

        // Função global para selecionar item
        window.selecionarItem = function(inputId, popupId, clearBtnId, valor) {
            const input = document.getElementById(inputId);
            const popup = document.getElementById(popupId);
            const clearBtn = document.getElementById(clearBtnId);
            
            if (input) {
                input.value = valor;
                popup.classList.remove('show');
                if (clearBtn) {
                    clearBtn.style.display = 'flex';
                }
                input.dispatchEvent(new Event('change', { bubbles: true }));
            }
        };

        // ============================================
        // INICIALIZAR AUTOCOMPLETES
        // ============================================
        document.addEventListener('DOMContentLoaded', function() {
            // Autocomplete para cursos
            setupAutocomplete('cursoInput', 'cursoPopup', 'clearCurso', cursosTI);
            
            // Autocomplete para instituições (CORRIGIDO)
            setupAutocomplete('instituicaoInput', 'instituicaoPopup', 'clearInstituicao', instituicoesTI);
            
            // Preview de foto
            const fotoInput = document.getElementById('foto');
            const profilePreview = document.getElementById('profilePreview');
            
            if (fotoInput && profilePreview) {
                fotoInput.addEventListener('change', function(e) {
                    if (this.files && this.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            profilePreview.src = e.target.result;
                        }
                        reader.readAsDataURL(this.files[0]);
                    }
                });
            }
            
            // Toggle senha
            document.querySelectorAll('.toggle-password').forEach(btn => {
                btn.addEventListener('click', function() {
                    const target = this.dataset.target;
                    const input = document.querySelector(`input[name="${target}"]`);
                    const icon = this.querySelector('i');
                    
                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('ri-eye-line');
                        icon.classList.add('ri-eye-off-line');
                    } else {
                        input.type = 'password';
                        icon.classList.remove('ri-eye-off-line');
                        icon.classList.add('ri-eye-line');
                    }
                });
            });
        });
    </script>
</body>
</html>
<?php
$conn->close();
?>