<?php

namespace App\Controller\Intranet\Coord;

use App\Controller\Page\PageBuilder;
use App\Model\Entity\DisciplinaBase;
use App\Model\Entity\DisciplinaAnual;
use App\Model\Entity\Semestre;
use App\Model\Entity\DashboardCoord;
use App\Database\Pagination;
use App\Controller\Intranet\Menu;
use App\Controller\Page\Alert;

class CadastrarDiscAnual{
    public function __construct() {}

    //Método responsável por retornar a página de Cursos
    public static function getCadastrarDiscAnual($request){
        //Componentes do Cursos

        $curso = (DashboardCoord::getCoordCurso($_SESSION['admin']['usuario']['name'])[0])->nomeCurso;
        $semestre = Semestre::getSemestreAtivo();

        //Quantidade Disciplinas
        $qtdDisc = DisciplinaBase::getQtdNomesDiscBase($semestre, $curso);

        if($qtdDisc > 0){
            //Página atual
            $queryParams = $request->getQueryParams();
            $paginaAtual = $queryParams['page'] ?? 1;

            //Paginação
            $obPagination = new Pagination($qtdDisc, $paginaAtual,5);


            //Botões paginação
            $paginas = $obPagination->getPages();
            $paginacao = PageBuilder::getButtons($paginas,'/coord/cadastdiscanual');

            $status = '';

            // Adquirindo Professor
            $postVars = $request->getPostVars();
            if($postVars == null)
                $professor = 'Professor';
            else {
                $professor = $postVars['professor'] ?? '';
                $disciplina = $postVars['disciplina'] ?? '';
                if($professor == 'Professor')
                    $status = Alert::getError('Escolha qual professor deseja atribuir à nova disciplina do semestre');
                else {
                        $status = Alert::getSuccess('Disciplina cadastrada no semestre com sucesso');
                        DisciplinaAnual::cadastroDiscAnual($professor, $disciplina, $curso);
                }
            }

            if(DisciplinaBase::getQtdNomesDiscBase($semestre, $curso) > 0){
                //Listagem de disciplinas
                $dadosDiscBase = DisciplinaBase::getNomesDiscBase($semestre, $curso, $obPagination->getLimit());
                $items = PageBuilder::getItemsDiscAnual($dadosDiscBase);

                //Content
                $content = PageBuilder::getComponent("pages/coord/cadastrarDiscAnual", [
                    'items' => $items,
                    'pages' => $paginacao,
                    'status' => $status
                ]);
            }else {
                //Content
                $content = PageBuilder::getComponent("pages/coord/cadastrarDiscAnualVazio");
            }
            
        }else {
            //Content
            $content = PageBuilder::getComponent("pages/coord/cadastrarDiscAnualVazio");
        }

        //Header
        $header = PageBuilder::getComponent("pages/intranet/header", [
            'nome' => $_SESSION['admin']['usuario']['name'],
            'cargo' => "Coordenador de ". "<strong>{$curso}</strong>"
            ]);

        //Menu
        $menu = PageBuilder::getComponent("pages/intranet/menu", [
            'items' => PageBuilder::getMenu(Menu::getCoordMenu(), 'Cadastrar Disciplinas no Semestre')
            ]);

        //Recebe o Template e o Imprime na Tela
        echo PageBuilder::getTemplate('templates/intranet/template_intranet',[
            'title' => 'Cadastrar Disciplinas no Semestre',
            'header' => $header,
            'menu' => $menu,
            'content' => $content,
        ]);

      exit;
    }

}