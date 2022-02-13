<?php

namespace App\Controller\Page;

use App\Utils\View;

class Alert{
    public function __construct() {}

    //Método resposável por retornar uma mensagem de sucesso
    public static function getSuccess($message)
    {
        return View::render('pages/alert', [
            "type" => 'success',
            "message" => $message
        ]);
    }

    //Método resposável por retornar uma mensagem de erro
    public static function getError($message)
    {
        return View::render('pages/alert', [
            "type" => 'danger',
            "message" => $message
        ]);
    }
 

}