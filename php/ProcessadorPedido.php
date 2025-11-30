<?php
// Salve como: php/ProcessadorPedido.php

abstract class ProcessadorPedido {
    protected $pdo;
    protected $carrinho;
    protected $userId;
    protected $totalPedido = 0;
    protected $itensParaInserir = [];

    public function __construct($pdo, $carrinho, $userId) {
        $this->pdo = $pdo;
        $this->carrinho = $carrinho;
        $this->userId = $userId;
    }

    // --- TEMPLATE METHOD (O fluxo principal) ---
    public final function processar() {
        try {
            $this->pdo->beginTransaction();

            $this->validarCarrinho();
            $this->verificarEstoque(); 
            
            // Passos que as subclasses definem
            $taxa = $this->calcularTaxas(); 
            $this->totalPedido += $taxa;
            $tipo = $this->getTipoEntrega();

            $pedidoId = $this->salvarPedido($tipo);
            $this->salvarItens($pedidoId);

            $this->pdo->commit();
            return ['pedido_id' => $pedidoId];

        } catch (Exception $e) {
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }
            throw $e;
        }
    }

    // --- MÉTODOS COMUNS ---
    private function validarCarrinho() {
        if (empty($this->carrinho) || !is_array($this->carrinho)) {
            throw new Exception('Carrinho vazio ou inválido.');
        }
    }

    private function verificarEstoque() {
        $stmt_produto = $this->pdo->prepare("SELECT preco, estoque FROM produtos WHERE id = ? FOR UPDATE");
        $stmt_update = $this->pdo->prepare("UPDATE produtos SET estoque = estoque - ? WHERE id = ?");

        foreach ($this->carrinho as $item) {
            $id = $item['produto_id'];
            $qtd = $item['quantidade'];

            if ($qtd <= 0) throw new Exception('Quantidade inválida.');

            $stmt_produto->execute([$id]);
            $prod = $stmt_produto->fetch();

            if (!$prod || $prod['estoque'] < $qtd) {
                throw new Exception("Estoque insuficiente para o produto ID $id");
            }

            $this->totalPedido += $prod['preco'] * $qtd;
            
            $this->itensParaInserir[] = [
                'id' => $id, 'qtd' => $qtd, 'preco' => $prod['preco']
            ];

            $stmt_update->execute([$qtd, $id]);
        }
    }

    private function salvarPedido($tipo) {
        $stmt = $this->pdo->prepare("INSERT INTO pedidos (usuario_id, tipo_entrega, total) VALUES (?, ?, ?)");
        $stmt->execute([$this->userId, $tipo, $this->totalPedido]);
        return $this->pdo->lastInsertId();
    }

    private function salvarItens($pedidoId) {
        $stmt = $this->pdo->prepare("INSERT INTO itens_pedido (pedido_id, produto_id, quantidade, preco_unitario) VALUES (?, ?, ?, ?)");
        foreach ($this->itensParaInserir as $item) {
            $stmt->execute([$pedidoId, $item['id'], $item['qtd'], $item['preco']]);
        }
    }

    // --- MÉTODOS ABSTRATOS (Obrigatórios nas filhas) ---
    abstract protected function getTipoEntrega();
    abstract protected function calcularTaxas();
}
?>