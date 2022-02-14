<?php

namespace App\Core\Middleware;

use App\Session\Public\Login as SessionLogin;

class RequireLogout{

    //Método responsável por executar o middleware
    public function handle($request, $next){
        //Verifica se o usuário está logado
        if(SessionLogin::isLogged()){
            $request->getRouter()->redirect('/');
        }

        //Executa o próximo nível do middleware
        return $next($request);
    }

}