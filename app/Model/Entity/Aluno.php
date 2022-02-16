<?php

namespace App\Model\Entity;

use \PDO;
use App\Database\Database;

class Aluno{
    public $ano;

    public function __construct() {}

    public static function cadastrarAluno($nome, $rg, $cpf, $senha, $dataNasc, $curso){
        $query = "CALL sp_cadastro_aluno ('$senha', '$nome', '$cpf', '$rg', '$dataNasc', '$curso');";
        $database = new Database();
        $database->execute($query);
    }
}