# Especificação de Requisitos de Software
## Para <Site de queijaria>

Versão 0.1  
Preparado por <Júlio César, Gustavo Beserra e Gustavo Nogueira>   
<data 25-05-2025>  

Tabela de Conteúdos
=================
* [Histórico de Revisões](#histórico-de-revisões)
* 1 [Introdução](#1-introdução)
  * 1.1 [Objetivo do Documento](#11-objetivo-do-documento)
  * 1.2 [Escopo do Produto](#12-escopo-do-produto)
  * 1.3 [Definições, Acrônimos e Abreviações](#13-definições-acrônimos-e-abreviações)
  * 1.4 [Referências](#14-referências)
  * 1.5 [Visão Geral do Documento](#15-visão-geral-do-documento)
* 2 [Visão Geral do Produto](#2-visão-geral-do-produto)
  * 2.1 [Perspectiva do Produto](#21-perspectiva-do-produto)
  * 2.2 [Funções do Produto](#22-funções-do-produto)
  * 2.3 [Restrições do Produto](#23-restrições-do-produto)
  * 2.4 [Características dos Usuários](#24-características-dos-usuários)
  * 2.5 [Suposições e Dependências](#25-suposições-e-dependências)
  * 2.6 [Rateio de Requisitos](#26-rateio-de-requisitos)
* 3 [Requisitos](#3-requisitos)
  * 3.1 [Interfaces Externas](#31-interfaces-externas)
    * 3.1.1 [Interfaces com o Usuário](#311-interfaces-com-o-usuário)
    * 3.1.2 [Interfaces de Hardware](#312-interfaces-de-hardware)
    * 3.1.3 [Interfaces de Software](#313-interfaces-de-software)
  * 3.2 [Funcionais](#32-funcionais)
  * 3.3 [Qualidade de Serviço](#33-qualidade-de-serviço)
    * 3.3.1 [Desempenho](#331-desempenho)
    * 3.3.2 [Segurança](#332-segurança)
    * 3.3.3 [Confiabilidade](#333-confiabilidade)
    * 3.3.4 [Disponibilidade](#334-disponibilidade)
  * 3.4 [Conformidade](#34-conformidade)
  * 3.5 [Projeto e Implementação](#35-projeto-e-implementação)
    * 3.5.1 [Instalação](#351-instalação)
    * 3.5.2 [Distribuição](#352-distribuição)
    * 3.5.3 [Manutenibilidade](#353-manutenibilidade)
    * 3.5.4 [Reusabilidade](#354-reusabilidade)
    * 3.5.5 [Portabilidade](#355-portabilidade)
    * 3.5.6 [Custo](#356-custo)
    * 3.5.7 [Prazo](#357-prazo)
    * 3.5.8 [Prova de Conceito](#358-prova-de-conceito)
* 4 [Verificação](#4-verificação)
* 5 [Apêndices](#5-apêndices)

## Histórico de Revisões
| Nome | Data    | Motivo da Alteração  | Versão   |
| ---- | ------- | -------------------- | -------- |
|      |         |                      |          |
|      |         |                      |          |
|      |         |                      |          |

## 1. Introdução

### 1.1 Objetivo do Documento
Este documento de Especificação de Requisitos de Software tem como objetivo descrever de forma clara os requisitos funcionais e não funcionais do página web a ser desenvolvida para uma loja de queijos que tem um negócio local na região de Pernambuco. O público-alvo deste documento inclui desenvolvedores, analistas de requisitos, testadores, gestores do projeto e demais stakeholders envolvidos no desenvolvimento e validação do sistema. A ERS também serve como base para validação do produto final e uma referência para futuras manutenções.

### 1.2 Escopo do Produto
O sistema descrito neste documento é um site para uma loja de queijos, com foco em gestão de produtos, pedidos e faturamento. O sistema permitirá que o administrador (dono da loja) cadastre, edite e remova produtos, além de acompanhar relatórios de vendas e o status dos pedidos. Os clientes finais poderão consultar os produtos disponíveis, filtrá-los, montar um carrinho de compras e realizar pedidos, optando pela retirada no local ou pela entrega por mototáxi, conforme disponibilidade. Este produto é destinado a melhorar o fluxo de caixa e aumentar a eficiência de vendas da loja

### 1.3 Definições, Acrônimos e Abreviações
* ERS – Especificação de Requisitos de Software <br>
* RF – Requisito Funcional <br>
* Administrador – Dono da loja, responsável por gerenciar produtos, pedidos e faturamento <br>
* Cliente Final – Usuário do sistema que realiza consultas e pedidos de produtos 

### 1.4 Referências
* IEEE Std 830-1998 - IEEE Recommended Practice for Software Requirements Specifications

### 1.5 Visão Geral do Documento
Este documento está organizado da seguinte forma: <br>

A Seção 2 apresenta uma visão geral do projeto, incluindo sua perspectiva, funções principais, restrições, características dos usuários e elicitação de requisitos. <br>
A Seção 3 especifica os requisitos do sistema de forma detalhada, divididos em requisitos funcionais, interfaces externas, requisitos de qualidade de serviço, conformidade e considerações de projeto e implementação. <br>
A Seção 4 descreve os métodos de verificação a serem utilizados para assegurar que o software atenda aos requisitos definidos. <br>
A Seção 5 apresenta os apêndices relevantes para o projeto. <br>

## 2. Visão Geral do Produto

### 2.1 Perspectiva do Produto

Nosso cliente necessita de uma ferramenta de amostroário para os laticínios oferecidos no seu estabelecimento, pois ainda que ele fizesse a produção, possuia dificuldades para anunciá-los de maneira eficar. Ele busca alcançar um público com interesses em derivados do leite por meio de um site com seu catálogo disponível.

### 2.2 Funções do Produto

* Dar informações gerais do estabelecimento
* Mostrar catálogo de produtos
* Mostrar formas de contato
* Registro de dados do usuário

### 2.3 Restrições do Produto

* Utilização das linguagens de programação web 
* Utilização de banco de dados 
* Criação de sistema de cadastro e login
* Utilização de metodologia ágel ao longo do projeto

### 2.4 Características dos Usuários

O usuário alvo deste projeto se encaixa em clientes com interesse em consumir queijos das mais diversas variedades, possuindo acesso a internet por qualquer dispositivo, sendo estes pessoas que já consomem dos produtos ou novos usuários em potencial. Também são alvos os funcionários do estabelecimento comercial, que utilizarão o sistema para armazenamento e coleta de informações sobre vendas e produtos disponíveis.

### 2.5 Suposições e Dependências

Este projeto possui algumas premissas e dependências que podem impactar os requisitos definidos nesta especificação. Presume-se que os usuários utilizarão navegadores modernos (como Google Chrome, Mozilla Firefox ou Microsoft Edge) com JavaScript habilitado. Também será feito uso de bibliotecas e frameworks de código aberto que precisam estar disponíveis e mantidos ao longo do desenvolvimento. O ambiente de produção deverá suportar conexões seguras, funcionamento de APIs de backend e serviços de banco de dados MySQL. Supõe-se, ainda, que não haverá alterações significativas durante o período de desenvolvimento. Caso essas premissas se alterem ou não se confirmem, o escopo, as funcionalidades e o cronograma do projeto poderão ser impactados.

### 2.6 Rateio de Requisitos

Os requisitos do sistema foram organizados em etapas de desenvolvimento progressivo, iniciando pela criação do design da interface, que envolve a definição da estrutura visual das páginas, identidade visual, responsividade e usabilidade. Em seguida, será implementado o sistema de login, responsável pela autenticação de usuários, exigindo a integração entre frontend, backend e a configuração de regras de segurança. Paralelamente, será feita a inserção e configuração do banco de dados, que armazenará informações de usuários, produtos e sessões. Após essa etapa, será desenvolvido o módulo de cadastro de produtos, permitindo a inclusão, edição e exclusão de itens do catálogo por usuários autorizados, com campos como nome, descrição, preço, imagem e categoria. Por fim, será implementada a funcionalidade de carrinho de compras, permitindo aos usuários adicionar produtos, visualizar o total, remover itens e preparar o pedido para uma futura etapa de finalização. Essa distribuição busca garantir entregas parciais funcionais, possibilitando validações contínuas ao longo do desenvolvimento.

## 3. Requisitos
> Esta seção especifica os requisitos do sistema de software de gestão da queijaria. Os requisitos aqui descritos fornecem o detalhamento necessário para o desenvolvimento do sistema e posterior verificação pela equipe de testes.

> Os requisitos específicos devem:
* Ser unicamente identificáveis.  
* Declarar o sujeito do requisito (por exemplo, sistema, software, etc.) e o que deverá ser feito.  
* Opcionalmente, declarar as condições e restrições, se houver.  
* Descrever entradas (como pedidos ou dados de produção), saídas (relatórios, notificações) do sistema e todas as funções realizadas pelo sistema em resposta a uma entrada ou para suportar uma saída.  
* Ser verificáveis (por exemplo, a realização do requisito pode ser comprovada para satisfação do cliente).  
* Estar em conformidade com a sintaxe, palavras-chave e termos acordados.

### 3.1 Interfaces Externas
> Esta subseção define todas as entradas e saídas do sistema de software. Cada interface definida pode incluir:
* Nome do item  
* Fonte da entrada ou destino da saída  
* Faixa válida, precisão e/ou tolerância  
* Unidades de medida  
* Temporização  
* Relações com outras entradas/saídas  
* Formato/organização das telas  
* Formato/organização das janelas  
* Formatos de dados  
* Formatos de comandos  
* Mensagens finais  

#### 3.1.1 Interfaces com o Usuário
> O sistema oferecerá uma interface gráfica acessível via navegador para os seguintes perfis:
* Operador de Produção
* Gerente da Queijaria
* Atendente de Vendas
* Administrador do Sistema

> Características esperadas:
* Layout responsivo e intuitivo.
* Telas de cadastro de produtos, controle de maturação, controle de estoque, pedidos e vendas.
* Relatórios com visualização gráfica (produção diária, perdas, estoques, etc.).
* Botões padrão: Salvar, Cancelar, Ajuda, Voltar.
* Mensagens de erro e confirmação claras.
* Atalhos de teclado para acelerar cadastros e consultas.

#### 3.1.2 Interfaces de Hardware
* Dispositivos conectados à internet

#### 3.1.3 Interfaces de Software
* Banco de dados MySQL.
* Sistema operacional Linux (Ubuntu 22.04 ou superior) e Windows (10 ou superior).

### 3.2 Funcionais
* RF01: O sistema deve permitir o cadastro, edição e exclusão de produtos pelo administrador (dono da loja).
* RF02: O sistema deve exibir a lista de produtos disponíveis para o cliente com seus respectivos detalhes.
* RF03: O cliente deve poder adicionar produtos ao carrinho e realizar pedidos.
* RF04: O sistema deve permitir ao cliente selecionar entre retirada no local ou entrega.
* RF05: O sistema deve permitir ao administrador visualizar relatórios de faturamento.
* RF06: O sistema deve notificar o administrador sobre novos pedidos realizados.
* RF07: O sistema deve permitir a adição de novos produtos pelo administrador.

### 3.3 Qualidade de Serviço

#### 3.3.1 Desempenho
* O sistema deve responder a qualquer requisição em até 2 segundos em condições normais de operação (< 10 usuários simultâneos).
* Relatórios devem ser gerados em no máximo 8 segundos para até 1.000 registros.

#### 3.3.2 Segurança
* Autenticação por login e senha criptografada.
* Controle de acesso baseado em perfil (admin, produção, vendas).
* Os dados de produção e vendas devem ser armazenados em banco seguro.

#### 3.3.3 Confiabilidade
* O sistema deve manter uma taxa de disponibilidade mínima de 99% durante o horário comercial.
* Tolerância a falhas em caso de queda de energia.

#### 3.3.4 Disponibilidade
* xxt

### 3.4 Conformidade
* Geração de relatórios comerciais.
* Registro de alterações nos dados de lotes e estoque para fins de auditoria interna.

### 3.5 Projeto e Implementação

#### 3.5.1 Instalação
* Deve funcionar em ambiente local (intranet).
* Acesso simples via web.

#### 3.5.2 Distribuição
* Suporte a queijaria com bancos de dados.

#### 3.5.3 Manutenibilidade
* Código modular com documentação técnica e manual de instrução.
* Sistema deve permitir ativação/desativação de módulos conforme necessidade.

#### 3.5.4 Reusabilidade
* Módulos como cadastro de produtos e geração de etiquetas devem ser reutilizáveis em outros contextos (ex: fábrica de embutidos).

#### 3.5.5 Portabilidade
* Compatível com Windows 10+, Linux e macOS.
* Interface web acessível por dispositivos móveis.

#### 3.5.6 Custo
* Custo de desenvolvimento estimado em R$ x,xx.
* Licenciamento anual para manutenção e suporte técnico: R$ x,xx.

#### 3.5.7 Prazo
* Entrega da primeira versão funcional: x dias após início do projeto.
* Entregas parciais a cada 1(uma) semana para validação incremental.

#### 3.5.8 Prova de Conceito
* Um protótipo funcional com registro de produção e controle de estoque será entregue na primeira iteração, para validação em campo na queijaria.

## 4. Verificação
> Esta seção fornece as abordagens e métodos de verificação planejados para qualificar o software. As informações de verificação devem ser fornecidas paralelamente aos itens de requisitos da Seção 3. O propósito do processo de verificação é fornecer evidências objetivas de que um sistema ou elemento do sistema atende aos requisitos e características especificadas.

<!-- TODO: adicionar mais orientações, semelhante à seção 3 -->
<!-- ieee 15288:2015 -->

## 5. Apêndices
