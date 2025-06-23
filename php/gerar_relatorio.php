<?php
session_start();
require_once 'conexao.php';
require_once 'auth.php';

// Checa se é admin
if (!isAdmin()) {
    http_response_code(403);
    die("Acesso negado. Apenas administradores podem gerar relatórios.");
}

try {
    // Busca de pedidos
    $stmt_pedidos = $pdo->query("SELECT p.*, u.nome as cliente_nome FROM pedidos p JOIN usuarios u ON p.usuario_id = u.id ORDER BY p.id DESC");
    $pedidos = $stmt_pedidos->fetchAll(PDO::FETCH_ASSOC);

    // Define o nome do arquivo que será baixado
    $filename = "relatorio_pedidos_" . date('Y-m-d') . ".txt";

    // Prepara o cabeçalho do arquivo de texto
    $fileContent .= "     Relatório de Pedidos - Laticínio Esperança\n";
    $fileContent .= "Gerado em: " . date('d/m/Y H:i:s') . "\n\n";

    // Verifica se existem pedidos
    if (empty($pedidos)) {
        $fileContent .= "Nenhum pedido encontrado no sistema.";
    } else {
        // Itera sobre cada pedido e o adiciona ao conteúdo do arquivo
        foreach ($pedidos as $pedido) {
            $fileContent .= "Pedido ID:      " . $pedido['id'] . "\n";
            $fileContent .= "Cliente:        " . $pedido['cliente_nome'] . "\n";
            $fileContent .= "Data do Pedido: " . date('d/m/Y H:i', strtotime($pedido['data_pedido'])) . "\n";
            $fileContent .= "Status:         " . ucfirst($pedido['status']) . "\n"; // ucfirst deixa a primeira letra maiúscula
            $fileContent .= "Valor Total:    R$ " . number_format($pedido['total'], 2, ',', '.') . "\n";
            $fileContent .= "----------------------------------------------------------\n";
        }
    }

    header('Content-Type: text/plain; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    
    // Envia o conteúdo do arquivo para o navegador onde se inicia o download
    echo $fileContent;
    exit();

} catch (PDOException $e) {
    http_response_code(500);
    die("Erro ao conectar ao banco de dados e gerar o relatório: " . $e->getMessage());
}
?>