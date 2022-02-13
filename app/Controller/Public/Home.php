<?php

namespace App\Controller\Public;

use App\Controller\Page\PageBuilder;

class Home{
    public function __construct() {}

    //Método responsável por retornar o conteúdo (view) da nossa home
    public static function getHome()
    {
        //Componentes da Home
        $content = PageBuilder::getComponent("pages/public/home", [
            'content' => 'Home Page'
          ]);

          //Recebe o Template e o Imrpime na Tela
          echo PageBuilder::getTemplate('templates/public/template_home',[
            'title' => 'Home',
            'content' => $content
          ]);
    }

}