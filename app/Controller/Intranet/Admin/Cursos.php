<?php

namespace App\Controller\Intranet\Admin;

use App\Controller\Page\PageBuilder;
use App\Model\Entity\Curso;
use App\Database\Pagination;
use App\Controller\Intranet\Menu;


class Cursos{
    public function __construct() {}

    //Método responsável por retornar a página de Cursos
    public static function getCursos($request)
    {
      //Componentes do Cursos

      //Quantidade Cursos
      $qtdCursos = Curso::getQtdCursos();

      //Página atual
      $queryParams = $request->getQueryParams();
      $paginaAtual = $queryParams['page'] ?? 1;

      //Paginação
      $obPagination = new Pagination($qtdCursos, $paginaAtual,5);


      //Botões paginação
      $paginas = $obPagination->getPages();
      $paginacao = PageBuilder::getButtons($paginas);

      //Listagem de cursos
      $cursos = Curso::listCurso($obPagination->getLimit());
      $items = PageBuilder::getItems($cursos);

       //Header
       $header = PageBuilder::getComponent("pages/intranet/header", [
        'nome' => $_SESSION['admin']['usuario']['name'],
        'cargo' => 'Administrador'
        ]);

      //Menu
      $menu = PageBuilder::getComponent("pages/intranet/menu", [
        'items' => PageBuilder::getMenu(Menu::getAdmMenu(), 'Gerenciar Cursos')
        ]);

      //Content
      $content = PageBuilder::getComponent("pages/admin/curso", [
        'items' => $items,
        'pages' => $paginacao
      ]);

      //Recebe o Template e o Imprime na Tela
      echo PageBuilder::getTemplate('templates/intranet/template_intranet',[
        'title' => 'Cursos - Adm',
        'header' => $header,
        'menu' => $menu,
        'content' => $content,
      ]);

      exit;
    }

}