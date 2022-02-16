<?php

namespace App\Model\Entity;

use \PDO;
use \PDOException;
use App\Database\Database;

class Aviso{
    public $id;

    public $id_AvisoGlobal;

    public $remetente;

    public $grupo;

    public $assunto;

    public $dataHora;

    public function __construct() {}

    public static function listAvisosGlobais($limit){
        return (new Database("AvisoGlobal"))->select(null, null, $limit,"id_AvisoGlobal, nome")->fetchAll(PDO::FETCH_CLASS,self::class);
    }

    public static function getQtdAvisosGlobais(){
        return (new Database("AvisoGlobal"))->select(null, null, null,"COUNT(*) as qtd")->fetchObject()->qtd;
    }

    public static function cadastrarAvisoGlobal($nomeAviso,$descricaoAviso, $nome_curso, $nomeProf){
        $query = "CALL sp_cadastro_aviso_global('{$nomeAviso}','{$descricaoAviso}','{$nome_curso}','{$nomeProf}');";
        $database = new Database();
        $status = $database->execute($query);
        if($status instanceof PDOException){
            return $status->getMessage();
        }
        else{
            return true;
        }
    }

    public static function atualizarAvisoGlobal($idAvisoGlobal, $nomeAviso,$descricaoAviso){
        $query = "CALL atualizarAvisoGlobal({$idAvisoGlobal},'{$nomeAviso}','{$descricaoAviso}');";
        $database = new Database();
        $status = $database->execute($query);
        if($status instanceof PDOException){
            return $status->getMessage();
        }
        else{
            return true;
        }
    }

    public static function deletarAvisoGlobal($id){
        $query = "CALL  deletaAvisoGlobalPorID({$id});";
        $database = new Database();
        $status = $database->execute($query);
        if($status instanceof PDOException){
            return $status->getMessage();
        }
        else{
            return true;
        }
    }

    public static function infoAvisoGlobal($idAviso){
        $query = "SELECT id_avisoGlobal,nome,descricao FROM AvisoGlobal WHERE id_avisoGlobal = {$idAviso} LIMIT 1;";
        return (new Database())->execute($query)->fetch(PDO::FETCH_ASSOC);
    }

    public static function getAvisos($nomeCurso, $nomeAluno, $limit){
        $query = "SELECT av.id_aviso as 'id',pr.nome as 'remetente', db.nome as 'grupo', av.nome as 'assunto', av.dataHora as 'dataHora'
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
                SELECT ag.id_avisoGlobal as 'id', pr.nome as 'remetente', '{$nomeCurso}' as 'grupo', ag.nome as 'assunto', ag.dataHora as 'dataHora'
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

    public static function getAvisosInfo($idAviso, $grupo){
        $query = "CALL listarContentAviso('{$idAviso}', '{$grupo}', @assuntoSaida, @descricaoSaida);";
        $database = new Database();
        $database->execute($query);
        return (($database->execute('SELECT @assuntoSaida as assunto,@descricaoSaida as descricao'))->fetch(PDO::FETCH_ASSOC));
    }
}