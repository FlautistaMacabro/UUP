<?php

namespace App\Controller\Intranet\Coord;

use App\Controller\Page\PageBuilder;
use App\Controller\Intranet\Menu;
use App\Controller\Page\Alert;
use App\Model\Entity\Semestre;
use App\Model\Entity\DashboardCoord;

class FecharSemestre{
    public function __construct() {}

    //Método responsável por retornar a página de Alterar Senha
    public static function getFecharSemestre($request = null)
    {
        // Componentes do Fechar Semestre

        // Header
        $header = PageBuilder::getComponent("pages/intranet/header", [
            'nome' => $_SESSION['admin']['usuario']['name'],
            'cargo' => 'Coordenador'
        ]);

        // Menu
        $menu = PageBuilder::getComponent("pages/intranet/menu", [
            'items' => PageBuilder::getMenu(Menu::getCoordMenu(), 'Fechar Semestre')
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
            $status = Alert::getError('Escolha qual semestre que deseja fechar');
        elseif ($semestre != null){
            $status = Semestre::fecharSemestre($semestre,(DashboardCoord::getCoordCurso($_SESSION['admin']['usuario']['name'])[0])->nomeCurso);
            if($status == -1)
                $status = Alert::getError('As disciplinas do curso durante semestre escolhido precisam estar fechadas antes');
            else $status == 0 ? $status = Alert::getError('O semestre escolhido já está fechado') : $status = Alert::getSuccess('O semestre foi aberto com sucesso');
        }

        $semestresAluno = array('1','2');
        $semestresAluno = PageBuilder::getOptionsSemestre($semestresAluno, $semestre);

        // Content
        $content = PageBuilder::getComponent("pages/coord/fecharSemestre", [
          'status' => $status,
          'semestres' => $semestresAluno,
        ]);

        // //Recebe o Template e o Imprime na Tela
        echo PageBuilder::getTemplate('templates/intranet/template_intranet',[
            'title' => 'Fechar Semestre',
            'header' => $header,
            'menu' => $menu,
            'content' => $content
        ]);

        exit;
    }

}

?>