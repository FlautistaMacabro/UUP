<?php

use App\Core\Response;
use App\Controller\Public;

//AUTENTICAÇÃO

//ROTA LOGIN (GET)
$router->get('/login', [
    'middlewares' => [
        'require-logout'
],
function(){
    return new Response(200, Public\Login::getLogin());
}
]);

//ROTA INTRANET LOGIN (POST)
$router->post('/login', [
'middlewares' => [
    'require-logout'
],
function($request){
    return new Response(200, Public\Login::authentication($request));
}
]);

//ROTA INTRANET LOGOUT (GET)
$router->get('/logout', [
'middlewares' => [
    'require-login'
],
function($request){
    return new Response(200, Public\Login::logout($request));
}
]);