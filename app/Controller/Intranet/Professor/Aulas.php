<?php

namespace App\Controller\Intranet\Professor;

use App\Controller\Page\PageBuilder;
use App\Model\Entity\Professor;
use App\Database\Pagination;
use App\Controller\Intranet\Menu;
use App\Controller\Page\Alert;
use App\Model\Entity\Aula;

class Aulas{
    public function __construct() {}

    public static function getTableItems($nomes){
      $items = '';
      $count = count($nomes);
      $itemName = '';

      for ($i=0; $i < $count ; $i++) {
          (!($i%2 == 0)) ? $itemName = '91' : $itemName = '92';

          $items .= PageBuilder::getComponent("pages/items/item{$itemName}", ['nome' => $nomes[$i]->nome]);
      }

      return $items;
    }

    //Método responsável por retornar a página de Aulas
    public static function getAulas($request, $id, $typemsg = null, $msg = null)
    {
      //Componentes de Aulas


      //print_r(Aula::listarDadosdeFreqPorIDAula(14));
      //exit;

       //Messages
       $status = (!is_null($msg) && !is_null($typemsg)) ? (($typemsg) ? Alert::getSuccess($msg) : Alert::getError($msg)) : '';

      //Quantidade Aulas
      $qtdAulas = Aula::getQtdAulas($id);

      //Página atual
      $queryParams = $request->getQueryParams();
      $paginaAtual = $queryParams['page'] ?? 1;

      //Paginação
      $obPagination = new Pagination($qtdAulas, $paginaAtual,5);


      //Botões paginação
      $paginas = $obPagination->getPages();
      $paginacao = PageBuilder::getButtons($paginas,'/professor/discAula/'.$id);

      //Listagem de Aulas
      $aulas = Aula::listAulas($id,$obPagination->getLimit());
      $items = PageBuilder::getItemsAulas($aulas);

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
      $content = PageBuilder::getComponent("pages/professor/aulas", [
        'items' => $items,
        'pages' => $paginacao,
        'status' => $status,
        'especdisc' => (Professor::getDisciplinaName($id)),
        'id' => $id
      ]);

      //Nome dos alunos
      $nomes = Professor::getDadosAluno($id);

      //Recebe o Template e o Imprime na Tela
      echo PageBuilder::getTemplate('templates/intranet/template_intranet',[
        'title' => 'Disciplinas - Professor',
        'header' => $header,
        'menu' => $menu,
        'content' => $content,
        'itemsTable' => self::getTableItems($nomes),
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

     //Método responsável por cadastrar Avisos Globais
     public static function cadastrar($request,$id)
     {
         //POST VARS
         $postVars = $request->getPostVars();
         $nome = $postVars['nome-aula'] ?? '';
         $hora = $postVars['hora-aula'] ?? '';
         $data = $postVars['data-aula'] ?? '';
         $descricao = $postVars['descricao-aula'] ?? '';
         $presença = $postVars['presenca_list'] ?? [''];


        if(empty($nome)) {  self::getAulas($request, $id, 0 , "O nome do aviso não pode estar vazio");}
        if(empty($descricao)) {  self::getAulas($request, $id, 0 , "A descrição não pode estar vazia");}
        if(empty($hora)) {  self::getAulas($request, $id, 0 , "A hora não pode estar vazia");}
        if(empty($data)) {  self::getAulas($request, $id, 0 , "A data não pode estar vazia");}


        $status = Aula::cadastrarAulas($nome, $descricao,$data, $hora, $id);

        if($status !== true) {  self::getAulas($request,$id, 0, "Error: ".$status);}

        $id_aula = Aula::getIDAula($id);

        $dadosAlunos = Aula::getNomeeIDDados($id);

        $count = count($dadosAlunos);
        $count2 = count($presença);

        for ($i=0, $j=0; $i < $count; $i++) {
          if($j < $count2 && $presença[$j] == $dadosAlunos[$i]['nome']){
            Aula::cadastrarFrequenciaPorID($id_aula['id_aula'],true,$dadosAlunos[$i]['idDados']);
            $j++;
          }else{
            Aula::cadastrarFrequenciaPorID($id_aula['id_aula'],false,$dadosAlunos[$i]['idDados']);
          }
        }

        self::getAulas($request, $id, 1, "Aula cadastrada com sucesso");
     }

     //Método responsável por deletar Aulas
     public static function deletar($request, $id)
     {
      //POST VARS
      $postVars = $request->getPostVars();
      $id_del = $postVars['id-aula-delete'] ?? '';
      $confirm = $postVars['confirm'] ?? '';

      if(empty($id_del)) {  self::getAulas($request, $id, 0 , "Selecione uma Aula para deletar");}

      if($confirm === "true") {
        $status = Aula::deletarAulas($id_del);

        if($status !== true) {  self::getAulas($request, $id, 0, "Error: ".$status);}
        else { self::getAulas($request, $id, 1, "Aula deletada com sucesso");}
      }
     }


     //Método responsável por editar Aulas
     public static function editar($request, $id)
     {
      //POST VARS
      $postVars = $request->getPostVars();
      $idAula = $postVars['id-aula-atual'] ?? '';
      $nome = $postVars['nome-aula'] ?? '';
      $descricao = $postVars['descricao-aula'] ?? '';
      $presença = $postVars['presenca_list'] ?? [''];


     if(empty($nome)) {  self::getAulas($request, $id, 0 , "O nome do aviso não pode estar vazio");}
     if(empty($descricao)) {  self::getAulas($request, $id, 0 , "A descrição não pode estar vazia");}


     $status = Aula::atualizarAulasPorID($idAula, $nome,$descricao);

     if($status !== true) {  self::getAulas($request,$id, 0, "Error: ".$status);}

     $dadosAlunos = Aula::getNomeeIDDados($id);

     $count = count($dadosAlunos);
     $count2 = count($presença);

     for ($i=0, $j=0; $i < $count; $i++) {
       if($j < $count2 && $presença[$j] == $dadosAlunos[$i]['nome']){
         Aula::atualizarFrequenciaPorID($idAula,$dadosAlunos[$i]['idDados'],true);
         $j++;
       }else{
         Aula::atualizarFrequenciaPorID($idAula,$dadosAlunos[$i]['idDados'],false);
       }
     }

     self::getAulas($request, $id, 1, "Aula cadastrada com sucesso");
  }
}