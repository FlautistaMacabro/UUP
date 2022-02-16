<?php

namespace App\Controller\Public\Aluno;

use App\Controller\Page\PageBuilder;
use App\Model\Entity\DisciplinaProf;
use App\Model\Entity\DadosAluno;
use App\Database\Pagination;
use App\Controller\Public\Menu;
use App\Controller\Page\Alert;

class Matricula{
    public function __construct() {}

    //Método responsável por retornar a página de Cursos
    public static function getMatricula($request){
        //Componentes da Matrícula

        $curso = $_SESSION['usuario']['curso'];
        $nomeAluno = $_SESSION['usuario']['name'];

        //Quantidade Disciplinas disponíveis
        $qtdDisc = DisciplinaProf::getQtdDisciplinaProf($nomeAluno, $curso);

        $status = '';

        if($qtdDisc > 0){
            //Página atual
            $queryParams = $request->getQueryParams();
            $paginaAtual = $queryParams['page'] ?? 1;

            //Paginação
            $obPagination = new Pagination($qtdDisc, $paginaAtual,5);


            //Botões paginação
            $paginas = $obPagination->getPages();
            $paginacao = PageBuilder::getButtons($paginas,'/matricula');

            // Adquirindo Professor
            $postVars = $request->getPostVars();
            if($postVars != null){
                $disciplina = $postVars['disc'] ?? '';
                $professor = $postVars['prof'] ?? '';
                $status = Alert::getSuccess('A matrícula na disciplina foi um sucesso');
                DadosAluno::cadastrarDadosAluno($nomeAluno, 'Em execução', $curso, $disciplina, $professor);
            }

            if(DisciplinaProf::getQtdDisciplinaProf($nomeAluno, $curso) > 0){
                //Listagem de disciplinas
                $dadosDiscProf = DisciplinaProf::getDisciplinaProf($nomeAluno, $curso, $obPagination->getLimit());
                $items = PageBuilder::getItemsDadosAluno($dadosDiscProf);

                //Content
                $content = PageBuilder::getComponent("pages/aluno/matricula", [
                    'items' => $items,
                    'pages' => $paginacao,
                    'status' => $status
                ]);
            }else {
                //Content
                $content = PageBuilder::getComponent("pages/aluno/matriculaVazia", [
                    'status' => $status
                ]);
            }
            
        }else {
            //Content
            $content = PageBuilder::getComponent("pages/aluno/matriculaVazia", [
                'status' => $status
            ]);
        }

        //Header
        $header = PageBuilder::getComponent("pages/public/header", [
            'nome' => $nomeAluno,
            'cargo' => "Aluno"
            ]);

        //Menu
        $menu = PageBuilder::getComponent("pages/public/menu", [
            'items' => PageBuilder::getMenu(Menu::getAlunoMenu(), 'Rematrícula')
            ]);

        //Recebe o Template e o Imprime na Tela
        echo PageBuilder::getTemplate('templates/public/template',[
            'title' => 'Rematrícula',
            'header' => $header,
            'menu' => $menu,
            'content' => $content,
        ]);

      exit;
    }

}