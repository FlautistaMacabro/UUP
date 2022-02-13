<?php

use App\Core\Response;
use App\Controller\Intranet\Admin;

//ROTAS ADMIN (GET)
$router->get('/admin', [
    'middlewares' => [
        'require-intranet-login',
        'require-admin-permission'
    ],
    function(){
        return new Response(200, Admin\Dashboard::getDashboard());
    }
]);

$router->get('/admin/', [
    'middlewares' => [
        'require-intranet-login',
        'require-admin-permission'
    ],
    function(){
        return new Response(200, Admin\Dashboard::getDashboard());
    }
]);


//ROTA ADMIN CURSOS (GET)
$router->get('/admin/cursos', [
    'middlewares' => [
        'require-intranet-login',
        'require-admin-permission'
    ],
    function($request){
        return new Response(200, Admin\Cursos::getCursos($request));
    }
]);


//ROTA ADMIN USERS (GET)
$router->get('/admin/users', [
    'middlewares' => [
        'require-intranet-login',
        'require-admin-permission'
    ],
    function(){
        return new Response(200, Admin\Users::getUsers());
    }
]);

//ROTA ADMIN ALTERAR SENHA (GET)
$router->get('/admin/password', [
    'middlewares' => [
        'require-intranet-login',
        'require-admin-permission'
    ],
    function(){
        return new Response(200, Admin\AlterarSenha::getAlterarSenha());
    }
]);

//ROTA ADMIN ALTERAR SENHA (POST)
$router->post('/admin/password', [
    'middlewares' => [
        'require-intranet-login',
        'require-admin-permission'
    ],
    function($request){
        return new Response(200, Admin\AlterarSenha::setNewPassword($request));
    }
]);
