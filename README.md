# Sistema de Gerenciamento de Academia

Este é um sistema de gerenciamento de academia construído usando o framework Laravel e o template AdminLTE para a interface de usuário.

## Características Principais

- Autenticação por login e senha.
- Manipulação de sessão para dados do usuário autenticado.
- Níveis de permissão de usuário para acesso controlado.
- Herança de dados para diferentes entidades do sistema.
- Modelagem de dados abrangendo alunos, instrutores, planos, pagamentos e mais.
- Modelagem de projeto e estrutura de banco de dados bem definida.

## Funcionalidades

- CRUD (Create, Read, Update, Delete) para alunos, instrutores, planos e outros recursos.
- Utilização de janelas modais para interações mais amigáveis.
- Direcionamento otimizado com uso do Blade para renderização.
- Gráficos dinâmicos usando a biblioteca Chart.js para visualização de estatísticas.
- Design responsivo para funcionamento em diversos dispositivos.
- Validação de campos para garantir dados consistentes.
- Requisições Ajax para melhorar a experiência do usuário.
- Utilização do Webpack para otimização de recursos front-end.

## Autenticação e Autorização

- O sistema implementa autenticação com Laravel.
- As senhas são armazenadas de forma segura usando a função bcrypt().
- O middleware de autenticação é usado para proteger rotas específicas.
- Configuração do arquivo `auth.php` para personalizar o modelo de autenticação.

## Estrutura do Banco de Dados

O banco de dados é estruturado da seguinte forma:

- Tabela `pessoas` contendo informações gerais de indivíduos.
- Tabelas relacionadas a endereços, contatos, alunos, instrutores, planos e pagamentos.
- Relacionamentos definidos usando Eloquent para consultas complexas.

## API e Webhooks

- Uma API foi criada para fornecer o histórico de pagamentos.
- Autenticação JWT é usada para proteger as rotas da API.
- Exemplo de uso de webhooks para processamento de pagamentos.

## Outras Funcionalidades Propostas

- Implementação de diferentes APIs para obter informações sobre alunos, instrutores, planos, etc.
- Discussão sobre segurança da API e autenticação JWT.
- Utilização do componente modal do AdminLTE para exibição de informações.
- Discussão sobre estratégias de design responsivo.

## Como Iniciar o Projeto

1. Clone este repositório.
2. Configure o arquivo `.env` com as informações de banco de dados.
3. Execute `composer install` para instalar as dependências do Laravel.
4. Execute `php artisan key:generate` para gerar a chave de aplicação.
5. Execute `php artisan migrate` para criar as tabelas do banco de dados.
6. Execute `php artisan serve` para iniciar o servidor local.

Sinta-se à vontade para explorar as funcionalidades e personalizar o sistema de acordo com suas necessidades.
