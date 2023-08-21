# Sistema de Gerenciamento de Academia

Este é um sistema de gerenciamento de academia construído usando o framework Laravel na sua versão 8x e PHP 7.4 e o template AdminLTE para a interface de usuário.

## Características Principais

- Autenticação por login e senha valendo-se do recurso Auth
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

- Uma API foi criada para fornecer o histórico de pagamentos simulando que os planos disponíveis estivessem publicados e aptos à venda na plataforma da Eduzz
- Autenticação é usada para proteger as rotas da API.
- Exemplo de uso de webhooks para processamento de pagamentos.

## Possibilidades de Expansão do Projeto

1. Inclusão de Imagens de Perfil - Permita que os usuários façam o upload de fotos para seus perfis.
2. Upload de Arquivos - Implemente a capacidade de os alunos enviarem exames, laudos médicos e outros documentos relevantes, armazenando esses arquivos de forma segura e acessível.
3. Tabela de Dados de Saúde - Introduza uma tabela específica para dados de saúde do aluno, como histórico médico, alergias e restrições.
4. Sistema de Cobrança Integrado - Desenvolva um sistema de cobrança de mensalidades integrado. Envie lembretes de pagamento via WhatsApp ou e-mail e até outros canais

## Como Iniciar o Projeto

1. Clone este repositório.
2. Configure o arquivo `.env` com as informações de banco de dados.
3. Execute `composer install` para instalar as dependências do Laravel.
4. Execute `php artisan key:generate` para gerar a chave de aplicação.
5. Execute `php artisan migrate` para criar as tabelas do banco de dados.
6. Execute `php artisan serve` para iniciar o servidor local.

Sinta-se à vontade para explorar as funcionalidades e personalizar o sistema de acordo com suas necessidades.



