<?php

//Pacotes composer
require __DIR__.'/../vendor/autoload.php';
//Variáves de Ambiente
require __DIR__.'/environment.php';

use App\Utils\View;
use App\Database\Database;
use App\Core\Middleware\Queue as MiddlewareQueue;

//Configurando a conexão com o banco
Database::config(
    $_ENV['DB_HOST'],
    $_ENV['DB_NAME'],
    $_ENV['DB_USER'],
    $_ENV['DB_PASS']
);

//Define valor padrão das variáveis
View::init([
    'URL'=> $_ENV['URL']
]);

//Define o mapeamento de middlewares
MiddlewareQueue::setMap([
    'maintenance' => App\Core\Middleware\Maintenance::class,
    'require-intranet-logout' => App\Core\Middleware\RequireIntranetLogout::class,
    'require-intranet-login' => App\Core\Middleware\RequireIntranetLogin::class
]);

//Define o mapeamento de middlewares padrões (executados em todas as rotas)
MiddlewareQueue::setDefault([
    'maintenance'
]);