<?php

use App\Core\Response;
use App\Controller\Intranet\Professor;

//ROTA PROFESSOR (GET)
$router->get('/professor', [
    'middlewares' => [
        'require-intranet-login',
        'require-professor-permission'
    ],
    function(){
        return new Response(200, Professor\Dashboard::getDashboard());
    }
]);

//ROTA PROFESSOR (GET)
$router->get('/professor/', [
    'middlewares' => [
        'require-intranet-login',
        'require-professor-permission'
    ],
    function(){
        return new Response(200, Professor\Dashboard::getDashboard());
    }
]);

//ROTA PROFESSOR DISCIPLINAS (GET)
$router->get('/professor/disciplinas', [
    'middlewares' => [
        'require-intranet-login',
        'require-professor-permission'
    ],
    function($request){
        return new Response(200, Professor\Disciplinas::getDisciplinas($request));
    }
]);


//ROTA PROFESSOR DISCIPLINAS (GET)
$router->get('/professor/disciplinas/{id}', [
    'middlewares' => [
        'require-intranet-login',
        'require-professor-permission'
    ],
    function($request, $id){
        return new Response(200, Professor\Disciplinas::manageDisciplina($request, $id));
    }
]);


//ROTA PROFESSOR DISCIPLINAS (GET)
$router->get('/professor/discAula/{id}', [
    'middlewares' => [
        'require-intranet-login',
        'require-professor-permission'
    ],
    function($request, $id){
        return new Response(200, Professor\Aulas::getAulas($request, $id));
    }
]);


//ROTA PROFESSOR DISCIPLINAS (POST)
$router->post('/professor/discAula/{id}', [
    'middlewares' => [
        'require-intranet-login',
        'require-professor-permission'
    ],
    function($request, $id){
        return new Response(200, Professor\Aulas::postAulas($request, $id));
    }
]);



//ROTA PROFESSOR DISCIPLINAS (GET)
$router->get('/professor/avisosprof/{id}', [
    'middlewares' => [
        'require-intranet-login',
        'require-professor-permission'
    ],
    function($request, $id){
        return new Response(200, Professor\Avisos::getAvisos($request, $id));
    }
]);


//ROTA PROFESSOR DISCIPLINAS (POST)
$router->post('/professor/avisosprof/{id}', [
    'middlewares' => [
        'require-intranet-login',
        'require-professor-permission'
    ],
    function($request, $id){
        return new Response(200, Professor\Avisos::postAulas($request, $id));
    }
]);


//ROTA PROFESSOR ALTERAR SENHA (GET)
$router->get('/professor/password', [
    'middlewares' => [
        'require-intranet-login',
        'require-professor-permission'
    ],
    function(){
        return new Response(200, Professor\AlterarSenha::getAlterarSenha());
    }
]);


//ROTA PROFESSOR ALTERAR SENHA (POST)
$router->post('/professor/password', [
    'middlewares' => [
        'require-intranet-login',
        'require-professor-permission'
    ],
    function($request){
        return new Response(200, Professor\AlterarSenha::setNewPassword($request));
    }
]);
