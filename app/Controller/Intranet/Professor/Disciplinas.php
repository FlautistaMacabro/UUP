<?php

namespace App\Controller\Intranet\Professor;

use App\Controller\Page\PageBuilder;
use App\Database\Pagination;
use App\Controller\Intranet\Menu;
use App\Controller\Page\Alert;
use App\Model\Entity\Professor;

class Disciplinas{
    public function __construct() {}

    //Método responsável por retornar a página de Disciplinas
    public static function getDisciplinas($request, $typemsg = null,$msg = null)
    {
      //Componentes do Disciplinas

       //Messages
       $status = (!is_null($msg) && !is_null($typemsg)) ? (($typemsg) ? Alert::getSuccess($msg) : Alert::getError($msg)) : '';

      //Quantidade Disciplinas
      $qtdCursos = Professor::getQtdDiscAtivasProf($_SESSION['admin']['usuario']['id']);

      //Página atual
      $queryParams = $request->getQueryParams();
      $paginaAtual = $queryParams['page'] ?? 1;

      //Paginação
      $obPagination = new Pagination($qtdCursos, $paginaAtual,5);


      //Botões paginação
      $paginas = $obPagination->getPages();
      $paginacao = PageBuilder::getButtons($paginas,'/professor/disciplinas');

      //Listagem de Disciplinas
      $disc = Professor::listDiscAtivasProf($_SESSION['admin']['usuario']['id'], $obPagination->getLimit());
      $items = PageBuilder::getItemsDisciplinas($disc);

       //Header
       $header = PageBuilder::getComponent("pages/intranet/header", [
        'nome' => $_SESSION['admin']['usuario']['name'],
        'cargo' => 'Professor'
        ]);

      //Menu
      $menu = PageBuilder::getComponent("pages/intranet/menu", [
        'items' => PageBuilder::getMenu(Menu::getProfessorMenu(), 'Disciplinas')
        ]);

      //Content
      $content = PageBuilder::getComponent("pages/professor/disciplinas", [
        'items' => $items,
        'pages' => $paginacao,
        'status' => $status
      ]);

      //Recebe o Template e o Imprime na Tela
      echo PageBuilder::getTemplate('templates/intranet/template_intranet',[
        'title' => 'Disciplinas - Professor',
        'header' => $header,
        'menu' => $menu,
        'content' => $content,
      ]);

      exit;
    }

    public static function manageDisciplina($request, $id)
    {
        //Componentes do Disciplinas

        //Header
        $header = PageBuilder::getComponent("pages/intranet/header", [
         'nome' => $_SESSION['admin']['usuario']['name'],
         'cargo' => 'Professor'
         ]);

       //Menu
       $menu = PageBuilder::getComponent("pages/intranet/menu", [
         'items' => PageBuilder::getMenu(Menu::getProfessorMenu(), 'Disciplinas')
         ]);

       //Content
       $content = PageBuilder::getComponent("pages/professor/especDisciplina", [
         'especdisc' => (Professor::getDisciplinaName($id)),
         'id' => $id
       ]);

       //Recebe o Template e o Imprime na Tela
       echo PageBuilder::getTemplate('templates/intranet/template_intranet',[
         'title' => 'Disciplinas - Professor',
         'header' => $header,
         'menu' => $menu,
         'content' => $content,
       ]);

       exit;
    }

}