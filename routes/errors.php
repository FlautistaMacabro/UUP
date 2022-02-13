<?php

use App\Core\Response;
use App\Controller\Page\PageBuilder;


//ROTA ERRO 403 (GET)
$router->get('/error/403', [
function(){ return new Response(403, PageBuilder::getComponent('pages/errors/error_403')); }]);
