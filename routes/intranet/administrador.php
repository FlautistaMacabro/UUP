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

//ROTA ADMIN CURSOS (POST)
$router->post('/admin/cursos', [
    'middlewares' => [
        'require-intranet-login',
        'require-admin-permission'
    ],
    function($request){
        return new Response(200, Admin\Cursos::postCursos($request));
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

//ROTA ADMIN CADASTRAR ALUNO (GET)
$router->get('/admin/cadaluno', [
    'middlewares' => [
        'require-intranet-login',
        'require-admin-permission'
    ],
    function(){
        return new Response(200, Admin\CadastroAluno::getCadastroAluno());
    }
]);


//ROTA ADMIN CADASTRAR ALUNO (POST)
$router->post('/admin/cadaluno', [
    'middlewares' => [
        'require-intranet-login',
        'require-admin-permission'
    ],
    function($request){
        return new Response(200, Admin\CadastroAluno::getCadastroAluno($request));
    }
]);

//ROTA ADMIN CADASTRAR PROFESSOR (GET)
$router->get('/admin/cadprof', [
    'middlewares' => [
        'require-intranet-login',
        'require-admin-permission'
    ],
    function(){
        return new Response(200, Admin\CadastroProfessor::getCadastroProfessor());
    }
]);


//ROTA ADMIN CADASTRAR PROFESSOR (POST)
$router->post('/admin/cadprof', [
    'middlewares' => [
        'require-intranet-login',
        'require-admin-permission'
    ],
    function($request){
        return new Response(200, Admin\CadastroProfessor::getCadastroProfessor($request));
    }
]);

//ROTA ADMIN CADASTRAR COORDENADOR (GET)
// $router->get('/admin/cadcoord', [
//     'middlewares' => [
//         'require-intranet-login',
//         'require-admin-permission'
//     ],
//     function(){
//         return new Response(200, Admin\CadastroCoordenador::getCadastroCoordenador());
//     }
// ]);


// //ROTA ADMIN CADASTRAR COORDENADOR (POST)
// $router->post('/admin/cadcoord', [
//     'middlewares' => [
//         'require-intranet-login',
//         'require-admin-permission'
//     ],
//     function($request){
//         return new Response(200, Admin\CadastroCoordenador::getCadastroCoordenador($request));
//     }
// ]);
