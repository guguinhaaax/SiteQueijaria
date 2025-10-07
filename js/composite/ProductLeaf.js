/**
 * CLASSE PRODUCTLEAF
 * Representa um produto individual (folha na árvore do Composite)
 * Não contém outros componentes, é o elemento final
 */
class ProductLeaf extends ProductComponent {
    /**
     * Construtor do produto individual
     * @param {string} id - ID do produto
     * @param {string} nome - Nome do produto
     * @param {number} preco - Preço unitário
     * @param {number} estoque - Quantidade em estoque
     * @param {string} imagem - URL da imagem (opcional)
     */
    constructor(id, nome, preco, estoque, imagem = null) {
        // Chama o construtor da classe pai (ProductComponent)
        super(id, nome, preco);
        this.estoque = estoque;
        this.imagem = imagem;
        this.quantidade = 1; // Quantidade padrão no carrinho
    }

    /**
     * Retorna os detalhes completos do produto para exibição
     * @returns {object} Objeto com todos os detalhes do produto
     */
    showDetails() {
        return {
            id: this.id,
            nome: this.nome,
            preco: this.preco,
            estoque: this.estoque,
            imagem: this.imagem,
            tipo: 'produto' // Identifica que é um produto individual
        };
    }

    /**
     * Define a quantidade do produto no carrinho
     * @param {number} quantidade - Nova quantidade
     */
    setQuantity(quantidade) {
        this.quantidade = quantidade;
    }

    /**
     * Calcula o preço total considerando a quantidade
     * @returns {number} Preço total (preço unitário × quantidade)
     */
    getPrice() {
        return this.preco * this.quantidade;
    }
}