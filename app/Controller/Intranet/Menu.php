<?php

namespace App\Controller\Intranet;

class Menu{
    public function __construct() {}

    private static $adminMenu = [
        'GERAL' => [
            [
                'label' => 'Dashboard',
                'link' =>  '/admin'
            ]
        ],
        'ADMINISTRAÇÃO' => [
            [
                'label' => 'Gerenciar Cursos',
                'link' => '/admin/cursos'
            ]
        ],
        'PESSOAS' => [
            [
                'label' => 'Gerenciar Usuários',
                'link' => '/admin/users'
            ]
        ],
        'CONTA' => [
            [
                'label' => 'Alterar Senha',
                'link' => '/admin/password'
            ]
        ]
    ];

    private static $coordMenu = [
        'GERAL' => [
            [
                'label' => 'Dashboard',
                'link' =>  '/coord'
            ]
        ],
        'ADMINISTRAÇÃO' => [
            [
                'label' => 'Gerenciar Disciplinas Base',
                'link' => '/coord/discbase'
            ],
            [
                'label' => 'Período',
                'link' => '/coord/periodo'
            ],
            [
                'label' => 'Gerenciar Avisos Globais',
                'link' => '/coord/avisos'
            ]
        ],
        'CONTA' => [
            [
                'label' => 'Alterar Senha',
                'link' => '/coord/password'
            ],
            [
                'label' => 'Alterar Perfil',
                'link' => '/professor'
            ]
        ]
    ];

    private static $professorMenu = [
        'GERAL' => [
            [
                'label' => 'Dashboard',
                'link' =>  '/professor'
            ]
        ],
        'ADMINISTRAÇÃO' => [
            [
                'label' => 'Disciplinas',
                'link' => '/professor/disciplinas'
            ]
        ],
        'CONTA' => [
            [
                'label' => 'Alterar Senha',
                'link' => '/professor/password'
            ]
        ]
    ];

    //Método responsável por retornar o Menu do Admin
    public static function getAdmMenu(){ return self::$adminMenu;}

     //Método responsável por retornar o Menu do Coordenador
     public static function getCoordMenu(){ return self::$coordMenu;}

    //Método responsável por retornar o Menu do Professor
    public static function getProfessorMenu(){ return self::$professorMenu;}

}