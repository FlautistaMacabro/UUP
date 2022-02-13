<?php

namespace App\Database;


class Pagination{

    //Número máximos de registros por página
    private $limit;

    //quantidade total de resultados do banco
    private $results;

    //quantidade de páginas
    private $pages;

    //página atual
    private $currentPage;


    public function __construct($results, $currentPage = 1,$limit = 5) {
        $this->results = $results;
        $this->currentPage = (is_numeric($currentPage) and $currentPage > 0)? $currentPage : 1;
        $this->limit = $limit;
        $this->calculate();
    }


    //Método responsável por calcular a páginação
    private function calculate(){
        //Calcula o total de páginas
        $this->pages = $this->results > 0 ? ceil($this->results / $this->limit) : 1;

        //verifica se a página atual não excede o limite de páginas
        $this->currentPage = $this->currentPage <= $this->pages ? $this->currentPage : $this->pages;

    }


    //Método responsável por retornar a cláusula limit
    public function getLimit(){
        $offset = ($this->limit * ($this->currentPage - 1));
        return $offset.','.$this->limit;
    }

    //Método responsável por retornar as opções de páginas disponíveis
    public function getPages(){
        //Não retorna páginas
        if($this->pages == 1) return [];

        //Páginas
        $paginas = [];
        for ($i=1; $i <= $this->pages; $i++) {
            $paginas[] = [
                'pagina' => $i,
                'atual' => $i == $this->currentPage
            ];
        }

        return $paginas;
    }
}