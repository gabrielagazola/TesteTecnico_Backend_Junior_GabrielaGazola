# Teste Técnico - Backend Júnior - Construção de API - CodeIgniter 4

Esta API foi construída utilizando o framework **CodeIgniter 4** e segue o padrão RESTful para a manipulação de postagens. O projeto inclui funcionalidades para **listar**, **criar**, **atualizar** e **excluir** postagens.

## Tecnologias Utilizadas

- PHP 7.x ou superior
- CodeIgniter 4
- MySQL
- Composer (para gerenciar dependências)
- cURL (para testar a API via terminal)

## Requisitos

Antes de executar o projeto, garanta que possui os seguintes itens instalados:

- **PHP 7.x ou superior**
- **Composer**
- **MySQL**

## Instalação e Configuração

### Passo 1: Clonar o Repositório

```bash
git clone https://github.com/gabrielagazola/TesteTecnico_Backend_Junior_GabrielaGazola
cd TesteTecnico_Backend_Junior_GabrielaGazola
```

### Passo 2: Instalar Dependências

```bash
composer install
```

### Passo 3: Configurar o Banco de Dados

Crie um banco de dados no MySQL:

```sql
CREATE DATABASE minha_api_db;
```

Edite o arquivo `.env` e configure as credenciais do banco:

```
database.default.hostname = localhost
database.default.database = minha_api_db
database.default.username = root
database.default.password = testetecnico
```

### Passo 4: Construção do Banco de Dados

#### Migrações
As tabelas do banco de dados são criadas usando migrações do CodeIgniter 4. As migrações garantem que a estrutura do banco esteja sempre atualizada e podem ser executadas com:

```bash
php spark migrate
```

Isso criará a tabela `posts` com os seguintes campos:

- **id**: Chave primária, auto-incremento.
- **title**: Título do post (VARCHAR 255).
- **content**: Conteúdo do post (TEXT).
- **created_at** e **updated_at**: Campos de timestamp gerenciados automaticamente.

A migração correspondente pode ser encontrada em `app/Database/Migrations/XXXX_XX_XX_CreatePostsTable.php`.

#### Seeders
Para popular o banco de dados com dados iniciais, execute o seeder:

```bash
php spark db:seed PostSeeder
```

Isso adicionará alguns posts de exemplo na tabela `posts`.

### Passo 5: Iniciar o Servidor

```bash
php spark serve
```

A API estará acessível em `http://localhost:8080/posts`.

---

## Endpoints da API

### Listar todos os posts

```bash
curl http://localhost:8080/posts
```

### Obter um post por ID

```bash
curl http://localhost:8080/posts/1
```

### Criar um novo post

```bash
curl -X POST http://localhost:8080/posts \
-H "Content-Type: application/json" \
-d '{"title": "Novo Post", "content": "Conteúdo do novo post"}'
```

### Atualizar um post

```bash
curl -X PUT http://localhost:8080/posts/1 \
-H "Content-Type: application/json" \
-d '{"title": "Post Atualizado", "content": "Conteúdo atualizado"}'
```

### Excluir um post

```bash
curl -X DELETE http://localhost:8080/posts/1
```

---

## Possíveis Erros e Soluções

### 1. Erro: `404 Not Found`

**Solução:** Verifique se o servidor está rodando (`php spark serve`).

### 2. Erro: `SQLSTATE[HY000] [1045] Access denied for user`

**Solução:** Verifique as credenciais no arquivo `.env`.

### 3. Erro: `Class not found`

**Solução:** Rode `composer dump-autoload` e tente novamente.

### 4. Erro: `Table 'minha_api_db.posts' doesn't exist`

**Solução:** Rode `php spark migrate` para criar as tabelas.

---

### Autor

Desenvolvido por **Gabriela Machado Gazola**.

