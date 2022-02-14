<?php

namespace App\Controller\Public\Aluno;

use App\Controller\Page\PageBuilder;
use App\Controller\Public\Menu;
use App\Controller\Page\Alert;
use App\Model\Entity\Pessoa;

class AlterarSenha{
    public function __construct() {}

    //Método responsável por retornar a página de Alterar Senha
    public static function getAlterarSenha($tipoMsg = null, $message = null)
    {
        //Componentes do AlterarSenha

        // Header
        $header = PageBuilder::getComponent("pages/public/header", [
            'nome' => $_SESSION['usuario']['name'],
            'cargo' => 'Aluno'
          ]);

        // Menu
        $menu = PageBuilder::getComponent("pages/public/menu", [
            'items' => PageBuilder::getMenu(Menu::getAlunoMenu(), 'Alterar Senha')
          ]);

        $status = '';

        //Menssage
        if($message != null)
            $tipoMsg == 1 ? $status = Alert::getSuccess($message) : $status = Alert::getError($message);

        // Content
        $content = PageBuilder::getComponent("pages/aluno/alterarSenha", [
            'status' => $status
        ]);

        //Recebe o Template e o Imprime na Tela
        echo PageBuilder::getTemplate('templates/public/template',[
            'title' => 'Alterar Senha',
            'header' => $header,
            'menu' => $menu,
            'content' => $content
          ]);

        exit;
    }

    public static function setNewPassword($request){
        //POST VARS
        $postVars = $request->getPostVars();
        $senhaAtual = $postVars['password'] ?? '';
        $senhaNova = $postVars['newpassword'] ?? '';
        $nome = $_SESSION['usuario']['name'];

        $retornoAlteracao = (Pessoa::setNewPasswordAluno($nome,$senhaAtual,$senhaNova))[0];

        self::getAlterarSenha($retornoAlteracao->tipo, $retornoAlteracao->msg);
    }

}

?>