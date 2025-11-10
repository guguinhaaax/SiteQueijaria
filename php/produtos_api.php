<?php
// Substitua 'db_connect.php' pelo seu script de conexão ao banco de dados real
require 'conexao.php'; 
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

// Lógica para simular PUT via POST, pois formulários HTML não suportam PUT nativamente com multipart/form-data
if ($method === 'POST' && isset($_POST['_method']) && strtoupper($_POST['_method']) === 'PUT') {
    $method = 'PUT';
}

switch ($method) {
    case 'GET':
        // ALTERAÇÃO: Adicionado 'unidade_medida' na consulta SELECT
        $stmt = $pdo->query('SELECT id, nome, preco, unidade_medida, estoque, imagem FROM produtos ORDER BY nome ASC');
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($products);
        break;

    case 'POST':
        // ALTERAÇÃO: Captura 'unidade_medida' do formulário
        $nome = $_POST['nome'] ?? '';
        $preco = $_POST['preco'] ?? 0;
        $unidade_medida = $_POST['unidade_medida'] ?? 'unidade'; // Captura o novo campo
        $estoque = $_POST['estoque'] ?? 0;
        $imagem_path = null;

        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
            
            // --- INÍCIO DA CORREÇÃO DE SEGURANÇA (ALVO 2) ---
            $imageFileType = strtolower(pathinfo($_FILES["imagem"]["name"], PATHINFO_EXTENSION));
            $tmp_name = $_FILES["imagem"]["tmp_name"];

            // 1. Validação da Extensão (Lista de permissões)
            $allowed_extensions = ['jpg', 'jpeg', 'png'];
            if (!in_array($imageFileType, $allowed_extensions)) {
                http_response_code(400);
                echo json_encode(['message' => 'Erro: Apenas arquivos JPG, JPEG e PNG são permitidos.']);
                exit;
            }

            // 2. Validação do Tipo MIME (Verificação real do tipo de arquivo)
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime_type = $finfo->file($tmp_name);
            $allowed_mime_types = ['image/jpeg', 'image/png'];

            if (!in_array($mime_type, $allowed_mime_types)) {
                http_response_code(400);
                echo json_encode(['message' => 'Erro: Tipo de arquivo inválido detectado.']);
                exit;
            }

            $target_dir = "uploads/";
            // Garante que o diretório de destino exista
            if (!is_dir('../' . $target_dir)) {
                mkdir('../' . $target_dir, 0777, true);
            }
            $target_file = $target_dir . uniqid() . '.' . $imageFileType;
            if (move_uploaded_file($tmp_name, '../' . $target_file)) {
                 $imagem_path = $target_file;
            }
        }
        
        // ALTERAÇÃO: Adicionado 'unidade_medida' e seu placeholder na query INSERT
        $sql = "INSERT INTO produtos (nome, preco, unidade_medida, estoque, imagem) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$nome, $preco, $unidade_medida, $estoque, $imagem_path])) {
            http_response_code(201); // 201 Created é mais apropriado para POST
            echo json_encode(['message' => 'Produto adicionado com sucesso!']);
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'Erro ao adicionar produto.']);
        }
        break;

    case 'PUT':
        // Para PUT, os dados vêm de $_POST por causa da simulação com FormData
        $data = $_POST;

        $id = $data['id'] ?? null;
        $nome = $data['nome'] ?? '';
        $preco = $data['preco'] ?? 0;
        $unidade_medida = $data['unidade_medida'] ?? 'unidade'; // Captura o novo campo para atualização
        $estoque = $data['estoque'] ?? 0;

        if (!$id) {
            http_response_code(400);
            echo json_encode(['message' => 'ID do produto não fornecido.']);
            exit;
        }
        
        // Busca a imagem atual para não perdê-la se nenhuma nova for enviada
        $stmt_img = $pdo->prepare("SELECT imagem FROM produtos WHERE id = ?");
        $stmt_img->execute([$id]);
        $imagem_path = $stmt_img->fetchColumn();

        // Lógica para atualizar a imagem, se uma nova for enviada
        // Lógica para atualizar a imagem, se uma nova for enviada
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
            
            // --- INÍCIO DA CORREÇÃO DE SEGURANÇA (ALVO 2) ---
            $imageFileType = strtolower(pathinfo($_FILES["imagem"]["name"], PATHINFO_EXTENSION));
            $tmp_name = $_FILES["imagem"]["tmp_name"];

            // 1. Validação da Extensão (Lista de permissões)
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($imageFileType, $allowed_extensions)) {
                http_response_code(400);
                echo json_encode(['message' => 'Erro: Apenas arquivos JPG, JPEG, PNG e GIF são permitidos.']);
                exit;
            }

            // 2. Validação do Tipo MIME (Verificação real do tipo de arquivo)
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime_type = $finfo->file($tmp_name);
            $allowed_mime_types = ['image/jpeg', 'image/png', 'image/gif'];

            if (!in_array($mime_type, $allowed_mime_types)) {
                http_response_code(400);
                echo json_encode(['message' => 'Erro: Tipo de arquivo inválido detectado.']);
                exit;
            }
            // --- FIM DA CORREÇÃO DE SEGURANÇA ---
            
            // (Opcional: deletar a imagem antiga do servidor aqui)
            $target_dir = "uploads/";
            if (!is_dir('../' . $target_dir)) {
                mkdir('../' . $target_dir, 0777, true);
            }
            $target_file = $target_dir . uniqid() . '.' . $imageFileType;
            if (move_uploaded_file($tmp_name, '../' . $target_file)) {
                 $imagem_path = $target_file;
            }
        }
        
        // ALTERAÇÃO: Adicionado 'unidade_medida = ?' na query UPDATE
        $sql = "UPDATE produtos SET nome = ?, preco = ?, unidade_medida = ?, estoque = ?, imagem = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute([$nome, $preco, $unidade_medida, $estoque, $imagem_path, $id])) {
            echo json_encode(['message' => 'Produto atualizado com sucesso!']);
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'Erro ao atualizar produto.']);
        }
        break;

    case 'DELETE':
        // Nenhuma alteração necessária para o DELETE
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'] ?? null;

        if ($id) {
            // (Opcional: aqui você também pode adicionar lógica para deletar o arquivo de imagem do servidor)
            $sql = "DELETE FROM produtos WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$id])) {
                echo json_encode(['message' => 'Produto removido com sucesso!']);
            } else {
                http_response_code(500);
                echo json_encode(['message' => 'Erro ao remover produto.']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'ID do produto não fornecido.']);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['message' => 'Método não permitido']);
        break;
}
?>