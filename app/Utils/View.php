<?php

namespace App\Utils;

class View{

    //Variáveis padrões da View
    private static $vars = [];

    public function __construct() {}

    //Método que define os dados iniciais da classe
    public static function init($vars = []){
        self::$vars = $vars;
    }

    private static function getContentView($view)
    {
        $file = __DIR__."/../Resources/views/".$view.".html";
         return file_exists($file) ? file_get_contents($file) : "";
    }

    public static function render($view, $vars = [])
    {
        //Conteúdo da View
        $contentView = self::getContentView($view);

        //Merge de varáveis da view
        $vars = array_merge(self::$vars, $vars);

        //Chaves do array de variáveis
        $keys = array_keys($vars);
        $keys = array_map(function($item){
            return '{{'.$item.'}}';
        },$keys);

        //Retorna o conteúdo renderizado
        return str_replace($keys, array_values($vars), $contentView);
    }

}