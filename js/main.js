document.addEventListener('DOMContentLoaded', function() {
    const navLogin = document.getElementById('nav-login');
    const navCadastro = document.getElementById('nav-cadastro');
    const navConta = document.getElementById('nav-conta');
    const navAdmin = document.getElementById('nav-admin');
    const navLogout = document.getElementById('nav-logout');
    const cartLink = document.getElementById('cart-link');
    const cartCountDisplay = document.querySelector('.cart-count-display');

    // Função para exibir notificações
    window.showNotification = function(message, type = 'success') {
        const container = document.getElementById('notification-container');
        if (!container) return;

        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.textContent = message;

        container.appendChild(notification);

        setTimeout(() => {
            notification.classList.add('show');
        }, 10);

        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                container.removeChild(notification);
            }, 500);
        }, 3000);
    }

    function updateCartCount() {
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

    async function checkAuthStatus() {
        try {
            const response = await fetch('php/auth_status.php');
            const data = await response.json();

            if (data.isAuthenticated) {
                if(navLogin) navLogin.style.display = 'none';
                if(navCadastro) navCadastro.style.display = 'none';
                if(navConta) navConta.style.display = 'inline-block';
                if(navLogout) navLogout.style.display = 'inline-block';
                if(cartLink) cartLink.style.display = 'inline-block';

                if (data.isAdmin) {
                   if(navAdmin) navAdmin.style.display = 'inline-block';
                } else {
                   if(navAdmin) navAdmin.style.display = 'none';
                }
            } else {
                if(navLogin) navLogin.style.display = 'inline-block';
                if(navCadastro) navCadastro.style.display = 'inline-block';
                if(navConta) navConta.style.display = 'none';
                if(navAdmin) navAdmin.style.display = 'none';
                if(navLogout) navLogout.style.display = 'none';
                if(cartLink) cartLink.style.display = 'none';
            }
        } catch (error) {
            console.error('Erro ao verificar status de autenticação:', error);
            // Assumir não logado em caso de erro
        }
    }

    if (navLogout) {
        navLogout.addEventListener('click', async function(event) {
            event.preventDefault();
            try {
                const response = await fetch('php/logout.php');
                const data = await response.json();
                if (data.success) {
                    showNotification(data.message);
                    localStorage.removeItem('carrinho');
                    setTimeout(() => {
                        window.location.href = 'index.html';
                    }, 1500);
                } else {
                    showNotification('Erro ao fazer logout.', 'error');
                }
            } catch (error) {
                console.error('Erro de logout:', error);
                showNotification('Ocorreu um erro ao tentar sair.', 'error');
            }
        });
    }

    const anoAtualSpan = document.getElementById('anoAtual');
    if (anoAtualSpan) {
        anoAtualSpan.textContent = new Date().getFullYear();
    }

    checkAuthStatus();
    updateCartCount();
});