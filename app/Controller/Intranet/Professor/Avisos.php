<?php

namespace App\Controller\Intranet\Professor;

use App\Controller\Page\PageBuilder;
use App\Model\Entity\Professor;
use App\Database\Pagination;
use App\Controller\Intranet\Menu;
use App\Controller\Page\Alert;
use App\Model\Entity\AvisoProf;

class Avisos{
    public function __construct() {}


    //Método responsável por retornar a página de Avisos
    public static function getAvisos($request, $id, $typemsg = null, $msg = null)
    {
      //Componentes de Avisos

       //Messages
       $status = (!is_null($msg) && !is_null($typemsg)) ? (($typemsg) ? Alert::getSuccess($msg) : Alert::getError($msg)) : '';

      //Quantidade Avisos
      $qtdAvisos = AvisoProf::getQtdAvisos($id);

      //Página atual
      $queryParams = $request->getQueryParams();
      $paginaAtual = $queryParams['page'] ?? 1;

      //Paginação
      $obPagination = new Pagination($qtdAvisos, $paginaAtual,5);


      //Botões paginação
      $paginas = $obPagination->getPages();
      $paginacao = PageBuilder::getButtons($paginas,'/professor/avisosprof/'.$id);

      //Listagem de Avisos
      $avisos = AvisoProf::listAvisos($id,$obPagination->getLimit());
      $items = PageBuilder::getItemsAvisoProf($avisos);

       //Header
       $header = PageBuilder::getComponent("pages/intranet/header", [
        'nome' => $_SESSION['admin']['usuario']['name'],
        'cargo' => 'Professor'
        ]);

      //Menu
      $menu = PageBuilder::getComponent("pages/intranet/menu", [
        'items' => PageBuilder::getMenu(Menu::getProfessorMenu(), 'Disciplinas')
        ]);

      //Content
      $content = PageBuilder::getComponent("pages/professor/avisos", [
        'items' => $items,
        'pages' => $paginacao,
        'status' => $status,
        'especdisc' => (Professor::getDisciplinaName($id)),
        'id' => $id
      ]);


      //Recebe o Template e o Imprime na Tela
      echo PageBuilder::getTemplate('templates/intranet/template_intranet',[
        'title' => 'Avisos - Professor',
        'header' => $header,
        'menu' => $menu,
        'content' => $content
      ]);

      exit;
    }

    //Método responsável or direcionar para a ação correta
    public static function postAulas($request,$id){
       //POST VARS
       $postVars = $request->getPostVars();
       $action = $postVars['post-action'] ?? '';

       if(!empty($action) && !is_null($action)){
         if($action == "cadastrar") self::cadastrar($request,$id);
         else if($action == "deletar") self::deletar($request,$id);
         else if($action == "editar") self::editar($request,$id);
       }
    }

     //Método responsável por cadastrar Avisos
     public static function cadastrar($request,$id)
     {
         //POST VARS
         $postVars = $request->getPostVars();
         $nome = $postVars['nome-aviso'] ?? '';
         $descricao = $postVars['descricao-aviso'] ?? '';


        if(empty($nome)) {  self::getAvisos($request, $id, 0 , "O nome do aviso não pode estar vazio");}
        if(empty($descricao)) {  self::getAvisos($request, $id, 0 , "A descrição não pode estar vazia");}


        $status = AvisoProf::cadastrarAvisos($nome, $descricao, $id);

        if($status !== true) {  self::getAvisos($request,$id, 0, "Error: ".$status);}
        else {self::getAvisos($request, $id, 1, "Aviso cadastrado com sucesso");}

     }

     //Método responsável por deletar Avisos
     public static function deletar($request, $id)
     {
      //POST VARS
      $postVars = $request->getPostVars();
      $id_del = $postVars['id-delete-aviso'] ?? '';
      $confirm = $postVars['confirm'] ?? '';

      if(empty($id_del)) {  self::getAvisos($request, $id, 0 , "Selecione um Aviso para deletar");}

      if($confirm === "true") {
        $status = AvisoProf::deletarAvisos($id_del);

        if($status !== true) {  self::getAvisos($request, $id, 0, "Error: ".$status);}
        else { self::getAvisos($request, $id, 1, "Aviso deletado com sucesso");}
      }
     }


     //Método responsável por editar Avisos
     public static function editar($request, $id)
     {
     //POST VARS
     $postVars = $request->getPostVars();
     $idAviso = $postVars['id-aviso-atual'] ?? '';
     $nome = $postVars['nome-aviso'] ?? '';
     $descricao = $postVars['descricao-aviso'] ?? '';



    if(empty($nome)) {  self::getAvisos($request, $id, 0 , "O nome do aviso não pode estar vazio");}
    if(empty($descricao)) {  self::getAvisos($request, $id, 0 , "A descrição não pode estar vazia");}


    $status = AvisoProf::atualizarAviso($idAviso,$nome, $descricao);

    if($status !== true) {  self::getAvisos($request,$id, 0, "Error: ".$status);}
    else {self::getAvisos($request, $id, 1, "Aviso atualizado com sucesso");}
  }
}