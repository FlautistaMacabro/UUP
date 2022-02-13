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
        'APRESENTAÇÃO' => [
            [
                'label' => 'Cursos',
                'link' => '/admin/cursos'
            ]
        ],
        'PESSOAS' => [
            [
                'label' => 'Usuários',
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

    //Método responsável por retornar o Menu do Admin
    public static function getAdmMenu(){ return self::$adminMenu;}

}