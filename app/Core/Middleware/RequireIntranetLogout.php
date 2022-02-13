<?php

namespace App\Core\Middleware;

use App\Session\Intranet\Login as SessionIntranetLogin;

class RequireIntranetLogout{

    //Método responsável por executar o middleware
    public function handle($request, $next){
        //Verifica se o usuário está logado
        if(SessionIntranetLogin::isLogged()){
            //Tipo do usuário logado na sessão atual
            $userType = $_SESSION['admin']['usuario']['type'];

            if($userType == 1) {
                //Redireciona o usuário para a home do admin
                $request->getRouter()->redirect('/admin');
            }
            else if($userType == 2){
                //Redireciona o usuário para a home do professor
                $request->getRouter()->redirect('/professor');
            }else if($userType == 3){
                 //Redireciona o usuário para a home do coordenador
                 $request->getRouter()->redirect('/coord');
            }

        }

        //Executa o próximo nível do middleware
        return $next($request);
    }

}
