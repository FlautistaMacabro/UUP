<?php

namespace App\Core\Middleware;

use \Exception;

class Maintenance{

    //Método responsável por executar o middleware
    public function handle($request, $next){
        //Verifica o estado de manutenção da página
        if($_ENV['MAINTENANCE'] == 'true'){
            throw new Exception("Página em manutenção. Tente novamente mais tarde", 200); 
        }
       
        //Executa o próximo nível do middleware
        return $next($request);
       
    }

}
