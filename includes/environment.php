<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

try{ //Variáveis de ambiente requeridas
    $dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER'])->notEmpty();
    $dotenv->required('DB_PASS');
} 
catch (RuntimeException $re) //Erro caso a variável de ambiente não esteja definida
{
    $file = file_get_contents(__DIR__.'/../app/Resources/views/pages/errors/env_error.html');
    echo str_replace('{{errorMessage}}',$re->getMessage(),$file);
    exit;
} 
catch (Exception $e) //Erro caso a variável de ambiente esteja vazia
{
    $file = file_get_contents(__DIR__.'/../app/Resources/views/pages/errors/env_error.html');
    echo str_replace('{{errorMessage}}',$e->getMessage(),$file);
    exit;
}

