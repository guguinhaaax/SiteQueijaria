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
> Esta seção deve fornecer uma visão geral de todo o documento

### 1.1 Objetivo do Documento
Descrever o propósito da ERS e seu público-alvo.

### 1.2 Escopo do Produto
Identificar o produto cujos requisitos de software são especificados neste documento, incluindo o número da revisão ou versão. Explicar o que o produto abordado por esta ERS fará, especialmente se esta ERS descreve apenas parte do sistema ou um único subsistema. Fornecer uma descrição breve do software especificado e seu propósito, incluindo benefícios, objetivos e metas relevantes. Relacionar o software com os objetivos corporativos ou estratégias de negócio. Se houver um documento separado de visão e escopo, referenciar este documento ao invés de duplicar seu conteúdo aqui.

### 1.3 Definições, Acrônimos e Abreviações

### 1.4 Referências
Listar quaisquer outros documentos ou endereços web aos quais esta ERS se refere. Estes podem incluir guias de estilo de interface do usuário, contratos, normas, especificações de requisitos do sistema, documentos de casos de uso ou um documento de visão e escopo. Fornecer informações suficientes para que o leitor possa acessar uma cópia de cada referência, incluindo título, autor, número da versão, data e fonte ou localização.

### 1.5 Visão Geral do Documento
Descrever o que o restante do documento contém e como está organizado.

## 2. Visão Geral do Produto
> Esta seção deve descrever os fatores gerais que afetam o produto e seus requisitos. Esta seção não declara requisitos específicos. Em vez disso, fornece um contexto para esses requisitos, definidos em detalhes na Seção 3, e facilita sua compreensão.

### 2.1 Perspectiva do Produto
Descrever o contexto e a origem do produto especificado nesta ERS. Por exemplo, indicar se o produto é um membro sucessor de uma família de produtos, um substituto para certos sistemas existentes ou um produto novo e autônomo. Se a ERS define um componente de um sistema maior, relacionar os requisitos do sistema maior à funcionalidade deste software e identificar interfaces entre ambos. Um diagrama simples mostrando os principais componentes do sistema, interconexões de subsistemas e interfaces externas pode ser útil.

### 2.2 Funções do Produto
Resumir as principais funções que o produto deve executar ou permitir que o usuário execute. Os detalhes serão fornecidos na Seção 3, então aqui é necessário apenas um resumo de alto nível (como uma lista com marcadores). Organizar as funções para torná-las compreensíveis a qualquer leitor da ERS. Uma figura com grupos principais de requisitos relacionados e suas relações, como um diagrama de fluxo de dados de alto nível ou diagrama de classes de objetos, pode ser eficaz.

### 2.3 Restrições do Produto
Esta subseção deve fornecer uma descrição geral de quaisquer itens que limitarão as opções do desenvolvedor. Estes podem incluir:

* Interfaces com usuários, outros aplicativos ou hardware.  
* Restrições de qualidade de serviço.  
* Conformidade com normas.  
* Restrições de projeto ou implementação.

### 2.4 Características dos Usuários
Identificar as várias classes de usuários que se prevê utilizar este produto. As classes de usuários podem ser diferenciadas com base na frequência de uso, subconjunto de funções utilizadas, conhecimento técnico, níveis de segurança ou privilégio, nível educacional ou experiência. Descrever as características relevantes de cada classe de usuário. Certos requisitos podem se aplicar apenas a determinadas classes. Distinguir as classes de usuários mais importantes daquelas cuja satisfação é menos crítica.

### 2.5 Suposições e Dependências
Listar quaisquer fatores assumidos (em oposição a fatos conhecidos) que possam afetar os requisitos declarados na ERS. Estes podem incluir componentes comerciais ou de terceiros que se planeja utilizar, questões relacionadas ao ambiente de desenvolvimento ou operação, ou restrições. O projeto poderá ser afetado se essas suposições forem incorretas, não forem compartilhadas ou mudarem. Identificar também quaisquer dependências externas do projeto, como componentes de software a serem reutilizados de outro projeto, a menos que já estejam documentadas em outro lugar (por exemplo, no documento de visão e escopo ou plano do projeto).

### 2.6 Rateio de Requisitos
Distribuir os requisitos de software entre os elementos de software. Para requisitos que exigirão implementação em vários elementos, ou quando a alocação a um elemento ainda estiver indefinida, isso deve ser declarado. Uma tabela de referência cruzada por função e elemento de software deve ser usada para resumir o rateio.

Identificar requisitos que podem ser adiados para versões futuras do sistema (por exemplo, blocos ou incrementos).

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
