<?php
require_once 'auth.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$nome = $data['nome'] ?? '';
$email = $data['email'] ?? '';
$senha = $data['senha'] ?? '';

// Se algum dos campos estiver vazio exibe mensagem de erro
if (empty($nome) || empty($email) || empty($senha)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Por favor, preencha todos os campos.']);
    exit();
}

// Validação de registro do usuário
if (registerUser($nome, $email, $senha, $pdo)) {
    echo json_encode(['success' => true, 'message' => 'Cadastro realizado com sucesso!']);
} else {
    http_response_code(409);
    echo json_encode(['success' => false, 'message' => 'Erro ao cadastrar. O email pode já estar em uso.']);
}
