<?php

use App\Core\Response;
use App\Controller\Public\Aluno;

//ROTA HOME (GET)
$router->get('/', [
'middlewares' => [
    'require-login'
],
    function(){
        return new Response(200, Aluno\Home::getHome());
    }
]);

// ROTA ALTERAR SENHA (GET)
$router->get('/password', [
'middlewares' => [
    'require-login'
],
    function(){
        return new Response(200, Aluno\AlterarSenha::getAlterarSenha());
    }
]);

// ROTA ALTERAR SENHA (POST)
$router->post('/password', [
'middlewares' => [
    'require-login'
],
    function($request){
        return new Response(200, Aluno\AlterarSenha::setNewPassword($request));
    }
]);


//ROTA DINÂMICA
/*
$router->get('/pagina/{idPagina}/{acao}', [
    function($idPagina,$acao,$idcarlos){
        return new Response(200, 'Página '.$idPagina.' - '.$acao);
    }
]);
*/