<?php

namespace App\Model\Entity;

use \PDO;
use \PDOException;
use App\Database\Database;

class AvisoProf{
    public function __construct() {}


    public static function listAvisos($idDiscAnual, $limit){
        $query = "SELECT id_aviso, nome, descricao, dataHora FROM aviso WHERE id_discAnual = {$idDiscAnual} LIMIT {$limit};";
        $database = new Database();
        return ($database->execute($query))->fetchAll(PDO::FETCH_CLASS,self::class);
    }

    public static function listAvisosPorID($idAviso){
        $query = "SELECT id_aviso, nome, descricao, dataHora FROM aviso WHERE id_aviso = {$idAviso} LIMIT 1;";
        $database = new Database();
        return ($database->execute($query))->fetch(PDO::FETCH_ASSOC);
    }

    public static function getQtdAvisos($idDiscAnual){
        $query = "SELECT COUNT(*) as qtd FROM aviso WHERE id_discAnual = {$idDiscAnual};";
        $database = new Database();
        return ($database->execute($query))->fetchObject()->qtd;
    }

    public static function cadastrarAvisos($nomeAviso,$descricao, $idDiscAnual){
        $query = "CALL sp_cadastro_avisoPorID ('{$nomeAviso}','{$descricao}','{$idDiscAnual}');";
        $database = new Database();
        $status = $database->execute($query);
        if($status instanceof PDOException){
            return $status->getMessage();
        }
        else{
            return true;
        }
    }

    public static function atualizarAviso($idAviso, $nomeAviso,$descricaoAviso){
        $query = "CALL atualizarAviso({$idAviso},'{$nomeAviso}','{$descricaoAviso}');";
        $database = new Database();
        $status = $database->execute($query);
        if($status instanceof PDOException){
            return $status->getMessage();
        }
        else{
            return true;
        }
    }

    public static function deletarAvisos($id){
        $query = "CALL deletaAvisoPorID({$id});";
        $database = new Database();
        $status = $database->execute($query);
        if($status instanceof PDOException){
            return $status->getMessage();
        }
        else{
            return true;
        }
    }

}