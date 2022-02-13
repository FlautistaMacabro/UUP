<?php

use App\Core\Response;
use App\Controller\Public;

//ROTA HOME
$router->get('/', [
    function(){
        return new Response(200, Public\Home::getHome());
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