# RH Management System

Este é um sistema de gerenciamento de recursos humanos desenvolvido em Laravel. Ele permite gerenciar colaboradores, departamentos e permissões de usuários.

## Funcionalidades

- Gerenciamento de colaboradores
- Gerenciamento de departamentos
- Controle de permissões de usuários
- Autenticação e autorização
- Envio de e-mails de confirmação de conta

## Requisitos

- PHP >= 8.0
- Composer
- MySQL
- Node.js (para compilação de assets)

## Instalação

1. Clone o repositório:

    ```sh
    git clone https://github.com/seu-usuario/rh_mangnt.git
    cd rh_mangnt
    ```

2. Instale as dependências do PHP:

    ```sh
    composer install
    ```

3. Instale as dependências do Node.js:

    ```sh
    npm install
    ```

4. Copie o arquivo `.env.example` para `.env` e configure suas variáveis de ambiente:

    ```sh
    cp .env.example .env
    ```

5. Gere a chave da aplicação:

    ```sh
    php artisan key:generate
    ```

6. Configure o banco de dados no arquivo `.env` e execute as migrações:

    ```sh
    php artisan migrate
    ```

7. Compile os assets:

    ```sh
    npm run dev
    ```

8. Inicie o servidor de desenvolvimento:

    ```sh
    php artisan serve
    ```

## Uso

- Acesse o sistema em `http://localhost:8000`.
- Faça login com suas credenciais.
- Navegue pelas funcionalidades do sistema para gerenciar colaboradores, departamentos e permissões.

## Estrutura do Projeto

- `app/Http/Controllers`: Controladores da aplicação.
- `app/Models`: Modelos da aplicação.
- `resources/views`: Views da aplicação.
- `routes/web.php`: Definição das rotas da aplicação.

## Contribuição

1. Faça um fork do projeto.
2. Crie uma branch para sua feature (`git checkout -b feature/nova-feature`).
3. Commit suas mudanças (`git commit -am 'Adiciona nova feature'`).
4. Envie para o repositório remoto (`git push origin feature/nova-feature`).
5. Abra um Pull Request.

## Licença

Este projeto está licenciado sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.
