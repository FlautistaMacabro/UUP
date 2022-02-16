<?php

namespace App\Controller\Intranet\Coord;

use App\Controller\Page\PageBuilder;
use App\Model\Entity\DashboardCoord;
use App\Controller\Intranet\Menu;

class Dashboard{
    public function __construct() {}

    //Método responsável por retornar a dashboard do coord
    public static function getDashboard()
    {
        //Componentes do Dashboard

        //Nome Curso
        $nomeCurso = (DashboardCoord::getCoordCurso($_SESSION['admin']['usuario']['name'])[0])->nomeCurso;

        //Valores resumo universidade
        $values = (DashboardCoord::getValues($_SESSION['admin']['usuario']['name']))[0];

        //Header
        $header = PageBuilder::getComponent("pages/intranet/header", [
          'nome' => $_SESSION['admin']['usuario']['name'],
          'cargo' => 'Coordenador de <strong>'.$nomeCurso.'</strong>'
          ]);


        //Menu
        $menu = PageBuilder::getComponent("pages/intranet/menu", [
          'items' => PageBuilder::getMenu(Menu::getCoordMenu(), 'Dashboard')
          ]);


        //Content
        $content = PageBuilder::getComponent("pages/coord/dashboard", [
          'cursoNome' => $nomeCurso ,
          'qtdDiscs' => $values->qtdDiscs,
          'qtdProfs' => $values->qtdProfs,
          'qtdAlunos' => $values->qtdAlunos
          ]);

        //Recebe o Template e o Imprime na Tela
        echo PageBuilder::getTemplate('templates/intranet/template_intranet',[
          'title' => 'Dashboard - Coordenador',
          'header' => $header,
          'menu' => $menu,
          'content' => $content
        ]);

        exit;
    }


}