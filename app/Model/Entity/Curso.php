<?php

namespace App\Model\Entity;

use \PDO;
use App\Database\Database;

class Curso{
    public $id_curso;

    public $nome;

    public $minAnos;

    public $maxAnos;

    public $qtdAlunos;

    public function __construct() {}

    public static function listCurso($limit){
        return (new Database("Curso"))->select(null, null, $limit,"nome")->fetchAll(PDO::FETCH_CLASS,self::class);
    }

    public static function getQtdCursos(){
        return (new Database("Curso"))->select(null, null, null,"COUNT(*) as qtd")->fetchObject()->qtd;
    }

}


