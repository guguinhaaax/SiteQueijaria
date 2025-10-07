/**
 * CLASSE CARTMANAGER
 * Gerencia o carrinho de compras usando o padrão Composite
 * Trata produtos individuais e kits de forma uniforme
 */
class CartManager {
    constructor() {
        // Carrega o carrinho do localStorage ou inicia vazio
        this.items = JSON.parse(localStorage.getItem('carrinho')) || [];
    }

    /**
     * Adiciona um componente (produto ou kit) ao carrinho
     * @param {ProductComponent} productComponent - Componente a ser adicionado
     * @param {number} quantidade - Quantidade a adicionar
     * @returns {CartManager} Retorna this para method chaining
     * @throws {Error} Se não há estoque disponível
     */
    addItem(productComponent, quantidade = 1) {
        // Verifica se o item já existe no carrinho
        const existingItemIndex = this.items.findIndex(item => item.id == productComponent.id);
        
        if (existingItemIndex > -1) {
            // Item já existe, atualiza a quantidade
            const maxStock = productComponent.getStock();
            const newQuantity = this.items[existingItemIndex].quantidade + quantidade;
            
            if (newQuantity <= maxStock) {
                this.items[existingItemIndex].quantidade = newQuantity;
            } else {
                throw new Error(`Quantidade máxima para ${productComponent.nome} é ${maxStock}.`);
            }
        } else {
            // Item novo, verifica se tem estoque
            if (productComponent.getStock() > 0) {
                // Obtém os detalhes do componente usando o método do Composite
                const itemData = productComponent.showDetails();
                itemData.quantidade = quantidade;
                itemData.estoque_disponivel = productComponent.getStock();
                this.items.push(itemData);
            } else {
                throw new Error(`${productComponent.nome} está fora de estoque.`);
            }
        }
        
        // Salva no localStorage e notifica os listeners
        this.saveToLocalStorage();
        return this;
    }

    /**
     * Remove um item do carrinho
     * @param {string} productId - ID do produto/kit a remover
     * @returns {CartManager} Retorna this para method chaining
     */
    removeItem(productId) {
        this.items = this.items.filter(item => item.id != productId);
        this.saveToLocalStorage();
        return this;
    }

    /**
     * Atualiza a quantidade de um item no carrinho
     * @param {string} productId - ID do produto/kit
     * @param {number} newQuantity - Nova quantidade
     * @returns {CartManager} Retorna this para method chaining
     */
    updateQuantity(productId, newQuantity) {
        const itemIndex = this.items.findIndex(item => item.id == productId);
        if (itemIndex > -1) {
            const maxAllowed = this.items[itemIndex].estoque_disponivel;
            // Garante que a quantidade fique entre 1 e o estoque máximo
            this.items[itemIndex].quantidade = Math.min(Math.max(1, newQuantity), maxAllowed);
            this.saveToLocalStorage();
        }
        return this;
    }

    /**
     * Calcula o total do carrinho
     * @returns {number} Valor total do carrinho
     */
    getTotal() {
        return this.items.reduce((total, item) => {
            return total + (item.preco * item.quantidade);
        }, 0);
    }

    /**
     * Retorna todos os itens do carrinho
     * @returns {Array} Array de itens do carrinho
     */
    getItems() {
        return this.items;
    }

    /**
     * Limpa todo o carrinho
     * @returns {CartManager} Retorna this para method chaining
     */
    clear() {
        this.items = [];
        this.saveToLocalStorage();
        return this;
    }

    /**
     * Salva o carrinho no localStorage e dispara evento de atualização
     * @private
     */
    saveToLocalStorage() {
        localStorage.setItem('carrinho', JSON.stringify(this.items));
        // Dispara evento customizado para notificar outros componentes
        document.dispatchEvent(new CustomEvent('cartUpdated'));
    }

    /**
     * Calcula o número total de itens (somando quantidades)
     * @returns {number} Total de itens no carrinho
     */
    getTotalItemsCount() {
        return this.items.reduce((sum, item) => sum + item.quantidade, 0);
    }
}