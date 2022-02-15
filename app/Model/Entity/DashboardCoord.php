<?php

namespace App\Model\Entity;

use \PDO;
use App\Database\Database;

class DashboardCoord{
    public $qtdDiscs;

    public $qtdProfs;

    public $qtdAlunos;

    public $nomeCurso;

    public function __construct() {}

    public static function getValues($nomeCoord){
        $query = "CALL listarQuantDiscCoord('{$nomeCoord}',@quantDiscBase,@quantAlunoCurso,@quantProfCurso);";
        $database = new Database();
        $database->execute($query);
        return (($database->execute('SELECT @quantDiscBase as qtdDiscs,@quantProfCurso as qtdProfs,@quantAlunoCurso as qtdAlunos;'))->fetchAll(PDO::FETCH_CLASS,self::class));
    }

    public static function getCoordCurso($nomeCoord){
        $query = "SELECT c.nome as 'nomeCurso'
        FROM curso as c
            INNER JOIN professor as pr
            ON c.id_curso = pr.id_prof
        WHERE pr.nome = '{$nomeCoord}' AND pr.id_curso IS NOT NULL
        LIMIT 1;";
        return (new Database())->execute($query)->fetchAll(PDO::FETCH_CLASS,self::class);
    }

}


