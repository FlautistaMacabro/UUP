<?php

namespace App\Model\Entity;

use \PDO;
use App\Database\Database;

class DadosAluno{
    public $ano;

    public function __construct() {}

    public static function cadastrarDadosAluno($nomeAluno, $situacao, $nomeCurso, $nomeDisc, $nomeProf){
        $ano = date('Y');
        $query = "CALL sp_cadastro_dadosAlunoPorNomes('$nomeAluno', '$situacao', '$nomeCurso', '$nomeDisc', '$nomeProf', $ano);";
        $database = new Database();
        return ($database->execute($query))->fetchAll(PDO::FETCH_CLASS,self::class);
    }
}