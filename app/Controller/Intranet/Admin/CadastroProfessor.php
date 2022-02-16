<?php

namespace App\Controller\Intranet\Admin;

use App\Controller\Page\PageBuilder;
use App\Model\Entity\Professor;
use App\Controller\Intranet\Menu;
use App\Controller\Page\Alert;

class CadastroProfessor{
    public function __construct() {}

    //Método responsável por retornar o cadastro de aluno
    public static function getCadastroProfessor($request = null)
    {
        //Componentes do cadastro de professor

        //Header
        $header = PageBuilder::getComponent("pages/intranet/header", [
          'nome' => $_SESSION['admin']['usuario']['name'],
          'cargo' => 'Administrador'
          ]);


        //Menu
        $menu = PageBuilder::getComponent("pages/intranet/menu", [
          'items' => PageBuilder::getMenu(Menu::getAdmMenu(), 'Cadastrar Professor')
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

            if($nome == '' || $rg == '' || $cpf == '' || $senha == '' || $dataNasc == '' || $salario == '' || $cargaHoraria == '')
                $status = Alert::getError('Preencha todos os campos antes de cadastrar');
            else {
                $status = Alert::getSuccess('Professor cadastrado com sucesso!');
                $salario = floatval($salario);
                $cargaHoraria = intval($salario);
                Professor::cadastrarProf($salario, $cargaHoraria, $senha, $nome, $cpf, $rg, $dataNasc);
            }
        }

        //Content
        $content = PageBuilder::getComponent("pages/admin/cadastrarProf", [
            'status' => $status,
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