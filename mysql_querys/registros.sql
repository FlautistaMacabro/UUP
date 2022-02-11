-- REGISTROS

-- Semestre
insert into semestre (num, aberto) values (1,1);
insert into semestre (num, aberto) values (2,0);

-- Ano
insert into ano (num) values (2021);
insert into ano (num) values (2020);
insert into ano (num) values (2019);
insert into ano (num) values (2018);
insert into ano (num) values (2017);

-- Administrador
insert into administrador (salario,cargaHoraria,email,senha,nome,cpf,rg,data_nasc) 
    values (30000,150,'mandachuva.adm@uup.br',MD5('esseehocara'),'Fausto Pentelho','56437893278','73659213','1993-05-13');
insert into administrador (salario,cargaHoraria,email,senha,nome,cpf,rg,data_nasc)
    values (20000,80,'mandachuvinha.adm@uup.br',MD5('esseehosegundocara'),'Celma Guimarães','98975434549','9878645','1996-02-25');

-- Curso
insert into curso (nome,tipo,minAnos,maxAnos,id_adm) values ('Ciência da Computação', 0, 4, 7, 1);
insert into curso (nome,tipo,minAnos,maxAnos,id_adm) values ('Engenharia da Computação', 0, 5, 8, 1);
insert into curso (nome,tipo,minAnos,maxAnos,id_adm) values ('Física', 1, 4, 7, 1);
insert into curso (nome,tipo,minAnos,maxAnos,id_adm) values ('Matemática', 1, 4, 7, 2);
insert into curso (nome,tipo,minAnos,maxAnos,id_adm) values ('Mecatrônica', 2, 3, 6, 2);

-- Aluno
insert into aluno (ra,email,senha,nome,cpf,rg,data_nasc,id_sem,id_ano,id_curso)
    values ('745380','roberta@uup.br',MD5('senhamtofortesenha'),'Roberta','76809372101','86308593','2000-07-13',1,1,1);
insert into aluno (ra,email,senha,nome,cpf,rg,data_nasc,id_sem,id_ano,id_curso)
    values ('584557','julio@uup.br',MD5('senhafraca'),'Julio','58326050968','18473075','2002-08-11',2,2,1);
insert into aluno (ra,email,senha,nome,cpf,rg,data_nasc,id_sem,id_ano,id_curso)
    values ('575745','frederico@uup.br',MD5('senha1234'),'Frederico','95731095736','98365021','2003-10-24',1,1,1);
insert into aluno (ra,email,senha,nome,cpf,rg,data_nasc,id_sem,id_ano,id_curso)
    values ('456745','jesus@uup.br',MD5('escolasenhalembrar'),'Jesus','17409673922','95836092','2001-11-27',1,1,1);
insert into aluno (ra,email,senha,nome,cpf,rg,data_nasc,id_sem,id_ano,id_curso)
    values ('743441','rodolfo@uup.br',MD5('naotenhosenha2'),'Rodolfo','12698460684','48760321','2001-02-15',1,1,1);

-- Coordenadores
insert into professor (salario,cargaHoraria,email,senha,id_curso,nome,cpf,rg,data_nasc) 
    values (13000,120,'renato.prof@uup.br',MD5('jesselindaS2'),1,'Renato','24609812657','98972213','1993-04-21');
insert into professor (salario,cargaHoraria,email,senha,id_curso,nome,cpf,rg,data_nasc)
    values (11000,110,'jessica.prof@uup.br',MD5('mundoUtopico'),2,'Jessica','65897538921','5453768','1994-09-23');

-- Professor
insert into professor (salario,cargaHoraria,email,senha,nome,cpf,rg,data_nasc) 
    values (500.80,80,'reginaldo.prof@uup.br',MD5('100senha'),'Reginaldo','94726194728','47291472','1988-07-08');
insert into professor (salario,cargaHoraria,email,senha,nome,cpf,rg,data_nasc) 
    values (1500,60,'rubens.prof@uup.br',MD5('rubinho92'),'Rubens','95434863267','65443214','1989-02-08');
