# Ditech - Reserva de Salas

Projeto em Laravel 6, utilizando CoreUI para o teste de desenvolvedor PHP na Diteh. 

## O que contém

- Painel admnistrativo baseado no [CoreUI theme](https://coreui.io/) 
- Gerenciamento de Usuários, Regras e Permissões
- CRUD de Salas
- Gerenciamento de Reserva de Salas por usuário
- API disponível em http://__seu_endereco__/api/v1/users
- Recursos disponíveis *users* *rooms* *bookings* *permissions* *roles*

## Como Instalar

- Clonar esse repositório com __git clone__
- Faça uma cópia de __.env.example__ para __.env__ and edite as credenciais da sua base de dados
- Execute o comando __composer install__
- Execute o comando __php artisan key:generate__
- Execute o comando __php artisan migrate --seed__ (irá popular com alguns dados pré-definidos)
- Execute o comando __php artisan storage:link__
- Acesse a URL principal ou vá para o __/login__ e logue com as credenciais __admin@admin.com__ e senha  __ditechguy__

Para maiores informações contatar pelo e-mail zarpelon@gmail.com