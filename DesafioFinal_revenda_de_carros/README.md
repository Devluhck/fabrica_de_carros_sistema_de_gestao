# 🚗 Sistema de Fábrica de Carros

Sistema web desenvolvido em PHP para gerenciamento de uma fábrica de carros, permitindo fabricar, vender e visualizar informações dos veículos.

## 📋 Descrição

Este sistema permite gerenciar o estoque de uma fábrica de carros através de uma interface web simples e intuitiva. O usuário pode fabricar múltiplos carros, vender carros específicos e visualizar todas as informações dos carros disponíveis na fábrica.

## 🏗️ Estrutura do Projeto

```
fabrica/
├── assets/
│   ├── css/
│   │   └── estilo.css          # Estilos CSS do sistema
│   └── js/
│       └── validacoes.js       # Scripts JavaScript (se necessário)
├── controlador/
│   └── processa.php            # Script principal que processa todas as ações
├── modelo/
│   ├── Carro.php               # Classe que representa um carro
│   └── Fabrica.php             # Classe que gerencia a fábrica e seus carros
├── visualizacao/
│   └── index.php               # Interface do menu principal
├── index.html                  # Página inicial (redireciona para o menu)
└── README.md                   # Este arquivo
```

## 🎯 Funcionalidades

### 1. Fabricar Carros
- Permite fabricar múltiplos carros de uma vez
- Solicita a quantidade de carros a serem fabricados
- Para cada carro, coleta:
  - **Modelo** (obrigatório)
  - **Cor** (obrigatório)
  - **Marca** (opcional)
  - **Ano** (opcional)
  - **Placa** (opcional)
  - **Preço** (opcional)

### 2. Vender um Carro
- Permite vender um carro específico da fábrica
- Solicita o **modelo** e a **cor** do carro a ser vendido
- Remove o carro do estoque após a venda bem-sucedida
- Valida se o carro existe antes de realizar a venda

### 3. Ver Informações dos Carros
- Exibe uma lista completa de todos os carros fabricados
- Mostra todas as informações de cada carro usando os métodos getters
- Exibe o total de carros disponíveis na fábrica

### 4. Finalizar Sessão
- Limpa todos os dados da sessão
- Permite iniciar uma nova sessão de trabalho

## 🔧 Tecnologias Utilizadas

- **PHP 7.4+**: Linguagem de programação server-side
- **HTML5**: Estrutura das páginas
- **CSS3**: Estilização da interface
- **Sessions PHP**: Armazenamento temporário dos dados da fábrica

## 📦 Classes do Sistema

### Classe `Carro`
Representa um carro individual com os seguintes atributos:

**Atributos Obrigatórios:**
- `modelo` (string): Modelo do carro
- `cor` (string): Cor do carro

**Atributos Opcionais:**
- `ano` (string|null): Ano do carro
- `marca` (string|null): Marca do carro
- `placa` (string|null): Placa do carro
- `preco` (float|null): Preço do carro

**Métodos:**
- Getters e setters para todos os atributos
- Construtor que recebe modelo e cor como parâmetros obrigatórios

### Classe `Fabrica`
Gerencia o estoque de carros da fábrica.

**Atributos:**
- `carros` (array): Array privado que armazena todos os carros fabricados

**Métodos:**
- `fabricarCarro(int $quantidade, array $dadosCarros)`: Fabricar múltiplos carros usando um loop `for`
- `venderCarro(string $modelo, string $cor)`: Remove um carro do array pelo modelo e cor
- `listarCarros()`: Retorna uma string HTML com todas as informações dos carros usando os métodos `get()` de cada atributo
- `getCarros()`: Retorna o array de carros
- `setCarros(array $carros)`: Define o array de carros

## 🚀 Como Usar

### Requisitos
- Servidor web (Apache, Nginx, etc.)
- PHP 7.4 ou superior
- Navegador web moderno

### Instalação
1. Clone ou baixe o projeto para o diretório do seu servidor web (ex: `htdocs` no XAMPP)
2. Certifique-se de que o servidor web está configurado para executar PHP
3. Acesse o sistema através do navegador:
   ```
   http://localhost/fabrica/
   ```
   ou
   ```
   http://localhost/fabrica/visualizacao/index.php
   ```

### Uso do Sistema

1. **Fabricar Carros:**
   - Clique em "Fabricar Carros" no menu
   - Informe a quantidade de carros a serem fabricados
   - Preencha os dados de cada carro (modelo e cor são obrigatórios)
   - Clique em "Fabricar Carros"

2. **Vender um Carro:**
   - Clique em "Vender um Carro" no menu
   - Informe o modelo e a cor do carro a ser vendido
   - Clique em "Vender Carro"

3. **Ver Informações:**
   - Clique em "Ver Informações dos Carros" no menu
   - Visualize todos os carros fabricados e suas informações

4. **Finalizar Sessão:**
   - Clique em "Finalizar Sessão" para limpar todos os dados
   - Isso permite iniciar uma nova sessão de trabalho

## 📝 Observações Importantes

- Os dados são armazenados na sessão PHP, portanto serão perdidos quando a sessão expirar ou for finalizada
- O sistema valida a existência do carro antes de realizar a venda
- Modelo e cor são os únicos campos obrigatórios para fabricar um carro
- O sistema permite fabricar múltiplos carros de uma vez através de um loop `for`

## 🎓 Conceitos Aplicados

- **Programação Orientada a Objetos (POO)**: Uso de classes, objetos, encapsulamento
- **Sessions**: Armazenamento temporário de dados
- **MVC (Model-View-Controller)**: Separação de responsabilidades
- **Validação de Dados**: Verificação de dados obrigatórios e opcionais
- **Manipulação de Arrays**: Adição e remoção de elementos

## 👨‍💻 Desenvolvimento

Este sistema foi desenvolvido como projeto acadêmico para demonstrar conceitos de programação orientada a objetos em PHP, gerenciamento de sessões e desenvolvimento web.

## 📄 Licença

Este projeto é de uso educacional.
