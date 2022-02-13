<?php

namespace App\Model\Entity;

use \PDO;
use App\Database\Database;

class Admin{
    public function __construct() {}

    public static function setNewPassword($nome, $novaSenha){
        $query = "CALL atualizarSenhaADM('{$nome}','{$novaSenha}');";
        $database = new Database();
        $database->execute($query);
    }
}