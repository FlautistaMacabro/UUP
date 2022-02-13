<?php

namespace App\Core\Middleware;

use App\Controller\Page\PageBuilder;
use \Exception;

class Maintenance{

    //Método responsável por executar o middleware
    public function handle($request, $next){
        //Verifica o estado de manutenção da página
        if($_ENV['MAINTENANCE'] == 'true'){
            throw new Exception(PageBuilder::getComponent("pages/errors/maintenance"), 200);
        }

        //Executa o próximo nível do middleware
        return $next($request);

    }

}
