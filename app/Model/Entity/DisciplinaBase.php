<?php

namespace App\Model\Entity;

use \PDO;
use \PDOException;
use App\Database\Database;

class DisciplinaBase{
    public $id_discBase;

    public $nome;

    public $cargaHoraria;

    public $quantAulasPrev;

    public $anoMinimo;

    public $id_curso;

    public $id_sem;

    public function __construct() {}

    public static function listDiscBase($limit){
        return (new Database("DisciplinaBase"))->select(null, null, $limit,"nome")->fetchAll(PDO::FETCH_CLASS,self::class);
    }

    public static function getQtdDiscBase(){
        return (new Database("DisciplinaBase"))->select(null, null, null,"COUNT(*) as qtd")->fetchObject()->qtd;
    }

    public static function cadastrarDiscBase($nome,$cargaHoraria, $quantAulasPrev, $nome_curso, $semestreDado, $ano_minimo){
        $query = "CALL sp_cadastro_disciplina_base('{$nome}','{$cargaHoraria}','{$quantAulasPrev}','{$nome_curso}','{$semestreDado}','{$ano_minimo}');";
        $database = new Database();
        $status = $database->execute($query);
        if($status instanceof PDOException){
            return $status->getMessage();
        }
        else{
            return true;
        }
    }


    public static function atualizarDiscBase($nomeDiscBaseAtual, $nomeCursoAtual,$nomeDiscBaseNovo, $cargaHorariaDada, $quantAulasPrevDada,$semestreDado,$nomeCursoNovo,$ano_minimo){
        $query = "CALL atualizarDiscBasePorNome('{$nomeDiscBaseAtual}','{$nomeCursoAtual}','{$nomeDiscBaseNovo}','{$cargaHorariaDada}','{$quantAulasPrevDada}','{$semestreDado}','{$nomeCursoNovo}','{$ano_minimo}');";
        $database = new Database();
        $status = $database->execute($query);
        if($status instanceof PDOException){
            return $status->getMessage();
        }
        else{
            return true;
        }
    }

    public static function deletarDiscBase($nomeDiscBase,$nomeCurso){
        $query = "CALL  deletaDiscBasePorNome('{$nomeDiscBase}','{$nomeCurso}');";
        $database = new Database();
        $status = $database->execute($query);
        if($status instanceof PDOException){
            return $status->getMessage();
        }
        else{
            return true;
        }
    }

    public static function infoDiscBase($nomeDiscBase){
        $query = "SELECT nome as 'nome_disc',cargaHoraria as 'carga_horaria', quantAulasPrev as 'qtd_aulas_previstas', id_sem as 'semestre_dado', anoMinimo as 'ano_min' FROM disciplinaBase WHERE nome = '{$nomeDiscBase}' LIMIT 1;";
        return (new Database())->execute($query)->fetch(PDO::FETCH_ASSOC);
    }

}


