<?php

namespace App\Controller\Public\Aluno;

use App\Controller\Page\PageBuilder;
use App\Controller\Public\Menu;
use App\Model\Entity\DiscAlunoAnual;
use App\Model\Entity\Ano;

class Historico{
    public function __construct() {}

    //Método responsável por retornar o conteúdo (view) da nossa home
    public static function getHistorico($request = null)
    {
        //Componentes do Histórico

        // Header
        $header = PageBuilder::getComponent("pages/public/header", [
          'nome' => $_SESSION['usuario']['name'],
          'cargo' => 'Aluno de <strong>'.$_SESSION['usuario']['curso'].'</strong>'
        ]);

        // Menu
        $menu = PageBuilder::getComponent("pages/public/menu", [
          'items' => PageBuilder::getMenu(Menu::getAlunoMenu(), 'Histórico')
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

        $disciplinas = DiscAlunoAnual::getValues($_SESSION['usuario']['curso'], $ano, $semestre, $_SESSION['usuario']['name']);
        $items = PageBuilder::getItemsHistorico($disciplinas);

        $anosAluno = Ano::getAnosAluno($_SESSION['usuario']['name']);
        $anosAluno = PageBuilder::getOptionsAno($anosAluno, $ano);

        $semestresAluno = array('1','2');
        $semestresAluno = PageBuilder::getOptionsSemestre($semestresAluno, $semestre);

        // Content
        $content = PageBuilder::getComponent("pages/aluno/historico", [
          'items' => $items,
          'semestres' => $semestresAluno,
          'anos' => $anosAluno
        ]);

        //Recebe o Template e o Imprime na Tela
        echo PageBuilder::getTemplate('templates/public/template',[
          'title' => 'Histórico',
          'header' => $header,
          'menu' => $menu,
          'content' => $content
        ]);

        exit;
    }

}