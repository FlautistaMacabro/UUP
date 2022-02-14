<?php

namespace App\Session\Public;

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
    public static function login($getUserId, $getUserName)
    {
      //Inicia a sessão
      self::init();

      //Define a sessão do usuário
      $_SESSION['usuario'] = [
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
      return isset($_SESSION['usuario']['name']);
    }

    //Método responsável por destruir a sessão atual
    public static function logout(){
      //Inicia a sessão
      self::init();

      //Desloga o usuário
      unset($_SESSION['usuario']);

      //SUCESSO
      return true;
    }

}