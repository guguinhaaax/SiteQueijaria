<?php
require_once 'auth.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'] ?? '';
$senha = $data['senha'] ?? '';

if (loginUser($email, $senha, $pdo)) {
    echo json_encode(['success' => true, 'message' => 'Login realizado com sucesso!', 'is_admin' => isAdmin()]);
} else {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Email ou senha inválidos.']);
}
