<?php

namespace App\Model\Entity;

use \PDO;
use App\Database\Database;

class DashboardAluno{
    public $quantExecucao;

    public $quantAprovado;

    public $quantRestante;

    public function __construct() {}

    public static function getValues($nomeAluno){
        $query = "CALL listarQuantDiscAluno('{$nomeAluno}',@quantExecucao,@quantAprovado,@quantRestante);";
        $database = new Database();
        $database->execute($query);
        return (($database->execute('SELECT @quantExecucao as quantExecucao,@quantAprovado as quantAprovado,@quantRestante as quantRestante;'))->fetchAll(PDO::FETCH_CLASS,self::class));
    }

}


