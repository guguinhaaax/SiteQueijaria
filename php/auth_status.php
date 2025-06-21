<?php
session_start();
require_once 'auth.php';

header('Content-Type: application/json');

echo json_encode([
    'isAuthenticated' => isAuthenticated(),
    'isAdmin' => isAdmin()
]);

