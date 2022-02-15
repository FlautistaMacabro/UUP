<?php

namespace App\Model\Entity;

use \PDO;
use App\Database\Database;

class DashboardProfessor{
    public $qtdAlunos;

    public $qtdDiscsAtivas;

    public $qtdDiscs;

    public function __construct() {}

    public static function getValues($nomeProf){
        $query = "CALL listarQuantDiscProf('{$nomeProf}',@quantAlunoDisc,@quantDiscAtiva,@quantDiscCurso);";
        $database = new Database();
        $database->execute($query);
        return (($database->execute('SELECT @quantAlunoDisc as qtdAlunos,@quantDiscAtiva as qtdDiscsAtivas,@quantDiscCurso as qtdDiscs;'))->fetchAll(PDO::FETCH_CLASS,self::class));
    }

}


