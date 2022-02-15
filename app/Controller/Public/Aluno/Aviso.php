<?php

namespace App\Controller\Public\Aluno;

use App\Controller\Page\PageBuilder;
use App\Controller\Public\Menu;
use App\Model\Entity\Aviso as ModelAviso;
use App\Database\Pagination;

class Aviso{
    public function __construct() {}

    //Método responsável por retornar o conteúdo (view) da nossa home
    public static function getAviso($request)
    {
        //Componentes de Avisos

        // Header
        $header = PageBuilder::getComponent("pages/public/header", [
          'nome' => $_SESSION['usuario']['name'],
          'cargo' => 'Aluno'
        ]);

        // Menu
        $menu = PageBuilder::getComponent("pages/public/menu", [
          'items' => PageBuilder::getMenu(Menu::getAlunoMenu(), 'Avisos')
        ]);

        //Listagem

        // Quantidade de Avisos
        $qtdAvisos = ModelAviso::getQtdAvisos($_SESSION['usuario']['curso'], $_SESSION['usuario']['name']);

        //Página atual
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;

        //Paginação
        $obPagination = new Pagination($qtdAvisos, $paginaAtual,7);

        //Botões paginação
        $paginas = $obPagination->getPages();
        $paginacao = PageBuilder::getButtons($paginas,'/aviso');

        $dadosAvisos = ModelAviso::getAvisos($_SESSION['usuario']['curso'], $_SESSION['usuario']['name'], $obPagination->getLimit());
        $items = PageBuilder::getItemsAviso($dadosAvisos);

        // Content
        $content = PageBuilder::getComponent("pages/aluno/aviso", [
          'items' => $items,
          'pages' => $paginacao
        ]);

        //Recebe o Template e o Imprime na Tela
        echo PageBuilder::getTemplate('templates/public/template',[
          'title' => 'Avisos',
          'header' => $header,
          'menu' => $menu,
          'content' => $content
        ]);

        exit;
    }

}