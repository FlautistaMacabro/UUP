<?php

namespace App\Model\Session;

use \PDO;
use App\Database\Database;

class Login{
    public $id;

    public $type;

    public $name;

    public $curso;

    public function __construct() {}

    public static function login($email,$senha){
        $query = "CALL verificaLoginFuncionarios('{$email}','{$senha}',@tipo,@id,@nome_user);";
        $database = new Database();
        $database->execute($query);
        return (($database->execute('SELECT @tipo as type,@id as id,@nome_user as name;'))->fetchAll(PDO::FETCH_CLASS,self::class));
    }

    public static function loginAluno($email,$senha){
        $query = "CALL verificaLoginAluno('{$email}','{$senha}',@retorno,@id,@nome_user,@nome_curso);";
        $database = new Database();
        $database->execute($query);
        return (($database->execute('SELECT @retorno as type,@id as id,@nome_user as name, @nome_curso as curso;'))->fetchAll(PDO::FETCH_CLASS,self::class));
    }

}


