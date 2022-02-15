<?php

namespace App\Controller\Public;

class Menu{
    public function __construct() {}

    private static $alunoMenu = [
        'GERAL' => [
            [
                'label' => 'Frequências e Notas',
                'link' =>  '/'
            ]
        ],
        'CONTA' => [
            [
                'label' => 'Alterar Senha',
                'link' => '/password'
            ]
        ]
    ];

    //Método responsável por retornar o Menu do Aluno
    public static function getAlunoMenu(){return self::$alunoMenu;}

}