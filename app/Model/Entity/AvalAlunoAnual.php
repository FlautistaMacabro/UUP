<?php

namespace App\Model\Entity;

use \PDO;
use App\Database\Database;

class AvalAlunoAnual{
    public $disc;

    public $prof;

    public $data;

    public $aval;

    public $nota;

    public $freq;

    public $aulasDadas;

    public $aulasPrev;

    public function __construct() {}

    public static function getValues($nomeCurso, $ano, $semestre, $nomeAluno){
        $query = "SELECT db.nome as 'disc', pr.nome as 'prof', au.dataAula as 'data', av.nome as 'aval', n.nota as 'nota', da.freqFinal as 'freq', dl.quantAulasDadas as 'aulasDadas', db.quantAulasPrev as 'aulasPrev'
        FROM disciplinaAnual as dl
            INNER JOIN disciplinaBase as db
            ON dl.id_discBase = db.id_discBase
                INNER JOIN curso as c
                ON db.id_curso = c.id_curso
            INNER JOIN aula as au
            ON dl.id_discAnual = au.id_discAnual
                INNER JOIN avaliacao as av
                ON au.id_aula = av.id_aula
            INNER JOIN dados_aluno as da
            ON dl.id_discAnual = da.id_discAnual
                INNER JOIN aluno as al
                ON da.id_aluno = al.id_aluno
                INNER JOIN nota as n
                ON da.id_dados = n.id_dados and av.id_aval = n.id_aval
            INNER JOIN professor as pr
            ON dl.id_prof = pr.id_prof
            INNER JOIN ano as an
            ON dl.id_ano = an.id_ano
        WHERE c.nome = '{$nomeCurso}' AND an.num = {$ano} AND db.id_sem = {$semestre} AND al.nome = '{$nomeAluno}'
        ORDER BY db.nome, pr.nome;";
        $database = new Database();
        return ($database->execute($query))->fetchAll(PDO::FETCH_CLASS,self::class);
    }

    // public function __toString()
    // {
    //     return ($this->disc . $this->prof . $this->data . $this->aval . $this->nota . $this->freq . $this->aulasDadas . $this->aulasPrev);
    // }
    
}