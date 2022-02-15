<?php

namespace App\Controller\Intranet\Admin;

use App\Controller\Page\PageBuilder;
use App\Model\Entity\Curso;
use App\Database\Pagination;
use App\Controller\Intranet\Menu;
use App\Controller\Page\Alert;

class Cursos{
    public function __construct() {}

    //Método responsável por retornar a página de Cursos
    public static function getCursos($request, $typemsg = null,$msg = null)
    {
      //Componentes do Cursos

       //Messages
       $status = (!is_null($msg) && !is_null($typemsg)) ? (($typemsg) ? Alert::getSuccess($msg) : Alert::getError($msg)) : '';

      //Quantidade Cursos
      $qtdCursos = Curso::getQtdCursos();

      //Página atual
      $queryParams = $request->getQueryParams();
      $paginaAtual = $queryParams['page'] ?? 1;

      //Paginação
      $obPagination = new Pagination($qtdCursos, $paginaAtual,5);


      //Botões paginação
      $paginas = $obPagination->getPages();
      $paginacao = PageBuilder::getButtons($paginas);

      //Listagem de cursos
      $cursos = Curso::listCurso($obPagination->getLimit());
      $items = PageBuilder::getItems($cursos);

       //Header
       $header = PageBuilder::getComponent("pages/intranet/header", [
        'nome' => $_SESSION['admin']['usuario']['name'],
        'cargo' => 'Administrador'
        ]);

      //Menu
      $menu = PageBuilder::getComponent("pages/intranet/menu", [
        'items' => PageBuilder::getMenu(Menu::getAdmMenu(), 'Gerenciar Cursos')
        ]);

      //Content
      $content = PageBuilder::getComponent("pages/admin/curso", [
        'items' => $items,
        'pages' => $paginacao,
        'status' => $status
      ]);

      //Recebe o Template e o Imprime na Tela
      echo PageBuilder::getTemplate('templates/intranet/template_intranet',[
        'title' => 'Cursos - Adm',
        'header' => $header,
        'menu' => $menu,
        'content' => $content,
      ]);

      exit;
    }

    //Método responsável or direcionar para a ação correta
    public static function postCursos($request){
       //POST VARS
       $postVars = $request->getPostVars();
       $action = $postVars['post-action'] ?? '';

       if(!empty($action) && !is_null($action)){
         if($action == "cadastrar") self::cadastrar($request);
         else if($action == "deletar") self::deletar($request);
         else if($action == "editar") self::editar($request);
       }
    }

     //Método responsável por cadastrar Cursos
     public static function cadastrar($request)
     {
        //Filter positive integer
         $filter_options = array(
             'options' => array( 'min_range' => 1)
         );


         //POST VARS
         $postVars = $request->getPostVars();
         $nome = $postVars['nome-curso'] ?? '';
         $tipoCurso = $postVars['tipo-curso'] ?? 0;
         $minAno = $postVars['min-anos'] ?? '';
         $maxAno = $postVars['max-anos'] ?? '';

        if(empty($nome)) {  self::getCursos($request, 0 , "O nome do curso não pode estar vazio");}
        if($tipoCurso < 0 || $tipoCurso > 2) {  self::getCursos($request, 0 , "Selecione um tipo de curso válido");}
        if(filter_var( $minAno, FILTER_VALIDATE_INT, $filter_options ) === FALSE) {  self::getCursos($request, 0 , "Mínimo Anos precisa ser um inteiro positivo");}
        if(filter_var( $maxAno, FILTER_VALIDATE_INT, $filter_options ) === FALSE) {  self::getCursos($request, 0 , "Máximo Anos precisa ser um inteiro positivo");}
        if($minAno > $maxAno) {  self::getCursos($request, 0 , "O mínimo de anos tem que ser menor ou igual ao máximo de anos");}


        $status = Curso::cadastrarCurso($nome, $tipoCurso,$minAno, $maxAno, $_SESSION['admin']['usuario']['name']);

        if($status !== true) {  self::getCursos($request, "Error: ".$status);}
        else { self::getCursos($request, 1, "Curso cadastrado com sucesso");}
     }

     //Método responsável por deletar Cursos
     public static function deletar($request)
     {
      //POST VARS
      $postVars = $request->getPostVars();
      $nome = $postVars['nome-curso-delete'] ?? '';
      $confirm = $postVars['confirm'] ?? '';

      if(empty($nome)) {  self::getCursos($request, 0 , "Selecione um curso para deletar");}

      if($confirm === "true") {
        $status = Curso::deletarCurso($nome);

        if($status !== true) {  self::getCursos($request, "Error: ".$status);}
        else { self::getCursos($request, 1, "Curso deletado com sucesso");}
      }
     }


     //Método responsável por editar Cursos
     public static function editar($request)
     {
        //Filter positive integer
        $filter_options = array(
          'options' => array( 'min_range' => 1)
        );


        //POST VARS
        $postVars = $request->getPostVars();
        $nomeAtual = $postVars['nome-curso-atual'] ?? '';
        $nome = $postVars['nome-curso'] ?? '';
        $tipoCurso = $postVars['tipo-curso'] ?? 0;
        $minAno = $postVars['min-anos'] ?? '';
        $maxAno = $postVars['max-anos'] ?? '';

        if(empty($nome)) {  self::getCursos($request, 0 , "O nome do curso não pode estar vazio");}
        if($tipoCurso < 0 || $tipoCurso > 2) {  self::getCursos($request, 0 , "Selecione um tipo de curso válido");}
        if(filter_var( $minAno, FILTER_VALIDATE_INT, $filter_options ) === FALSE) {  self::getCursos($request, 0 , "Mínimo Anos precisa ser um inteiro positivo");}
        if(filter_var( $maxAno, FILTER_VALIDATE_INT, $filter_options ) === FALSE) {  self::getCursos($request, 0 , "Máximo Anos precisa ser um inteiro positivo");}
        if($minAno > $maxAno) {  self::getCursos($request, 0 , "O mínimo de anos tem que ser menor ou igual ao máximo de anos");}


        $status = Curso::atualizarCurso($nomeAtual, $nome, $tipoCurso,$minAno, $maxAno);

        if($status !== true) {  self::getCursos($request, "Error: ".$status);}
        else { self::getCursos($request, 1, "Curso atualizado com sucesso");}
      }
}