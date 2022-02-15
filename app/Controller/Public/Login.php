<?php

namespace App\Controller\Public;

use App\Controller\Page\PageBuilder;
use App\Model\Session\Login as LoginUsuario;
use App\Session\Public\Login as SessionLogin;
use App\Controller\Page\Alert;

class Login{
    public function __construct() {}

    //Método responsável por retornar o conteúdo do login de alunos
    public static function getLogin($errorMessage = null)
    {
        //Componentes do Login

        //Error message
        $status = !is_null($errorMessage) ? Alert::getError($errorMessage) : '';

        $content = PageBuilder::getComponent("pages/public/login", [
            'status' => $status
          ]);

          //Recebe o Template e o Imrpime na Tela
          echo PageBuilder::getTemplate('templates/public/template_login',[
            'title' => 'Home',
            'content' => $content
          ]);

        exit;
    }

    public static function authentication($request)
    {
        //POST VARS
        $postVars = $request->getPostVars();
        $email = $postVars['email'] ? $postVars['email'] . '@uup.br' : '';
        $senha = $postVars['password'] ?? '';

        //Validação do Login
        $loginStatus = (LoginUsuario::loginAluno($email,$senha))[0];

        //Error
        if($loginStatus->type == 0){return self::getLogin($loginStatus->name);}

        //Cria a sessão de login
        SessionLogin::login($loginStatus->id, $loginStatus->name, $loginStatus->curso);

        //Redireciona o usuário para a tela apropriada
        $request->getRouter()->redirect('/');
    }

    //Método responsável por deslogar o usuário
    public static function logout($request){
      //Destrói a sessão de login
      SessionLogin::logout();

      //Redireciona o usuário para o login
      $request->getRouter()->redirect('/login');
    }

}

?>