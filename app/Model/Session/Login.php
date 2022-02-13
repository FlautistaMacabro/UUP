<?php

namespace App\Model\Session;

use \PDO;
use App\Database\Database;

class Login{
    public $id;

    public $type;

    public $name;

    public function __construct() {}

    public static function login($email,$senha){
        $query = "CALL verificaLoginFuncionarios('{$email}','{$senha}',@tipo,@id,@nome_user);";
        $database = new Database();
        $database->execute($query);
        return (($database->execute('SELECT @tipo as type,@id as id,@nome_user as name;'))->fetchAll(PDO::FETCH_CLASS,self::class));
    }

}


