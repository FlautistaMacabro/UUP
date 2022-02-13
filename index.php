<?php

require __DIR__.'/includes/app.php';

use \App\Core\Router;
use \App\Database\Database;

$database = new Database();

//Inicia o router
$router = new Router($_ENV['URL']);


//Inclui as rotas possíveis dependendo do tipo de usuário
include __DIR__.'/routes/routes.php';


//Imprime o response da rota
$router->run()->sendResponse();

