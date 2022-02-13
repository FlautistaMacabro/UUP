<?php

use App\Core\Response;
use App\Controller\Intranet;

//AUTENTICAÇÃO

//ROTAS INTRANET (GET)
$router->get('/intranet', [
function($request) {$request->getRouter()->redirect('/intranet/login');} ]);

$router->get('/intranet/', [
function($request) {$request->getRouter()->redirect('/intranet/login');} ]);


//ROTA INTRANET LOGIN (GET)
$router->get('/intranet/login', [
    'middlewares' => [
        'require-intranet-logout'
],
function($request){
    return new Response(200, Intranet\Login::getLogin($request));
}
]);

//ROTA INTRANET LOGIN (POST)
$router->post('/intranet/login', [
'middlewares' => [
        'require-intranet-logout'
],
function($request){
    return new Response(200, Intranet\Login::authentication($request));
}
]);

//ROTA INTRANET LOGOUT (GET)
$router->get('/intranet/logout', [
'middlewares' => [
    'require-intranet-login'
],
function($request){
    return new Response(200, Intranet\Login::logout($request));
}
]);