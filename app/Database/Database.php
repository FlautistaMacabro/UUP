<?php

namespace App\Database;

use \PDO;
use \PDOException;

class Database{

    //Host de conexão com o banco de dados
    private static $DB_HOST;

    //Nome do banco de dados
    private static $DB_NAME;

    //Usuário do banco de dados
    private static $DB_USER;

    //Senha de acesso ao banco de dados
    private static $DB_PASS;

    //Tabela do banco
    private $table;

    //Instância da conexão com o banco de dados
    private $connection;

    public function __construct($table = null) {
        $this->table = $table;
        $this->setConnection();
    }

    //Método responsável por configurar o banco de dados
    public static function config($DB_HOST,$DB_NAME,$DB_USER,$DB_PASS){
        self::$DB_HOST = $DB_HOST;
        self::$DB_NAME = $DB_NAME;
        self::$DB_USER = $DB_USER;
        self::$DB_PASS = $DB_PASS;
    }

    //Método responsável por criar uma conexão com o banco de dados
    private function setConnection(){
        try {
            $this->connection = new PDO('mysql:host='.self::$DB_HOST.';dbname='.self::$DB_NAME,self::$DB_USER,self::$DB_PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Error: '.$e->getMessage());
        }
    }

    /**
     * Método responsável por executar queries dentro do banco de dados
     *
     * @return PDOStatment
    */

    public function execute($query, $params = []){
        try {
            $statment = $this->connection->prepare($query);
            $statment->execute($params);
            return $statment;
        } catch (PDOException $e) {
            return $e;
        }
    }

    //Função responsável por criar uma consulta no banco (retorna todos os elementos de uma tabela)
    public function select($where = null, $order = null, $limit = null,$fields = '*'){
        //DADOS DA QUERY
        $where = strlen($where) ? 'WHERE '.$where : '';
        $order = strlen($order) ? 'ORDER BY '.$order : '';
        $limit = strlen($limit) ? 'LIMIT '.$limit : '';

        //MONTA A QUERY
        $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;

        //EXECUTA A QUERY
        return $this->execute($query);
    }
}