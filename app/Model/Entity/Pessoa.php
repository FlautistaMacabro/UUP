<?php

namespace App\Model\Entity;

use \PDO;
use App\Database\Database;

class Pessoa{
    public function __construct() {}

    public $tipo;

    public $msg;

    public static function setNewPasswordADM($nome, $senha, $novaSenha){
        $query = "CALL atualizarSenhaADM('{$nome}','{$senha}','{$novaSenha}',@retorno,@mensagem);";
        $database = new Database();
        $database->execute($query);
        return (($database->execute('SELECT @retorno as tipo, @mensagem as msg;'))->fetchAll(PDO::FETCH_CLASS,self::class));
    }
}