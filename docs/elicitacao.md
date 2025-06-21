# Especificação de Requisitos de Software

## Para Site de queijaria

Versão 0.2
Preparado por Júlio César, Gustavo Beserra e Gustavo Nogueira
21-06-2025

# Tabela de Conteúdos

  * [Histórico de Revisões](https://www.google.com/search?q=%23hist%C3%B3rico-de-revis%C3%B5es)
  * 1 [Introdução](https://www.google.com/search?q=%231-introdu%C3%A7%C3%A3o)
      * 1.1 [Objetivo do Documento](https://www.google.com/search?q=%2311-objetivo-do-documento)
      * 1.2 [Escopo do Produto](https://www.google.com/search?q=%2312-escopo-do-produto)
      * 1.3 [Definições, Acrônimos e Abreviações](https://www.google.com/search?q=%2313-defini%C3%A7%C3%B5es-acr%C3%B4nimos-e-abrevia%C3%A7%C3%B5es)
      * 1.4 [Referências](https://www.google.com/search?q=%2314-refer%C3%AAncias)
      * 1.5 [Visão Geral do Documento](https://www.google.com/search?q=%2315-vis%C3%A3o-geral-do-documento)
  * 2 [Visão Geral do Produto](https://www.google.com/search?q=%232-vis%C3%A3o-geral-do-produto)
      * 2.1 [Perspectiva do Produto](https://www.google.com/search?q=%2321-perspectiva-do-produto)
      * 2.2 [Funções do Produto](https://www.google.com/search?q=%2322-fun%C3%A7%C3%B5es-do-produto)
      * 2.3 [Restrições do Produto](https://www.google.com/search?q=%2323-restri%C3%A7%C3%B5es-do-produto)
      * 2.4 [Características dos Usuários](https://www.google.com/search?q=%2324-caracter%C3%ADsticas-dos-usu%C3%A1rios)
      * 2.5 [Suposições e Dependências](https://www.google.com/search?q=%2325-suposi%C3%A7%C3%B5es-e-depend%C3%AAncias)
      * 2.6 [Rateio de Requisitos](https://www.google.com/search?q=%2326-rateio-de-requisitos)
  * 3 [Requisitos](https://www.google.com/search?q=%233-requisitos)
      * 3.1 [Interfaces Externas](https://www.google.com/search?q=%2331-interfaces-externas)
          * 3.1.1 [Interfaces com o Usuário](https://www.google.com/search?q=%23311-interfaces-com-o-usu%C3%A1rio)
          * 3.1.2 [Interfaces de Hardware](https://www.google.com/search?q=%23312-interfaces-de-hardware)
          * 3.1.3 [Interfaces de Software](https://www.google.com/search?q=%23313-interfaces-de-software)
      * 3.2 [Funcionais](https://www.google.com/search?q=%2332-funcionais)
      * 3.3 [Qualidade de Serviço](https://www.google.com/search?q=%2333-qualidade-de-servi%C3%A7o)
          * 3.3.1 [Desempenho](https://www.google.com/search?q=%23331-desempenho)
          * 3.3.2 [Segurança](https://www.google.com/search?q=%23332-seguran%C3%A7a)
          * 3.3.3 [Confiabilidade](https://www.google.com/search?q=%23333-confiabilidade)
          * 3.3.4 [Disponibilidade](https://www.google.com/search?q=%23334-disponibilidade)
      * 3.4 [Conformidade](https://www.google.com/search?q=%2334-conformidade)
      * 3.5 [Projeto e Implementação](https://www.google.com/search?q=%2335-projeto-e-implementa%C3%A7%C3%A3o)
          * 3.5.1 [Instalação](https://www.google.com/search?q=%23351-instala%C3%A7%C3%A3o)
          * 3.5.2 [Distribuição](https://www.google.com/search?q=%23352-distribui%C3%A7%C3%A3o)
          * 3.5.3 [Manutenibilidade](https://www.google.com/search?q=%23353-manutenibilidade)
          * 3.5.4 [Reusabilidade](https://www.google.com/search?q=%23354-reusabilidade)
          * 3.5.5 [Portabilidade](https://www.google.com/search?q=%23355-portabilidade)
          * 3.5.6 [Custo](https://www.google.com/search?q=%23356-custo)
          * 3.5.7 [Prazo](https://www.google.com/search?q=%23357-prazo)
          * 3.5.8 [Prova de Conceito](https://www.google.com/search?q=%23358-prova-de-conceito)
  * 4 [Verificação](https://www.google.com/search?q=%234-verifica%C3%A7%C3%A3o)
  * 5 [Apêndices](https://www.google.com/search?q=%235-ap%C3%AAndices)

## Histórico de Revisões

| Nome | Data | Motivo da Alteração | Versão |
|---|---|---|---|
| Júlio César, Gustavo Beserra, Gustavo Nogueira | 21-06-2025 | Adaptação do SRS às funcionalidades implementadas, detalhamento de requisitos de qualidade e preenchimento de seções pendentes. Atualização para v0.2. | 0.2 |

## 1\. Introdução

### 1.1 Objetivo do Documento

Este documento de Especificação de Requisitos de Software tem como objetivo descrever de forma clara os requisitos funcionais e não funcionais do página web a ser desenvolvida para uma loja de queijos que tem um negócio local em Sanharó. O público-alvo deste documento inclui desenvolvedores, analistas de requisitos, testadores, gestores do projeto e demais stakeholders envolvidos no desenvolvimento e validação do sistema. A ERS também serve como base para validação do produto final e uma referência para futuras manutenções.

### 1.2 Escopo do Produto

O sistema descrito neste documento é um site para uma loja de queijos, com foco em gestão de produtos, pedidos e faturamento. O sistema permitirá que o administrador (dono da loja) cadastre, edite e remova produtos, além de acompanhar relatórios de vendas e o status dos pedidos. Os clientes finais poderão consultar os produtos disponíveis, adicionar ao carrinho e realizar pedidos, optando exclusivamente pela retirada no local. Este produto é destinado a melhorar o fluxo de caixa e aumentar a eficiência de vendas da loja.

### 1.3 Definições, Acrônimos e Abreviações

  * ERS – Especificação de Requisitos de Software
  * RF – Requisito Funcional
  * RNF – Requisito Não Funcional
  * Administrador – Dono da loja, responsável por gerenciar produtos, pedidos e faturamento
  * Cliente Final – Usuário do sistema que realiza consultas e pedidos de produtos
  * BLOB – Binary Large Object (Tipo de dado para armazenar dados binários, como imagens, diretamente no banco de dados)
  * PHP – Linguagem de programação de backend.
  * MySQL – Sistema de gerenciamento de banco de dados relacional.
  * JavaScript – Linguagem de programação de frontend.

### 1.4 Referências

  * IEEE Std 830-1998 - IEEE Recommended Practice for Software Requirements Specifications

### 1.5 Visão Geral do Documento

Este documento está organizado da seguinte forma:

A Seção 2 apresenta uma visão geral do projeto, incluindo sua perspectiva, funções principais, restrições, características dos usuários e elicitação de requisitos.
A Seção 3 especifica os requisitos do sistema de forma detalhada, divididos em requisitos funcionais, interfaces externas, requisitos de qualidade de serviço, conformidade e considerações de projeto e implementação.
A Seção 4 descreve os métodos de verificação a serem utilizados para assegurar que o software atenda aos requisitos definidos.
A Seção 5 apresenta os apêndices relevantes para o projeto.

## 2\. Visão Geral do Produto

### 2.1 Perspectiva do Produto

Nosso cliente necessita de uma ferramenta de amostroário para os produtos oferecidos no seu estabelecimento, pois ainda que ele fizesse a produção, possuia dificuldades para anunciá-los de maneira eficaz. Ele busca alcançar um público com interesses em derivados do leite por meio de um site com seu catálogo disponível.

### 2.2 Funções do Produto

  * Dar informações gerais do estabelecimento.
  * Mostrar catálogo de produtos.
  * Mostrar formas de contato (diretamente na página inicial).
  * Registro e autenticação de usuários.
  * Gestão de carrinho de compras.
  * Finalização de pedidos para retirada.
  * Gestão de produtos (para administradores).
  * Visualização de faturamento e pedidos (para administradores).

### 2.3 Restrições do Produto

  * Utilização das linguagens de programação web PHP e JavaScript para o desenvolvimento.
  * Utilização de banco de dados MySQL para armazenamento persistente de dados.
  * Criação de sistema de cadastro e login com senhas criptografadas (bcrypt).
  * Utilização de metodologia ágil ao longo do projeto.
  * O armazenamento de imagens de produtos será feito diretamente no banco de dados como BLOBs.
  * A única opção de entrega disponível para pedidos será a retirada no local.

### 2.4 Características dos Usuários

O usuário alvo deste projeto se encaixa em clientes com interesse em consumir queijos, possuindo acesso a internet por qualquer dispositivo, sendo estes pessoas que já consomem dos produtos ou novos usuários em potencial. Também são alvos os funcionários do estabelecimento comercial, que utilizarão o sistema para armazenamento e coleta de informações sobre vendas e produtos disponíveis.

### 2.5 Suposições e Dependências

Este projeto possui algumas premissas e dependências que podem impactar os requisitos definidos nesta especificação. Presume-se que os usuários utilizarão navegadores com JavaScript habilitado. Também será feito uso de bibliotecas e frameworks de código aberto que precisam estar disponíveis e mantidos ao longo do desenvolvimento. O ambiente de produção deverá suportar conexões seguras, funcionamento de APIs de backend e serviços de banco de dados MySQL. Supõe-se, ainda, que não haverá alterações significativas nos requisitos principais durante o período de desenvolvimento. Caso essas premissas se alterem ou não se confirmem, o escopo, as funcionalidades e o cronograma do projeto poderão ser impactados.

### 2.6 Rateio de Requisitos

Os requisitos do sistema foram organizados em etapas de desenvolvimento progressivo. O **design da interface** envolve a definição da estrutura visual das páginas, identidade visual, responsividade e usabilidade. Em seguida, será implementado o **sistema de login e cadastro**, responsável pela autenticação de usuários e criação de contas. Paralelamente, será feita a **inserção e configuração do banco de dados MySQL**, que armazenará informações de usuários, produtos e pedidos. Posteriormente, será desenvolvido o **módulo de gestão de produtos** (CRUD), permitindo a inclusão, edição e exclusão de itens do catálogo por usuários administradores, com campos como nome, preço, estoque e **upload de imagem**. Por fim, será implementada a funcionalidade de **carrinho de compras**, permitindo aos usuários adicionar produtos, visualizar o total, remover itens e preparar o pedido para **finalização exclusiva via retirada no local**. Essa distribuição busca garantir entregas parciais funcionais, possibilitando validações contínuas ao longo do desenvolvimento.

## 3\. Requisitos

### 3.1 Interfaces Externas

#### 3.1.1 Interfaces com o Usuário

O sistema oferecerá uma interface gráfica acessível via navegador para os seguintes perfis:

  * **Cliente Final:** Interage com o catálogo de produtos, carrinho de compras, formulários de cadastro/login e visualização de pedidos.
  * **Administrador do Sistema:** Interage com painéis de gestão de produtos, relatórios de faturamento e visualização/atualização de pedidos.

Características esperadas:

  * Layout responsivo e intuitivo em desktop e dispositivos móveis.
  * Telas de: Página Inicial, Produtos, Carrinho de Compras, Login, Cadastro, Minha Conta (Pedidos do Cliente), Dashboard Admin, Gestão de Produtos (Admin), Faturamento e Pedidos (Admin).
  * Mensagens de erro e confirmação claras e contextuais (ex: "Produto adicionado ao carrinho", "Estoque insuficiente", "Login realizado com sucesso").
  * Interatividade via JavaScript para ações no carrinho e validações de formulário.

#### 3.1.2 Interfaces de Hardware

  * Dispositivos de computação (desktops, notebooks, tablets, smartphones) com acesso à internet.
  * Servidor web para hospedagem da aplicação.

#### 3.1.3 Interfaces de Software

  * **Banco de dados:** MySQL (versão compatível com PDO).
  * **Sistema operacional do servidor:** Linux (Ubuntu 22.04 ou superior) e Windows (10 ou superior) para ambiente de desenvolvimento.
  * **Linguagens de Programação:** PHP 8.x (ou superior) para o backend e JavaScript para o frontend.
  * **Servidor Web:** Apache HTTP Server hospedado em um ambiente de produção (online).
  * **Bibliotecas/Frameworks Frontend:** Font Awesome (para ícones).
  * **Ferramentas de Gerenciamento de BD:** phpMyAdmin (recomendado para gestão e visualização do banco de dados).

### 3.2 Funcionais

  * **RF01: Gestão de Produtos (Administrador):**
      * **RF01.1:** O sistema deve permitir ao administrador **cadastrar** novos produtos, fornecendo **nome, preço, estoque e uma imagem do produto (upload de arquivo)**. A descrição do produto é opcional e não é um campo do formulário de cadastro/edição.
      * **RF01.2:** O sistema deve permitir ao administrador **editar** produtos existentes, atualizando **nome, preço, estoque e/ou a imagem do produto**.
      * **RF01.3:** O sistema deve permitir ao administrador **excluir** produtos existentes.
  * **RF02: Exibição de Produtos (Cliente):** O sistema deve exibir para o cliente uma lista de produtos disponíveis, incluindo nome, preço, estoque e a imagem do produto.
  * **RF03: Carrinho de Compras (Cliente):**
      * **RF03.1:** O sistema deve permitir ao cliente **adicionar produtos ao carrinho**.
      * **RF03.2:** O sistema deve permitir ao cliente **ajustar a quantidade** de cada produto no carrinho, respeitando o estoque disponível.
      * **RF03.3:** O sistema deve permitir ao cliente **remover produtos** do carrinho.
      * **RF03.4:** O sistema deve exibir o **total acumulado** dos produtos no carrinho.
  * **RF04: Finalização de Pedido (Cliente):**
      * **RF04.1:** O sistema deve permitir ao cliente **finalizar um pedido** com os itens do carrinho.
      * **RF04.2:** O sistema deve **automaticamente definir o tipo de entrega como "Retirada no Local"**, sem opção de escolha para o cliente.
      * **RF04.3:** O sistema deve verificar a disponibilidade de estoque dos produtos no carrinho antes de finalizar o pedido.
  * **RF05: Relatórios de Faturamento (Administrador):** O sistema deve permitir ao administrador visualizar relatórios de faturamento, detalhando o valor total de vendas por período (ex: diário).
  * **RF06: Notificação de Novos Pedidos (Administrador):** O sistema deve registrar ou indicar a ocorrência de novos pedidos para o administrador.
  * **RF07: Controle de Acesso e Conta de Usuário:**
      * **RF07.1:** O sistema deve permitir que usuários se **registrem**, fornecendo nome, e-mail e senha.
      * **RF07.2:** O sistema deve permitir que usuários **façam login**, validando e-mail e senha.
      * **RF07.3:** O sistema deve permitir que usuários **façam logout**.
      * **RF07.4:** O sistema deve permitir que usuários autenticados (clientes) **visualizem seus próprios pedidos**.
      * **RF07.5:** O sistema deve **restringir o acesso às funcionalidades administrativas** (dashboard, gestão de produtos, faturamento, gestão de pedidos) apenas a usuários com perfil de administrador.
  * **RF08: Gestão de Status de Pedidos (Administrador):** O sistema deve permitir ao administrador **visualizar e alterar o status** de qualquer pedido (Pendente, Processando, Concluído, Cancelado).

### 3.3 Qualidade de Serviço

#### 3.3.1 Desempenho

  * O sistema deve responder a qualquer requisição **HTTP (API calls)** em até 2 segundos em condições normais de operação (considerando um ambiente local de desenvolvimento com \< 10 usuários simultâneos).
  * Relatórios de faturamento devem ser gerados em no máximo 8 segundos para até 1.000 registros de pedidos.
  * O carregamento inicial da página de produtos com imagens deve ser responsivo, com as imagens aparecendo em até 5 segundos em conexões de banda larga padrão.

#### 3.3.2 Segurança

  * **RNF02.1:** As senhas dos usuários devem ser armazenadas utilizando **hashing forte (Bcrypt)**.
  * **RNF02.2:** O controle de acesso a funcionalidades administrativas deve ser rigoroso e baseado na **permissão de perfil de usuário (`is_admin`)**.
  * **RNF02.3:** Todas as interações com o banco de dados devem ser realizadas através de **instruções preparadas (PDO)** para prevenir ataques de injeção de SQL.
  * **RNF02.4:** A gestão de sessão deve ser segura, incluindo o uso de sessões PHP padrão e destruição adequada ao logout.
  * **RNF02.5:** A validação de tipos de arquivo e tamanho para upload de imagens deve ser implementada para mitigar riscos de segurança.

#### 3.3.3 Confiabilidade

  * O sistema deve manter uma taxa de disponibilidade mínima de **99%** durante o horário comercial (em ambiente de produção).
  * As operações críticas de escrita no banco de dados (cadastro de produtos, finalização de pedidos, atualização de status/estoque) devem utilizar **transações de banco de dados** para garantir a integridade e consistência dos dados em caso de falhas parciais.
  * O sistema deve lidar graciosamente com situações de **estoque insuficiente**, impedindo a finalização do pedido e informando o cliente.

#### 3.3.4 Disponibilidade

  * O sistema deve estar acessível 24/7 (em ambiente de produção), com o tempo de inatividade programado para manutenção minimizado.
  * Em caso de falha de serviço (ex: MySQL inativo), o sistema deve exibir uma mensagem de erro compreensível ao usuário em vez de travar.

### 3.4 Conformidade

  * Geração de relatórios comerciais básicos de faturamento.
  * Implementação em conformidade com as boas práticas de desenvolvimento web (HTML5, CSS3, JavaScript ES6+, PHP 8.x).
  * Conformidade com os requisitos de licenciamento de bibliotecas e ferramentas de código aberto utilizadas.

### 3.5 Projeto e Implementação

#### 3.5.1 Instalação

  * O sistema deve ser instalável exclusivamente em servidores de produção (online) que possuam ambiente LAMP/WAMP compatível.
  * A instalação envolve copiar os arquivos da aplicação para o diretório de documentos do servidor web do ambiente de hospedagem.
  * É necessário criar o banco de dados MySQL e importar o script SQL fornecido para configurar a estrutura das tabelas.
  * As credenciais de acesso ao banco de dados devem ser configuradas no arquivo php/conexao.php.
  * Após a instalação, o acesso ao sistema se dará via navegador web através do domínio configurado no ambiente de hospedagem.

#### 3.5.2 Distribuição

  * O sistema será distribuído como um conjunto de arquivos web (HTML, CSS, JS, PHP) e um script SQL para o banco de dados.
  * Suporte a ambientes de queijaria que utilizam bancos de dados relacionais.

#### 3.5.3 Manutenibilidade

  * O código-fonte deve ser modularizado (separação de responsabilidades entre PHP, HTML, CSS, JavaScript).
  * O código deve ser bem comentado e seguir padrões de codificação consistentes.
  * A documentação técnica (incluindo o README.md e este SRS) e o manual de usuário devem ser atualizados.
  * O sistema deve ser desenhado para facilitar futuras expansões de funcionalidades (ex: mais opções de entrega, gestão de clientes).

#### 3.5.4 Reusabilidade

  * Componentes de interface (cabeçalho, rodapé, barra de navegação) são reutilizados em todas as páginas HTML.
  * As funções de autenticação e conexão com o banco de dados são encapsuladas em arquivos PHP dedicados (`auth.php`, `conexao.php`) para reuso.
  * As APIs RESTful para produtos e pedidos são reutilizáveis por diferentes partes do frontend.

#### 3.5.5 Portabilidade

  * Compatível com sistemas operacionais de servidor amplamente utilizados (Windows Server, Linux).
  * A interface web é acessível por diversos navegadores modernos em diferentes dispositivos (desktops, notebooks, tablets, smartphones).

#### 3.5.6 Custo

  * Custo de desenvolvimento estimado em R$ xxxx,xx (projeto de faculdade, sem custos diretos de mão de obra para os desenvolvedores).
  * Licenciamento: Não há custos de licenciamento de software, pois utiliza tecnologias de código aberto (PHP, MySQL, Apache, JavaScript).

#### 3.5.7 Prazo

  * Entrega da primeira versão funcional (conforme especificado neste documento): 21 de junho de 2025.
  * Entregas parciais a cada 1 (uma) semana para validação incremental.

#### 3.5.8 Prova de Conceito

  * Um protótipo funcional com cadastro de produtos (com upload de imagem), gestão de estoque básico, funcionalidade de carrinho de compras e finalização de pedido (retirada) será entregue na primeira iteração para validação em campo na queijaria.

## 4\. Verificação

Esta seção fornece as abordagens e métodos de verificação planejados para qualificar o software. As informações de verificação devem ser fornecidas paralelamente aos itens de requisitos da Seção 3. O propósito do processo de verificação é fornecer evidências objetivas de que um sistema ou elemento do sistema atende aos requisitos e características especificadas.

  * **RF01 (Gestão de Produtos):**

      * **RF01.1 (Cadastrar):** Teste de inserção de novos produtos com e sem imagem. Teste de preenchimento dos campos obrigatórios (nome, preço, estoque) e validação de formatos. Verificação da gravação no banco de dados e da exibição correta na lista de produtos.
      * **RF01.2 (Editar):** Teste de atualização de todos os campos editáveis de um produto existente (nome, preço, estoque) e da imagem (troca por nova imagem ou manutenção da existente). Verificação da atualização no banco de dados e da renderização correta na interface.
      * **RF01.3 (Excluir):** Teste de exclusão de produtos. Verificação da remoção do registro correspondente no banco de dados e da atualização da lista de produtos na interface.

  * **RF02 (Exibição de Produtos):** Teste de carregamento da página de produtos. Verificação visual da lista de produtos, seus detalhes (nome, preço, estoque) e se as imagens são exibidas corretamente.

  * **RF03 (Carrinho de Compras):**

      * **RF03.1 (Adicionar):** Teste de clique no botão "Adicionar ao carrinho" em múltiplos produtos. Verificação do incremento correto do contador de itens no carrinho.
      * **RF03.2 (Ajustar Quantidade):** Teste de alteração da quantidade de itens diretamente no carrinho, incluindo casos de ajuste para valores mínimos (1) e máximos (estoque disponível). Verificação do recálculo automático do subtotal do item e do total do carrinho.
      * **RF03.3 (Remover):** Teste de clique no botão "Remover" para itens específicos. Verificação da remoção visual do item do carrinho e do recálculo do total.
      * **RF03.4 (Total):** Verificação contínua do cálculo e exibição precisa do valor total do carrinho em todas as operações de adição, ajuste e remoção.

  * **RF04 (Finalização de Pedido):**

      * **RF04.1 (Finalizar):** Teste de finalização de um pedido com um ou múltiplos itens no carrinho. Verificação da criação de um novo registro na tabela `pedidos` e dos itens correspondentes na tabela `itens_pedido` no banco de dados.
      * **RF04.2 (Retirada):** Verificação no banco de dados de que o campo `tipo_entrega` do pedido recém-criado está sempre definido como `'retirada'`.
      * **RF04.3 (Estoque):** Teste de cenário onde a quantidade de um produto no carrinho excede o estoque disponível. O sistema deve exibir uma mensagem de erro e impedir a finalização do pedido.

  * **RF05 (Relatórios de Faturamento):** Teste de acesso à página de relatórios de faturamento (acesso admin). Verificação da exibição correta dos dados de faturamento agrupados por período (ex: diário), incluindo valores e datas.

  * **RF06 (Notificação de Novos Pedidos):** Verificação da geração de logs de erro ou outras formas de notificação (simuladas) no ambiente de desenvolvimento sempre que um novo pedido é finalizado com sucesso.

  * **RF07 (Controle de Acesso e Conta):**

      * **RF07.1 (Registro):** Teste de cadastro de novos usuários com dados válidos e inválidos (ex: e-mail já em uso). Verificação da persistência dos dados no banco de dados e do retorno de mensagens de sucesso/erro.
      * **RF07.2 (Login):** Teste de login com credenciais válidas e inválidas. Verificação do redirecionamento para a página inicial em caso de sucesso e da exibição de mensagens de erro para credenciais inválidas.
      * **RF07.3 (Logout):** Teste de clique no link "Sair". Verificação do encerramento da sessão e do redirecionamento para a página inicial.
      * **RF07.4 (Meus Pedidos):** Teste de acesso à página "Minha Conta" por um cliente autenticado. Verificação da listagem de todos os pedidos realizados por aquele cliente.
      * **RF07.5 (Restrição Admin):** Teste de tentativa de acesso direto a URLs de páginas administrativas (`admin_dashboard.html`, `admin_add_produto.html`, `admin_faturamento.html`) por usuários não-administradores. O sistema deve redirecioná-los para a página inicial ou exibir uma mensagem de acesso negado.

  * **RF08 (Gestão de Status de Pedidos):** Teste de alteração do status de pedidos na página de faturamento (acesso admin). Verificação da atualização imediata do status no banco de dados e da correta exibição do novo status para o cliente na página "Minha Conta".

  * **RNF01 (Usabilidade):**

      * Realização de testes de usabilidade com um grupo representativo de usuários para coletar feedback sobre a intuitividade da interface.
      * Revisão por pares do design das telas para garantir clareza e consistência.
      * Verificação de todas as mensagens do sistema (erro, sucesso, validação) para garantir que sejam claras e úteis.

  * **RNF02 (Desempenho):**

      * Medição do tempo de carregamento de páginas críticas (Produtos, Carrinho, Login) usando ferramentas de desenvolvedor do navegador.
      * Simulação de múltiplos acessos simultâneos (se houver ferramenta de teste de carga) para verificar o desempenho sob estresse.
      * Medição do tempo de geração de relatórios de faturamento com um volume crescente de dados.

  * **RNF03 (Segurança):**

      * Auditoria do banco de dados para verificar se as senhas estão armazenadas como hashes Bcrypt.
      * Testes de intrusão para tentar acessar funcionalidades administrativas sem autenticação ou com credenciais inválidas.
      * Análise de código para identificar vulnerabilidades comuns (XSS, CSRF, etc.), especialmente nas interações com formulários e APIs.
      * Verificação do comportamento do sistema ao tentar fazer upload de arquivos maliciosos ou muito grandes.

  * **RNF04 (Confiabilidade):**

      * Testes de "crash" simulados, como interrupção abrupta do servidor MySQL durante a finalização de um pedido, para garantir a reversão de transações incompletas e a integridade dos dados.
      * Testes de cenários de erro (ex: falha de rede, banco de dados indisponível) para verificar a robustez da aplicação e a exibição de mensagens de erro adequadas.

  * **RNF05 (Manutenibilidade):**

      * Revisão de código para garantir conformidade com padrões de codificação, clareza e modularidade.
      * Verificação da existência e precisão dos comentários no código e da documentação externa.
      * Testes de integração de novos módulos/funcionalidades para garantir que não quebrem as existentes.

  * **RNF06 (Portabilidade/Compatibilidade):**

      * Testes de compatibilidade em diferentes navegadores (Google Chrome, Mozilla Firefox, Microsoft Edge) e suas versões mais recentes.
      * Testes de responsividade em emuladores de dispositivos móveis e em dispositivos reais (smartphones, tablets) para garantir a correta renderização da interface.

## 5\. Apêndices

  * **Apêndice A: Script SQL do Banco de Dados:** Contém o script completo para a criação das tabelas `usuarios`, `produtos`, `pedidos` e `itens_pedido`, incluindo as especificações de `MEDIUMBLOB` para imagens e `ENUM('retirada')` para o tipo de entrega.
  * **Apêndice B: Manual do Usuário:** Documento detalhado com instruções sobre como utilizar a aplicação, tanto para clientes quanto para administradores.
  * **Apêndice C: Estrutura de Pastas do Projeto:** Detalhamento da organização dos arquivos e diretórios da aplicação.

-----
