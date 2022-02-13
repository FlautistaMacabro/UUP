<?php

use App\Controller\Page\PageBuilder;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

try{ //Variáveis de ambiente requeridas
    $dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER'])->notEmpty();
    $dotenv->required('DB_PASS');
}
catch (RuntimeException $re) //Erro caso a variável de ambiente não esteja definida
{
    echo PageBuilder::getComponent("pages/errors/env_error", [
        'URL' => $_ENV['URL'],
        'errorMessage' => $re->getMessage()
    ]);
}
catch (Exception $e) //Erro caso a variável de ambiente esteja vazia
{
    echo PageBuilder::getComponent("pages/errors/env_error", [
        'URL' => $_ENV['URL'],
        'errorMessage' => $re->getMessage()
    ]);
}

