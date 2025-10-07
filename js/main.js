/**
 * ARQUIVO PRINCIPAL DA APLICAÇÃO
 * Gerencia autenticação, carrinho e interface do usuário
 * Agora integrado com o padrão Composite para o carrinho
 */
document.addEventListener('DOMContentLoaded', function() {
    // Referências aos elementos de navegação do DOM
    const navLogin = document.getElementById('nav-login');
    const navCadastro = document.getElementById('nav-cadastro');
    const navConta = document.getElementById('nav-conta');
    const navAdmin = document.getElementById('nav-admin');
    const navLogout = document.getElementById('nav-logout');
    const cartLink = document.getElementById('cart-link');
    const cartCountDisplay = document.querySelector('.cart-count-display');

    /**
     * FUNÇÃO DE NOTIFICAÇÃO
     * Exibe mensagens temporárias para o usuário
     * @param {string} message - Mensagem a ser exibida
     * @param {string} type - Tipo da notificação ('success', 'error', etc.)
     */
    window.showNotification = function(message, type = 'success') {
        const container = document.getElementById('notification-container');
        if (!container) return;

        // Cria elemento da notificação
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.textContent = message;

        // Adiciona ao container
        container.appendChild(notification);

        // Animação de entrada
        setTimeout(() => {
            notification.classList.add('show');
        }, 10);

        // Remove após 3 segundos
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                if (container.contains(notification)) {
                    container.removeChild(notification);
                }
            }, 500);
        }, 3000);
    }

    /**
     * ATUALIZA CONTADOR DO CARRINHO (USANDO COMPOSITE)
     * Agora usa o CartManager para obter o total de itens
     * Funciona tanto para produtos individuais quanto kits
     */
    function updateCartCount() {
        try {
            // Usa o CartManager para obter o total de itens
            const cartManager = new CartManager();
            const totalItems = cartManager.getTotalItemsCount();
            
            if (cartCountDisplay) {
                if (totalItems > 0) {
                    cartCountDisplay.textContent = totalItems;
                    cartCountDisplay.style.display = 'inline-block';
                } else {
                    cartCountDisplay.style.display = 'none';
                }
            }
        } catch (error) {
            console.error('Erro ao atualizar contador do carrinho:', error);
            // Fallback para o método antigo se houver erro
            let carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
            const totalItems = carrinho.reduce((sum, item) => sum + item.quantidade, 0);
            if (cartCountDisplay) {
                if (totalItems > 0) {
                    cartCountDisplay.textContent = totalItems;
                    cartCountDisplay.style.display = 'inline-block';
                } else {
                    cartCountDisplay.style.display = 'none';
                }
            }
        }
    }

    /**
     * VERIFICA STATUS DE AUTENTICAÇÃO
     * Sincroniza dados locais com o servidor
     * Mantém compatibilidade com o sistema existente
     */
    async function checkAuthStatus() {
        console.log('Verificando status de autenticação...', {
            localStorage: localStorage.getItem('userAuth'),
            session: await (await fetch('php/auth_status.php')).json()
        });
        
        try {
            // Requisição para verificar autenticação no servidor
            const response = await fetch('php/auth_status.php');
            const serverAuth = await response.json();
            
            // Sincroniza com dados locais
            const localAuth = JSON.parse(localStorage.getItem('userAuth')) || {};
            
            if (serverAuth.isAuthenticated) {
                // Usuário autenticado no servidor - atualiza localStorage
                localStorage.setItem('userAuth', JSON.stringify({
                    ...localAuth, // Mantém dados locais existentes
                    isAuthenticated: true,
                    id: serverAuth.user_id,
                    name: serverAuth.user_name,
                    isAdmin: serverAuth.is_admin
                }));
                
                // Atualiza interface do usuário
                updateAuthUI(true, serverAuth.is_admin);
            } else {
                // Usuário não autenticado no servidor
                if (localAuth.isAuthenticated) {
                    // Mantém dados locais mas marca como não autenticado
                    localStorage.setItem('userAuth', JSON.stringify({
                        ...localAuth,
                        isAuthenticated: false
                    }));
                }
                updateAuthUI(false, false);
            }
        } catch (error) {
            console.error('Erro ao verificar status de autenticação:', error);
            // Fallback: usa apenas dados locais se servidor indisponível
            const localAuth = JSON.parse(localStorage.getItem('userAuth')) || {};
            updateAuthUI(localAuth.isAuthenticated, localAuth.isAdmin);
        }
    }

    /**
     * ATUALIZA INTERFACE DE AUTENTICAÇÃO
     * Mostra/oculta elementos baseado no status de autenticação
     * @param {boolean} isAuthenticated - Usuário está autenticado
     * @param {boolean} isAdmin - Usuário é administrador
     */
    function updateAuthUI(isAuthenticated, isAdmin) {
        if (isAuthenticated) {
            // Usuário logado - mostra opções de conta
            if(navLogin) navLogin.style.display = 'none';
            if(navCadastro) navCadastro.style.display = 'none';
            if(navConta) navConta.style.display = 'inline-block';
            if(navLogout) navLogout.style.display = 'inline-block';
            if(cartLink) cartLink.style.display = 'inline-block';
            if(navAdmin) navAdmin.style.display = isAdmin ? 'inline-block' : 'none';
        } else {
            // Usuário não logado - mostra opções de login/cadastro
            if(navLogin) navLogin.style.display = 'inline-block';
            if(navCadastro) navCadastro.style.display = 'inline-block';
            if(navConta) navConta.style.display = 'none';
            if(navAdmin) navAdmin.style.display = 'none';
            if(navLogout) navLogout.style.display = 'none';
            // Carrinho ainda visível para usuários não logados
            if(cartLink) cartLink.style.display = 'inline-block';
        }
    }

    /**
     * EVENT LISTENER PARA LOGOUT
     * Usa o sistema existente mas garante compatibilidade com Composite
     */
    if (navLogout) {
        navLogout.addEventListener('click', async function(event) {
            event.preventDefault();
            try {
                // Faz logout no servidor
                const response = await fetch('php/logout.php');
                const data = await response.json();
                
                if (data.success) {
                    showNotification(data.message);
                    
                    // Limpa carrinho do localStorage (compatível com Composite)
                    localStorage.removeItem('carrinho');
                    
                    // Redireciona após breve delay
                    setTimeout(() => {
                        window.location.href = 'index.html';
                    }, 1500);
                } else {
                    showNotification('Erro ao fazer logout.', 'error');
                }
            } catch (error) {
                console.error('Erro durante logout:', error);
                showNotification('Ocorreu um erro ao tentar sair.', 'error');
            }
        });
    }

    /**
     * ATUALIZA ANO NO COPYRIGHT
     * Funcionalidade básica mantida
     */
    const anoAtualSpan = document.getElementById('anoAtual');
    if (anoAtualSpan) {
        anoAtualSpan.textContent = new Date().getFullYear();
    }

    /**
     * LISTENER PARA ATUALIZAÇÕES DO CARRINHO
     * Escuta eventos disparados pelo CartManager quando o carrinho muda
     */
    document.addEventListener('cartUpdated', function() {
        updateCartCount();
    });

    /**
     * LISTENER PARA ADIÇÃO DE KITS (EXEMPLO DE USO DO COMPOSITE)
     * Pode ser usado em páginas que oferecem kits especiais
     */
    document.addEventListener('addKitToCart', function(event) {
        try {
            const { kit, quantidade } = event.detail;
            const cartManager = new CartManager();
            cartManager.addItem(kit, quantidade);
            showNotification(`Kit ${kit.getName()} adicionado ao carrinho!`, 'success');
            updateCartCount();
        } catch (error) {
            showNotification(error.message, 'error');
        }
    });

    // INICIALIZAÇÃO DA APLICAÇÃO
    checkAuthStatus();
    updateCartCount();
    
    // Exemplo de como adicionar kits programaticamente (para teste)
    console.log('Sistema Composite carregado. Use KitManager para criar kits:');
    console.log('Ex: const kitFesta = KitManager.criarKitFesta();');
});