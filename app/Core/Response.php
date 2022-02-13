<?php

namespace App\Core;

class Response{

    //Código do status Http
    private $httpCode = 200;

    //Cabeçalho do Response
    private $headers = [];

    //Tipo de conteúdo que está sendo retornado
    private $contentType = "text/html";

    //Conteúdo do Response
    private $content;

    public function __construct($httpCode,$content,$contentType = "text/html"){
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setContentType($contentType);
    }

    //Método que altera o contentType do Response
    public function setContentType($contentType){
        $this->contentType = $contentType;
        $this->addHeader('Content-Type',$contentType);
    }

    //Método responsável por adicionar um registro no cabeçalho do response
    public function addHeader($key,$value){
        $this->headers[$key] = $value;
    }

    //Método que envia os headers para o navegador
    private function sendHeaders(){
        //STATUS
        http_response_code($this->httpCode);

        //ENVIAR HEADERS
        foreach ($this->headers as $key=>$value) {
            header($key.': '.$value);
        }
    }

    //Método que envia a resposta para o usuário
    public function sendResponse(){
        //Envia os headers
        $this->sendHeaders();

        //Imprime o conteúdo
        switch ($this->contentType) {
            case 'text/html':
                echo $this->content;
                exit;
        }
    }
}