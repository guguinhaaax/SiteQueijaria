<?php
// Salve como: php/PedidoRetirada.php

// Importa a classe mãe que criamos acima
require_once 'ProcessadorPedido.php'; 

class PedidoRetirada extends ProcessadorPedido {

    protected function getTipoEntrega() {
        return 'retirada';
    }

    protected function calcularTaxas() {
        return 0; // Retirada não tem custo extra
    }
}
?>