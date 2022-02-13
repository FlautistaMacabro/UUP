<?php

use App\Core\Response;
use App\Controller\Intranet\Coord;

//ROTA COORD (GET)
$router->get('/coord', [
    'middlewares' => [
        'require-intranet-login'
    ],
    function(){
        return new Response(200, Coord\Dashboard::getDashboard());
    }
]);