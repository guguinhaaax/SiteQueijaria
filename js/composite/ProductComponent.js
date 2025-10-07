/**
 * CLASSE ABSTRATA PRODUCTCOMPONENT
 * Interface comum para todos os componentes do padrão Composite
 * Define os métodos que tanto Leaf quanto Composite devem implementar
 */
class ProductComponent {
    /**
     * Construtor base para todos os componentes de produto
     * @param {string} id - Identificador único do produto/kit
     * @param {string} nome - Nome do produto/kit
     * @param {number} preco - Preço base do produto/kit
     */
    constructor(id, nome, preco) {
        this.id = id;
        this.nome = nome;
        this.preco = preco;
    }

    /**
     * Método para obter o preço do componente
     * Será implementado diferentemente em Leaf e Composite
     * @returns {number} Preço do componente
     */
    getPrice() {
        return this.preco;
    }

    /**
     * Obtém o nome do componente
     * @returns {string} Nome do produto/kit
     */
    getName() {
        return this.nome;
    }

    /**
     * Obtém o ID do componente
     * @returns {string} ID único
     */
    getId() {
        return this.id;
    }

    /**
     * Obtém o estoque disponível
     * @returns {number} Quantidade em estoque
     */
    getStock() {
        return this.estoque || 0;
    }

    /**
     * MÉTODO ABSTRATO - Deve ser implementado pelas subclasses
     * Retorna os detalhes do componente para exibição
     * @throws {Error} Se não for implementado pela subclass
     */
    showDetails() {
        throw new Error("Método showDetails deve ser implementado pelas subclasses");
    }

    /**
     * Verifica se o componente é composto (Composite) ou individual (Leaf)
     * @returns {boolean} True se for Composite, False se for Leaf
     */
    isComposite() {
        return false;
    }
}