insert into professor (salario,cargaHoraria,email,senha,nome,cpf,rg,data_nasc) 
    values (2345.50,100,'vitor.prof@uup.br',MD5('vitinho67'),'Vitor','58723159764','87988654','1982-12-13');

-- Disciplina Base
insert into disciplinaBase (nome,cargaHoraria,quantAulasPrev,id_curso,id_sem,anoMinimo)
    values ('Cálculo 1',200,80,1,2,1);
insert into disciplinaBase (nome,cargaHoraria,quantAulasPrev,id_curso,id_sem,anoMinimo)
    values ('Sistemas Operacionais 1',250,90,1,2,2);
insert into disciplinaBase (nome,cargaHoraria,quantAulasPrev,id_curso,id_sem,anoMinimo)
    values ('Banco de Dados 1',220,85,1,1,3);
insert into disciplinaBase (nome,cargaHoraria,quantAulasPrev,id_curso,id_sem,anoMinimo)
    values ('Algoritmos e Técnicas de Programação',180,70,1,1,1);
insert into disciplinaBase (nome,cargaHoraria,quantAulasPrev,id_curso,id_sem,anoMinimo)
    values ('Engenharia de Software',150,60,1,1,3);

-- Rematrícula
insert into rematricula (aberta, id_sem)
    values (0, 1);
insert into rematricula (aberta, id_sem)
    values (0, 2);

-- Disciplina Anual
insert into disciplinaAnual (quantAulasDadas,ativa,id_prof,id_ano,id_discBase,id_remat)
    values (60,0,1,3,1,2);
insert into disciplinaAnual (quantAulasDadas,ativa,id_prof,id_ano,id_discBase,id_remat)
    values (60,0,2,2,2,2);
insert into disciplinaAnual (quantAulasDadas,ativa,id_prof,id_ano,id_discBase,id_remat)
    values (70,1,3,1,3,1);
insert into disciplinaAnual (quantAulasDadas,ativa,id_prof,id_ano,id_discBase,id_remat)
    values (40,1,4,1,4,1);
insert into disciplinaAnual (quantAulasDadas,ativa,id_prof,id_ano,id_discBase,id_remat)
    values (50,1,5,1,5,1);

