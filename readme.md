# [Projeto Base - Exemplo] Reserva de Salas

Projeto em Laravel 6, utilizando Laravel 6 e CoreUI. 

## O que contém

- Painel admnistrativo baseado no [CoreUI theme](https://coreui.io/) 
- Gerenciamento de Usuários, Regras e Permissões
- Suporte a multi-idiomas
- CRUD de Salas
- Gerenciamento de Reserva de Salas por usuário
- Possibilidade de exportar os dados para CSV, PDF, Excel.
- Pesquisa, paginação, filtros. 
- Envio de e-mail para novos usuários, alteração de senha.
- API disponível em http://__seu_endereco__/api/v1/users
- Recursos disponíveis *users* *rooms* *bookings* *permissions* *roles*
- Dump inicial conforme solicitado em dump/init.sql

## Como Instalar

- Clonar esse repositório com __git clone__
- Faça uma cópia de __.env.example__ para __.env__ então edite as credenciais da sua base de dados
- Execute o comando __composer install__
- Execute o comando __php artisan key:generate__
- Execute o comando __php artisan migrate --seed__ (irá popular com alguns dados pré-definidos)
- Execute o comando __php artisan storage:link__
- Acesse a URL principal ou vá para o __/login__ e logue com as credenciais __admin@admin.com__ e senha  __ditechguy__

## Mailtrap

- Para acessar os e-mails, acesse: https://mailtrap.io/
- Usuário: zarpelon@gmail.com
- Senha: ditechguy

Para maiores informações contatar pelo e-mail zarpelon@gmail.com
