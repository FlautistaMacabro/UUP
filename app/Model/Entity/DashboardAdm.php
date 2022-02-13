<?php

namespace App\Model\Entity;

use \PDO;
use App\Database\Database;

class DashboardAdm{
    public $qtdCursos;

    public $qtdDiscs;

    public $qtdFuncs;

    public $qtdAlunos;

    public function __construct() {}

    public static function getValues(){
        $query = "CALL listarQuantPessoas(@quantCursos,@quantDiscs,@quantFuncs,@quantAlunos);";
        $database = new Database();
        $database->execute($query);
        return (($database->execute('SELECT @quantCursos as qtdCursos,@quantDiscs as qtdDiscs,@quantFuncs as qtdFuncs,@quantAlunos as qtdAlunos;'))->fetchAll(PDO::FETCH_CLASS,self::class));
    }
    
}


