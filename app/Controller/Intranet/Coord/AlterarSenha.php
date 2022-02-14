<?php

namespace App\Controller\Intranet\Coord;

use App\Controller\Page\PageBuilder;
use App\Controller\Intranet\Menu;
use App\Controller\Page\Alert;
use App\Model\Entity\Pessoa;

class AlterarSenha{
    public function __construct() {}

    //Método responsável por retornar a página de Alterar Senha
    public static function getAlterarSenha($tipoMsg = null, $message = null)
    {
        //Componentes do AlterarSenha

        //Header
        $header = PageBuilder::getComponent("pages/intranet/header", [
            'nome' => $_SESSION['admin']['usuario']['name'],
            'cargo' => 'Coordenador'
        ]);

        //Menu
        $menu = PageBuilder::getComponent("pages/intranet/menu", [
            'items' => PageBuilder::getMenu(Menu::getCoordMenu(), 'Alterar Senha')
        ]);

        $status = '';

        //Menssage
        if($message != null)
            $tipoMsg == 1 ? $status = Alert::getSuccess($message) : $status = Alert::getError($message);

        // Content
        /*$content = PageBuilder::getComponent("pages/coord/alterarSenha", [
            'status' => $status
        ]);*/

        //Recebe o Template e o Imprime na Tela
        echo PageBuilder::getTemplate('templates/intranet/template_intranet',[
            'title' => 'Alterar Senha - Coordenador',
            'header' => $header,
            'menu' => $menu,
            'content' => ''
        ]);

        exit;
    }

    public static function setNewPassword($request){
        //POST VARS
        $postVars = $request->getPostVars();
        $senhaAtual = $postVars['password'] ?? '';
        $senhaNova = $postVars['newpassword'] ?? '';
        $nome = $_SESSION['admin']['usuario']['name'];

        $retornoAlteracao = (Pessoa::setNewPasswordADM($nome,$senhaAtual,$senhaNova))[0];

        self::getAlterarSenha($retornoAlteracao->tipo, $retornoAlteracao->msg);
    }

}

?>