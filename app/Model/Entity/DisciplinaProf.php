<?php

namespace App\Model\Entity;

use \PDO;
use App\Database\Database;

class DisciplinaProf{
    public $disc;

    public $prof;

    public function __construct() {}

    public static function getDisciplinaProf($nomeAluno, $nomeCurso, $limit){
        $ano = date('Y');
        $query = "SELECT db.nome as 'disc', pr.nome as 'prof'
        FROM disciplinaAnual as dl
            INNER JOIN ano as an
            ON dl.id_ano = an.id_ano
            INNER JOIN professor as pr
            ON dl.id_prof = PR.id_prof
            INNER JOIN disciplinaBase as db
            ON dl.id_discBase = db.id_discBase
                INNER JOIN curso as c
                ON db.id_curso = c.id_curso
        WHERE c.nome = '{$nomeCurso}' AND an.num = {$ano} AND dl.id_remat = (SELECT id_remat FROM rematricula WHERE aberta = 1 LIMIT 1) AND dl.ativa = 1 AND db.id_discBase NOT IN (SELECT db.id_discBase 
        FROM disciplinaBase as db
            INNER JOIN disciplinaAnual as dl
            ON db.id_discBase = dl.id_discBase
                INNER JOIN dados_aluno as da
                ON dl.id_discAnual = da.id_discAnual
                    INNER JOIN situacao_aluno as sa
                    ON da.id_sit = sa.id_sit
                    INNER JOIN aluno as al
                    ON da.id_aluno = al.id_aluno
                        INNER JOIN ano as an
                        ON al.id_ano = an.id_ano
        WHERE al.nome = '{$nomeAluno}' AND (sa.situacao_ NOT IN ('Reprovado','Trancado','COVID') OR db.anoMinimo > ((YEAR(CURDATE()) - an.num)+1))) LIMIT {$limit};";
        $database = new Database();
        return ($database->execute($query))->fetchAll(PDO::FETCH_CLASS,self::class);
    }

    public static function getQtdDisciplinaProf($nomeAluno, $nomeCurso){
        $ano = date('Y');
        $query = "SELECT COUNT(*) as 'qtd'
        FROM disciplinaAnual as dl
            INNER JOIN ano as an
            ON dl.id_ano = an.id_ano
            INNER JOIN professor as pr
            ON dl.id_prof = PR.id_prof
            INNER JOIN disciplinaBase as db
            ON dl.id_discBase = db.id_discBase
                INNER JOIN curso as c
                ON db.id_curso = c.id_curso
        WHERE c.nome = '{$nomeCurso}' AND an.num = {$ano} AND dl.id_remat = (SELECT id_remat FROM rematricula WHERE aberta = 1 LIMIT 1) AND dl.ativa = 1 AND db.id_discBase NOT IN (SELECT db.id_discBase 
        FROM disciplinaBase as db
            INNER JOIN disciplinaAnual as dl
            ON db.id_discBase = dl.id_discBase
                INNER JOIN dados_aluno as da
                ON dl.id_discAnual = da.id_discAnual
                    INNER JOIN situacao_aluno as sa
                    ON da.id_sit = sa.id_sit
                    INNER JOIN aluno as al
                    ON da.id_aluno = al.id_aluno
                        INNER JOIN ano as an
                        ON al.id_ano = an.id_ano
        WHERE al.nome = '{$nomeAluno}' AND (sa.situacao_ NOT IN ('Reprovado','Trancado','COVID') OR db.anoMinimo > ((YEAR(CURDATE()) - an.num)+1)));";
        return (new Database())->execute($query)->fetchObject()->qtd;
    }
}