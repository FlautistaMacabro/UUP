<?php

namespace App\Controller\Intranet;

use App\Controller\Page\PageBuilder;
use App\Model\Session\Login as LoginIntranet;
use App\Session\Intranet\Login as SessionIntranetLogin;
use App\Controller\Page\Alert;


class Login{
    public function __construct() {}

    //Método responsável por retornar o conteúdo (view) do nosso login
    public static function getLogin($request, $errorMessage = null)
    {
         //Componentes do Login

         //Error message
         $status = !is_null($errorMessage) ? Alert::getError($errorMessage) : '';

         //Content
         $content = PageBuilder::getComponent("pages/intranet/login", [
           'status' => $status
         ]);

          //Recebe o Template e o Imprime na Tela
          echo PageBuilder::getTemplate('templates/intranet/template_intranet_login',[
            'title' => '.:Intranet Login',
            'content' => $content
          ]);

          exit;
    }

    public static function redirect($request, $type){

        //Redireciona o usuário para a respectiva página
        if ($type == 3)  $request->getRouter()->redirect('/coord');
        else if ($type == 2)  $request->getRouter()->redirect('/professor');
        else if ($type == 1)  $request->getRouter()->redirect('/admin');
    }


    public static function authentication($request)
    {
        //POST VARS
        $postVars = $request->getPostVars();
        $email = $postVars['email'] ?? '';
        $senha = $postVars['password'] ?? '';

        //Validação do Login
        $loginStatus = (LoginIntranet::login($email,$senha))[0];

        //Error
        if($loginStatus->type < 1 || $loginStatus->type > 3){return self::getLogin($request, $loginStatus->name);}

        //Cria a sessão de login
        SessionIntranetLogin::login($loginStatus->type, $loginStatus->id, $loginStatus->name);

        //Redireciona o usuário para a tela apropriada
        self::redirect($request, $loginStatus->type);

    }

    //Método responsável por deslogar o usuário
    public static function logout($request){
        //Destrói a sessão de login
        SessionIntranetLogin::logout();

        //Redireciona o usuário para o login intranet
        $request->getRouter()->redirect('/intranet/login');
    }

}