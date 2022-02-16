<?php

namespace App\Model\Entity;

use \PDO;
use App\Database\Database;

class Semestre{

    public function __construct() {}

    public static function abrirSemestre($semestre, $nomeCurso){
        $query = "SELECT abrirSemestre({$semestre}, '{$nomeCurso}') as tipo";
        $database = new Database();
        return (STRING)(($database->execute($query))->fetch(PDO::FETCH_ASSOC))['tipo'];
    }

    public static function fecharSemestre($semestre, $nomeCurso){
        $query = "SELECT fecharSemestre({$semestre}, '{$nomeCurso}') as tipo";
        $database = new Database();
        return (STRING)(($database->execute($query))->fetch(PDO::FETCH_ASSOC))['tipo'];
    }

    public static function abrirRematricula($semestre, $nomeCurso){
        $query = "SELECT abrirRematricula({$semestre}, '{$nomeCurso}') as tipo";
        $database = new Database();
        return (STRING)(($database->execute($query))->fetch(PDO::FETCH_ASSOC))['tipo'];
    }

    public static function fecharRematricula($nomeCurso){
        $query = "SELECT fecharRematricula('{$nomeCurso}') as tipo";
        $database = new Database();
        return (STRING)(($database->execute($query))->fetch(PDO::FETCH_ASSOC))['tipo'];
    }

    public static function getSemestreAtivo(){
        $query = "SELECT num as 'sem' FROM semestre WHERE aberto = 1 LIMIT 1";
        return (new Database())->execute($query)->fetchObject()->sem;
    }
}