<?php

namespace App\Controller\Intranet\Coord;

use App\Controller\Page\PageBuilder;
use App\Model\Entity\DisciplinaBase;
use App\Model\Entity\DashboardCoord;
use App\Database\Pagination;
use App\Controller\Intranet\Menu;
use App\Controller\Page\Alert;

class DisciplinasBase{
    public function __construct() {}

    //Método responsável por retornar a página de Disciplinas Base
    public static function getDiscBase($request, $typemsg = null,$msg = null)
    {
      //Componentes do Disciplinas Base

      //Nome Curso
      $nomeCurso = (DashboardCoord::getCoordCurso($_SESSION['admin']['usuario']['name'])[0])->nomeCurso;

       //Messages
       $status = (!is_null($msg) && !is_null($typemsg)) ? (($typemsg) ? Alert::getSuccess($msg) : Alert::getError($msg)) : '';

      //Quantidade Disciplinas Base
      $qtdCursos = DisciplinaBase::getQtdDiscBase();

      //Página atual
      $queryParams = $request->getQueryParams();
      $paginaAtual = $queryParams['page'] ?? 1;

      //Paginação
      $obPagination = new Pagination($qtdCursos, $paginaAtual,5);


      //Botões paginação
      $paginas = $obPagination->getPages();
      $paginacao = PageBuilder::getButtons($paginas,'/coord/discbase');

      //Listagem de Disciplinas Base
      $cursos = DisciplinaBase::listDiscBase($obPagination->getLimit());
      $items = PageBuilder::getItems($cursos);

       //Header
       $header = PageBuilder::getComponent("pages/intranet/header", [
        'nome' => $_SESSION['admin']['usuario']['name'],
        'cargo' => 'Coordenador de <strong>'.$nomeCurso.'</strong>'
        ]);

      //Menu
      $menu = PageBuilder::getComponent("pages/intranet/menu", [
        'items' => PageBuilder::getMenu(Menu::getCoordMenu(), 'Gerenciar Disciplinas Base')
        ]);

      //Content
      $content = PageBuilder::getComponent("pages/coord/discBase", [
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
    public static function postDisciplina($request){
       //POST VARS
       $postVars = $request->getPostVars();
       $action = $postVars['post-action'] ?? '';

       if(!empty($action) && !is_null($action)){
         if($action == "cadastrar") self::cadastrar($request);
         else if($action == "deletar") self::deletar($request);
         else if($action == "editar") self::editar($request);
       }
    }

     //Método responsável por cadastrar Disciplinas Base
     public static function cadastrar($request)
     {
        //Filter positive integer
         $filter_options = array(
             'options' => array( 'min_range' => 1)
         );


         //POST VARS
         $postVars = $request->getPostVars();
         $nome = $postVars['nome-discbase'] ?? '';
         $cargaHoraria = $postVars['carga-horaria'] ?? 0;
         $qtdAulasPrev = $postVars['qtd-aulas-previstas'] ?? 0;
         $semestre = $postVars['semestre-dado'] ?? 0;
         $ano = $postVars['ano-min'] ?? 0;

        if(empty($nome)) {  self::getDiscBase($request, 0 , "O nome da disciplina não pode estar vazio");}
        if($semestre < 1 || $semestre > 2) {  self::getDiscBase($request, 0 , "Selecione um semestre válido");}
        if(filter_var( $cargaHoraria, FILTER_VALIDATE_INT, $filter_options ) === FALSE) {  self::getDiscBase($request, 0 , "Carga Horária precisa ser um inteiro positivo");}
        if(filter_var( $qtdAulasPrev, FILTER_VALIDATE_INT, $filter_options ) === FALSE) {  self::getDiscBase($request, 0 , "Qtd. Aulas Previstas Anos precisa ser um inteiro positivo");}
        if(filter_var( $ano, FILTER_VALIDATE_INT, $filter_options ) === FALSE) {  self::getDiscBase($request, 0 , "Ano Anos precisa ser um inteiro positivo");}
        $nomecurso = (DashboardCoord::getCoordCurso($_SESSION['admin']['usuario']['name'])[0])->nomeCurso;


        $status = DisciplinaBase::cadastrarDiscBase($nome, $cargaHoraria,$qtdAulasPrev, $nomecurso, $semestre, $ano);

        if($status !== true) {  self::getDiscBase($request, "Error: ".$status);}
        else { self::getDiscBase($request, 1, "Disciplina Base cadastrada com sucesso");}
     }

     //Método responsável por deletar Disciplinas Base
     public static function deletar($request)
     {
      //POST VARS
      $postVars = $request->getPostVars();
      $nome = $postVars['nome-disciplina-delete'] ?? '';
      $confirm = $postVars['confirm'] ?? '';

      if(empty($nome)) {  self::getDiscBase($request, 0 , "Selecione uma Disciplina Base para deletar");}
      $nomecurso = (DashboardCoord::getCoordCurso($_SESSION['admin']['usuario']['name'])[0])->nomeCurso;

      if($confirm === "true") {
        $status = DisciplinaBase::deletarDiscBase($nome, $nomecurso);

        if($status !== true) {  self::getDiscBase($request, "Error: ".$status);}
        else { self::getDiscBase($request, 1, "Disciplina Base deletada com sucesso");}
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
      $nome = $postVars['nome-discbase'] ?? '';
      $nomeAtual = $postVars['nome-discbase-atual'] ?? '';
      $cargaHoraria = $postVars['carga-horaria'] ?? 0;
      $qtdAulasPrev = $postVars['qtd-aulas-previstas'] ?? 0;
      $semestre = $postVars['semestre-dado'] ?? 0;
      $ano = $postVars['ano-min'] ?? 0;

     if(empty($nome)) {  self::getDiscBase($request, 0 , "O nome da disciplina não pode estar vazio");}
     if($semestre < 1 || $semestre > 2) {  self::getDiscBase($request, 0 , "Selecione um semestre válido");}
     if(filter_var( $cargaHoraria, FILTER_VALIDATE_INT, $filter_options ) === FALSE) {  self::getDiscBase($request, 0 , "Carga Horária precisa ser um inteiro positivo");}
     if(filter_var( $qtdAulasPrev, FILTER_VALIDATE_INT, $filter_options ) === FALSE) {  self::getDiscBase($request, 0 , "Qtd. Aulas Previstas Anos precisa ser um inteiro positivo");}
     if(filter_var( $ano, FILTER_VALIDATE_INT, $filter_options ) === FALSE) {  self::getDiscBase($request, 0 , "Ano Anos precisa ser um inteiro positivo");}
     $nomecurso = (DashboardCoord::getCoordCurso($_SESSION['admin']['usuario']['name'])[0])->nomeCurso;


     $status = DisciplinaBase::atualizarDiscBase($nomeAtual, $nomecurso,$nome, $cargaHoraria, $qtdAulasPrev, $semestre, $nomecurso, $ano );

     if($status !== true) {  self::getDiscBase($request, "Error: ".$status);}
     else { self::getDiscBase($request, 1, "Disciplina Base atualizada com sucesso");}
    }
}