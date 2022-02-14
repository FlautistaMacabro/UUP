<?php

use App\Core\Response;
use App\Controller\Public;

//ROTA HOME (GET)
$router->get('/', [
    function(){
        return new Response(200, Public\Home::getHome());
    }
]);

//ROTA LOGIN (GET)
$router->get('/login', [
    function(){
        return new Response(200, Public\Login::getLogin());
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