<?php

namespace App\Model\Entity;

use \PDO;
use App\Database\Database;

class Professor{

    public $nome;

    public function __construct() {}

    public static function getNomesProf() {
        $query = "SELECT nome as 'nome' FROM professor;";
        return (new Database())->execute($query)->fetchAll(PDO::FETCH_CLASS, self::class);
    }
}