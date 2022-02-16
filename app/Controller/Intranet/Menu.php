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
        'GERENCIAR USUÁRIOS' => [
            [
                'label' => 'Cadastrar Aluno',
                'link' => '/admin/cadaluno'
            ],
            [
                'label' => 'Cadastrar Professor',
                'link' => '/admin/cadprof'
            ]
            // [
            //     'label' => 'Cadastrar Coordenador',
            //     'link' => '/admin/cadcoord'
            // ]
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
                'label' => 'Gerenciar Avisos Globais',
                'link' => '/coord/avisos'
            ],
            [
                'label' => 'Cadastrar Disciplinas no Semestre',
                'link' => '/coord/cadastdiscanual'
            ],
            [
                'label' => 'Abrir Semestre',
                'link' => '/coord/abrirsemestre'
            ],
            [
                'label' => 'Fechar Semestre',
                'link' => '/coord/fecharsemestre'
            ],
            [
                'label' => 'Abrir Rematrícula',
                'link' => '/coord/abrirrematricula'
            ],
            [
                'label' => 'Fechar Rematrícula',
                'link' => '/coord/fecharrematricula'
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

    private static $professorMenuCoord = [
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
                'label' => 'Alterar Perfil',
                'link' => '/coord'
            ]
        ]
    ];

    //Método responsável por retornar o Menu do Admin
    public static function getAdmMenu(){ return self::$adminMenu;}

     //Método responsável por retornar o Menu do Coordenador
     public static function getCoordMenu(){ return self::$coordMenu;}

    //Método responsável por retornar o Menu do Professor
    public static function getProfessorMenu(){ return self::$professorMenu;}

    //Método responsável por retornar o Menu do Professor Coord
    public static function getProfessorMenuCoord(){ return self::$professorMenuCoord;}

}