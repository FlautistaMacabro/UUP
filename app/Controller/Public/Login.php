<?php

namespace App\Controller\Public;

use App\Controller\Page\PageBuilder;
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

}

?>