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
    function(){
        return new Response(200, '');
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

//ROTA COORD ABRIR SEMESTRE (GET)
$router->get('/coord/abrirsemestre', [
    'middlewares' => [
        'require-intranet-login',
        'require-coord-permission'
    ],
    function(){
        return new Response(200, Coord\AbrirSemestre::getAbrirSemestre());
    }
]);


//ROTA COORD ABRIR SEMESTRE (POST)
$router->post('/coord/abrirsemestre', [
    'middlewares' => [
        'require-intranet-login',
        'require-coord-permission'
    ],
    function($request){
        return new Response(200, Coord\AbrirSemestre::getAbrirSemestre($request));
    }
]);

//ROTA COORD FECHAR SEMESTRE (GET)
$router->get('/coord/fecharsemestre', [
    'middlewares' => [
        'require-intranet-login',
        'require-coord-permission'
    ],
    function(){
        return new Response(200, Coord\FecharSemestre::getFecharSemestre());
    }
]);


//ROTA COORD FECHAR SEMESTRE (POST)
$router->post('/coord/fecharsemestre', [
    'middlewares' => [
        'require-intranet-login',
        'require-coord-permission'
    ],
    function($request){
        return new Response(200, Coord\FecharSemestre::getFecharSemestre($request));
    }
]);

//ROTA COORD ABRIR REMATRÍCULA (GET)
$router->get('/coord/abrirrematricula', [
    'middlewares' => [
        'require-intranet-login',
        'require-coord-permission'
    ],
    function(){
        return new Response(200, Coord\AbrirRematricula::getAbrirRematricula());
    }
]);


//ROTA COORD ABRIR REMATRÍCULA (POST)
$router->post('/coord/abrirrematricula', [
    'middlewares' => [
        'require-intranet-login',
        'require-coord-permission'
    ],
    function($request){
        return new Response(200, Coord\AbrirRematricula::getAbrirRematricula($request));
    }
]);

//ROTA COORD FECHAR REMATRÍCULA (GET)
$router->get('/coord/fecharrematricula', [
    'middlewares' => [
        'require-intranet-login',
        'require-coord-permission'
    ],
    function(){
        return new Response(200, Coord\FecharRematricula::getFecharRematricula());
    }
]);


//ROTA COORD FECHAR REMATRÍCULA (POST)
$router->post('/coord/fecharrematricula', [
    'middlewares' => [
        'require-intranet-login',
        'require-coord-permission'
    ],
    function($request){
        return new Response(200, Coord\FecharRematricula::getFecharRematricula($request));
    }
]);
