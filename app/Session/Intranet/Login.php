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
    public static function login($getAdmType, $getAdmId, $getAdmName)
    {
      //Inicia a sessão
      self::init();

      //Define a sessão do usuário
      $_SESSION['admin']['usuario'] = [
          'type' => $getAdmType,
          'id' => $getAdmId,
          'name' => $getAdmName
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