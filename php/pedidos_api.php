<?php
session_start();
require_once 'conexao.php';
require_once 'auth.php';
require_once 'PedidoRetirada.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Permite listar todos os pedidos
        if (isAdmin()) {
            if (isset($_GET['faturamento'])) {
                // Relatório de faturamento
                $stmt = $pdo->query("SELECT DATE(data_pedido) as data, SUM(total) as faturamento_diario FROM pedidos WHERE status = 'concluido' GROUP BY DATE(data_pedido) ORDER BY data DESC");
                echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
            } else if (isset($_GET['id'])) {
                // Busca um pedido específico com seus itens 
                $pedido_id = $_GET['id'];
                $stmt_pedido = $pdo->prepare("SELECT p.*, u.nome as cliente_nome FROM pedidos p JOIN usuarios u ON p.usuario_id = u.id WHERE p.id = ?");
                $stmt_pedido->execute([$pedido_id]);
                $pedido = $stmt_pedido->fetch(PDO::FETCH_ASSOC);

                if ($pedido) {
                    $stmt_itens = $pdo->prepare("SELECT ip.*, pr.nome as produto_nome FROM itens_pedido ip JOIN produtos pr ON ip.produto_id = pr.id WHERE ip.pedido_id = ?");
                    $stmt_itens->execute([$pedido_id]);
                    $pedido['itens'] = $stmt_itens->fetchAll(PDO::FETCH_ASSOC);
                    echo json_encode($pedido);
                } else {
                    http_response_code(404);
                    echo json_encode(['message' => 'Pedido não encontrado.']);
                }
            } else {
                // Lista todos os pedidos com seus itens
                $stmt_pedidos = $pdo->query("SELECT p.*, u.nome as cliente_nome FROM pedidos p JOIN usuarios u ON p.usuario_id = u.id ORDER BY data_pedido DESC");
                $pedidos = $stmt_pedidos->fetchAll(PDO::FETCH_ASSOC);

                // Para cada pedido, busca e anexa os seus itens
                foreach ($pedidos as &$pedido) { 
                    $stmt_itens = $pdo->prepare("
                        SELECT ip.*, pr.nome as produto_nome 
                        FROM itens_pedido ip 
                        JOIN produtos pr ON ip.produto_id = pr.id 
                        WHERE ip.pedido_id = ?
                    ");
                    $stmt_itens->execute([$pedido['id']]);
                    $pedido['itens'] = $stmt_itens->fetchAll(PDO::FETCH_ASSOC);
                }
                
                echo json_encode($pedidos);
            }
        } else if (isAuthenticated()) {
            // Cliente vê seus próprios pedidos
            try {
                // Busca os pedidos do usuário
                $stmt_pedidos = $pdo->prepare("SELECT * FROM pedidos WHERE usuario_id = ? ORDER BY data_pedido DESC");
                $stmt_pedidos->execute([$_SESSION['user_id']]);
                $pedidos = $stmt_pedidos->fetchAll(PDO::FETCH_ASSOC);

                // Para cada pedido, busca os itens
                foreach ($pedidos as &$pedido) {
                    $stmt_itens = $pdo->prepare("
                        SELECT ip.*, pr.nome as produto_nome 
                        FROM itens_pedido ip 
                        JOIN produtos pr ON ip.produto_id = pr.id 
                        WHERE ip.pedido_id = ?
                    ");
                    $stmt_itens->execute([$pedido['id']]);
                    $pedido['itens'] = $stmt_itens->fetchAll(PDO::FETCH_ASSOC);
                }

                echo json_encode($pedidos);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['message' => 'Erro ao buscar pedidos: ' . $e->getMessage()]);
            }
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Não autorizado. Faça login para ver seus pedidos.']);
        }
        break;
    case 'POST':
        // Verificação de segurança
        if (!isAuthenticated()) {
            http_response_code(401);
            echo json_encode(['message' => 'Não autorizado.']);
            exit();
        }

        $data = json_decode(file_get_contents('php://input'), true);
        $carrinho = $data['carrinho'] ?? [];
        $tipo_entrega = $data['tipo_entrega'] ?? '';

        try {
            // Verifica se o tipo é retirada
            if ($tipo_entrega === 'retirada') {
                // INSTANCIA A NOSSA NOVA CLASSE
                // Passamos o $pdo (vem do conexao.php), o carrinho e o ID do usuário
                $processador = new PedidoRetirada($pdo, $carrinho, $_SESSION['user_id']);
                
                // EXECUTA O PADRÃO TEMPLATE METHOD
                $resultado = $processador->processar();

                echo json_encode([
                    'message' => 'Pedido realizado com sucesso!', 
                    'pedido_id' => $resultado['pedido_id']
                ]);
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Tipo de entrega inválido.']);
            }

        } catch (Exception $e) {
            // Se der erro (estoque, banco, etc), cai aqui
            if (strpos($e->getMessage(), 'Estoque') !== false) {
                http_response_code(400);
            } else {
                http_response_code(500);
            }
            echo json_encode(['message' => 'Erro: ' . $e->getMessage()]);
        }
        break;

    case 'PUT':
        // Permite que o administrador mude o status do pedido
        if (!isAdmin()) {
            http_response_code(403);
            echo json_encode(['message' => 'Acesso negado. Apenas administradores podem atualizar pedidos.']);
            exit();
        }

        $data = json_decode(file_get_contents('php://input'), true);
        $pedido_id = $data['pedido_id'] ?? 0;
        $status = $data['status'] ?? '';

        if (empty($pedido_id) || !in_array($status, ['pendente', 'processando', 'concluido', 'cancelado'])) {
            http_response_code(400);
            echo json_encode(['message' => 'ID do pedido e status válidos são obrigatórios para atualização.']);
            exit();
        }

        try {
            if ($status === 'cancelado') {
                $pdo->beginTransaction();

                $stmt_status = $pdo->prepare("SELECT status FROM pedidos WHERE id = ?");
                $stmt_status->execute([$pedido_id]);
                $status_atual = $stmt_status->fetchColumn();

                if ($status_atual !== 'cancelado') {
                    $stmt_itens = $pdo->prepare("SELECT produto_id, quantidade FROM itens_pedido WHERE pedido_id = ?");
                    $stmt_itens->execute([$pedido_id]);
                    $itens = $stmt_itens->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($itens as $item) {
                        $stmt_restore = $pdo->prepare("UPDATE produtos SET estoque = estoque + ? WHERE id = ?");
                        $stmt_restore->execute([$item['quantidade'], $item['produto_id']]);
                    }
                }
                
                $stmt = $pdo->prepare("UPDATE pedidos SET status = ? WHERE id = ?");
                $stmt->execute([$status, $pedido_id]);
                
                $pdo->commit();

            } else {
                $stmt = $pdo->prepare("UPDATE pedidos SET status = ? WHERE id = ?");
                $stmt->execute([$status, $pedido_id]);
            }

            echo json_encode(['message' => 'Status do pedido atualizado com sucesso!']);
        } catch (PDOException $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            http_response_code(500);
            echo json_encode(['message' => 'Erro ao atualizar status do pedido: ' . $e->getMessage()]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['message' => 'Método não permitido.']);
        break;
}
?>