<?php

namespace App\Model\Entity;

use \PDO;
use App\Database\Database;

class DiscAlunoAnual{
    public $disc;

    public $prof;

    public $media;

    public $freq;

    public $aulasDadas;

    public $aulasPrev;

    public $situacao;

    public function __construct() {}

    public static function getValues($nomeCurso, $ano, $semestre, $nomeAluno){
        $query = "SELECT db.nome as 'disc', pr.nome as 'prof', da.mediaFinal as 'media', da.freqFinal as 'freq', dl.quantAulasDadas as 'aulasDadas', db.quantAulasPrev as 'aulasPrev', sa.situacao_ as 'situacao'
                    FROM disciplinaAnual as dl
                        INNER JOIN disciplinaBase as db
                        ON dl.id_discBase = db.id_discBase
                            INNER JOIN curso as c
                            ON db.id_curso = c.id_curso
                        INNER JOIN dados_aluno as da
                        ON dl.id_discAnual = da.id_discAnual
                            INNER JOIN situacao_aluno as sa
                            ON da.id_sit = sa.id_sit
                            INNER JOIN aluno as al
                            ON da.id_aluno = al.id_aluno
                        INNER JOIN professor as pr
                        ON dl.id_prof = pr.id_prof
                        INNER JOIN ano as an
                        ON dl.id_ano = an.id_ano
                    WHERE c.nome = '{$nomeCurso}' AND an.num = {$ano} AND db.id_sem = {$semestre} AND al.nome = '{$nomeAluno}'
                    ORDER BY db.nome, pr.nome;";
        $database = new Database();
        return ($database->execute($query))->fetchAll(PDO::FETCH_CLASS,self::class);
    }
    
}