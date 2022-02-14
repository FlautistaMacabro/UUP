<?php

//INCLUI AS ROTAS DE LOGIN
include __DIR__.'/intranet/login.php';
include __DIR__.'/public/login.php';

//INCLUI AS ROTAS DE ADMINISTRADOR
include __DIR__.'/intranet/administrador.php';

//INCLUI AS ROTAS DE PROFESSOR
include __DIR__.'/intranet/professor.php';

//INCLUI AS ROTAS DE COORDENADOR
include __DIR__.'/intranet/coordenador.php';

//INCLUI AS ROTAS DE ALUNO
include __DIR__.'/public/aluno.php';

//ERRORS
include __DIR__.'/errors.php';
