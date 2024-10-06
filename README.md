# bolos-plugin

Este repositório contém um plugin WordPress para o cadastro e exibição de receitas de bolos, desenvolvido para facilitar a gestão e apresentação de receitas em seu site. O projeto está configurado para ser executado em um ambiente Docker, utilizando o Docker Compose para orquestrar os contêineres necessários.

## Funcionalidades

- **Post Type Personalizado**: Cadastro de receitas com campos personalizados (Título, Imagem, Descrição, Tempo de Preparo e Ingredientes).
- **Taxonomia Personalizada**: Categorias para organizar as receitas.
- **Template Archive**: Exibição das receitas com Imagem, Título e Tempo de Preparo.
- **Filtro por Categoria**: Selectbox para filtrar receitas por categorias disponíveis.

## Pré-requisitos

- **Git**: Para clonar o repositório.
- **Docker** e **Docker Compose**: Para executar o ambiente de desenvolvimento.
- **Portas Disponíveis**: Certifique-se de que as portas `8000` (WordPress) e `3306` (MySQL) estejam disponíveis em seu sistema.

## Instalação

### 1. Clonar o Repositório

Clone o repositório em sua máquina local:

```bash
git clone https://github.com/seu-usuario/receitas-bolos.git
cd receitas-bolos
```

### 3. Subir os Contêineres com Docker Compose

Inicie os contêineres do Docker:

```bash
docker-compose up -d
```

Isso irá iniciar os seguintes serviços:

- **db**: Contêiner MySQL.
- **wordpress**: Contêiner WordPress.

### 4. Instalar o WordPress

- Acesse `http://localhost:8000` em seu navegador.
- Siga as instruções na tela para configurar o WordPress.

### 5. Instalar os Plugins Necessários

#### Advanced Custom Fields (ACF)

Instale e ative o plugin **Advanced Custom Fields**:

- No painel administrativo do WordPress, vá para **Plugins > Adicionar Novo**.
- Pesquise por **Advanced Custom Fields**.
- Clique em **Instalar** e, em seguida, **Ativar**.

### 6. Ativar o Plugin Receitas de Bolos

- O plugin já está presente na pasta `wp-content/plugins/receitas-bolos`.
- No painel administrativo do WordPress, vá para **Plugins > Plugins Instalados**.
- Encontre **Receitas de Bolos** e clique em **Ativar**.

## Uso

### Cadastro de Receitas

- No menu lateral do WordPress, clique em **Receitas > Adicionar Nova**.
- Preencha os campos:
  - **Título**
  - **Imagem Destacada**
  - **Descrição**
  - **Tempo de Preparo**
  - **Ingredientes**
- Publique a receita.

### Categorias de Receitas

- Vá para **Receitas > Categorias** para criar ou editar categorias.
- As categorias podem ser usadas para filtrar receitas no front-end.

### Visualização

- **Página de Arquivo**: Acesse `http://localhost:8000/receitas` para ver todas as receitas.
- **Filtro por Categoria**: Use o selectbox no topo da página para filtrar receitas por categoria.
- **Detalhes da Receita**: Clique em uma receita para ver os detalhes completos e sugestões de outras receitas na seção "Veja Mais".
