/**
 * CLASSE PRODUCTCOMPOSITE
 * Representa um kit ou pacote que contém outros produtos (Leafs ou outros Composites)
 * Pode formar estruturas hierárquicas complexas
 */
class ProductComposite extends ProductComponent {
    /**
     * Construtor do kit/composite
     * @param {string} id - ID do kit
     * @param {string} nome - Nome do kit
     * @param {string} descricao - Descrição do kit
     * @param {number} desconto - Percentual de desconto (0-100)
     */
    constructor(id, nome, descricao, desconto = 0) {
        // Preço inicial é 0, será calculado baseado nos componentes filhos
        super(id, nome, 0);
        this.descricao = descricao;
        this.desconto = desconto;
        this.children = []; // Array para armazenar os componentes filhos
        this.quantidade = 1; // Quantidade padrão no carrinho
    }

    /**
     * Adiciona um componente filho ao composite (kit)
     * @param {ProductComponent} product - Componente a ser adicionado
     * @returns {ProductComposite} Retorna this para method chaining
     */
    add(product) {
        this.children.push(product);
        return this; // Permite method chaining: kit.add(p1).add(p2)
    }

    /**
     * Remove um componente filho do composite
     * @param {ProductComponent} product - Componente a ser removido
     * @returns {ProductComposite} Retorna this para method chaining
     */
    remove(product) {
        const index = this.children.indexOf(product);
        if (index > -1) {
            this.children.splice(index, 1);
        }
        return this;
    }

    /**
     * Calcula o preço total do kit aplicando desconto
     * Soma os preços de todos os filhos e aplica o desconto
     * @returns {number} Preço total do kit com desconto
     */
    getPrice() {
        // Soma os preços de todos os componentes filhos
        const subtotal = this.children.reduce((total, child) => {
            return total + child.getPrice();
        }, 0);
        
        // Aplica o desconto percentual
        const precoComDesconto = subtotal * (1 - this.desconto / 100);
        
        // Multiplica pela quantidade no carrinho
        return precoComDesconto * this.quantidade;
    }

    /**
     * Retorna detalhes completos do kit incluindo seus componentes
     * @returns {object} Objeto com todos os detalhes do kit
     */
    showDetails() {
        return {
            id: this.id,
            nome: this.nome,
            descricao: this.descricao,
            preco: this.getPrice(), // Preço já calculado com desconto
            desconto: this.desconto,
            produtos: this.children.map(child => child.showDetails()), // Detalhes dos filhos
            tipo: 'kit', // Identifica que é um kit composto
            quantidade: this.quantidade
        };
    }

    /**
     * Define a quantidade do kit no carrinho
     * Propaga a quantidade para os componentes filhos se necessário
     * @param {number} quantidade - Nova quantidade
     */
    setQuantity(quantidade) {
        this.quantidade = quantidade;
        // Propaga a quantidade para os filhos (cada filho recebe a mesma quantidade)
        this.children.forEach(child => {
            if (child.setQuantity) {
                child.setQuantity(quantidade);
            }
        });
    }

    /**
     * Indica que este componente é um composite (kit)
     * @returns {boolean} Sempre true para esta classe
     */
    isComposite() {
        return true;
    }

    /**
     * Calcula o estoque disponível do kit
     * O estoque do kit é determinado pelo produto com menor estoque
     * @returns {number} Estoque disponível do kit
     */
    getStock() {
        if (this.children.length === 0) return 0;
        
        // Encontra o menor estoque entre todos os componentes filhos
        return Math.min(...this.children.map(child => child.getStock()));
    }
}