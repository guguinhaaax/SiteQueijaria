<?php
require_once 'auth.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'] ?? '';
$senha = $data['senha'] ?? '';

if (loginUser($email, $senha, $pdo)) {
    // Obter dados completos do usuário
    $stmt = $pdo->prepare("SELECT id, nome, is_admin FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    echo json_encode([
        'success' => true,
        'message' => 'Login realizado com sucesso!',
        'user_id' => $user['id'],
        'is_admin' => (bool)$user['is_admin'],
        'user_name' => $user['nome']
    ]);
} else {
    http_response_code(401);
    echo json_encode([
        'success' => false,
        'message' => 'Email ou senha inválidos.'
    ]);
}