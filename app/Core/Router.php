<?php

namespace App\Core;

use App\Core\Middleware\Queue as MiddlewareQueue;
use \Closure;
use \Exception;
use \ReflectionFunction;

class Router{

    //URL completa do projeto (raiz)
    private $url = "";

    //Prefixo de todas as rotas
    private $prefix = "";

    //Indice de rotas
    private $routes = [];

    //Instancia de Request
    private $request;

    //Método responsável por iniciar a classe
    public function __construct($url){
        $this->request = new Request($this);
        $this->url = $url;
        $this->setPrefix();
    }
    
    //Método que define o prefixo das rotas
    private function setPrefix(){
        //Informações da URL atual
        $parseUrl = parse_url($this->url);

        //Define o prefixo
        $this->prefix = $parseUrl['path'] ?? "";
    }

    //Método responsável por definir uma rota na classe
    private function addRoute($method, $route, $params = []){
        //Validação dos parâmetros
        foreach ($params as $key=>$value) {
            if($value instanceof Closure){
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }

        //Middlewares da rota
        $params['middlewares'] = $params['middlewares'] ?? [];

        //Variáveis da Rota
        $params['variables'] = [];

        //Padrão de validação das variáveis das rotas
        $patternVariable = '/{(.*?)}/';
        if(preg_match_all($patternVariable,$route,$matches)){
              $route = preg_replace($patternVariable, '(.*?)',$route);
              $params['variables'] = $matches[1]; 
        }
       
        
        //Padrão de validação da URL
        $patternRoute = '/^'.str_replace('/','\/',$route).'$/';

        //Adiciona rota dentro da classe
        $this->routes[$patternRoute][$method] = $params;
        
    }

     //Retorna a URI desconsiderando o prefixo
     private function getUri(){
        //URI DA REQUEST
        $uri = $this->request->getUri();

        //FATIA A URI COM O PREFIXO
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];

        //Retorna a URI sem prefixo
        return end($xUri);
    }

    //Retorna os dados da rota atual
    private function getRoute(){
        //URI
        $uri = $this->getUri();

        //Método
        $httpMethod = $this->request->getHttpMethod();

       //Valida as rotas
       foreach ($this->routes as $patternRoute=>$methods) {
            //Verifica se a rota bate com o padrão
            if(preg_match($patternRoute,$uri,$matches)){
                //Verifica o método
                if(isset($methods[$httpMethod])){
                    //Removo a primeira posição
                    unset($matches[0]);

                    //Variáveis processadas 
                    $keys = $methods[$httpMethod]['variables'];           
                    $methods[$httpMethod]['variables'] = array_combine($keys,$matches);
                    $methods[$httpMethod]['variables']['request'] = $this->request;

                    //Retorno dos parâmetros da rota
                    return $methods[$httpMethod];
                }

                //Método não permitido
                throw new Exception("Método não é permitido", 405);
                
            }
       }

       //URL não encontrada
       throw new Exception("URL não encontrada", 404);


    }

    //Método responsável por executar a rota atual
    public function run(){
        try {
            
            //Obtém a rota atual
            $route = $this->getRoute();

            //Verifica o controlador

            if(!isset($route['controller'])){
                throw new Exception("A URL não pode ser processada", 500);
            }

            //Argumentos da função
            $args = [];

            //Reflection
            $refletion = new ReflectionFunction($route['controller']);
            foreach ($refletion->getParameters() as $parameter) {
                  $name = $parameter->getName();
                  $args[$name] = $route['variables'][$name] ?? '';
            }
            
            //Retorna a execução da fila de middlewares
            return (new MiddlewareQueue($route['middlewares'],$route['controller'],$args))->next($this->request);
        } catch (Exception $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
    }

    //Método responsável por redirecionar a URL
    public function redirect($route){
        //URL
        $url = $this->url.$route;

        //Executa o redirect
        header('Location: '.$url);
        exit;
    }

    //Método Responsável por retornar a URL atual
    public function getCurrentUrl(){
        return $this->url.$this->getUri();
    }

    //Método responsável por definir um rota GET
    public function get($route, $params = []){
        $this->addRoute("GET",$route, $params);
    }

    //Método responsável por definir um rota POST
    public function post($route, $params = []){
        $this->addRoute("POST",$route, $params);
    }

    //Método responsável por definir um rota PUT
    public function put($route, $params = []){
        $this->addRoute("PUT",$route, $params);
    }

    //Método responsável por definir um rota DELETE
    public function delete($route, $params = []){
        $this->addRoute("DELETE",$route, $params);
    }

}