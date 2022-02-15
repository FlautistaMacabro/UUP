<?php

namespace App\Controller\Public\Aluno;

use App\Controller\Page\PageBuilder;
use App\Controller\Public\Menu;
use App\Model\Entity\AvalAlunoAnual;
use App\Model\Entity\Ano;

class Home{
    public function __construct() {}

    //Método responsável por retornar o conteúdo (view) da nossa home
    public static function getHome($request = null)
    {
        //Componentes da Home

        // Header
        $header = PageBuilder::getComponent("pages/public/header", [
          'nome' => $_SESSION['usuario']['name'],
          'cargo' => 'Aluno'
        ]);

        // Menu
        $menu = PageBuilder::getComponent("pages/public/menu", [
          'items' => PageBuilder::getMenu(Menu::getAlunoMenu(), 'Frequências e Notas')
        ]);

        //Listagem

        if($request != null){
          $postVars = $request->getPostVars();
          $semestre = $postVars['semestre'];
          $ano = $postVars['ano'];

          if($semestre == 'Semestre')
            idate('m', date('m')) >= 6 ? $semestre = 2 : $semestre = 1;
          else $semestre = intval($semestre);
          if($ano == 'Ano')
            $ano = date('Y');
          else $ano = intval($ano);

        }else {
          idate('m', date('m')) >= 6 ? $semestre = 2 : $semestre = 1;
          $ano = date('Y');
        }

        $cursos = AvalAlunoAnual::getValues($_SESSION['usuario']['curso'], $ano, $semestre, $_SESSION['usuario']['name']);
        $items = PageBuilder::getItemsFreqNotas($cursos);

        $anosAluno = Ano::getAnosAluno($_SESSION['usuario']['name']);
        $anosAluno = PageBuilder::getOptionsAno($anosAluno);

        // Content
        $content = PageBuilder::getComponent("pages/aluno/home", [
          'items' => $items,
          'anos' => $anosAluno
        ]);

        // print_r('<pre>');
        // print_r($cursos);
        // print_r('</pre>');
        // exit;

        // $content = PageBuilder::getComponent("pages/aluno/home");
          //   'items' => $items
          // ]);

        //Recebe o Template e o Imprime na Tela
        echo PageBuilder::getTemplate('templates/public/template',[
          'title' => 'Frequências e Notas',
          'header' => $header,
          'menu' => $menu,
          'content' => $content
        ]);

        exit;
    }

}