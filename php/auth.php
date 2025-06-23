<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'conexao.php';

// Registra o usuário
function registerUser($nome, $email, $senha, $pdo) {
    // Usando bcrypt para fazer criptografia da senha
    $hashed_password = password_hash($senha, PASSWORD_BCRYPT);
    try {
        //Inserção no banco de dados
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
        $stmt->execute([$nome, $email, $hashed_password]);
        return true;
    //Tratamento de erros
    } catch (PDOException $e) {
        return false;
    }
}

// Login do usuário com consulta no BD para verificação de senha
function loginUser($email, $senha, $pdo) {
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nome'];
        $_SESSION['is_admin'] = $user['is_admin'];
        return true;
    }
    return false;
}

// Limpando variáveis de sessão e destroindo dados associados a sessão atual
function logoutUser() {
    session_unset();
    session_destroy();
}


function isAdmin() {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
}

function isAuthenticated() {
    return isset($_SESSION['user_id']);
}
