<?php

namespace App\Controller\Intranet\Coord;

use App\Controller\Page\PageBuilder;
use App\Controller\Intranet\Menu;
use App\Controller\Page\Alert;
use App\Model\Entity\Semestre;
use App\Model\Entity\DashboardCoord;

class FecharRematricula{
    public function __construct() {}

    //Método responsável por retornar a página de Alterar Senha
    public static function getFecharRematricula($request = null)
    {
        // Componentes do Abrir Semestre
        $curso = (DashboardCoord::getCoordCurso($_SESSION['admin']['usuario']['name'])[0])->nomeCurso;
        
        // Header
        $header = PageBuilder::getComponent("pages/intranet/header", [
            'nome' => $_SESSION['admin']['usuario']['name'],
            'cargo' => "Coordenador de ". "<strong>{$curso}</strong>"
        ]);

        // Menu
        $menu = PageBuilder::getComponent("pages/intranet/menu", [
            'items' => PageBuilder::getMenu(Menu::getCoordMenu(), 'Fechar Rematrícula')
        ]);

        $status = '';
        if($request != null){
            // Carregando a mensagem correta
            $status = Semestre::fecharRematricula($curso);

            if($status == -1)
                $status = Alert::getError('Há disciplinas diponíveis que nenhum aluno se inscreveu');
            else $status == 0 ? $status = Alert::getError('Não há rematrículas abertas') : $status = Alert::getSuccess('A rematrícula foi fechada com sucesso');
        }

        // Content
        $content = PageBuilder::getComponent("pages/coord/fecharRematricula", [
          'status' => $status
        ]);

        // //Recebe o Template e o Imprime na Tela
        echo PageBuilder::getTemplate('templates/intranet/template_intranet',[
            'title' => 'Fechar Rematrícula',
            'header' => $header,
            'menu' => $menu,
            'content' => $content
        ]);

        exit;
    }

}

?>