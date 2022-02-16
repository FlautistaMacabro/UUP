<?php

namespace App\Controller\Intranet\Admin;

use App\Controller\Page\PageBuilder;
use App\Model\Entity\Curso;
use App\Model\Entity\Professor;
use App\Controller\Intranet\Menu;
use App\Controller\Page\Alert;

class CadastroCoordenador{
    public function __construct() {}

    //Método responsável por retornar o cadastro de aluno
    public static function getCadastroCoordenador($request = null)
    {
        //Componentes do cadastro de coordenador

        //Header
        $header = PageBuilder::getComponent("pages/intranet/header", [
          'nome' => $_SESSION['admin']['usuario']['name'],
          'cargo' => 'Administrador'
          ]);


        //Menu
        $menu = PageBuilder::getComponent("pages/intranet/menu", [
          'items' => PageBuilder::getMenu(Menu::getAdmMenu(), 'Cadastrar Coordenador')
          ]);

        $status = '';

        if($request != null){
            $postVars = $request->getPostVars();
            $nome = $postVars['nome'] ?? '';
            $rg = $postVars['rg'] ?? '';
            $cpf = $postVars['cpf'] ?? '';
            $senha = $postVars['senha'] ?? '';
            $dataNasc = $postVars['data'] ?? '';
            $salario = $postVars['salario'] ?? '';
            $cargaHoraria = $postVars['cargaHoraria'] ?? '';
            $curso = $postVars['curso'] ?? '';

            if($nome == '' || $rg == '' || $cpf == '' || $senha == '' || $dataNasc == '' || $salario == '' || $cargaHoraria == '' || $curso == '' || $curso == '-1')
                $status = Alert::getError('Preencha todos os campos antes de cadastrar');
            else {
                $status = Alert::getSuccess('Coordenador cadastrado com sucesso!');
                $salario = floatval($salario);
                $cargaHoraria = intval($salario);
                Professor::cadastrarCoord($salario, $cargaHoraria, $senha, $nome, $cpf, $rg, $dataNasc, $curso);
            }
        }

        $cursos = Curso::listCurso(null);
        $items = PageBuilder::getOptionsCurso($cursos);

        //Content
        $content = PageBuilder::getComponent("pages/admin/cadastrarCoord", [
            'status' => $status,
            'cursos' => $items
          ]);

        //Recebe o Template e o Imprime na Tela
        echo PageBuilder::getTemplate('templates/intranet/template_intranet',[
          'title' => 'Cadastrar Coordenador',
          'header' => $header,
          'menu' => $menu,
          'content' => $content
        ]);

        exit;
    }

}