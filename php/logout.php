<?php
require_once 'auth.php';

// A função logoutUser já inicia a sessão se necessário
logoutUser();

// Em vez de redirecionar, retorna uma resposta JSON
header('Content-Type: application/json');
echo json_encode(['success' => true, 'message' => 'Sessão encerrada com sucesso!']);
exit();