<?php

namespace App\Model\Entity;

use \PDO;
use App\Database\Database;

class Aviso{
    public $remetente;

    public $grupo;

    public $assunto;

    public $dataHora;

    public function __construct() {}

    public static function getAvisos($nomeCurso, $nomeAluno, $limit){
        $query = "SELECT pr.nome as 'remetente', db.nome as 'grupo', av.nome as 'assunto', av.dataHora as 'dataHora'
                FROM disciplinaAnual as dl
                    INNER JOIN disciplinaBase as db
                    ON dl.id_discBase = db.id_discBase
                        INNER JOIN curso as c
                        ON db.id_curso = c.id_curso
                    INNER JOIN dados_aluno as da
                    ON dl.id_discAnual = da.id_discAnual
                        INNER JOIN aluno as al
                        ON da.id_aluno = al.id_aluno
                    INNER JOIN professor as pr
                    ON dl.id_prof = pr.id_prof
                    INNER JOIN aviso as av
                    ON dl.id_discAnual = av.id_discAnual
                WHERE c.nome = '{$nomeCurso}' AND al.nome = '{$nomeAluno}'
           UNION
                SELECT pr.nome as 'remetente', '{$nomeCurso}' as 'grupo', ag.nome as 'assunto', ag.dataHora as 'dataHora'
                    FROM disciplinaAnual as dl
                        INNER JOIN disciplinaBase as db
                        ON dl.id_discBase = db.id_discBase
                        INNER JOIN dados_aluno as da
                        ON dl.id_discAnual = da.id_discAnual
                            INNER JOIN aluno as al
                            ON da.id_aluno = al.id_aluno
                        INNER JOIN professor as pr
                        ON dl.id_prof = pr.id_prof
                            INNER JOIN curso as c
                            ON pr.id_curso = c.id_curso
                                INNER JOIN avisoglobal as ag
                                ON c.id_curso = ag.id_curso
                    WHERE c.nome = '{$nomeCurso}' AND al.nome = '{$nomeAluno}' AND pr.id_curso IS NOT NULL AND ag.id_prof = pr.id_prof
        ORDER BY dataHora DESC LIMIT {$limit};";
        $database = new Database();
        return ($database->execute($query))->fetchAll(PDO::FETCH_CLASS,self::class);
    }

    public static function getQtdAvisos($nomeCurso, $nomeAluno){
        $query = "SELECT COUNT(*) as 'qtd' 
        FROM (
        (SELECT av.dataHora as 'dataHora'
            FROM disciplinaAnual as dl
                INNER JOIN disciplinaBase as db
                   ON dl.id_discBase = db.id_discBase
                    INNER JOIN curso as c
                       ON db.id_curso = c.id_curso
                INNER JOIN dados_aluno as da
                   ON dl.id_discAnual = da.id_discAnual
                       INNER JOIN aluno as al
                       ON da.id_aluno = al.id_aluno
                   INNER JOIN professor as pr
                   ON dl.id_prof = pr.id_prof
                INNER JOIN aviso as av
                ON dl.id_discAnual = av.id_discAnual
            WHERE c.nome = '{$nomeCurso}' AND al.nome = '{$nomeAluno}')
               UNION
        (SELECT ag.dataHora as 'dataHora'
            FROM disciplinaAnual as dl
                INNER JOIN disciplinaBase as db
                ON dl.id_discBase = db.id_discBase
                INNER JOIN dados_aluno as da
                ON dl.id_discAnual = da.id_discAnual
                    INNER JOIN aluno as al
                    ON da.id_aluno = al.id_aluno
                INNER JOIN professor as pr
                ON dl.id_prof = pr.id_prof
                    INNER JOIN curso as c
                    ON pr.id_curso = c.id_curso
                        INNER JOIN avisoglobal as ag
                        ON c.id_curso = ag.id_curso
            WHERE c.nome = '{$nomeCurso}' AND al.nome = '{$nomeAluno}' AND pr.id_curso IS NOT NULL AND ag.id_prof = pr.id_prof)
            ) x;";
        $database = new Database();
        return ($database->execute($query))->fetchObject()->qtd;
    }
}