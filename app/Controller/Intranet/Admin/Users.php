<?php

namespace App\Controller\Intranet\Admin;

use App\Controller\Page\PageBuilder;


class Users{
    public function __construct() {}

    //Método responsável por retornar a dashboard do adm
    public static function getUsers()
    {
        //Componentes do Users


        //Content


        //Recebe o Template e o Imprime na Tela
        echo PageBuilder::getTemplate('templates/intranet/template_intranet',[
          'title' => 'Usuários - Adm',
          'content' => ''
        ]);
    }


}