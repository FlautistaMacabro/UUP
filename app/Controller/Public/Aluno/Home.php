<?php

namespace App\Controller\Public\Aluno;

use App\Controller\Page\PageBuilder;
use App\Controller\Public\Menu;

class Home{
    public function __construct() {}

    //Método responsável por retornar o conteúdo (view) da nossa home
    public static function getHome()
    {
        //Componentes da Home

        // Header
        $header = PageBuilder::getComponent("pages/public/header", [
          'nome' => $_SESSION['usuario']['name'],
          'cargo' => 'Aluno'
        ]);

        // Menu
        $menu = PageBuilder::getComponent("pages/public/menu", [
          'items' => PageBuilder::getMenu(Menu::getAlunoMenu(), 'Home')
        ]);

        // Content
        $content = PageBuilder::getComponent("pages/aluno/home");

        //Recebe o Template e o Imprime na Tela
        echo PageBuilder::getTemplate('templates/public/template',[
          'title' => 'Home',
          'header' => $header,
          'menu' => $menu,
          'content' => $content
        ]);

        exit;
    }

}