Manual do Usuário - Laticínio Esperança

1. Visão Geral da Aplicação

O site foi desenvolvido para facilitar a compra de produtos pelos clientes e a gestão da loja pelo administrador.

Principais Funcionalidades:

    Para Clientes: Visualizar produtos, adicionar ao carrinho, finalizar pedidos (apenas retirada no local) e acompanhar seus pedidos.
    Para Administradores: Cadastrar, editar e excluir produtos; visualizar relatórios de faturamento e gerenciar pedidos.

2. Acessando a Aplicação

Para acessar a aplicação, abra seu navegador web e digite o endereço onde o projeto está hospedado.

http://endereçohospedado.com.br

3. Navegação Geral do Site

A navegação principal do site é consistente em todas as páginas e inclui:

    Início: Leva você de volta à página inicial.
    Produtos: Exibe a lista completa de produtos disponíveis para compra.
    Contato: Rola para a seção de contato na página inicial, onde você pode encontrar informações de contato.

Na barra superior, você encontrará links para:

    Iniciar Sessão: Para usuários cadastrados fazerem login.
    Cadastre-se: Para novos usuários criarem uma conta.
    Carrinho: Acessa seu carrinho de compras, exibindo o número de itens adicionados.
    Minha Conta: (Visível após o login) Permite visualizar seus pedidos.
    Admin: (Visível apenas para administradores logados) Acessa o painel de administração.
    Sair: (Visível após o login) Encerra sua sessão.

4. Funcionalidades para Clientes
4.1. Cadastro de Nova Conta

    Clique em "Cadastre-se" na barra superior ou no link "Cadastre-se agora" na página de Login.
    Preencha os campos "Seu nome", "E-mail" e "Senha".
    Clique em "Cadastrar".
    Após o sucesso, exibirá uma mensagem e você será redirecionado(a) para a página de Login.

4.2. Iniciar Sessão (Login)

    Clique em "Iniciar Sessão" na barra superior.
    Preencha seu "E-mail" e "Senha" cadastrados.
    Clique em "Entrar".
    Após o login, a barra superior de navegação será atualizada, mostrando "Minha Conta", "Admin" (se for administrador) e "Sair".

4.3. Visualizar Produtos

    Clique em "Produtos" na navegação principal.
    Você verá uma lista de queijos disponíveis com seus nomes, preços e estoque.
    As imagens dos produtos serão carregadas diretamente do sistema.

4.4. Adicionar Produtos ao Carrinho

    Na página de Produtos, clique no botão "Adicionar ao carrinho" ao lado do produto desejado.
    Uma mensagem confirmará a adição.
    O ícone do carrinho na barra superior mostrará a quantidade total de itens.
    Se você tentar adicionar mais do que o estoque disponível, uma notificação será exibida.

4.5. Gerenciar o Carrinho de Compras

    Clique no ícone "Carrinho" na barra superior para acessar a página do seu carrinho.
    Aqui você verá uma lista dos produtos adicionados, suas quantidades e subtotais.
    Ajustar Quantidade: Você pode alterar a quantidade de um item digitando no campo "Quantidade". O sistema verificará o estoque disponível.
    Remover Item: Clique no botão "Remover" (ícone de lixeira) ao lado do item para tirá-lo do carrinho.
    O "Total" do carrinho será atualizado automaticamente.

4.6. Finalizar Pedido

    Na página do Carrinho, revise seus itens e o total.
    A opção de entrega será fixada como "Retirada no Local".
    Clique em "Finalizar Pedido".
    Uma mensagem de sucesso será exibida e você será redirecionado(a) para a página "Minha Conta" para ver seus pedidos.
    Seu carrinho será esvaziado após a finalização bem-sucedida.

4.7. Minha Conta (Meus Pedidos)

    Após fazer login, clique em "Minha Conta" na barra superior.
    Você verá uma lista de todos os seus pedidos, com detalhes como ID do Pedido, data, total, tipo de entrega (sempre "Retirada") e status (Pendente, Processando, Concluído, Cancelado).

5. Funcionalidades para Administradores

Para acessar as funcionalidades de administrador, você deve estar logado com uma conta que tenha o status is_admin definido como TRUE no banco de dados.

    Faça login com uma conta de administrador.
    Clique em "Admin" na barra superior. Isso o(a) levará ao Dashboard Admin.

5.1. Dashboard Admin

O Dashboard Admin é o ponto central para as operações administrativas. A partir daqui, você pode acessar:

    Gerenciar Produtos: Para adicionar, editar ou excluir produtos.
    Ver Faturamento e Pedidos: Para visualizar relatórios de vendas e gerenciar o status dos pedidos.

5.2. Gerenciar Produtos (admin_add_produto.html)

    No Dashboard Admin, clique em "Gerenciar Produtos".
    Adicionar Novo Produto:
        Preencha o Nome do Produto, Preço e Estoque.
        Clique em "Imagem do Produto" para fazer o upload de uma imagem do seu computador (formatos JPG, PNG, GIF são aceitos, máximo 16MB).
        Clique em "Adicionar Produto" para salvar.
    Editar Produtos Existentes:
        Abaixo do formulário, você verá uma lista dos produtos já cadastrados.
        Clique em "Editar" ao lado do produto que deseja modificar.
        Os campos do formulário serão preenchidos com os dados do produto (exceto a imagem, que você precisará reenviar se quiser alterá-la).
        Faça as alterações necessárias e clique em "Atualizar Produto".
    Excluir Produtos:
        Na lista de produtos existentes, clique em "Excluir" ao lado do produto que deseja remover.
        Confirme a exclusão quando solicitado.

5.3. Ver Faturamento e Pedidos (admin_faturamento.html)

    No Dashboard Admin, clique em "Ver Faturamento e Pedidos".
    Relatório de Faturamento:
        Você verá uma lista com o faturamento diário do laticínio.
    Todos os Pedidos:
        Uma lista detalhada de todos os pedidos realizados, incluindo ID do pedido, cliente, data, total e status.
        Atualizar Status do Pedido: Para cada pedido, há um menu suspenso ("Select") onde você pode alterar o status do pedido (Pendente, Processando, Concluído, Cancelado). Basta selecionar o novo status e ele será salvo automaticamente.

6. Contato e Suporte

    WhatsApp: (87) 99165-7703.
    Instagram: @laticinio_esperanca232.
    Endereço: Rua Manoel Batista, 322, Santa Clara, Sanharó - PE.

Você pode encontrar estas informações na seção "Contato" da página inicial.
