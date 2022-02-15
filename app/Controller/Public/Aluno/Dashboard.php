<?php

namespace App\Controller\Public\Aluno;

use App\Controller\Page\PageBuilder;
use App\Model\Entity\DashboardAluno;
use App\Controller\Public\Menu;

class Dashboard{
    public function __construct() {}

    //Método responsável por retornar a dashboard do adm
    public static function getDashboard()
    {
        //Componentes do Dashboard

        //Valores resumo universidade
        $values = (DashboardAluno::getValues($_SESSION['usuario']['name']))[0];

        //Header
        $header = PageBuilder::getComponent("pages/intranet/header", [
          'nome' => $_SESSION['usuario']['name'],
          'cargo' => 'Aluno de <strong>'.$_SESSION['usuario']['curso'].'</strong>'
          ]);


        //Menu
        $menu = PageBuilder::getComponent("pages/intranet/menu", [
          'items' => PageBuilder::getMenu(Menu::getAlunoMenu(), 'Dashboard')
          ]);


        //Content
        $content = PageBuilder::getComponent("pages/aluno/dashboard", [
          'cursoNome' => $_SESSION['usuario']['curso'],
          'quantExecucao' => $values->quantExecucao,
          'quantAprovado' => $values->quantAprovado,
          'quantRestante' => $values->quantRestante
          ]);

        //Recebe o Template e o Imprime na Tela
        echo PageBuilder::getTemplate('templates/intranet/template_intranet',[
          'title' => 'Dashboard - Aluno',
          'header' => $header,
          'menu' => $menu,
          'content' => $content
        ]);

        exit;
    }


}