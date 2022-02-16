<?php

namespace App\Model\Entity;

use \PDO;
use App\Database\Database;

class DisciplinaAnual{

    public function __construct() {}

    public static function cadastroDiscAnual($prof, $disc, $curso){
        $query = "CALL sp_cadastro_disciplina_anual('{$prof}', '{$disc}', '{$curso}');";
        $database = new Database();
        $database->execute($query);
    }
}