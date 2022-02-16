<?php

namespace App\Controller\Intranet\Admin;

use App\Controller\Page\PageBuilder;
use App\Model\Entity\Curso;
use App\Model\Entity\Aluno;
use App\Controller\Intranet\Menu;
use App\Controller\Page\Alert;

class CadastroAluno{
    public function __construct() {}

    //Método responsável por retornar o cadastro de aluno
    public static function getCadastroAluno($request = null)
    {
        //Componentes do cadastro de aluno

        // Lista de Cursos
        $cursos = Curso::listCurso(null);
        $items = PageBuilder::getOptionsCurso($cursos);

        //Header
        $header = PageBuilder::getComponent("pages/intranet/header", [
          'nome' => $_SESSION['admin']['usuario']['name'],
          'cargo' => 'Administrador'
          ]);


        //Menu
        $menu = PageBuilder::getComponent("pages/intranet/menu", [
          'items' => PageBuilder::getMenu(Menu::getAdmMenu(), 'Cadastrar Aluno')
          ]);

        $status = '';

        if($request != null){
            $postVars = $request->getPostVars();
            $nome = $postVars['nome'] ?? '';
            $rg = $postVars['rg'] ?? '';
            $cpf = $postVars['cpf'] ?? '';
            $senha = $postVars['senha'] ?? '';
            $dataNasc = $postVars['data'] ?? '';
            $curso = $postVars['curso'] ?? '';

            if($nome == '' || $rg == '' || $cpf == '' || $senha == '' || $dataNasc == '' || $curso == '' || $curso == '-1')
                $status = Alert::getError('Preencha todos os campos antes de cadastrar');
            else {
                $status = Alert::getSuccess('Aluno cadastrado com sucesso!');
                Aluno::cadastrarAluno($nome, $rg, $cpf, $senha, $dataNasc, $curso);
            }
        }

        //Content
        $content = PageBuilder::getComponent("pages/admin/cadastrarAluno", [
            'status' => $status,
            'cursos' => $items
          ]);

        //Recebe o Template e o Imprime na Tela
        echo PageBuilder::getTemplate('templates/intranet/template_intranet',[
          'title' => 'Cadastrar Aluno',
          'header' => $header,
          'menu' => $menu,
          'content' => $content
        ]);

        exit;
    }


}