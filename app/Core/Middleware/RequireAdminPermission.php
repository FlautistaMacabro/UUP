<?php

namespace App\Core\Middleware;

use App\Session\Intranet\Login as SessionIntranetLogin;

class RequireAdminPermission{

    //Método responsável por executar o middleware
    public function handle($request, $next){
        //Verifica o tipo de usuário logado
        if(!(SessionIntranetLogin::getUserType() == 1)){
            //Redireciona o usuário para a página correta
            $request->getRouter()->redirect('/intranet');
        }

        //Executa o próximo nível do middleware
        return $next($request);
    }

}
