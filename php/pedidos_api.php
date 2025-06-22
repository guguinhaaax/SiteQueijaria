<?php
session_start();
require_once 'conexao.php';
require_once 'auth.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // RF05: O sistema deve permitir ao administrador visualizar relatórios de faturamento.
        // Permite listar todos os pedidos (admin) ou pedidos do usuário logado (cliente)
        if (isAdmin()) {
            if (isset($_GET['faturamento'])) {
                // RF05: Relatório de faturamento
                $stmt = $pdo->query("SELECT DATE(data_pedido) as data, SUM(total) as faturamento_diario FROM pedidos WHERE status = 'concluido' GROUP BY DATE(data_pedido) ORDER BY data DESC");
                echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
            } else if (isset($_GET['id'])) {
                // Busca um pedido específico com seus itens (para admin ver detalhes)
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
                // --- INÍCIO DA CORREÇÃO ---
                // O bloco anterior foi substituído para garantir que os itens sejam incluídos
                // na lista de todos os pedidos para o administrador.
                
                // Lista todos os pedidos (PARA O ADMIN) com seus itens
                $stmt_pedidos = $pdo->query("SELECT p.*, u.nome as cliente_nome FROM pedidos p JOIN usuarios u ON p.usuario_id = u.id ORDER BY data_pedido DESC");
                $pedidos = $stmt_pedidos->fetchAll(PDO::FETCH_ASSOC);

                // Para cada pedido, busca e anexa os seus itens
                foreach ($pedidos as &$pedido) { // O "&" é importante para modificar o array original
                    $stmt_itens = $pdo->prepare("
                        SELECT ip.*, pr.nome as produto_nome 
                        FROM itens_pedido ip 
                        JOIN produtos pr ON ip.produto_id = pr.id 
                        WHERE ip.pedido_id = ?
                    ");
                    $stmt_itens->execute([$pedido['id']]);
                    $pedido['itens'] = $stmt_itens->fetchAll(PDO::FETCH_ASSOC);
                }
                
                // Agora a resposta para o admin terá a mesma estrutura da resposta para o cliente
                echo json_encode($pedidos);
                // --- FIM DA CORREÇÃO ---
            }
        } else if (isAuthenticated()) {
            // Cliente vê apenas seus próprios pedidos COM OS ITENS INCLUSOS (esta parte já estava correta)
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

    // O restante do arquivo (case 'POST', case 'PUT', etc.) permanece o mesmo
    // ...
    // ... (cole o restante do seu código PHP aqui) ...
    // ...
    case 'POST':
        // RF03: O cliente deve poder adicionar produtos ao carrinho e realizar pedidos.
        // RF04: O sistema deve permitir ao cliente selecionar entre retirada no local ou entrega.
        if (!isAuthenticated()) {
            http_response_code(401);
            echo json_encode(['message' => 'Não autorizado. Faça login para realizar um pedido.']);
            exit();
        }

        $data = json_decode(file_get_contents('php://input'), true);
        $carrinho = $data['carrinho'] ?? []; // Array de {produto_id, quantidade}
        
        $tipo_entrega = $data['tipo_entrega'] ?? '';

        if (empty($carrinho) || !is_array($carrinho)) {
            http_response_code(400);
            echo json_encode(['message' => 'Dados do pedido inválidos. O carrinho está vazio ou em formato incorreto.']);
            exit();
        }
        
        if (!in_array($tipo_entrega, ['retirada', 'mototaxi'])) {
            http_response_code(400);
            echo json_encode(['message' => "Tipo de entrega inválido. Valores permitidos: 'retirada', 'mototaxi'."]);
            exit();
        }

        $pdo->beginTransaction();
        try {
            $total_pedido = 0;
            $itens_para_inserir = [];

            $stmt_produto = $pdo->prepare("SELECT preco, estoque FROM produtos WHERE id = ? FOR UPDATE");
            $stmt_update_estoque = $pdo->prepare("UPDATE produtos SET estoque = estoque - ? WHERE id = ?");

            foreach ($carrinho as $item) {
                if (!isset($item['produto_id']) || !isset($item['quantidade']) || !is_numeric($item['quantidade']) || $item['quantidade'] <= 0) {
                    throw new Exception('Item do carrinho inválido.');
                }
                
                $produto_id = $item['produto_id'];
                $quantidade = $item['quantidade'];

                $stmt_produto->execute([$produto_id]);
                $produto = $stmt_produto->fetch();

                if (!$produto || $produto['estoque'] < $quantidade) {
                    throw new Exception('Estoque insuficiente para o produto ID ' . $produto_id);
                }

                $total_item = $produto['preco'] * $quantidade;
                $total_pedido += $total_item;
                $itens_para_inserir[] = [
                    'produto_id' => $produto_id,
                    'quantidade' => $quantidade,
                    'preco_unitario' => $produto['preco']
                ];

                $stmt_update_estoque->execute([$quantidade, $produto_id]);
            }

            $stmt = $pdo->prepare("INSERT INTO pedidos (usuario_id, tipo_entrega, total) VALUES (?, ?, ?)");
            $stmt->execute([$_SESSION['user_id'], $tipo_entrega, $total_pedido]);
            $pedido_id = $pdo->lastInsertId();

            $stmt_itens = $pdo->prepare("INSERT INTO itens_pedido (pedido_id, produto_id, quantidade, preco_unitario) VALUES (?, ?, ?, ?)");
            foreach ($itens_para_inserir as $item) {
                $stmt_itens->execute([$pedido_id, $item['produto_id'], $item['quantidade'], $item['preco_unitario']]);
            }

            $pdo->commit();
            error_log("Novo pedido realizado! ID do Pedido: " . $pedido_id . " por usuário ID: " . $_SESSION['user_id']);

            echo json_encode(['message' => 'Pedido realizado com sucesso!', 'pedido_id' => $pedido_id]);

        } catch (Exception $e) {
            $pdo->rollBack();
            if (strpos($e->getMessage(), 'Estoque insuficiente') !== false) {
                http_response_code(400);
            } else {
                http_response_code(500);
            }
            echo json_encode(['message' => 'Erro ao realizar pedido: ' . $e->getMessage()]);
        }
        break;

    case 'PUT':
        // Permitir que o administrador mude o status do pedido
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