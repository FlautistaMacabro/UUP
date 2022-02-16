<?php

namespace App\Controller\Intranet\Coord;

use App\Controller\Page\PageBuilder;
use App\Model\Entity\DashboardCoord;
use App\Database\Pagination;
use App\Controller\Intranet\Menu;
use App\Controller\Page\Alert;
use App\Model\Entity\Aviso;

class Avisos{
    public function __construct() {}

    //Método responsável por retornar a página de Avisos Globais
    public static function getAvisos($request, $typemsg = null,$msg = null)
    {
      //Componentes do Avisos Globais

      //Nome Curso
      $nomeCurso = (DashboardCoord::getCoordCurso($_SESSION['admin']['usuario']['name'])[0])->nomeCurso;

       //Messages
       $status = (!is_null($msg) && !is_null($typemsg)) ? (($typemsg) ? Alert::getSuccess($msg) : Alert::getError($msg)) : '';

      //Quantidade Avisos Globais
      $qtdAvisos = Aviso::getQtdAvisosGlobais();

      //Página atual
      $queryParams = $request->getQueryParams();
      $paginaAtual = $queryParams['page'] ?? 1;

      //Paginação
      $obPagination = new Pagination($qtdAvisos, $paginaAtual,5);


      //Botões paginação
      $paginas = $obPagination->getPages();
      $paginacao = PageBuilder::getButtons($paginas,'/coord/avisos');

      //Listagem de Avisos Globais
      $avisos = Aviso::listAvisosGlobais($obPagination->getLimit());
      $items = PageBuilder::getItemsAvisoGlobal($avisos);

       //Header
       $header = PageBuilder::getComponent("pages/intranet/header", [
        'nome' => $_SESSION['admin']['usuario']['name'],
        'cargo' => 'Coordenador de <strong>'.$nomeCurso.'</strong>'
        ]);

      //Menu
      $menu = PageBuilder::getComponent("pages/intranet/menu", [
        'items' => PageBuilder::getMenu(Menu::getCoordMenu(), 'Gerenciar Avisos Globais')
        ]);

      //Content
      $content = PageBuilder::getComponent("pages/coord/avisos", [
        'items' => $items,
        'pages' => $paginacao,
        'status' => $status
      ]);

      //Recebe o Template e o Imprime na Tela
      echo PageBuilder::getTemplate('templates/intranet/template_intranet',[
        'title' => 'Disciplinas Base - Coordenador',
        'header' => $header,
        'menu' => $menu,
        'content' => $content,
      ]);

      exit;
    }

    //Método responsável or direcionar para a ação correta
    public static function postAvisos($request){
       //POST VARS
       $postVars = $request->getPostVars();
       $action = $postVars['post-action'] ?? '';

       if(!empty($action) && !is_null($action)){
         if($action == "cadastrar") self::cadastrar($request);
         else if($action == "deletar") self::deletar($request);
         else if($action == "editar") self::editar($request);
       }
    }

     //Método responsável por cadastrar Avisos Globais
     public static function cadastrar($request)
     {
         //POST VARS
         $postVars = $request->getPostVars();
         $nome = $postVars['nome-aviso'] ?? '';
         $descricao = $postVars['descricao-aviso'] ?? '';


        if(empty($nome)) {  self::getAvisos($request, 0 , "O nome do aviso não pode estar vazio");}
        if(empty($descricao)) {  self::getAvisos($request, 0 , "A descrição não pode estar vazia");}
        $nomecurso = (DashboardCoord::getCoordCurso($_SESSION['admin']['usuario']['name'])[0])->nomeCurso;


        $status = Aviso::cadastrarAvisoGlobal($nome, $descricao,$nomecurso, $_SESSION['admin']['usuario']['name']);

        if($status !== true) {  self::getAvisos($request, "Error: ".$status);}
        else { self::getAvisos($request, 1, "Aviso Global cadastrado com sucesso");}
     }

     //Método responsável por deletar Avisos Globais
     public static function deletar($request)
     {
      //POST VARS
      $postVars = $request->getPostVars();
      $id = $postVars['id-aviso-delete'] ?? '';
      $confirm = $postVars['confirm'] ?? '';

      if(empty($id)) {  self::getAvisos($request, 0 , "Selecione um Aviso Global para deletar");}
      $nomecurso = (DashboardCoord::getCoordCurso($_SESSION['admin']['usuario']['name'])[0])->nomeCurso;

      if($confirm === "true") {
        $status = Aviso::deletarAvisoGlobal($id, $nomecurso);

        if($status !== true) {  self::getAvisos($request, "Error: ".$status);}
        else { self::getAvisos($request, 1, "Aviso Global deletado com sucesso");}
      }
     }


     //Método responsável por editar Avisos Globais
     public static function editar($request)
     {
       //POST VARS
       $postVars = $request->getPostVars();
       $id = $postVars['id-aviso-atual'] ?? 0;
       $nome = $postVars['nome-aviso'] ?? '';
       $descricao = $postVars['descricao-aviso'] ?? '';


      if(empty($nome)) {  self::getAvisos($request, 0 , "O nome do aviso não pode estar vazio");}
      if(empty($descricao)) {  self::getAvisos($request, 0 , "A descrição não pode estar vazia");}

      $status = Aviso::atualizarAvisoGlobal($id , $nome,$descricao);

      if($status !== true) {  self::getAvisos($request, "Error: ".$status);}
      else { self::getAvisos($request, 1, "Aviso Global atualizado com sucesso");}
    }
}