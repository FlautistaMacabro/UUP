<?php

namespace App\Session\Intranet;


class Login{
    public function __construct() {}

    //Método responsável por iniciar a sessão
    public static function init(){
        //Verifica se a sessão não está ativa
        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }
    }

    //Método responsável por criar a sessão
    public static function login($getUserType, $getUserId, $getUserName)
    {
      //Inicia a sessão
      self::init();

      //Define a sessão do usuário
      $_SESSION['admin']['usuario'] = [
          'type' => $getUserType,
          'id' => $getUserId,
          'name' => $getUserName
      ];

      //SUCESSO
      return true;
    }

    //Método responsável por verificar se o usuário está logado
    public static function isLogged(){
      //Inicia a sessão
      self::init();

      //Retorna a verificação
      return isset($_SESSION['admin']['usuario']['name']);
    }


    //Método responsável por retornar o tipo de usuário logado
    public static function getUserType(){
      //Inicia a sessão
      self::init();

      //Retorna a verificação
      return $_SESSION['admin']['usuario']['type'];

    }

    //Método responsável por destruir a sessão atual
    public static function logout(){
      //Inicia a sessão
      self::init();

      //Desloga o usuário
      unset($_SESSION['admin']['usuario']);

      //SUCESSO
      return true;
    }

}