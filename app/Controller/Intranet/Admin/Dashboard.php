<?php

namespace App\Controller\Intranet\Admin;

use App\Controller\Page\PageBuilder;
use App\Model\Entity\DashboardAdm;
use App\Controller\Intranet\Menu;


class Dashboard{
    public function __construct() {}

    //Método responsável por retornar a dashboard do adm
    public static function getDashboard()
    {
        //Componentes do Dashboard

        //Valores resumo universidade
         $values = (DashboardAdm::getValues())[0];

        //Header
        $header = PageBuilder::getComponent("pages/intranet/header", [
          'nome' => $_SESSION['admin']['usuario']['name'],
          'cargo' => 'Administrador'
          ]);


        //Menu
        $menu = PageBuilder::getComponent("pages/intranet/menu", [
          'items' => PageBuilder::getMenu(Menu::getAdmMenu(), 'Dashboard')
          ]);


        //Content
        $content = PageBuilder::getComponent("pages/admin/dashboard", [
          'qtdCursos' => $values->qtdCursos,
          'qtdDiscs' => $values->qtdDiscs,
          'qtdFuncs' => $values->qtdFuncs,
          'qtdAlunos' => $values->qtdAlunos
          ]);

        //Recebe o Template e o Imprime na Tela
        echo PageBuilder::getTemplate('templates/intranet/template_intranet',[
          'title' => 'Dashboard - Adm',
          'header' => $header,
          'menu' => $menu,
          'content' => $content
        ]);

        exit;
    }


}