<?php

namespace App\Model\Entity;

use \PDO;
use App\Database\Database;

class Ano{
    public $ano;

    public function __construct() {}

    public static function getAnosAluno($nomeAluno){
        $query = "SELECT num as 'ano' FROM ano WHERE num >= (SELECT an.num 
                    FROM ano as an
                        INNER JOIN aluno as al
                        ON an.id_ano = al.id_aluno
                    WHERE al.nome = '{$nomeAluno}'
                    LIMIT 1);";
        $database = new Database();
        return ($database->execute($query))->fetchAll(PDO::FETCH_CLASS,self::class);
    }
}