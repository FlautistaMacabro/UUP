<?php

namespace App\Core;

class Request{

    //Instância do Router
    private $router;

    //Método Http da Requisição
    private $httpMethod;

    //URI da página
    private $uri;

    //Parãmetros da URL ($_GET)
    private $queryParams = [];    

    //Variáveis recebidas no POST da página ($_POST)
    private $postVars = [];    

    //Cabeçalho da Requisição
    private $headers = [];

    public function __construct($router){
        $this->router = $router;
        $this->queryParams = $_GET ?? [];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->setUri();
    }

    //Método responsável por definir a URI
    private function setUri(){
      //URI completa (com GETS)
      $this->uri = $_SERVER['REQUEST_URI'];

      //Remove GETS da URI
      $xUri = explode('?',$this->uri);
      $this->uri = $xUri[0];
    }

    public function getRouter()
    {
       return $this->router;
    }

    public function getHttpMethod()
    {
       return $this->httpMethod;
    }

    public function getUri()
    {
       return $this->uri;
    }

    public function getHeaders()
    {
       return $this->headers;
    }

    public function getQueryParams()
    {
       return $this->queryParams;
    }

    public function getPostVars()
    {
       return $this->postVars;
    }

}