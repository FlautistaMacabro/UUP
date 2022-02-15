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
        $itemName = '';

        for ($i=0; $i < $count ; $i++) {
            (!($i%2 == 0)) ? $itemName = '1' : $itemName = '2';
           
            $items .= PageBuilder::getComponent("pages/items/item{$itemName}", ['item' => $list[$i]->nome]);
        }

        return $items;
      }

      //Método responsável por os itens da listagem
      public static function getItemsFreqNotas($list)
      {
        $items = '';
        $count = count($list);
        $itemName = '';

        for ($i=0; $i < $count ; $i++) {

            (!($i%2 == 0)) ? $itemName = '1' : $itemName = '2';

            $items .= PageBuilder::getComponent("pages/items/item3{$itemName}", [
                'disc' => (($i>0) && ($list[$i]->disc == $list[$i-1]->disc)) ? '' : $list[$i]->disc,
                'prof' => (($i>0) && ($list[$i]->prof == $list[$i-1]->prof)) ? '' : $list[$i]->prof,
                'data' => date('d/m/Y', strtotime($list[$i]->data)),
                'aval' => $list[$i]->aval,
                'nota' => number_format($list[$i]->nota, 1, ',', ' '),
                'freq' => (($i>0) && ($list[$i]->freq == $list[$i-1]->freq)) ? '' : $list[$i]->freq.'%',
                'aulasDadas' => (($i>0) && ($list[$i]->aulasDadas == $list[$i-1]->aulasDadas)) ? '' : $list[$i]->aulasDadas.'/',
                'aulasPrev' => (($i>0) && ($list[$i]->aulasPrev == $list[$i-1]->aulasPrev)) ? '' : $list[$i]->aulasPrev
            ]);
        }

        return $items;
      }

      //Método responsável por os itens da listagem
      public static function getOptionsAno($list)
      {
        $items = '';
        $count = count($list);

        for ($i=0; $i < $count ; $i++)
            $items .= PageBuilder::getComponent("pages/options/optionAno", ['ano' => $list[$i]->ano]);

        return $items;
      }

}