<?php
session_start();
require_once 'auth.php';

header('Content-Type: application/json');

$response = [
    'isAuthenticated' => isAuthenticated(),
    'isAdmin' => isAdmin()
];

// Se estiver autenticado, retorna mais dados para sincronização
if ($response['isAuthenticated']) {
    $response['user_id'] = $_SESSION['user_id'];
    $response['user_name'] = $_SESSION['user_name'];
    $response['is_admin'] = $_SESSION['is_admin'];
}

echo json_encode($response);