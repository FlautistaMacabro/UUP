<?php

use App\Core\Response;
use App\Controller\Intranet\Coord;

//ROTA COORD (GET)
$router->get('/coord', [
    'middlewares' => [
        'require-intranet-login',
        'require-coord-permission'
    ],
    function(){
        return new Response(200, Coord\Dashboard::getDashboard());
    }
]);

//ROTA COORD (GET)
$router->get('/coord/', [
    'middlewares' => [
        'require-intranet-login',
        'require-coord-permission'
    ],
    function(){
        return new Response(200, Coord\Dashboard::getDashboard());
    }
]);

//ROTA COORD DISCIPLINAS BASE (GET)
$router->get('/coord/discbase', [
    'middlewares' => [
        'require-intranet-login',
        'require-coord-permission'
    ],
    function($request){
        return new Response(200, Coord\DisciplinasBase::getDiscBase($request));
    }
]);

//ROTA COORD DISCIPLINAS BASE (POST)
$router->post('/coord/discbase', [
    'middlewares' => [
        'require-intranet-login',
        'require-coord-permission'
    ],
    function($request){
        return new Response(200, Coord\DisciplinasBase::postDisciplina($request));
    }
]);

//ROTA COORD AVISOS (GET)
$router->get('/coord/avisos', [
    'middlewares' => [
        'require-intranet-login',
        'require-coord-permission'
    ],
    function(){
        return new Response(200, '');
    }
]);

//ROTA COORD PERIODO (GET)
$router->get('/coord/periodo', [
    'middlewares' => [
        'require-intranet-login',
        'require-coord-permission'
    ],
    function(){
        return new Response(200, '');
    }
]);


//ROTA COORD ALTERAR SENHA (GET)
$router->get('/coord/password', [
    'middlewares' => [
        'require-intranet-login',
        'require-coord-permission'
    ],
    function(){
        return new Response(200, Coord\AlterarSenha::getAlterarSenha());
    }
]);


//ROTA COORD ALTERAR SENHA (POST)
$router->post('/coord/password', [
    'middlewares' => [
        'require-intranet-login',
        'require-coord-permission'
    ],
    function($request){
        return new Response(200, Coord\AlterarSenha::setNewPassword($request));
    }
]);