-- Avisos
insert into aviso (nome,descricao,dataHora,id_discAnual) values ('Materiais complementares',
    'Segue abaixo links de materiais úteis para a disciplina:
    linkqualquer.com
    maisumlink.net
    outroaqui.com/educacao', '2021-04-04 16:24:00', 1);
insert into aviso (nome,descricao,dataHora,id_discAnual) values ('Método de avaliação',
    'Haverá uma prova que será a média e um forms que vocês tem que me entregar pra poder fazer esta prova.', '2021-04-13 12:12:00', 2);
insert into aviso (nome,descricao,dataHora,id_discAnual) values ('Data da prova',
    'A prova vai ser dia 04/08/2001.', '2021-07-16 08:20:00', 3);
insert into aviso (nome,descricao,dataHora,id_discAnual) values ('Não haverá aula',
    'Infelizmente não poderei dar a aula de hoje. Voltamos semana que vem.', '2021-05-21 12:32:00', 4);
insert into aviso (nome,descricao,dataHora,id_discAnual) values ('Oportunidade de estágio',
    'Gosta de dinheiro? Para ganhar com a gente basta ter os seguintes requisitos:
    1 - Ter experiência com windows phone
    2 - Amar MacOS
    3 - Sniper Monkey', '2021-07-27 21:14:00', 5);

-- Avisos Globais
insert into avisoGlobal (nome,descricao,dataHora,id_curso) 
    values ('Evento de jogo', 'Jogos são tops uhhrrruuulll', '2021-09-13 12:12:00',1);
insert into avisoGlobal (nome,descricao,dataHora,id_curso) 
    values ('Evento de digitação', 'Digitando mais rápido que um carro vrum vrum', '2021-10-16 08:20:00',1);
insert into avisoGlobal (nome,descricao,dataHora,id_curso) 
    values ('EAD infinito', 'O curso agora é 100% ead KKK', '2021-10-21 08:20:00',1);
insert into avisoGlobal (nome,descricao,dataHora,id_curso) 
    values ('Montando PCs', 'Eae? Bora montar PC?', '2021-09-21 12:32:00',2);
insert into avisoGlobal (nome,descricao,dataHora,id_curso) 
    values ('Desmontando PCs', 'Eae? Bora desmontar PC?', '2021-10-21 12:32:00',2);

-- Situações do Aluno
insert into situacao_aluno (situacao_) VALUES ('Em execução');
insert into situacao_aluno (situacao_) VALUES ('Aprovado');
insert into situacao_aluno (situacao_) VALUES ('Reprovado');
insert into situacao_aluno (situacao_) VALUES ('Trancado');
insert into situacao_aluno (situacao_) VALUES ('COVID');
insert into situacao_aluno (situacao_) VALUES ('Pedido de Trancamento');

-- Dados do Aluno
insert into dados_aluno (id_aluno,id_sit,id_discAnual)
    values (2,2,1);
insert into dados_aluno (id_aluno,id_sit,id_discAnual)
    values (2,2,2);
insert into dados_aluno (id_aluno,id_sit,id_discAnual)
    values (4,1,4);
insert into dados_aluno (id_aluno,id_sit,id_discAnual)
    values (2,1,3);
insert into dados_aluno (id_aluno,id_sit,id_discAnual)
    values (3,4,3);

-- Hora da Aula
insert into hora_aula (hora) values ('14:00:00');
insert into hora_aula (hora) values ('14:10:00');
insert into hora_aula (hora) values ('19:00:00');
insert into hora_aula (hora) values ('19:10:00');
insert into hora_aula (hora) values ('16:00:00');

-- Aula
insert into aula (nome,descricao,dataAula,id_hora,id_discAnual) 
    values ('Aula 1','Introdução','2021-04-12',1,3);
insert into aula (nome,descricao,dataAula,id_hora,id_discAnual) 
    values ('Aula 10','','2021-05-12',4,2);
insert into aula (nome,descricao,dataAula,id_hora,id_discAnual) 
    values ('Aula 15','Prova 1','2021-06-20',2,1);
insert into aula (nome,descricao,dataAula,id_hora,id_discAnual) 
    values ('Aula 5','Loops de repetição','2021-04-27',1,4);
insert into aula (nome,descricao,dataAula,id_hora,id_discAnual) 
    values ('Aula 30','Prova Final','2021-07-08',3,5);
insert into aula (nome,descricao,dataAula,id_hora,id_discAnual) 
    values ('Aula 12','Prova 1','2021-06-14',1,4);
insert into aula (nome,descricao,dataAula,id_hora,id_discAnual) 
    values ('Aula 17','Prova 1','2021-05-14',1,3);
insert into aula (nome,descricao,dataAula,id_hora,id_discAnual) 
    values ('Aula 24','Prova 2','2021-07-20',2,1);

-- Avaliação 
insert into avaliacao (nome,id_aula) values ('P1',3);
insert into avaliacao (nome,id_aula) values ('P2',5);
insert into avaliacao (nome,id_aula) values ('P1',6);
insert into avaliacao (nome,id_aula) values ('P1',7);
insert into avaliacao (nome,id_aula) values ('P2',8);

-- Nota da avaliação
insert into nota (nota,id_aval,id_dados) values (7,1,1);
insert into nota (nota,id_aval,id_dados) values (7.5,2,1);
insert into nota (nota,id_aval,id_dados) values (6,3,3);
insert into nota (nota,id_aval,id_dados) values (5,1,2);
insert into nota (nota,id_aval,id_dados) values (4.5,4,4);

-- Frequência da aula 
insert into frequencia (id_dados,id_aula,faltou_) values (1,1,0);
insert into frequencia (id_dados,id_aula,faltou_) values (2,3,1);
insert into frequencia (id_dados,id_aula,faltou_) values (3,2,1);
insert into frequencia (id_dados,id_aula,faltou_) values (4,2,0);
insert into frequencia (id_dados,id_aula,faltou_) values (5,1,0);