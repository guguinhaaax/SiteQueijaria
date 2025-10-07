/**
 * CLASSE KITMANAGER
 * Factory para criar kits pré-definidos usando o padrão Composite
 * Centraliza a criação de combinações de produtos
 */
class KitManager {
    /**
     * Cria um kit especial para festas
     * @returns {ProductComposite} Kit festa composto por 3 produtos
     */
    static criarKitFesta() {
        // Cria o composite (kit) com 10% de desconto
        const kit = new ProductComposite('kit-001', 'Kit Festa', 'Kit completo para festas com queijos selecionados', 10);
        
        // Adiciona produtos individuais (Leafs) ao kit
        kit.add(new ProductLeaf('1', 'Queijo Mussarela', 25.00, 50));
        kit.add(new ProductLeaf('2', 'Queijo Prato', 28.00, 40));
        kit.add(new ProductLeaf('3', 'Requeijão Cremoso', 12.00, 30));
        
        return kit;
    }

    /**
     * Cria um kit de degustação para novos clientes
     * @returns {ProductComposite} Kit degustação com 15% de desconto
     */
    static criarKitDegustacao() {
        const kit = new ProductComposite('kit-002', 'Kit Degustação', 'Para experimentar a variedade dos nossos sabores', 15);
        
        kit.add(new ProductLeaf('1', 'Queijo Mussarela', 25.00, 50));
        kit.add(new ProductLeaf('4', 'Queijo Coalho', 18.00, 35));
        kit.add(new ProductLeaf('5', 'Manteiga da Terra', 8.00, 25));
        
        return kit;
    }

    /**
     * Cria um kit premium com produtos especiais
     * @returns {ProductComposite} Kit premium com maior desconto
     */
    static criarKitPremium() {
        const kit = new ProductComposite('kit-003', 'Kit Premium', 'Nossos melhores produtos com desconto especial', 20);
        
        kit.add(new ProductLeaf('2', 'Queijo Prato Especial', 35.00, 20));
        kit.add(new ProductLeaf('6', 'Queijo Brie', 45.00, 15));
        kit.add(new ProductLeaf('3', 'Requeijão Premium', 18.00, 25));
        
        return kit;
    }
}