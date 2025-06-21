<?php
session_start();
require_once 'conexao.php';
require_once 'auth.php';

// O header 'Content-Type: application/json' é definido dentro dos cases
// para permitir que o script também sirva imagens diretamente.

$method = $_SERVER['REQUEST_METHOD'];

// Para lidar com atualizações enviadas via formulário POST com um campo de método específico
if ($method === 'POST' && isset($_POST['_method']) && strtoupper($_POST['_method']) === 'PUT') {
    $method = 'PUT';
}

switch ($method) {
    case 'GET':
        header('Content-Type: application/json');
        // RF02: O sistema deve exibir a lista de produtos disponíveis para o cliente com seus respectivos detalhes.
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            // Se a requisição for para buscar a imagem
            if (isset($_GET['get_image']) && $_GET['get_image'] == 'true') {
                $stmt_img = $pdo->prepare("SELECT imagem FROM produtos WHERE id = ?");
                $stmt_img->execute([$id]);
                $imageData = $stmt_img->fetch(PDO::FETCH_ASSOC);

                if ($imageData && !empty($imageData['imagem'])) {
                    // ATENÇÃO: Como não há 'imagem_tipo' no banco, o tipo não pode ser definido dinamicamente.
                    // O navegador pode tentar fazer o download em vez de exibir.
                    // A melhor solução é adicionar uma coluna 'imagem_tipo' (ex: VARCHAR(50)) na sua tabela.
                    header("Content-Type: image/png"); // Definindo um tipo padrão, idealmente isso viria do banco.
                    echo $imageData['imagem'];
                } else {
                    // Servir uma imagem placeholder caso o produto não tenha imagem ou não exista
                    header("Content-Type: image/png");
                    readfile("img/placeholder.png"); // Certifique-se que este arquivo existe
                }
                exit();

            } else {
                // Busca os detalhes do produto (sem a imagem para não sobrecarregar o JSON)
                $stmt = $pdo->prepare("SELECT id, nome, preco, estoque FROM produtos WHERE id = ?");
                $stmt->execute([$id]);
                $product = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($product) {
                    echo json_encode($product);
                } else {
                    http_response_code(404);
                    echo json_encode(['message' => 'Produto não encontrado.']);
                }
            }
        } else {
            // Lista todos os produtos (sem a imagem)
            $stmt = $pdo->query("SELECT id, nome, preco, estoque FROM produtos");
            echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        }
        break;

    case 'POST': // Usado para CRIAR um novo produto
        header('Content-Type: application/json');
        if (!isAdmin()) {
            http_response_code(403);
            echo json_encode(['message' => 'Acesso negado. Apenas administradores podem adicionar produtos.']);
            exit();
        }

        $nome = $_POST['nome'] ?? '';
        $preco = $_POST['preco'] ?? 0;
        $estoque = $_POST['estoque'] ?? 0;
        $imagem = null;

        if (empty($nome) || empty($preco)) {
            http_response_code(400);
            echo json_encode(['message' => 'Nome e preço são obrigatórios.']);
            exit();
        }

        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
            // Validação do tipo de arquivo (MIME type)
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime_type = $finfo->file($_FILES['imagem']['tmp_name']);
            if (!in_array($mime_type, ['image/jpeg', 'image/png', 'image/gif'])) {
                http_response_code(400);
                echo json_encode(['message' => 'Tipo de arquivo não permitido. Apenas JPG, PNG, GIF.']);
                exit();
            }

            // Validação do tamanho do arquivo (MEDIUMBLOB suporta até 16MB)
            if ($_FILES['imagem']['size'] > 16 * 1024 * 1024) {
                 http_response_code(400);
                 echo json_encode(['message' => 'Imagem muito grande. Máximo 16MB.']);
                 exit();
            }

            $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
        }

        try {
            $stmt = $pdo->prepare("INSERT INTO produtos (nome, preco, imagem, estoque) VALUES (?, ?, ?, ?)");
            $stmt->bindParam(1, $nome);
            $stmt->bindParam(2, $preco);
            $stmt->bindParam(3, $imagem, PDO::PARAM_LOB);
            $stmt->bindParam(4, $estoque);
            $stmt->execute();
            echo json_encode(['message' => 'Produto adicionado com sucesso!', 'id' => $pdo->lastInsertId()]);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['message' => 'Erro ao adicionar produto: ' . $e->getMessage()]);
        }
        break;

    case 'PUT': // Usado para ATUALIZAR um produto existente
        header('Content-Type: application/json');
        if (!isAdmin()) {
            http_response_code(403);
            echo json_encode(['message' => 'Acesso negado. Apenas administradores podem editar produtos.']);
            exit();
        }

        // Dados de um PUT com 'multipart/form-data' não estão em $_POST.
        // É por isso que o formulário HTML deve enviar um POST com um campo <input type="hidden" name="_method" value="PUT">.
        // O código no topo do script já trata isso.
        
        $id = $_POST['id'] ?? 0;
        $nome = $_POST['nome'] ?? '';
        $preco = $_POST['preco'] ?? 0;
        $estoque = $_POST['estoque'] ?? 0;

        if (empty($id) || empty($nome) || empty($preco)) {
            http_response_code(400);
            echo json_encode(['message' => 'ID, nome e preço são obrigatórios para edição.']);
            exit();
        }

        try {
            // Verifica se uma nova imagem foi enviada
            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $mime_type = $finfo->file($_FILES['imagem']['tmp_name']);
                if (!in_array($mime_type, ['image/jpeg', 'image/png', 'image/gif'])) {
                    http_response_code(400);
                    echo json_encode(['message' => 'Tipo de arquivo não permitido.']);
                    exit();
                }
                if ($_FILES['imagem']['size'] > 16 * 1024 * 1024) {
                     http_response_code(400);
                     echo json_encode(['message' => 'Imagem muito grande. Máximo 16MB.']);
                     exit();
                }
                $imagem = file_get_contents($_FILES['imagem']['tmp_name']);

                // Atualiza todos os campos, incluindo a imagem
                $stmt = $pdo->prepare("UPDATE produtos SET nome = ?, preco = ?, estoque = ?, imagem = ? WHERE id = ?");
                $stmt->bindParam(1, $nome);
                $stmt->bindParam(2, $preco);
                $stmt->bindParam(3, $estoque);
                $stmt->bindParam(4, $imagem, PDO::PARAM_LOB);
                $stmt->bindParam(5, $id);
            } else {
                // Atualiza os campos, mas mantém a imagem existente
                $stmt = $pdo->prepare("UPDATE produtos SET nome = ?, preco = ?, estoque = ? WHERE id = ?");
                $stmt->bindParam(1, $nome);
                $stmt->bindParam(2, $preco);
                $stmt->bindParam(3, $estoque);
                $stmt->bindParam(4, $id);
            }
            $stmt->execute();
            echo json_encode(['message' => 'Produto atualizado com sucesso!']);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['message' => 'Erro ao atualizar produto: ' . $e->getMessage()]);
        }
        break;


    case 'DELETE':
        header('Content-Type: application/json');
        if (!isAdmin()) {
            http_response_code(403);
            echo json_encode(['message' => 'Acesso negado. Apenas administradores podem excluir produtos.']);
            exit();
        }

        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'] ?? 0;

        if (empty($id)) {
            http_response_code(400);
            echo json_encode(['message' => 'ID do produto é obrigatório para exclusão.']);
            exit();
        }

        try {
            $stmt = $pdo->prepare("DELETE FROM produtos WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode(['message' => 'Produto excluído com sucesso!']);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['message' => 'Erro ao excluir produto: ' . $e->getMessage()]);
        }
        break;

    default:
        header('Content-Type: application/json');
        http_response_code(405);
        echo json_encode(['message' => 'Método não permitido.']);
        break;
}
?>