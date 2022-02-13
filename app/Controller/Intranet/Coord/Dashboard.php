<?php

namespace App\Controller\Intranet\Coord;

use App\Controller\Page\PageBuilder;


class Dashboard{
    public function __construct() {}

    //Método responsável por retornar a dashboard do adm
    public static function getDashboard()
    {
        //Componentes da Home


        //Content


        //Recebe o Template e o Imprime na Tela
        echo PageBuilder::getTemplate('templates/admin/coord/template_coord',[
          'URL' => $_ENV['URL'],
          'title' => 'Coord Dashboard',
          'nome' => $_SESSION['admin']['usuario']['name'],
          'cargo' => 'Coordenador'
          //'content' => $content
        ]);
    }


}