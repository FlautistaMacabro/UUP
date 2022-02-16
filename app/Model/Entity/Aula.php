<?php

namespace App\Model\Entity;

use \PDO;
use \PDOException;
use App\Database\Database;

class Aula{
    public function __construct() {}

    public static function listAulas($idDiscAnual, $limit){
        $query = "SELECT nome, id_aula FROM aula WHERE id_discAnual = {$idDiscAnual} LIMIT {$limit};";
        return (new Database())->execute($query)->fetchAll(PDO::FETCH_CLASS,self::class);
    }

    public static function getQtdAulas($idDiscAnual){
        $query = "SELECT COUNT(*) as qtd FROM aula WHERE id_discAnual = {$idDiscAnual};";
        return ((new Database())->execute($query))->fetchObject()->qtd;
    }

    public static function getNomeeIDDados($idDiscAnual){
        $query = "SELECT al.nome as 'nome', da.id_dados as 'idDados'
        FROM dados_aluno as da
            INNER JOIN aluno as al
            ON da.id_aluno = al.id_aluno
        WHERE da.id_discAnual = {$idDiscAnual};";
        return (new Database())->execute($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getIDAula($idDiscAnual){
        $query = "SELECT id_aula FROM aula WHERE id_discAnual = {$idDiscAnual} ORDER BY id_aula DESC LIMIT 1;";
        return (new Database())->execute($query)->fetch(PDO::FETCH_ASSOC);
    }

    public static function listarDadosAulaPorID($idAula){
        $query = "SELECT au.id_aula, au.nome, au.descricao, au.dataAula, ha.hora as 'dataHora'
        FROM aula as au
            INNER JOIN hora_aula as ha
            ON au.id_hora = ha.id_hora
        WHERE au.id_aula = {$idAula};";
        return (new Database())->execute($query)->fetch(PDO::FETCH_ASSOC);
    }

    public static function listarDadosdeFreqPorIDAula($idAula){
        $query = "SELECT al.nome as 'nomeAluno', fr.faltou_ as 'presenca'
        FROM frequencia as fr
            INNER JOIN dados_aluno as da
            ON fr.id_dados = da.id_dados
                INNER JOIN aluno as al
                ON da.id_aluno = al.id_aluno
        WHERE fr.id_aula = {$idAula};";
        return (new Database())->execute($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function cadastrarAulas($nomeAula,$descricaoAula, $dataAulaDada, $horaAula, $idDiscAnual){
        $query = "CALL sp_cadastro_aulaPorID ('{$nomeAula}','{$descricaoAula}','{$dataAulaDada}','{$horaAula}','{$idDiscAnual}');";
        $database = new Database();
        $status = $database->execute($query);
        if($status instanceof PDOException){
            return $status->getMessage();
        }
        else{
            return true;
        }
    }

    public static function cadastrarFrequenciaPorID($idAula,$presenca, $IdDados){
        $query = "CALL sp_cadastro_frequenciaPorID('{$idAula}','{$presenca}','{$IdDados}');";
        $database = new Database();
        $status = $database->execute($query);
        if($status instanceof PDOException){
            return $status->getMessage();
        }
        else{
            return true;
        }
    }

    public static function atualizarAulasPorID($idAula, $nomeDado,$descricaoDada){
        $query = "CALL atualizarAulaPorID({$idAula},'{$nomeDado}','{$descricaoDada}');";
        $database = new Database();
        $status = $database->execute($query);
        if($status instanceof PDOException){
            return $status->getMessage();
        }
        else{
            return true;
        }
    }

    public static function atualizarFrequenciaPorID($idAula, $idDados,$presenca){
        $query = "CALL atualizarFrequenciaPorID({$idAula},'{$idDados}','{$presenca}');";
        $database = new Database();
        $status = $database->execute($query);
        if($status instanceof PDOException){
            return $status->getMessage();
        }
        else{
            return true;
        }
    }

    public static function deletarAulas($id){
        $query = "CALL deletaAulaPorID({$id});";
        $database = new Database();
        $status = $database->execute($query);
        if($status instanceof PDOException){
            return $status->getMessage();
        }
        else{
            return true;
        }
    }

    public static function getAulasInfo($idAviso, $grupo){
        $query = "CALL listarContentAviso('{$idAviso}', '{$grupo}', @assuntoSaida, @descricaoSaida);";
        $database = new Database();
        $database->execute($query);
        return (($database->execute('SELECT @assuntoSaida as assunto,@descricaoSaida as descricao'))->fetch(PDO::FETCH_ASSOC));
    }
}