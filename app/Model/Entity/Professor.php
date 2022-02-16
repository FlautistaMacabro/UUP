<?php

namespace App\Model\Entity;

use \PDO;
use App\Database\Database;

class Professor{

    public $nome;

    public function __construct() {}

    public static function getNomesProf() {
        $query = "SELECT nome as 'nome' FROM professor;";
        return (new Database())->execute($query)->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function getDisciplinaName($idDisc){
        $query = "SELECT db.nome as 'nomeDisc'
        FROM disciplinaBase as db
            INNER JOIN disciplinaAnual as dl
            ON db.id_discBase = dl.id_discBase
        WHERE dl.id_discAnual = {$idDisc};";
        $database = new Database();
        return (($database->execute($query))->fetch(PDO::FETCH_ASSOC))['nomeDisc'];
    }

    public static function listDiscAtivasProf($idProf, $limit){
        $query = "SELECT dl.id_discAnual, db.nome
        FROM disciplinaAnual as dl
            INNER JOIN disciplinaBase as db
            ON dl.id_discBase = db.id_discBase
        WHERE dl.id_prof = {$idProf} AND dl.ativa = 1 LIMIT {$limit};";
        $database = new Database();
        return ($database->execute($query))->fetchAll(PDO::FETCH_CLASS,self::class);
    }

    public static function getQtdDiscAtivasProf($idProf){
        $query = "SELECT COUNT(*) as qtd
        FROM disciplinaAnual as dl
            INNER JOIN disciplinaBase as db
            ON dl.id_discBase = db.id_discBase
        WHERE dl.id_prof = {$idProf} AND dl.ativa = 1;";
        $database = new Database();
        return ($database->execute($query))->fetchObject()->qtd;
    }

    public static function getDadosAluno($idDiscAnual){
        $query = " SELECT al.nome as 'nome', da.id_dados as 'idDados'
        FROM dados_aluno as da
            INNER JOIN aluno as al
            ON da.id_aluno = al.id_aluno
        WHERE da.id_discAnual = {$idDiscAnual};";
        $database = new Database();
        return ($database->execute($query))->fetchAll(PDO::FETCH_CLASS,self::class);
    }

}