<?php
session_start();
require_once 'conexao.php';
require_once 'auth.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST' && isset($_POST['_method']) && strtoupper($_POST['_method']) === 'PUT') {
    $method = 'PUT';
}

switch ($method) {
    case 'GET':
        header('Content-Type: application/json');
        
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $stmt = $pdo->prepare("SELECT id, nome, preco, estoque, imagem FROM produtos WHERE id = ?");
            $stmt->execute([$id]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($product) {
                echo json_encode($product);
            } else {
                http_response_code(404);
                echo json_encode(['message' => 'Produto não encontrado.']);
            }
        } else {
            $stmt = $pdo->query("SELECT id, nome, preco, estoque, imagem FROM produtos");
            echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        }
        break;

    case 'POST': // Criar um novo produto
        header('Content-Type: application/json');
        if (!isAdmin()) {
            http_response_code(403);
            echo json_encode(['message' => 'Acesso negado. Apenas administradores podem adicionar produtos.']);
            exit();
        }

        $nome = $_POST['nome'] ?? '';
        $preco = $_POST['preco'] ?? 0;
        $estoque = $_POST['estoque'] ?? 0;
        $imagem_path = null;

        if (empty($nome) || empty($preco)) {
            http_response_code(400);
            echo json_encode(['message' => 'Nome e preço são obrigatórios.']);
            exit();
        }

        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
            $target_dir = "../images/produtos/";
            // Verifica se o diretório existe e é gravável
            if (!is_dir($target_dir) && !mkdir($target_dir, 0777, true)) {
                 http_response_code(500);
                 echo json_encode(['message' => 'Erro: A pasta de imagens não pode ser criada ou não tem permissão de escrita.']);
                 exit();
            }

            $imageFileType = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
            $newFileName = uniqid() . '.' . $imageFileType;
            $target_file = $target_dir . $newFileName;

            if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
                $imagem_path = 'images/produtos/' . $newFileName;
            } else {
                http_response_code(500);
                echo json_encode(['message' => 'Erro ao fazer upload da imagem.']);
                exit();
            }
        }

        try {
            $stmt = $pdo->prepare("INSERT INTO produtos (nome, preco, imagem, estoque) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nome, $preco, $imagem_path, $estoque]);
            echo json_encode(['message' => 'Produto adicionado com sucesso!', 'id' => $pdo->lastInsertId()]);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['message' => 'Erro ao adicionar produto: ' . $e->getMessage()]);
        }
        break;

    case 'PUT': // Usado para atualizar um produto existente
        header('Content-Type: application/json');
        if (!isAdmin()) {
            http_response_code(403);
            echo json_encode(['message' => 'Acesso negado. Apenas administradores podem editar produtos.']);
            exit();
        }
        
        $id = $_POST['id'] ?? 0;
        $nome = $_POST['nome'] ?? '';
        $preco = $_POST['preco'] ?? 0;
        $estoque = $_POST['estoque'] ?? 0;
        $imagem_path = null;

        if (empty($id) || empty($nome) || empty($preco)) {
            http_response_code(400);
            echo json_encode(['message' => 'ID, nome e preço são obrigatórios para edição.']);
            exit();
        }
        
        try {
            $stmt_old_img = $pdo->prepare("SELECT imagem FROM produtos WHERE id = ?");
            $stmt_old_img->execute([$id]);
            $old_image_path = $stmt_old_img->fetchColumn();

            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
                $target_dir = "../images/produtos/";
                $imageFileType = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
                $newFileName = uniqid() . '.' . $imageFileType;
                $target_file = $target_dir . $newFileName;

                if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
                    if ($old_image_path && file_exists("../" . $old_image_path)) {
                        unlink("../" . $old_image_path);
                    }
                    $imagem_path = 'images/produtos/' . $newFileName;
                }
            } else {
                $imagem_path = $old_image_path;
            }

            $stmt = $pdo->prepare("UPDATE produtos SET nome = ?, preco = ?, estoque = ?, imagem = ? WHERE id = ?");
            $stmt->execute([$nome, $preco, $estoque, $imagem_path, $id]);
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
            $stmt_img = $pdo->prepare("SELECT imagem FROM produtos WHERE id = ?");
            $stmt_img->execute([$id]);
            $imagem_path = $stmt_img->fetchColumn();
            
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("DELETE FROM produtos WHERE id = ?");
            $stmt->execute([$id]);
            
            if ($stmt->rowCount() > 0) {
                if ($imagem_path && file_exists("../" . $imagem_path)) {
                    unlink("../" . $imagem_path);
                }
                $pdo->commit();
                echo json_encode(['message' => 'Produto excluído com sucesso!']);
            } else {
                $pdo->rollBack();
                http_response_code(404);
                echo json_encode(['message' => 'Produto não encontrado.']);
            }
        } catch (PDOException $e) {
            $pdo->rollBack();
            http_response_code(500);
            echo json_encode(['message' => 'O produto está em um pedido.']);
        }
        break;

    default:
        header('Content-Type: application/json');
        http_response_code(405);
        echo json_encode(['message' => 'Método não permitido.']);
        break;
}
?>