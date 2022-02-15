<?php

namespace App\Controller\Intranet\Professor;

use App\Controller\Page\PageBuilder;
use App\Model\Entity\DashboardProfessor;
use App\Controller\Intranet\Menu;

class Dashboard{
    public function __construct() {}

    //Método responsável por retornar a dashboard do adm
    public static function getDashboard()
    {
        //Componentes do Dashboard

        //Valores resumo universidade
        $values = (DashboardProfessor::getValues($_SESSION['admin']['usuario']['name']))[0];

        //Header
        $header = PageBuilder::getComponent("pages/intranet/header", [
          'nome' => $_SESSION['admin']['usuario']['name'],
          'cargo' => 'Professor'
          ]);


        //Menu
        $menu = PageBuilder::getComponent("pages/intranet/menu", [
          'items' => PageBuilder::getMenu(Menu::getProfessorMenu(), 'Dashboard')
          ]);


        //Content
        $content = PageBuilder::getComponent("pages/professor/dashboard", [
          'qtdAlunos' => $values->qtdAlunos,
          'qtdDiscsAtivas' => $values->qtdDiscsAtivas,
          'qtdDiscs' => $values->qtdDiscs
          ]);

        //Recebe o Template e o Imprime na Tela
        echo PageBuilder::getTemplate('templates/intranet/template_intranet',[
          'title' => 'Dashboard - Professor',
          'header' => $header,
          'menu' => $menu,
          'content' => $content
        ]);

        exit;
    }


}