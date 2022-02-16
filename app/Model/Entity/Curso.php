<?php

namespace App\Model\Entity;

use \PDO;
use \PDOException;
use App\Database\Database;

class Curso{
    public $id_curso;

    public $nome;

    public $minAnos;

    public $maxAnos;

    public $qtdAlunos;

    public function __construct() {}

    public static function listCurso($limit){
        return (new Database("Curso"))->select(null, null, $limit,"nome")->fetchAll(PDO::FETCH_CLASS,self::class);
    }

    public static function getQtdCursos(){
        return (new Database("Curso"))->select(null, null, null,"COUNT(*) as qtd")->fetchObject()->qtd;
    }

    public static function cadastrarCurso($nomeCurso,$tipoCurso, $minAnos, $maxAnos, $nomeAdm){
        $query = "CALL sp_cadastro_curso('{$nomeCurso}','{$tipoCurso}','{$minAnos}','{$maxAnos}','{$nomeAdm}');";
        $database = new Database();
        $status = $database->execute($query);
        if($status instanceof PDOException){
            return $status->getMessage();
        }
        else{
            return true;
        }
    }


    public static function atualizarCurso($nomeCursoAtual, $nomeCursoNovo,$tipoCurso, $minAnos, $maxAnos){
        $query = "CALL atualizarCursoPorNome('{$nomeCursoAtual}','{$nomeCursoNovo}','{$tipoCurso}','{$minAnos}','{$maxAnos}');";
        $database = new Database();
        $status = $database->execute($query);
        if($status instanceof PDOException){
            return $status->getMessage();
        }
        else{
            return true;
        }
    }

    public static function deletarCurso($nomeCurso){
        $query = "CALL  deletaCursoPorNome('{$nomeCurso}');";
        $database = new Database();
        $status = $database->execute($query);
        if($status instanceof PDOException){
            return $status->getMessage();
        }
        else{
            return true;
        }
    }

    public static function infoCurso($nomeCurso){
        $query = "SELECT id_curso, nome, tipo, minAnos, maxAnos FROM curso WHERE nome = '{$nomeCurso}' LIMIT 1;";
        return (new Database())->execute($query)->fetch(PDO::FETCH_ASSOC);
    }

    public static function nomeCoordenadores($nomeCurso){
        $query = "SELECT pr.nome
        FROM professor as pr
            INNER JOIN curso as c
            ON pr.id_curso = c.id_curso
        WHERE c.nome = '{$nomeCurso}';";
        return (new Database())->execute($query)->fetchAll(PDO::FETCH_ASSOC);
    }

}


