<?php

namespace App\Core\Middleware;

use App\Session\Public\Login as SessionLogin;

class RequireLogin{

    //Método responsável por executar o middleware
    public function handle($request, $next){
        //Verifica se o usuário está logado
        if(!SessionLogin::isLogged()){
            //Redireciona o usuário para a o login
            $request->getRouter()->redirect('/login');
        }

        //Executa o próximo nível do middleware
        return $next($request);
    }

}

?>