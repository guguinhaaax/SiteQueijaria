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
.ERS – Especificação de Requisitos de Software <br>
.RF – Requisito Funcional <br>Add commentMore actions
.Administrador – Dono da loja, responsável por gerenciar produtos, pedidos e faturamento <br>
.Cliente Final – Usuário do sistema que realiza consultas e pedidos de produtos 

### 1.4 Referências
.IEEE Std 830-1998 - IEEE Recommended Practice for Software Requirements Specifications

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

O usuário alvo deste projeto se encaixa em pessoas jovens e adultas, possuindo acesso regular a internet por meio de computadores, com mínimo grau acadêmico de alfabetização e qualquer classe econômica, com interesse em consumir produtos derivados do leite com regularidade constante.

## 3. Requisitos
> Esta seção especifica os requisitos do produto de software. Especifique todos os requisitos de software com nível de detalhe suficiente para permitir que os projetistas desenvolvam o sistema e que os testadores verifiquem que o sistema atende aos requisitos.

> Os requisitos específicos devem:
* Ser unicamente identificáveis.  
* Declarar o sujeito do requisito (por exemplo, sistema, software, etc.) e o que deverá ser feito.  
* Opcionalmente, declarar as condições e restrições, se houver.  
* Descrever cada entrada (estímulo) no sistema de software, cada saída (resposta) do sistema e todas as funções realizadas pelo sistema em resposta a uma entrada ou para suportar uma saída.  
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
Definir os componentes de software para os quais é necessária uma interface com o usuário. Descrever as características lógicas de cada interface entre o produto de software e os usuários. Isso pode incluir imagens de telas, quaisquer padrões de GUI ou guias de estilo de família de produtos a serem seguidos, restrições de layout de tela, botões e funções padrão (por exemplo, ajuda) que aparecerão em cada tela, atalhos de teclado, padrões de exibição de mensagens de erro, e assim por diante. Os detalhes do design da interface do usuário devem ser documentados em uma especificação separada.

Pode ser subdividido em requisitos de Usabilidade e Conveniência.

#### 3.1.2 Interfaces de Hardware
Descrever as características lógicas e físicas de cada interface entre o produto de software e os componentes de hardware do sistema. Isso pode incluir os tipos de dispositivos suportados, a natureza das interações de dados e controle entre o software e o hardware, e os protocolos de comunicação a serem utilizados.

#### 3.1.3 Interfaces de Software
Descrever as conexões entre este produto e outros componentes específicos de software (nome e versão), incluindo bancos de dados, sistemas operacionais, ferramentas, bibliotecas e componentes comerciais integrados. Identificar os itens de dados ou mensagens que entram e saem do sistema, descrevendo o propósito de cada um. Descrever os serviços necessários e a natureza da comunicação. Referenciar documentos que descrevam protocolos de API em detalhes. Identificar dados que serão compartilhados entre componentes. Se o mecanismo de compartilhamento de dados deve ser implementado de forma específica (por exemplo, uso de área de dados global em SO multitarefa), especificar isso como restrição de implementação.

### 3.2 Funcionais
> Esta seção especifica os requisitos dos efeitos funcionais que o software deve produzir no ambiente.

### 3.3 Qualidade de Serviço
> Esta seção apresenta requisitos adicionais relacionados à qualidade que os efeitos funcionais do software devem apresentar.

#### 3.3.1 Desempenho
Se houver requisitos de desempenho para o produto sob diversas circunstâncias, declará-los aqui e explicar a justificativa, para ajudar os desenvolvedores a entender a intenção e fazer escolhas adequadas de projeto. Especificar relações temporais para sistemas em tempo real. Fazer tais requisitos o mais específico possível. Pode ser necessário declarar requisitos de desempenho para funcionalidades individuais.

#### 3.3.2 Segurança
Especificar quaisquer requisitos de segurança ou privacidade relacionados ao uso do produto ou proteção dos dados usados ou criados. Definir requisitos de autenticação de identidade do usuário. Referenciar quaisquer políticas ou regulamentos externos que envolvam questões de segurança. Definir certificações que o produto deve satisfazer.

#### 3.3.3 Confiabilidade
Especificar os fatores necessários para estabelecer a confiabilidade requerida do sistema de software no momento da entrega.

#### 3.3.4 Disponibilidade
Especificar os fatores necessários para garantir um nível definido de disponibilidade para todo o sistema, como ponto de verificação, recuperação e reinicialização.

### 3.4 Conformidade
Especificar os requisitos derivados de normas ou regulamentos existentes, incluindo:
* Formato de relatórios  
* Nomenclatura de dados  
* Procedimentos contábeis  
* Rastreabilidade de auditoria  

Por exemplo, isso pode especificar que o software deva registrar toda atividade de processamento. Essas trilhas são necessárias em algumas aplicações para atender a padrões mínimos regulatórios ou financeiros. Um requisito de rastreamento de auditoria pode, por exemplo, exigir que todas as alterações em um banco de dados de folha de pagamento sejam registradas com os valores antes e depois.

### 3.5 Projeto e Implementação

#### 3.5.1 Instalação
Restrições para garantir que o software funcionará corretamente na plataforma de destino.

#### 3.5.2 Distribuição
Restrições nos componentes do software para se adequarem à estrutura geograficamente distribuída da organização, à distribuição dos dados ou dos dispositivos controlados.

#### 3.5.3 Manutenibilidade
Especificar atributos do software relacionados à facilidade de manutenção. Podem incluir requisitos de modularidade, interfaces ou limitação de complexidade. Requisitos não devem ser colocados aqui apenas por serem boas práticas de design.

#### 3.5.4 Reusabilidade
<!-- TODO: elaborar uma descrição -->

#### 3.5.5 Portabilidade
Especificar atributos relacionados à facilidade de portar o software para outras máquinas ou sistemas operacionais.

#### 3.5.6 Custo
Especificar o custo monetário do produto de software.

#### 3.5.7 Prazo
Especificar o cronograma de entrega do produto de software.

#### 3.5.8 Prova de Conceito
<!-- TODO: elaborar uma descrição -->

## 4. Verificação
> Esta seção fornece as abordagens e métodos de verificação planejados para qualificar o software. As informações de verificação devem ser fornecidas paralelamente aos itens de requisitos da Seção 3. O propósito do processo de verificação é fornecer evidências objetivas de que um sistema ou elemento do sistema atende aos requisitos e características especificadas.

<!-- TODO: adicionar mais orientações, semelhante à seção 3 -->
<!-- ieee 15288:2015 -->

## 5. Apêndices
