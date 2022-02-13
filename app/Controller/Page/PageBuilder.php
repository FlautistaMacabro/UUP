<?php

namespace App\Controller\Page;

use App\Utils\View;


class PageBuilder {
    public function __construct() {}

    //Método responsável por retornar o conteúdo de um componente de uma página
    public static function getComponent($path, $params = [])
    {
        //Componente de uma página
        return View::render($path, $params);
    }

    //Método Responsável por retornar o conteúdo de um template
    public static function getTemplate($path, $params)
    {
        //Componente de uma página
        return View::render($path, $params);
    }

     //Método responsável por retornar o menu da página
     public static function getMenu($array, $currentPage)
     {
         $menu = '';

         $menu_array = $array;
         $keys = array_keys($menu_array);
         $count = count($keys);

         for ($i=0; $i < $count; $i++) {
             $menu .= "<p class='menu-label'>".$keys[$i]."</p>";
             $menu .= "<ul class='menu-list'>";

             $count_items = count($menu_array[$keys[$i]]);
             for ($j=0; $j < $count_items; $j++) {
                 $item = $menu_array[$keys[$i]][$j];
                 $menu .= "<li> <a href='".$_ENV['URL'].$item["link"]."' class='".(($item["label"] == $currentPage) ? 'is-active' : '')."' ><strong>".$item["label"]."</strong></a> </li>";
             }
             $menu .= "</ul>";
         }

         return $menu;
     }

    //Método responsável por retornar a estrutura da paginação
     public static function getButtons($paginas){
        $paginacao = '';
        $count = count($paginas);

        for ($i=0; $i < $count; $i++) {
          $pagina = ($paginas[$i])['pagina'];
          $atual = ((($paginas[$i])['atual']) ? 'is-current' : '');
          $paginacao .= "<li> <a href='".$_ENV['URL']."/admin/cursos?page=".$pagina."' class='pagination-link ".$atual."'>".$pagina."</a></li>";
        }

        return $paginacao;
      }

      //Método responsável por os itens da listagem
      public static function getItems($list)
      {
        $items = '';
        $count = count($list);

        for ($i=0; $i < $count ; $i++) {
           (!($i%2 == 0))
           ? $items .= PageBuilder::getComponent("pages/items/item1", ['item' => $list[$i]->nome])
           : $items .= PageBuilder::getComponent("pages/items/item2", ['item' => $list[$i]->nome]);
        }

        return $items;
      }



}