<?php

namespace App\Controller\Intranet\Coord;

use App\Controller\Page\PageBuilder;
use App\Controller\Intranet\Menu;
use App\Controller\Page\Alert;
use App\Model\Entity\Semestre;
use App\Model\Entity\DashboardCoord;

class AbrirRematricula{
    public function __construct() {}

    //Método responsável por retornar a página de Alterar Senha
    public static function getAbrirRematricula($request = null)
    {
        // Componentes do Abrir Rematricula

        // Header
        $header = PageBuilder::getComponent("pages/intranet/header", [
            'nome' => $_SESSION['admin']['usuario']['name'],
            'cargo' => 'Coordenador'
        ]);

        // Menu
        $menu = PageBuilder::getComponent("pages/intranet/menu", [
            'items' => PageBuilder::getMenu(Menu::getCoordMenu(), 'Abrir Rematrícula')
        ]);

        // $status = '';

        // Obtendo o semestre dado
        if($request != null){
            $postVars = $request->getPostVars();
            $semestre = $postVars['semestre'];

            if($semestre != '0')
                $semestre = intval($semestre);
        }else $semestre = null;

        // Carregando a mensagem correta
        $status = '';

        if($semestre == '0')
            $status = Alert::getError('Escolha qual semestre que deseja abrir a rematrícula');
        elseif ($semestre != null){
            $status = Semestre::abrirRematricula($semestre,(DashboardCoord::getCoordCurso($_SESSION['admin']['usuario']['name'])[0])->nomeCurso);
            if($status == -2)
                $status = Alert::getError('O semestre escolhido está fechado');
            elseif ($status == -1)
                $status = Alert::getError('É necessário ter pelo menos uma disciplina ativa no semestre escolhido');
            else $status == 0 ? $status = Alert::getError('O semestre escolhido já está com uma rematrícula em aberto') : $status = Alert::getSuccess('A rematrícula foi aberta com sucesso');
        }

        $semestresAluno = array('1','2');
        $semestresAluno = PageBuilder::getOptionsSemestre($semestresAluno, $semestre);

        // Content
        $content = PageBuilder::getComponent("pages/coord/abrirRematricula", [
          'status' => $status,
          'semestres' => $semestresAluno,
        ]);

        // //Recebe o Template e o Imprime na Tela
        echo PageBuilder::getTemplate('templates/intranet/template_intranet',[
            'title' => 'Abrir Rematrícula',
            'header' => $header,
            'menu' => $menu,
            'content' => $content
        ]);

        exit;
    }

}

?>