<?php
require_once 'auth.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$nome = $data['nome'] ?? '';
$email = $data['email'] ?? '';
$senha = $data['senha'] ?? '';

if (empty($nome) || empty($email) || empty($senha)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Por favor, preencha todos os campos.']);
    exit();
}

if (registerUser($nome, $email, $senha, $pdo)) {
    echo json_encode(['success' => true, 'message' => 'Cadastro realizado com sucesso!']);
} else {
    http_response_code(409); // Conflict
    echo json_encode(['success' => false, 'message' => 'Erro ao cadastrar. O email pode já estar em uso.']);
}
