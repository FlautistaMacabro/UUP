<?php

namespace App\Core\Middleware;

use App\Session\Intranet\Login as SessionIntranetLogin;

class RequireIntranetLogin{

    //Método responsável por executar o middleware
    public function handle($request, $next){
        //Verifica se o usuário está logado
        if(!SessionIntranetLogin::isLogged()){
            //Redireciona o usuário para a o login intranet
            $request->getRouter()->redirect('/intranet/login');
        }

        //Executa o próximo nível do middleware
        return $next($request);
    }

}
