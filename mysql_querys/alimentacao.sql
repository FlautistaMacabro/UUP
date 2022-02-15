-- TRIGGERS

-- Atualização de Frequência

DELIMITER $$ 

CREATE DEFINER=`root`@`localhost` TRIGGER atualizaFreq_Insert AFTER INSERT ON frequencia
FOR EACH ROW
BEGIN
	UPDATE dados_aluno
        SET freqFinal = 
            (((SELECT COUNT(freq.id_freq) FROM frequencia as freq WHERE freq.faltou_ = 0 AND freq.id_dados = NEW.id_dados)/
            (SELECT COUNT(freq.id_freq) FROM frequencia as freq WHERE freq.id_dados = NEW.id_dados))*100)
        WHERE id_dados = NEW.id_dados;
END$$


CREATE DEFINER=`root`@`localhost` TRIGGER atualizaFreq_Update AFTER UPDATE ON frequencia
FOR EACH ROW
BEGIN
	UPDATE dados_aluno
        SET freqFinal = 
            (((SELECT COUNT(freq.id_freq) FROM frequencia as freq WHERE freq.faltou_ = 0 AND freq.id_dados = NEW.id_dados)/
            (SELECT COUNT(freq.id_freq) FROM frequencia as freq WHERE freq.id_dados = NEW.id_dados))*100)
        WHERE id_dados = NEW.id_dados;
END$$


-- CREATE DEFINER=`root`@`localhost` TRIGGER atualizaFreq_Delete AFTER DELETE ON frequencia
-- FOR EACH ROW
-- BEGIN
-- 	UPDATE dados_aluno
--         SET freqFinal = 
--             (((SELECT COUNT(freq.id_freq) FROM frequencia as freq WHERE freq.faltou_ = 0 AND freq.id_dados = OLD.id_dados)/
--             (SELECT COUNT(freq.id_freq) FROM frequencia as freq WHERE freq.id_dados = OLD.id_dados))*100)
--         WHERE id_dados = OLD.id_dados;
-- END$$

-- Atualização de Média Final

CREATE DEFINER=`root`@`localhost` TRIGGER atualizaMedFinal_Insert AFTER INSERT ON nota
FOR EACH ROW
BEGIN
	UPDATE dados_aluno
        SET mediaFinal = (SELECT SUM(n.nota)/COUNT(n.id_nota) FROM nota as n WHERE n.id_dados = NEW.id_dados)
        WHERE id_dados = NEW.id_dados;
END$$


CREATE DEFINER=`root`@`localhost` TRIGGER atualizaMedFinal_Update AFTER UPDATE ON nota
FOR EACH ROW
BEGIN
	UPDATE dados_aluno
        SET mediaFinal = (SELECT SUM(n.nota)/COUNT(n.id_nota) FROM nota as n WHERE n.id_dados = NEW.id_dados)
        WHERE id_dados = NEW.id_dados;
END$$

-- CREATE DEFINER=`root`@`localhost` TRIGGER atualizaMedFinal_Delete AFTER DELETE ON nota
-- FOR EACH ROW
-- BEGIN
-- 	UPDATE dados_aluno
--         SET mediaFinal = (SELECT SUM(n.nota)/COUNT(n.id_nota) FROM nota as n WHERE n.id_dados = OLD.id_dados)
--         WHERE id_dados = OLD.id_dados;
-- END$$

DELIMITER ;

-- REGISTROS

-- Semestre
insert into semestre (num, aberto) values (1,1);
insert into semestre (num, aberto) values (2,0);

-- Ano
insert into ano (num) values (2022);
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
    values (13000,120,'rosefe.prof@uup.br',MD5('renetolindoS2'),1,'Rosefe','24604732657','98975213','1990-06-14');
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
    outroaqui.com/educacao', '2020-04-04 16:24:00', 1);
insert into aviso (nome,descricao,dataHora,id_discAnual) values ('Método de avaliação',
    'Haverá uma prova que será a média e um forms que vocês tem que me entregar pra poder fazer esta prova.', '2021-04-13 12:12:00', 2);
insert into aviso (nome,descricao,dataHora,id_discAnual) values ('Data da prova',
    'A prova vai ser dia 04/08/2001.', '2022-07-16 08:20:00', 3);
insert into aviso (nome,descricao,dataHora,id_discAnual) values ('Não haverá aula',
    'Infelizmente não poderei dar a aula de hoje. Voltamos semana que vem.', '2022-05-21 12:32:00', 4);
insert into aviso (nome,descricao,dataHora,id_discAnual) values ('Oportunidade de estágio',
    'Gosta de dinheiro? Para ganhar com a gente basta ter os seguintes requisitos:
    1 - Ter experiência com windows phone
    2 - Amar MacOS
    3 - Sniper Monkey', '2022-07-27 21:14:00', 5);

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
    values ('Aula 1','Introdução','2022-04-12',1,3);
insert into aula (nome,descricao,dataAula,id_hora,id_discAnual) 
    values ('Aula 10','','2021-05-12',4,2);
insert into aula (nome,descricao,dataAula,id_hora,id_discAnual) 
    values ('Aula 15','Prova 1','2020-06-20',2,1);
insert into aula (nome,descricao,dataAula,id_hora,id_discAnual) 
    values ('Aula 5','Loops de repetição','2022-04-27',1,4);
insert into aula (nome,descricao,dataAula,id_hora,id_discAnual) 
    values ('Aula 30','Prova Final','2022-07-08',3,5);
insert into aula (nome,descricao,dataAula,id_hora,id_discAnual) 
    values ('Aula 12','Prova 1','2022-06-14',1,4);
insert into aula (nome,descricao,dataAula,id_hora,id_discAnual) 
    values ('Aula 17','Prova 1','2022-05-14',1,3);
insert into aula (nome,descricao,dataAula,id_hora,id_discAnual) 
    values ('Aula 24','Prova 2','2020-07-20',2,1);

-- Avaliação 
insert into avaliacao (nome,id_aula) values ('P1',3);
insert into avaliacao (nome,id_aula) values ('P2',5);
insert into avaliacao (nome,id_aula) values ('P1',6);
insert into avaliacao (nome,id_aula) values ('P1',7);
insert into avaliacao (nome,id_aula) values ('P2',8);

-- Nota da avaliação
insert into nota (nota,id_aval,id_dados) values (7,1,1);
insert into nota (nota,id_aval,id_dados) values (6,3,3);
insert into nota (nota,id_aval,id_dados) values (4.5,4,4);
insert into nota (nota,id_aval,id_dados) values (3,4,5);
insert into nota (nota,id_aval,id_dados) values (8,5,1);

-- Frequência da aula 
insert into frequencia (id_dados,id_aula,faltou_) values (1,1,0);
insert into frequencia (id_dados,id_aula,faltou_) values (2,3,1);
insert into frequencia (id_dados,id_aula,faltou_) values (3,2,1);
insert into frequencia (id_dados,id_aula,faltou_) values (4,2,0);
insert into frequencia (id_dados,id_aula,faltou_) values (5,1,0);

-- PROCEDURES E FUNCTIONS

DELIMITER $$

-- ATUALIZAR DE ANO
CREATE DEFINER=`root`@`localhost` PROCEDURE atualizar_ano()
BEGIN 
    DECLARE idAno int;
    DECLARE anoAtual int;
    SET anoAtual = YEAR(CURDATE());
    SELECT id_ano INTO idAno FROM ano WHERE anoAtual = num;
    IF idAno IS NULL THEN
        INSERT INTO ano(num) VALUES (anoAtual);
    END IF;
END$$

-- ABRIR ou FECHAR o SEMESTRE

-- FUNCTION para abrir um novo semestre
CREATE DEFINER=`root`@`localhost` FUNCTION abrirSemestre (semestre int, nomeCurso varchar(100))
RETURNS tinyint
BEGIN
    DECLARE flag tinyint;
    DECLARE semestreAnte int;
    DECLARE IdCurso int;

    -- Adquirindo ID do Curso
    SELECT id_curso INTO IdCurso FROM curso WHERE nome = nomeCurso;

    -- Adquirindo o semestre anterior
    IF semestre = 1 THEN 
        SET semestreAnte = 2;
    ELSE
        SET semestreAnte = 1;
    END IF;

    -- Verificando se o semestre anterior está fechado
    IF IdCurso IS NOT NULL THEN
        SELECT se.aberto INTO flag 
            FROM semestre as se
                INNER JOIN disciplinaBase as db
                ON se.id_sem = db.id_sem
            WHERE se.num = semestreAnte AND db.id_curso = IdCurso
            ORDER BY se.id_sem DESC LIMIT 1;
    END IF;

    IF flag = 0 then
        UPDATE semestre SET aberto = 1 WHERE num = semestre;
        SET flag = 1;
    ELSE 
        SET flag = 0;
    END IF;

    RETURN flag;
END$$

-- FUNCTION para fechar o semestre atual
CREATE DEFINER=`root`@`localhost` FUNCTION fecharSemestre (semestre int, nomeCurso varchar(100))
RETURNS tinyint
BEGIN
    DECLARE flag tinyint;
    DECLARE IDdisc int;
    DECLARE IdCurso int;

    -- Adquirindo ID do Curso
    SELECT id_curso INTO IdCurso FROM curso WHERE nome = nomeCurso;

    -- Verificando se todas as disciplinas do semestre atual estão fechadas
    IF IdCurso IS NOT NULL THEN
        SELECT id_discAnual INTO IDdisc
            FROM disciplinaAnual as da
                INNER JOIN disciplinaBase as db
                ON da.id_discBase = db.id_discBase
            WHERE db.id_sem = semestre AND da.ativa = 1 AND db.id_curso = IdCurso
            ORDER BY da.id_discAnual DESC LIMIT 1;
    END IF;

    IF IDdisc IS NULL then
        UPDATE semestre SET aberto = 0 WHERE num = semestre;
        SET flag = 1;
    ELSE 
        SET flag = 0;
    END IF;

    RETURN flag;
END$$

-- ABRIR e FECHAR período de REMATRÍCULA

-- FUNCTION para abrir rematrícula de um semestre
CREATE DEFINER=`root`@`localhost` FUNCTION abrirRematricula (semestre int, nomeCurso varchar(100))
RETURNS tinyint
BEGIN
    DECLARE IDdisc int;
    DECLARE flag tinyint;
    DECLARE IdCurso int;

    -- Adquirindo ID do Curso
    SELECT id_curso INTO IdCurso FROM curso WHERE nome = nomeCurso;
    
    -- Verificando se o semestre atual está aberto
    SELECT aberto INTO flag FROM semestre WHERE num = semestre;

    IF flag = 1 AND IdCurso IS NOT NULL THEN
        -- O semestre atual está aberto
        -- Verificando se há pelo menos uma disciplina aberta no semestre
        SELECT id_discAnual INTO IDdisc 
        FROM disciplinaAnual as da
            INNER JOIN disciplinaBase as db
            ON da.id_discBase = db.id_discBase
        WHERE db.id_sem = semestre AND da.aberta = 1 AND db.id_curso = IdCurso
        ORDER BY da.id_discAnual DESC LIMIT 1;

        IF IDdisc IS NOT NULL then
            -- Há pelo menos uma disciplina aberta no semestre, a rematrícula é aberta
            UPDATE rematricula SET aberta = 1 WHERE rematricula.id_sem = semestre;
        ELSE 
            SET flag = 0;
        END IF;
    END IF;
    RETURN flag;
END$$

-- FUNCTION para fechar rematrícula de um semestre
CREATE DEFINER=`root`@`localhost` FUNCTION fecharRematricula (nomeCurso varchar(100))
RETURNS tinyint
BEGIN
    DECLARE IDdisc int;
    DECLARE flag tinyint;
    DECLARE IdCurso int;

    -- Adquirindo ID do Curso
    SELECT id_curso INTO IdCurso FROM curso WHERE nome = nomeCurso;

    -- Verificando se não há disciplinas disponíveis que nenhum aluno se inscreveu
    IF IdCurso IS NOT NULL THEN
        SELECT dl.id_discAnual INTO IDdisc
        FROM disciplinaAnual AS dl
            LEFT JOIN dados_aluno as da
            ON da.id_discAnual = dl.id_discAnual
        WHERE dl.ativa = 1 AND dl.id_discAnual NOT IN (SELECT dl.id_discAnual
        FROM disciplinaAnual AS dl
            INNER JOIN dados_aluno as da
            ON dl.id_discAnual = da.id_discAnual
            INNER JOIN disciplinaBase as db
            ON dl.id_discBase = db.id_discBase
        WHERE dl.ativa = 1 AND db.id_curso = IdCurso)
        ORDER BY dl.id_discAnual DESC LIMIT 1;
    END IF;

    IF IDdisc IS NULL THEN
        UPDATE rematricula SET aberta = 0 WHERE aberta = 1;
        -- Não há disciplinas diponíveis que nenhum aluno se inscreveu, a rematrícula foi fechada
        SET flag = 1;
        -- Há disciplinas diponíveis que nenhum aluno se inscreveu, a rematrícula continua aberta
    ELSE SET flag = 0;
    END IF;
    RETURN flag;
END$$

-- ATIVAR e FECHAR DISCIPLINA ANUAL POR NOME

-- Ativar Disciplina Anual de um Ano, Professor e Curso específico
CREATE DEFINER=`root`@`localhost` PROCEDURE ativarDiscAnualPorAno_Prof_Disc_Curso (ano int, nomeProf varchar(100), nomeDisc varchar(100), nomeCurso varchar(100))
BEGIN 
    declare idProf int(11);
    declare idAno int(11);
    declare idDiscBase int(11);
    DECLARE IdCurso int;

    call atualizar_ano();

    SELECT id_curso INTO IdCurso FROM curso WHERE nome = nomeCurso;
    SELECT professor.id_prof into idProf from professor where professor.nome = nomeProf;
    SELECT ano.id_ano INTO idAno FROM ano WHERE ano.num = ano;
    IF IdCurso IS NOT NULL THEN
        SELECT db.id_discBase INTO idDiscBase FROM disciplinaBase as db WHERE db.nome = nomeDisc AND db.id_curso = IdCurso;
    END IF;
    IF ((idProf is not null) and (idAno is not null) and (idDiscBase is not null)) THEN
        UPDATE disciplinaAnual SET ativa = 1
            WHERE id_prof = idProf AND
                id_ano = idAno AND
                id_discBase = idDiscBase;
    END IF;
END$$

-- Fechar Disciplina Anual de um Ano e Professor específico
CREATE DEFINER=`root`@`localhost` FUNCTION fecharDiscAnualPorAno_Prof_NomeDisc (ano int, nomeProf varchar(100), nomeDisc varchar(100), nomeCurso varchar(100))
RETURNS TINYINT
BEGIN 
    declare idDados int;
    declare idProf int(11);
    declare idAno int(11);
    declare idDiscBase int(11);
    DECLARE IdCurso int;
    DECLARE flag TINYINT;
    SET flag = 0;

    call atualizar_ano();

    SELECT id_curso INTO IdCurso FROM curso WHERE nome = nomeCurso;
    select professor.id_prof into idProf from professor where professor.nome = nomeProf;
    IF IdCurso IS NOT NULL THEN
        SELECT db.id_discBase INTO idDiscBase FROM disciplinaBase as db WHERE db.nome = nomeDisc AND db.id_curso = IdCurso;
    END IF;
    IF ((idProf is not null) and (idDiscBase is not null)) THEN
        SELECT id_dados INTO idDados
            FROM dados_aluno as da
                INNER JOIN situacao_aluno as sa
                ON da.id_sit = sa.id_sit
                INNER JOIN disciplinaAnual as dl
                ON da.id_discAnual = dl.id_discAnual
                    INNER JOIN disciplinaBase as db
                    ON dl.id_discBase = db.id_discBase
                    INNER JOIN professor as pr
                    ON dl.id_prof = pr.id_prof
            WHERE pr.id_prof = idProf AND db.id_discBase = idDiscBase AND dl.ativa = 1 AND (sa.situacao_ = 'Em execução' OR sa.situacao_ = 'Pedido de Trancamento')
            ORDER BY da.id_dados DESC LIMIT 1;
        IF idDados IS NULL THEN
            SELECT ano.id_ano INTO idAno FROM ano WHERE ano.num = ano;
                IF idAno is not null THEN
                    UPDATE disciplinaAnual SET ativa = 0 
                        WHERE id_prof = idProf AND
                            id_ano = idAno AND
                            id_discBase = idDiscBase;
                    SET flag = 1;
                END IF;
        END IF;
    END IF;
    RETURN flag;
END$$

-- ATUALIZAÇÃO AUTOMÁTICA DE EMAIL

-- FUNCTION para retornar o email de um aluno novo
CREATE DEFINER=`root`@`localhost` FUNCTION novoEmailAluno (nomeDado varchar(100))
RETURNS varchar(100)
BEGIN
    DECLARE novoEmail varchar(100);
    DECLARE substr varchar(100);
    DECLARE primeiroNome varchar(100);
    DECLARE flag int DEFAULT 1;
    
    SET substr = SUBSTRING_INDEX(nomeDado, ' ', 1);

    IF SUBSTRING_INDEX(nomeDado, ' ', 2) = substr THEN
        SET novoEmail = LCASE(CONCAT(substr, '@uup.br'));
    ELSE
        SET primeiroNome = substr;
        WHILE flag != 0 DO
            SET flag = 0;
            SET nomeDado = SUBSTR(nomeDado, INSTR(nomeDado, substr) + CHAR_LENGTH(substr));
            IF LCASE(LEFT(nomeDado, 4)) = ' de ' THEN
                SET nomeDado = SUBSTR(nomeDado, INSTR(LCASE(nomeDado), ' de ') + 4);
            ELSE 
                IF LEFT(nomeDado, 1) = ' ' THEN
                    SET nomeDado = SUBSTR(nomeDado, INSTR(nomeDado, ' ') + 1);
                END IF;
            END IF;
            SET substr = SUBSTRING_INDEX(nomeDado, ' ', 1);
            SET novoEmail = LCASE(CONCAT(primeiroNome, '.', substr, '@uup.br'));
            SELECT id_aluno INTO flag FROM aluno WHERE email = novoEmail;
        END WHILE;
    END IF;
    RETURN novoEmail;
END$$

-- FUNCTION para retornar o email de um professor ou coordenador novo
CREATE DEFINER=`root`@`localhost` FUNCTION novoEmailProf (nomeDado varchar(100))
RETURNS varchar(100)
BEGIN
    DECLARE novoEmail varchar(100);
    DECLARE substr varchar(100);
    DECLARE primeiroNome varchar(100);
    DECLARE flag int DEFAULT 1;
    
    SET substr = SUBSTRING_INDEX(nomeDado, ' ', 1);

    IF SUBSTRING_INDEX(nomeDado, ' ', 2) = substr THEN
        SET novoEmail = LCASE(CONCAT(substr, '.prof@uup.br'));
    ELSE
        SET primeiroNome = substr;
        WHILE flag != 0 DO
            SET flag = 0;
            SET nomeDado = SUBSTR(nomeDado, INSTR(nomeDado, substr) + CHAR_LENGTH(substr));
            IF LCASE(LEFT(nomeDado, 4)) = ' de ' THEN
                SET nomeDado = SUBSTR(nomeDado, INSTR(LCASE(nomeDado), ' de ') + 4);
            ELSE 
                IF LEFT(nomeDado, 1) = ' ' THEN
                    SET nomeDado = SUBSTR(nomeDado, INSTR(nomeDado, ' ') + 1);
                END IF;
            END IF;
            SET substr = SUBSTRING_INDEX(nomeDado, ' ', 1);
            SET novoEmail = LCASE(CONCAT(primeiroNome, '.', substr, '.prof@uup.br'));
            SELECT id_prof INTO flag FROM professor WHERE email = novoEmail;
        END WHILE;
    END IF;
    RETURN novoEmail;
END$$

-- CADASTROS ADMINISTRADOR/COORDENADOR

-- PROCEDURE para cadastrar curso
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cadastro_curso`(nomeDado varchar(100), tipoDado tinyint, minAnosDado tinyint, maxAnosDado tinyint, nomeAdm varchar (100))
begin
    DECLARE IDadm int;
    -- Adquirindo o ID do ADM
    SELECT id_adm INTO IDadm FROM administrador WHERE nome = nomeAdm;
    IF IDadm IS NOT NULL then
        insert into curso(nome, tipo, minAnos, maxAnos, id_adm) values(nomeDado, tipoDado, minAnosDado, maxAnosDado, IDadm);
    END IF;
end$$

-- PROCEDURE para cadastrar disciplina base
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cadastro_disciplina_base`(nome varchar(100), cargaHoraria int(11),
quantAulasPrev int(11), nome_curso varchar(100), ano_minimo int)
BEGIN
    DECLARE idCurso int;
    DECLARE semestre int;
    select curso.id_curso into idCurso from curso where curso.nome = nome_curso;
    IF MONTH(CURDATE()) <= 6 THEN
        SET semestre = 1;
    ELSE SET semestre = 2;
    END IF;
    CASE
    WHEN idCurso IS NOT NULL THEN
        insert into disciplinaBase(nome,cargaHoraria,quantAulasPrev,id_curso,id_sem,anoMinimo) 
        values(nome,cargaHoraria,quantAulasPrev,idCurso,semestre,ano_minimo);
    END CASE;
END$$

-- PROCEDURE para cadastrar disciplina anual
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cadastro_disciplina_anual`(nome_prof varchar(100),
nome_disc_base varchar(100), nomeCurso varchar(100))
begin
    declare idProf int(11);
    declare idAno int(11);
    declare idDiscBase int(11);
    declare idRemat int;
    call atualizar_ano();
    select professor.id_prof into idProf from professor where professor.nome = nome_prof;
    SELECT ano.id_ano INTO idAno FROM ano WHERE ano.num = YEAR(CURDATE());
    select db.id_discBase, db.id_sem into idDiscBase, idRemat 
        from disciplinaBase as db
            INNER JOIN curso as c
            ON db.id_curso = c.id_curso
        where db.nome = nome_disc_base AND c.nome = nomeCurso;
    if ((idProf is not null) and (idAno is not null) and (idDiscBase is not null) and (idRemat is not null)) then
       insert into disciplinaAnual(ativa, id_prof, id_ano, id_discBase, id_remat) 
            values(1, idProf, idAno, idDiscBase, idRemat);
    end if;
end$$

-- PROCEDURE para cadastrar professor
CREATE DEFINER=`root`@`localhost` PROCEDURE sp_cadastro_professor (salario float, cargaHoraria int(11), senha varchar(80), nome varchar(100), cpf char(11), rg varchar(15), data_nasc date)
begin
    DECLARE emailCriado varchar(100) DEFAULT '.prof@uup.br';
    SET cpf = REPLACE(cpf, '.', '');
    SET rg = REPLACE(cpf, '-', '');
    SET cpf = REPLACE(cpf, '-', '');
    SET rg = REPLACE(rg, '.', '');
    SELECT novoEmailProf(nome) INTO emailCriado;
    insert into professor(salario, cargaHoraria, email, senha, nome, cpf, rg, data_nasc) 
        values(salario,cargaHoraria,emailCriado,senha,nome,cpf,rg,data_nasc);
end$$

-- PROCEDURE para cadastrar aluno
CREATE DEFINER=`root`@`localhost` PROCEDURE sp_cadastro_aluno (ra char(6), senha varchar(80), nome varchar(100), cpf char(14), rg VARCHAR(15), data_nasc date, nome_curso varchar(100))
BEGIN
    DECLARE semestre int;
    DECLARE idAnoAtual int;
    DECLARE idCurso int;
    DECLARE emailCriado varchar(100) DEFAULT '@uup.br';
    SET cpf = REPLACE(cpf, '.', '');
    SET cpf = REPLACE(cpf, '-', '');
    SET rg = REPLACE(rg, '.', '');
    SET rg = REPLACE(rg, '-', '');
    SELECT novoEmailAluno(nome) INTO emailCriado;
    IF MONTH(CURDATE()) <= 6 THEN
        SET semestre = 1;
    ELSE SET semestre = 2;
    END IF;
    CALL atualizar_ano();
    SELECT id_ano INTO idAnoAtual FROM ano WHERE num = YEAR(CURDATE());
    SELECT curso.id_curso INTO idCurso FROM curso WHERE nome_curso = curso.nome;
    IF (idAnoAtual IS NOT NULL) AND (idCurso IS NOT NULL) THEN
        INSERT INTO aluno(`ra`, `email`, `senha`, `nome`, `cpf`, `rg`, `data_nasc`, `id_sem`, `id_ano`, `id_curso`) 
                VALUES(`ra`, emailCriado, `senha`, `nome`, `cpf`, `rg`, `data_nasc`, semestre, idAnoAtual, idCurso);
    END IF;
END$$

-- PROCEDURE cadastrar avisos gerais
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cadastro_aviso_global`(nomeAviso varchar(100), descricaoAviso varchar(1000),
nome_curso varchar(100))
begin
   DECLARE idCurso int(11);
   declare dataHoraAviso datetime;
   select now() into dataHoraAviso;
   SELECT curso.id_curso INTO idCurso FROM curso WHERE nome_curso = curso.nome;
   if idCurso is not null then
       insert into avisoGlobal(nome, descricao, dataHora, id_curso) 
            values(nomeAviso, descricaoAviso, dataHoraAviso, idCurso);
    end if;
end$$

-- CADASTROS PROFESSOR

-- PROCEDURE cadastro aviso de disciplina
CREATE DEFINER=`root`@`localhost` PROCEDURE sp_cadastro_avisoPorNomes (nomeAviso varchar(100), descricao varchar(1000), nomeDisc varchar(100), nomeProf varchar(100), anoDado int, nomeCurso varchar(100))
begin
    declare idDiscAnual int(11);
    declare dataHoraAtual datetime;

    CALL atualizar_ano();

    SELECT id_discAnual into idDiscAnual 
        FROM disciplinaAnual as da
            INNER JOIN disciplinaBase as db
            ON db.id_discBase = da.id_discBase
                INNER JOIN curso as c
                ON db.id_curso = c.id_curso
            INNER JOIN professor as prof
            ON da.id_prof = prof.id_prof
            INNER JOIN ano as an
            ON da.id_ano = an.id_ano
        WHERE (prof.nome = nomeProf) and (db.nome = nomeDisc) and (an.num = anoDado) AND (c.nome = nomeCurso);
    SET dataHoraAtual = NOW();
    case
    when idDiscAnual is not null then
       insert into aviso(nome, descricao, dataHora, id_discAnual) 
        values(nomeAviso, descricao, dataHoraAtual, idDiscAnual);
    end case;
end$$

-- PROCEDURE cadastro aviso de disciplina
CREATE DEFINER=`root`@`localhost` PROCEDURE sp_cadastro_avisoPorID (nomeAviso varchar(100), descricao varchar(1000), idDiscAnual int)
begin
    declare dataHoraAtual datetime;

    SET dataHoraAtual = NOW();
    
    if idDiscAnual is not null then
       insert into aviso(nome, descricao, dataHora, id_discAnual) 
        values(nomeAviso, descricao, dataHoraAtual, idDiscAnual);
    end if;
end$$

-- PROCEDURE cadastro aula de professor em disciplina
CREATE DEFINER=`root`@`localhost` PROCEDURE sp_cadastro_aulaPorNomes (nomeAula varchar(100), descricaoAula varchar(1000), dataAulaDada date, horaAula time, nomeDisc varchar(100), nomeProf varchar(100), anoDado int, nomeCurso varchar(100))
begin
    declare idDiscAnual int;
    DECLARE idHora int;

    CALL atualizar_ano();

    -- Obtendo ID de disciplina anual
    SELECT id_discAnual into idDiscAnual 
        FROM disciplinaAnual as da
            INNER JOIN disciplinaBase as db
            ON db.id_discBase = da.id_discBase
                INNER JOIN curso as c
                ON db.id_curso = c.id_curso
            INNER JOIN professor as prof
            ON da.id_prof = prof.id_prof
            INNER JOIN ano as an
            ON da.id_ano = an.id_ano
        WHERE (prof.nome = nomeProf) and (db.nome = nomeDisc) and (an.num = anoDado) AND (c.nome = nomeCurso);

    -- Obtendo ID de hora aula
    SELECT id_hora INTO idHora FROM hora_aula WHERE hora = horaAula;

    -- Cadastrando hora na tabela, caso ainda não tenha
    IF idHora IS NULL THEN
        INSERT INTO hora_aula (hora) VALUES (horaAula);
        SELECT id_hora INTO idHora FROM hora_aula WHERE hora = horaAula;
    END IF;

   insert into aula(nome, descricao, dataAula, id_hora, id_discAnual) 
    values(nomeAula, descricaoAula, dataAulaDada, idHora, idDiscAnual);
end$$

-- PROCEDURE cadastro aula de professor em disciplina
CREATE DEFINER=`root`@`localhost` PROCEDURE sp_cadastro_aulaPorID (nomeAula varchar(100), descricaoAula varchar(1000), dataAulaDada date, horaAula time, idDiscAnual int)
begin
    DECLARE idHora int;

    -- Obtendo ID de hora aula
    SELECT id_hora INTO idHora FROM hora_aula WHERE hora = horaAula;

    -- Cadastrando hora na tabela, caso ainda não tenha
    IF idHora IS NULL THEN
        INSERT INTO hora_aula (hora) VALUES (horaAula);
        SELECT id_hora INTO idHora FROM hora_aula WHERE hora = horaAula;
    END IF;

   insert into aula(nome, descricao, dataAula, id_hora, id_discAnual) 
    values(nomeAula, descricaoAula, dataAulaDada, idHora, idDiscAnual);
end$$

-- PROCEDURE cadastro de avaliação de aula de um professor
CREATE DEFINER=`root`@`localhost` PROCEDURE sp_cadastro_avaliacao (nomeAval varchar(100), idAula int)
begin
   insert into avaliacao (nome, id_aula) values(nomeAval, idAula);
end$$

-- PROCEDURE cadastro de nota de avaliação de aula de um professor
CREATE DEFINER=`root`@`localhost` PROCEDURE sp_cadastro_notaPorNomes (notaDada float, idAval int, nomeCurso VARCHAR(100), nomeDiscBase VARCHAR(100), nomeProf VARCHAR(100), nomeAluno VARCHAR(100), anoLecionada int)
BEGIN
    DECLARE IdDados int;

    CALL atualizar_ano();

    -- Adquirindo ID do dados aluno
    SELECT dl.id_dados INTO IdDados 
        FROM dados_aluno as dl
            INNER JOIN disciplinaAnual as da
            ON dl.id_discAnual = da.id_discAnual
                INNER JOIN disciplinaBase as db
                ON da.id_discBase = db.id_discBase
                    INNER JOIN curso as c
                    ON db.id_curso = c.id_curso
                INNER JOIN professor as pr
                ON da.id_prof = pr.id_prof
                INNER JOIN ano as an
                ON da.id_ano = an.id_ano
            INNER JOIN aluno as al
            ON dl.id_aluno = al.id_aluno
        WHERE db.nome = nomeDiscBase AND c.nome = nomeCurso AND pr.nome = nomeProf AND al.nome = nomeAluno AND an.num = anoLecionada;
    
   insert into nota (nota, id_aval, id_dados) values(notaDada, idAval, IdDados);
END$$

-- PROCEDURE cadastro de nota de avaliação de aula de um professor
CREATE DEFINER=`root`@`localhost` PROCEDURE sp_cadastro_notaPorID (notaDada float, idAval int, IdDados int)
BEGIN
   insert into nota (nota, id_aval, id_dados) values(notaDada, idAval, IdDados);
END$$

-- PROCEDURE cadastro de frequência de uma aula de um professor
CREATE DEFINER=`root`@`localhost` PROCEDURE sp_cadastro_frequenciaPorNomes (idAula int, presenca tinyint, nomeCurso VARCHAR(100), nomeDiscBase VARCHAR(100), nomeProf VARCHAR(100), nomeAluno VARCHAR(100), anoLecionada int)
BEGIN
    DECLARE IdDados int;

    CALL atualizar_ano();

    -- Adquirindo ID do dados aluno
    SELECT dl.id_dados INTO IdDados 
        FROM dados_aluno as dl
            INNER JOIN disciplinaAnual as da
            ON dl.id_discAnual = da.id_discAnual
                INNER JOIN disciplinaBase as db
                ON da.id_discBase = db.id_discBase
                    INNER JOIN curso as c
                    ON db.id_curso = c.id_curso
                INNER JOIN professor as pr
                ON da.id_prof = pr.id_prof
                INNER JOIN ano as an
                ON da.id_ano = an.id_ano
            INNER JOIN aluno as al
            ON dl.id_aluno = al.id_aluno
        WHERE db.nome = nomeDiscBase AND c.nome = nomeCurso AND pr.nome = nomeProf AND al.nome = nomeAluno AND an.num = anoLecionada;
    
   insert into frequencia (id_dados, id_aula, faltou_) values(IdDados, idAula, presenca);
END$$

-- PROCEDURE cadastro de frequência de uma aula de um professor
CREATE DEFINER=`root`@`localhost` PROCEDURE sp_cadastro_frequenciaPorID (idAula int, presenca tinyint, IdDados int)
BEGIN
   insert into frequencia (id_dados, id_aula, faltou_) values(IdDados, idAula, presenca);
END$$

-- PROCEDURE cadastro de dados de um aluno
CREATE DEFINER=`root`@`localhost` PROCEDURE sp_cadastro_dadosAlunoPorNomes (media_final FLOAT, freq_final FLOAT, nomeAluno VARCHAR(100), situacao varchar(50), nomeCurso VARCHAR(100), nomeDiscBase VARCHAR(100), nomeProf VARCHAR(100), anoLecionada int)
BEGIN
    declare idDiscAnual int;
    DECLARE idAluno int;
    DECLARE idSit int;
    
    CALL atualizar_ano();

    -- Obtendo ID de disciplina anual
    SELECT id_discAnual into idDiscAnual 
        FROM disciplinaAnual as da
            INNER JOIN disciplinaBase as db
            ON db.id_discBase = da.id_discBase
                INNER JOIN curso as c
                ON db.id_curso = c.id_curso
            INNER JOIN professor as prof
            ON da.id_prof = prof.id_prof
            INNER JOIN ano as an
            ON da.id_ano = an.id_ano
        WHERE (prof.nome = nomeProf) and (db.nome = nomeDiscBase) and (an.num = anoLecionada) AND (c.nome = nomeCurso);
    
    -- Obtendo ID de aluno
    SELECT id_aluno INTO idAluno FROM aluno WHERE nome = nomeAluno;

    -- Obtendo ID de situacao
    SELECT id_sit INTO idSit FROM situacao_aluno WHERE situacao_ = situacao;
    
   insert into dados_aluno (mediaFinal, freqFinal, id_aluno, id_sit, id_discAnual) 
            values(media_final, freq_final, idAluno, idSit, idDiscAnual);
END$$

-- PROCEDURE cadastro de dados de um aluno
CREATE DEFINER=`root`@`localhost` PROCEDURE sp_cadastro_dadosAlunoPorID (media_final FLOAT, freq_final FLOAT, nomeAluno VARCHAR(100), situacao varchar(50), idDiscAnual int)
BEGIN
    DECLARE idAluno int;
    DECLARE idSit int;
    
    -- Obtendo ID de aluno
    SELECT id_aluno INTO idAluno FROM aluno WHERE nome = nomeAluno;

    -- Obtendo ID de situacao
    SELECT id_sit INTO idSit FROM situacao_aluno WHERE situacao_ = situacao;
    
   insert into dados_aluno (mediaFinal, freqFinal, id_aluno, id_sit, id_discAnual) 
            values(media_final, freq_final, idAluno, idSit, idDiscAnual);
END$$

-- LOGIN

-- PROCEDURE para verificar o login de Aluno
CREATE DEFINER=`root`@`localhost` PROCEDURE verificaLoginAluno (emailDado varchar(100), senhaDada varchar(80), OUT retorno tinyint, OUT id int, OUT nome_aluno varchar(100), OUT nome_curso varchar(100))
BEGIN
	DECLARE idAux int;
    DECLARE idAux2 int;
    DECLARE idCurso int;
    SELECT id_aluno INTO idAux FROM aluno WHERE email = emailDado;
    IF idAux IS NOT NULL THEN
        SET id = idAux;
        SET retorno = 1;
        -- Verificando se a senha bate com o registro do banco
        SELECT id_aluno INTO idAux2 FROM aluno WHERE id_aluno = idAux AND senha = MD5(senhaDada);
        IF idAux2 IS NOT NULL THEN
            -- Apresentar algo como: Login realizado com sucesso.

            -- Adquirindo o nome do Aluno
            SELECT nome INTO nome_aluno FROM aluno WHERE id_aluno = idAux;

            -- Adquirindo o nome do Curso que o aluno está matriculado
            SELECT c.nome INTO nome_curso
                FROM curso as c
                    INNER JOIN disciplinaBase as db
                    ON db.id_curso = c.id_curso
                        INNER JOIN disciplinaAnual as dl
                        ON db.id_discBase = dl.id_discBase
                            INNER JOIN dados_aluno as da
                            ON dl.id_discAnual = da.id_discAnual
                WHERE da.id_aluno = idAux
                LIMIT 1;
        ELSE
            -- Apresentar algo como: Senha incorreta.
            SET retorno = 0;
            SET id = 0;
            SET nome_aluno = 'Senha incorreta';
            SET nome_curso = '';
        END IF;
    ELSE
        -- Apresentar algo como: O Email não está cadastrado no banco.
        SET retorno = 0;
        SET id = 0;
        SET nome_aluno = 'Email ou senha incorretos';
        SET nome_curso = '';
    END IF;
END$$

-- PROCEDURE para verificar o login de ADM, Prof, Coordenador
CREATE DEFINER=`root`@`localhost` PROCEDURE verificaLoginFuncionarios (emailDado varchar(100), senhaDada varchar(80), OUT tipo tinyint, OUT id int, OUT nome_user varchar(100))
BEGIN
	DECLARE idAux int;
    DECLARE idAux2 int;
    DECLARE idCurso int;
    SELECT id_adm INTO idAux FROM administrador WHERE email = emailDado;
    -- Verificando se o email é de um ADM
    IF idAux IS NOT NULL THEN
        SET tipo = 1;
        SET id = idAux;
        -- Verificando se a senha bate com o registro do banco
        SELECT id_adm INTO idAux2 FROM administrador WHERE id_adm = idAux AND senha = MD5(senhaDada);
        IF idAux2 IS NOT NULL THEN
            -- Apresentar algo como: Login realizado com sucesso.
            -- Adquirindo o nome do ADM
            SELECT nome INTO nome_user FROM administrador WHERE id_adm = idAux;
        ELSE
            -- Apresentar algo como: Senha incorreta.
            SET tipo = 0;
            SET id = 0;
            SET nome_user = 'Senha incorreta';
        END IF;
    ELSE
		-- Verificando se o email é de um Professor
    	SELECT id_prof, id_curso INTO idAux, idCurso FROM professor WHERE email = emailDado;
        IF idAux IS NOT NULL THEN
            SET id = idAux;
            -- Verificando se o professor do registro é um Coordenador
            IF idCurso IS NOT NULL THEN
                SET tipo = 3;
            ELSE
                SET tipo = 2;
            END IF;
            SELECT id_prof INTO idAux2 FROM professor WHERE id_prof = idAux AND senha = MD5(senhaDada);
            -- Verificando se a senha bate com o registro do banco
            IF idAux2 IS NOT NULL THEN
                -- Apresentar algo como: Login realizado com sucesso.
                -- Adquirindo o nome do Professor/Coordenador
                SELECT nome INTO nome_user FROM professor WHERE id_prof = idAux;
            ELSE
                -- Apresentar algo como: Senha incorreta.
                SET tipo = 0;
                SET id = 0;
                SET nome_user = 'Senha incorreta';
            END IF;
        ELSE
            -- Apresentar algo como: O Email não está cadastrado no banco.
                SET tipo = 0;
                SET id = 0;
                SET nome_user = 'Email ou senha incorretos';
        END IF;
    END IF;
END$$

-- ATUALIZAÇÕES

-- Atualizar senhas

-- PROCEDURE para ATUALIZAR senha de aluno
CREATE DEFINER=`root`@`localhost` PROCEDURE atualizarSenhaAluno (nomeDado varchar(100), senhaAtual varchar(80), senhaNova varchar(80), OUT retorno tinyint, OUT mensagem varchar(100))
BEGIN
    DECLARE idUser int DEFAULT 0;

    SELECT id_aluno INTO idUser FROM aluno WHERE nome = nomeDado AND senha = MD5(senhaAtual);

    IF idUser != 0 THEN
        UPDATE aluno SET senha = MD5(senhaNova) WHERE id_aluno = idUser;
        SET retorno = 1;
        SET mensagem = 'Senha alterada com sucesso';
    ELSE
        SET retorno = 0;
        SET mensagem = 'Senha atual digitada incorreta';
    END IF;
END$$

-- PROCEDURE para ATUALIZAR senha de professor e coordenador
CREATE DEFINER=`root`@`localhost` PROCEDURE atualizarSenhaProf (nomeDado varchar(100), senhaAtual varchar(80), senhaNova varchar(80), OUT retorno tinyint, OUT mensagem varchar(100))
BEGIN
    DECLARE idUser int DEFAULT 0;

    SELECT id_prof INTO idUser FROM professor WHERE nome = nomeDado AND senha = MD5(senhaAtual);

    IF idUser != 0 THEN
        UPDATE professor SET senha = MD5(senhaNova) WHERE id_prof = idUser;
        SET retorno = 1;
        SET mensagem = 'Senha alterada com sucesso';
    ELSE
        SET retorno = 0;
        SET mensagem = 'Senha atual digitada incorreta';
    END IF;
END$$

-- PROCEDURE para ATUALIZAR senha de administrador
CREATE DEFINER=`root`@`localhost` PROCEDURE atualizarSenhaADM (nomeDado varchar(100), senhaAtual varchar(80), senhaNova varchar(80), OUT retorno tinyint, OUT mensagem varchar(100))
BEGIN
    DECLARE idUser int DEFAULT 0;

    SELECT id_adm INTO idUser FROM administrador WHERE nome = nomeDado AND senha = MD5(senhaAtual);

    IF idUser != 0 THEN
        UPDATE administrador SET senha = MD5(senhaNova) WHERE id_adm = idUser;
        SET retorno = 1;
        SET mensagem = 'Senha alterada com sucesso';
    ELSE
        SET retorno = 0;
        SET mensagem = 'Senha atual digitada incorreta';
    END IF;
END$$

-- PROCEDURE para ATUALIZAR curso que um Coordenador coordena
CREATE DEFINER=`root`@`localhost` FUNCTION atualizarCargoCoord (nomeProf varchar(100), nomeCurso varchar(100))
RETURNS tinyint
BEGIN
    DECLARE idCurso int DEFAULT NULL;
    DECLARE quantProf int DEFAULT 0;
    DECLARE retorno tinyint DEFAULT 1;

    SELECT id_curso INTO idCurso FROM professor WHERE nome = nomeProf;

    IF idCurso IS NOT NULL THEN
        SELECT COUNT(id_prof) INTO quantProf FROM professor WHERE id_curso = idCurso;
        IF quantProf <= 1 THEN
            SET retorno = 0;
        ELSE
            SELECT id_curso INTO idCurso FROM curso WHERE nome = nomeCurso;

            UPDATE professor SET id_curso = idCurso WHERE nome = nomeProf;
        END IF;
    ELSE
        SELECT id_curso INTO idCurso FROM curso WHERE nome = nomeCurso;

        UPDATE professor SET id_curso = idCurso WHERE nome = nomeProf;
    END IF;
    RETURN retorno;
END$$

-- PROCEDURE para TROCAR professores de disciplinas anuais por nomes
CREATE DEFINER=`root`@`localhost` PROCEDURE trocarProfDiscAnualPorNomes (nomeProf1 varchar(100), nomeDiscBase1 varchar(100), anoDisc1 varchar(100), nomeCurso1 varchar(100), nomeProf2 varchar(100), nomeDiscBase2 varchar(100), anoDisc2 varchar(100), nomeCurso2 varchar(100))
BEGIN
    declare idDiscAnual1 int DEFAULT NULL;
    declare idDiscAnual2 int DEFAULT NULL;
    declare idProf1 int DEFAULT NULL;
    declare idProf2 int DEFAULT NULL;
    
    CALL atualizar_ano();

    -- Obtendo ID de professor 1
    SELECT id_prof INTO idProf1 FROM professor WHERE nome = nomeProf1;

    -- Obtendo ID de disciplina anual 1
    SELECT id_discAnual into idDiscAnual1
        FROM disciplinaAnual as da
            INNER JOIN disciplinaBase as db
            ON db.id_discBase = da.id_discBase
                INNER JOIN curso as c
                ON db.id_curso = c.id_curso
            INNER JOIN ano as an
            ON da.id_ano = an.id_ano
        WHERE (da.id_prof = idProf1) and (db.nome = nomeDiscBase1) and (an.num = anoDisc1) AND (c.nome = nomeCurso1);

    -- Obtendo ID de professor 1
    SELECT id_prof INTO idProf2 FROM professor WHERE nome = nomeProf2;

    -- Obtendo ID de disciplina anual 2
    SELECT id_discAnual into idDiscAnual2
        FROM disciplinaAnual as da
            INNER JOIN disciplinaBase as db
            ON db.id_discBase = da.id_discBase
                INNER JOIN curso as c
                ON db.id_curso = c.id_curso
            INNER JOIN ano as an
            ON da.id_ano = an.id_ano
        WHERE (da.id_prof = idProf2) and (db.nome = nomeDiscBase2) and (an.num = anoDisc2) AND (c.nome = nomeCurso2);

    IF (idDiscAnual1 IS NOT NULL) AND (idDiscAnual2 IS NOT NULL) AND (idProf1 IS NOT NULL) AND (idProf2 IS NOT NULL) THEN
        UPDATE disciplinaAnual SET id_prof = idProf1 WHERE id_discAnual = idDiscAnual2;

        UPDATE disciplinaAnual SET id_prof = idProf2 WHERE id_discAnual = idDiscAnual1;
    END IF;
END$$

-- PROCEDURE para TROCAR professores de disciplinas anuais por IDs
CREATE DEFINER=`root`@`localhost` PROCEDURE trocarProfDiscAnualPorIDs (nomeProf1 varchar(100), idDiscAnual1 int, nomeProf2 varchar(100), idDiscAnual2 int)
BEGIN
    declare idProf1 int DEFAULT NULL;
    declare idProf2 int DEFAULT NULL;
    
    CALL atualizar_ano();

    -- Obtendo ID de professor 1
    SELECT id_prof INTO idProf1 FROM professor WHERE nome = nomeProf1;

    -- Obtendo ID de professor 1
    SELECT id_prof INTO idProf2 FROM professor WHERE nome = nomeProf2;

    IF (idDiscAnual1 IS NOT NULL) AND (idDiscAnual2 IS NOT NULL) AND (idProf1 IS NOT NULL) AND (idProf2 IS NOT NULL) THEN
        UPDATE disciplinaAnual SET id_prof = idProf1 WHERE id_discAnual = idDiscAnual2;

        UPDATE disciplinaAnual SET id_prof = idProf2 WHERE id_discAnual = idDiscAnual1;
    END IF;
END$$

-- -- Alterar CURSO a partir de ID
-- CREATE DEFINER=`root`@`localhost` PROCEDURE alteraCursoPorID (nomeCurso VARCHAR(100), tipoCurso tinyint, minAnosCurso tinyint, maxAnosCurso tinyint, idCurso int)
-- BEGIN
--     UPDATE curso SET nome = nomeCurso, tipo = tipoCurso, minAnos = minAnosCurso, maxAnos = maxAnosCurso WHERE id_curso = idCurso;
-- END$$

-- -- Alterar CURSO a partir de nome
-- CREATE DEFINER=`root`@`localhost` PROCEDURE alteraCursoPorNome (nomeCursoNovo VARCHAR(100), tipoCurso tinyint, minAnosCurso tinyint, maxAnosCurso tinyint, nomeCursoAtual VARCHAR(100))
-- BEGIN
--     UPDATE curso SET nome = nomeCursoNovo, tipo = tipoCurso, minAnos = minAnosCurso, maxAnos = maxAnosCurso WHERE nome = nomeCursoAtual;
-- END$$

-- PROCEDURE para ATUALIZAR curso
CREATE DEFINER=`root`@`localhost` PROCEDURE atualizarCursoPorNome (nomeCursoAtual varchar(100), nomeCursoNovo varchar(100), tipoDado tinyint, minAnosDado tinyint, maxAnosDado tinyint)
begin
    UPDATE curso 
        SET nome = nomeCursoNovo, tipo = tipoDado, minAnos = minAnosDado, maxAnos = maxAnosDado 
        WHERE nome = nomeCursoAtual;
end$$

-- PROCEDURE para ATUALIZAR DISCIPLINA BASE a partir de ID da DISCIPLINA BASE e nome do CURSO
CREATE DEFINER=`root`@`localhost` PROCEDURE atualizarDiscBasePorID (idDiscBase int, nomeDado VARCHAR(100), cargaHorariaDada int, quantAulasPrevDada int, semestreDado int, nomeCurso VARCHAR(100), ano_minimo int)
BEGIN
    DECLARE idCurso int;

    SELECT id_curso INTO idCurso FROM curso WHERE nome = nomeCurso;

    IF idCurso IS NOT NULL THEN
        UPDATE disciplinaBase SET nome = nomeDado, cargaHoraria = cargaHorariaDada, quantAulasPrev = quantAulasPrevDada, id_sem = semestreDado, id_curso = idCurso, anoMinimo = ano_minimo WHERE id_discBase = idDiscBase;
    END IF;
END$$

-- PROCEDURE para ATUALIZAR DISCIPLINA BASE a partir de nome da DISCIPLINA BASE e nome do CURSO
CREATE DEFINER=`root`@`localhost` PROCEDURE atualizarDiscBasePorNome (nomeDiscBaseAtual VARCHAR(100), nomeCursoAtual VARCHAR(100), nomeDiscBaseNovo VARCHAR(100), cargaHorariaDada int, quantAulasPrevDada int, semestreDado int, nomeCursoNovo VARCHAR(100), ano_minimo int)
BEGIN
    DECLARE idCurso int;
    DECLARE idDiscBase int;

    -- Adquirindo ID do novo curso
    SELECT id_curso INTO idCurso FROM curso WHERE nome = nomeCursoNovo;

    -- Adquirindo ID da disciplina base atual
    SELECT db.id_discBase INTO IdDiscBase 
        FROM disciplinaBase as db
            INNER JOIN curso as c
            ON db.id_curso = c.id_curso
        WHERE db.nome = nomeDiscBaseAtual AND c.nome = nomeCursoAtual;

    IF idCurso IS NOT NULL THEN
        UPDATE disciplinaBase SET nome = nomeDiscBaseNovo, cargaHoraria = cargaHorariaDada, quantAulasPrev = quantAulasPrevDada, id_sem = semestreDado, id_curso = idCurso, anoMinimo = ano_minimo WHERE id_discBase = idDiscBase;
    END IF;
END$$

-- PROCEDURE para ATUALIZAR avisos globais
CREATE DEFINER=`root`@`localhost` PROCEDURE atualizarAvisoGlobal (idAvisoGlobal int, nomeAviso varchar(100), descricaoAviso varchar(1000))
begin
    declare dataHoraAviso datetime;
    select now() into dataHoraAviso;
    UPDATE avisoGlobal 
        SET nome = nomeAviso, descricao = descricaoAviso, dataHora = dataHoraAviso
        WHERE id_avisoGlobal = idAvisoGlobal;
end$$

-- PROCEDURE para ATUALIZAR avaliação
CREATE DEFINER=`root`@`localhost` PROCEDURE atualizarAvaliacao (idAval int, nomeAval varchar(100))
begin
   UPDATE avaliacao 
    SET nome = nomeAval
    WHERE id_aval = idAval;
end$$

-- PROCEDURE para ATUALIZAR aluno
CREATE DEFINER=`root`@`localhost` PROCEDURE atualizarAluno (nomeDadoAtual varchar(100), raDado char(6), emailDado varchar(100), senhaDado varchar(80), nomeDadoNovo varchar(100), cpfDado char(14), rgDado VARCHAR(15), data_nascDado date, nome_cursoDado varchar(100), anoDado int, semestreDado int)
BEGIN
    DECLARE idAno int;
    DECLARE idCurso int;
    SET cpfDado = REPLACE(cpfDado, '.', '');
    SET cpfDado = REPLACE(cpfDado, '-', '');
    SET rgDado = REPLACE(rgDado, '.', '');
    SET rgDado = REPLACE(rgDado, '-', '');
    CALL atualizar_ano();
    SELECT id_ano INTO idAno FROM ano WHERE num = anoDado;
    SELECT id_curso INTO idCurso FROM curso WHERE nome = nome_cursoDado;
    IF (idAno IS NOT NULL) AND (idCurso IS NOT NULL) THEN
        UPDATE aluno 
            SET ra = raDado, email = emailDado, senha = senhaDado, nome = nomeDadoNovo, cpf = cpfDado, rg = rgDado, data_nasc = data_nascDado, id_sem = semestreDado, id_ano = idAno, id_curso = idCurso
            WHERE nome = nomeDadoAtual;
    END IF;
END$$

-- PROCEDURE para ATUALIZAR nota de avaliação
CREATE DEFINER=`root`@`localhost` PROCEDURE atualizarNota (idNota int, notaDada float)
BEGIN
   UPDATE nota SET nota = notaDada WHERE id_nota = idNota;
END$$

-- PROCEDURE para ATUALIZAR a frequencia de um aluno em uma aula por Nomes
CREATE DEFINER=`root`@`localhost` PROCEDURE atualizarFrequenciaPorNomes (idAula int, nomeCurso VARCHAR(100), nomeDiscBase VARCHAR(100), nomeProf VARCHAR(100), nomeAluno VARCHAR(100), anoLecionada int, presenca tinyint)
BEGIN
    DECLARE idDados int;

    -- Adquirindo ID do dados aluno
    SELECT dl.id_dados INTO IdDados 
        FROM dados_aluno as dl
            INNER JOIN disciplinaAnual as da
            ON dl.id_discAnual = da.id_discAnual
                INNER JOIN disciplinaBase as db
                ON da.id_discBase = db.id_discBase
                    INNER JOIN curso as c
                    ON db.id_curso = c.id_curso
                INNER JOIN professor as pr
                ON da.id_prof = pr.id_prof
                INNER JOIN ano as an
                ON da.id_ano = an.id_ano
            INNER JOIN aluno as al
            ON dl.id_aluno = al.id_aluno
        WHERE db.nome = nomeDiscBase AND c.nome = nomeCurso AND pr.nome = nomeProf AND al.nome = nomeAluno AND an.num = anoLecionada;
    
   UPDATE frequencia SET faltou_ = presenca WHERE id_aula = idAula AND id_dados = idDados;
END$$

-- PROCEDURE para ATUALIZAR a frequencia de um aluno em uma aula por ID
CREATE DEFINER=`root`@`localhost` PROCEDURE atualizarFrequenciaPorID (idAula int, idDados int, presenca tinyint)
BEGIN
   UPDATE frequencia SET faltou_ = presenca WHERE id_aula = idAula AND id_dados = idDados;
END$$

-- PROCEDURE para ATUALIZAR dados de um aluno por nomes
CREATE DEFINER=`root`@`localhost` PROCEDURE atualizarDadosAlunoPorNomes (nomeCurso VARCHAR(100), nomeDiscBase VARCHAR(100), nomeProf VARCHAR(100), nomeAluno VARCHAR(100), anoLecionada int, media_final float, freq_final float, situacao varchar(50))
BEGIN
    DECLARE idDados int;
    DECLARE idSit int;

    -- Adquirindo ID do dados aluno
    SELECT dl.id_dados INTO IdDados 
        FROM dados_aluno as dl
            INNER JOIN disciplinaAnual as da
            ON dl.id_discAnual = da.id_discAnual
                INNER JOIN disciplinaBase as db
                ON da.id_discBase = db.id_discBase
                    INNER JOIN curso as c
                    ON db.id_curso = c.id_curso
                INNER JOIN professor as pr
                ON da.id_prof = pr.id_prof
                INNER JOIN ano as an
                ON da.id_ano = an.id_ano
            INNER JOIN aluno as al
            ON dl.id_aluno = al.id_aluno
        WHERE db.nome = nomeDiscBase AND c.nome = nomeCurso AND pr.nome = nomeProf AND al.nome = nomeAluno AND an.num = anoLecionada;

    -- Obtendo ID de situacao
    SELECT id_sit INTO idSit FROM situacao_aluno WHERE situacao_ = situacao;
    
    UPDATE dados_aluno 
        SET mediaFinal = media_final, freqFinal = freq_final, id_sit = idSit 
        WHERE id_dados = idDados;
END$$

-- PROCEDURE para ATUALIZAR dados de um aluno por ID
CREATE DEFINER=`root`@`localhost` PROCEDURE atualizarDadosAlunoPorID (idDados int, media_final float, freq_final float, situacao varchar(50))
BEGIN
    DECLARE idSit int;

    -- Obtendo ID de situacao
    SELECT id_sit INTO idSit FROM situacao_aluno WHERE situacao_ = situacao;
    
    UPDATE dados_aluno 
        SET mediaFinal = media_final, freqFinal = freq_final, id_sit = idSit 
        WHERE id_dados = idDados;
END$$

-- REMOÇÕES

-- PROCEDURE para REMOVER curso que um Coordenador coordena
CREATE DEFINER=`root`@`localhost` FUNCTION removerCargoCoord (nomeProf varchar(100))
RETURNS tinyint
BEGIN
    DECLARE idCurso int DEFAULT NULL;
    DECLARE quantProf int DEFAULT 0;
    DECLARE retorno tinyint DEFAULT 1;

    SELECT id_curso INTO idCurso FROM professor WHERE nome = nomeProf;

    IF idCurso IS NOT NULL THEN
        SELECT COUNT(id_prof) INTO quantProf FROM professor WHERE id_curso = idCurso;
        IF quantProf <= 1 THEN
            SET retorno = 0;
        ELSE UPDATE professor SET id_curso = NULL WHERE nome = nomeProf;
        END IF;
    ELSE UPDATE professor SET id_curso = NULL WHERE nome = nomeProf;
    END IF;
    RETURN retorno;
END$$

-- Apagar CURSO a partir de código
CREATE DEFINER=`root`@`localhost` PROCEDURE deletaCursoPorID (idCurso int)
BEGIN
    -- Apagando as notas das avaliações do curso a ser deletado
    DELETE n
    FROM nota as n
        INNER JOIN avaliacao as av
        ON n.id_aval = av.id_aval
            INNER JOIN aula as au
            ON av.id_aula = au.id_aula
                INNER JOIN disciplinaAnual as da
                ON au.id_discAnual = da.id_discAnual
                    INNER JOIN disciplinaBase as db
                    ON da.id_discBase = db.id_discBase
                        INNER JOIN curso as c
                        ON db.id_curso = c.id_curso
   	WHERE c.id_curso = idCurso;
    
    -- Apagando as avaliações das diciplinas do curso a ser deletado
    DELETE av
    FROM avaliacao as av
        INNER JOIN aula as au
        ON av.id_aula = au.id_aula
            INNER JOIN disciplinaAnual as da
            ON au.id_discAnual = da.id_discAnual
                INNER JOIN disciplinaBase as db
                ON da.id_discBase = db.id_discBase
                    INNER JOIN curso as c
                    ON db.id_curso = c.id_curso
    WHERE c.id_curso = idCurso;

    -- Apagando as frequências das aulas do curso a ser deletado
    DELETE f
    FROM frequencia as f
        INNER JOIN aula as au
        ON f.id_aula = au.id_aula
            INNER JOIN disciplinaAnual as da
            ON au.id_discAnual = da.id_discAnual
                INNER JOIN disciplinaBase as db
                ON da.id_discBase = db.id_discBase
                    INNER JOIN curso as c
                    ON db.id_curso = c.id_curso
    WHERE c.id_curso = idCurso;

    -- Apagando as aulas das diciplinas do curso a ser deletado
    DELETE au
    FROM aula as au
        INNER JOIN disciplinaAnual as da
        ON au.id_discAnual = da.id_discAnual
            INNER JOIN disciplinaBase as db
            ON da.id_discBase = db.id_discBase
                INNER JOIN curso as c
                ON db.id_curso = c.id_curso
    WHERE c.id_curso = idCurso;

    -- Apagando os avisos das diciplinas matriculados no curso a ser deletado
    DELETE av
    FROM aviso as av
        INNER JOIN disciplinaAnual as da
        ON av.id_discAnual = da.id_discAnual
            INNER JOIN disciplinaBase as db
            ON da.id_discBase = db.id_discBase
                INNER JOIN curso as c
                ON db.id_curso = c.id_curso
    WHERE c.id_curso = idCurso;
    
    -- Apagando os dados dos alunos matriculados no curso a ser deletado
    DELETE da
    FROM dados_aluno as da
        INNER JOIN aluno as a
        ON a.id_aluno = da.id_aluno
            INNER JOIN curso as c
            ON c.id_curso = a.id_curso
    WHERE c.id_curso = idCurso;

    -- Apagando os dados dos alunos das disciplinas do curso a ser deletado
    DELETE dl
    FROM dados_aluno as dl
        INNER JOIN disciplinaAnual as da
        ON dl.id_discAnual = da.id_discAnual
            INNER JOIN disciplinaBase as db
            ON da.id_discBase = db.id_discBase
                INNER JOIN curso as c
                ON db.id_curso = c.id_curso
    WHERE c.id_curso = idCurso;

    -- Apagando as disciplinas anuais do curso a ser deletado
    DELETE da
    FROM disciplinaAnual as da
        INNER JOIN disciplinaBase as db
        ON da.id_discBase = db.id_discBase
            INNER JOIN curso as c
            ON db.id_curso = c.id_curso
    WHERE c.id_curso = idCurso;

    -- Apagando as disciplinas base do curso a ser deletado
    DELETE db
    FROM disciplinaBase as db
        INNER JOIN curso as c
        ON db.id_curso = c.id_curso
    WHERE c.id_curso = idCurso;

    -- Apagando os alunos matriculados no curso a ser deletado
    DELETE a
    FROM aluno as a
        INNER JOIN curso as c
        ON a.id_curso = c.id_curso
    WHERE c.id_curso = idCurso;

    -- Apagando os professores que lecionam nas diciplinas do curso a ser deletado
    DELETE p
    FROM professor as p
        INNER JOIN curso as c
        ON p.id_curso = c.id_curso
    WHERE c.id_curso = idCurso;

    -- Apagando os avisos globais do curso a ser deletado
    DELETE ag
    FROM avisoGlobal as ag
        INNER JOIN curso as c
        ON ag.id_curso = c.id_curso
    WHERE c.id_curso = idCurso;

    -- Apagando o curso em si
    DELETE FROM curso WHERE id_curso = idCurso;
END$$

-- Apagar CURSO a partir de nome
CREATE DEFINER=`root`@`localhost` PROCEDURE deletaCursoPorNome (nomeCurso VARCHAR(100))
BEGIN
    -- Apagando as notas das avaliações do curso a ser deletado
    DELETE n
    FROM nota as n
        INNER JOIN avaliacao as av
        ON n.id_aval = av.id_aval
            INNER JOIN aula as au
            ON av.id_aula = au.id_aula
                INNER JOIN disciplinaAnual as da
                ON au.id_discAnual = da.id_discAnual
                    INNER JOIN disciplinaBase as db
                    ON da.id_discBase = db.id_discBase
                        INNER JOIN curso as c
                        ON db.id_curso = c.id_curso
   	WHERE c.nome = nomeCurso;
    
    -- Apagando as avaliações das diciplinas do curso a ser deletado
    DELETE av
    FROM avaliacao as av
        INNER JOIN aula as au
        ON av.id_aula = au.id_aula
            INNER JOIN disciplinaAnual as da
            ON au.id_discAnual = da.id_discAnual
                INNER JOIN disciplinaBase as db
                ON da.id_discBase = db.id_discBase
                    INNER JOIN curso as c
                    ON db.id_curso = c.id_curso
    WHERE c.nome = nomeCurso;

    -- Apagando as frequências das aulas do curso a ser deletado
    DELETE f
    FROM frequencia as f
        INNER JOIN aula as au
        ON f.id_aula = au.id_aula
            INNER JOIN disciplinaAnual as da
            ON au.id_discAnual = da.id_discAnual
                INNER JOIN disciplinaBase as db
                ON da.id_discBase = db.id_discBase
                    INNER JOIN curso as c
                    ON db.id_curso = c.id_curso
    WHERE c.nome = nomeCurso;

    -- Apagando as aulas das diciplinas do curso a ser deletado
    DELETE au
    FROM aula as au
        INNER JOIN disciplinaAnual as da
        ON au.id_discAnual = da.id_discAnual
            INNER JOIN disciplinaBase as db
            ON da.id_discBase = db.id_discBase
                INNER JOIN curso as c
                ON db.id_curso = c.id_curso
    WHERE c.nome = nomeCurso;

    -- Apagando os avisos das diciplinas matriculados no curso a ser deletado
    DELETE av
    FROM aviso as av
        INNER JOIN disciplinaAnual as da
        ON av.id_discAnual = da.id_discAnual
            INNER JOIN disciplinaBase as db
            ON da.id_discBase = db.id_discBase
                INNER JOIN curso as c
                ON db.id_curso = c.id_curso
    WHERE c.nome = nomeCurso;
    
    -- Apagando os dados dos alunos matriculados no curso a ser deletado
    DELETE da
    FROM dados_aluno as da
        INNER JOIN aluno as a
        ON a.id_aluno = da.id_aluno
            INNER JOIN curso as c
            ON c.id_curso = a.id_curso
    WHERE c.nome = nomeCurso;

    -- Apagando os dados dos alunos das disciplinas do curso a ser deletado
    DELETE dl
    FROM dados_aluno as dl
        INNER JOIN disciplinaAnual as da
        ON dl.id_discAnual = da.id_discAnual
            INNER JOIN disciplinaBase as db
            ON da.id_discBase = db.id_discBase
                INNER JOIN curso as c
                ON db.id_curso = c.id_curso
    WHERE c.nome = nomeCurso;

    -- Apagando as disciplinas anuais do curso a ser deletado
    DELETE da
    FROM disciplinaAnual as da
        INNER JOIN disciplinaBase as db
        ON da.id_discBase = db.id_discBase
            INNER JOIN curso as c
            ON db.id_curso = c.id_curso
    WHERE c.nome = nomeCurso;

    -- Apagando as disciplinas base do curso a ser deletado
    DELETE db
    FROM disciplinaBase as db
        INNER JOIN curso as c
        ON db.id_curso = c.id_curso
    WHERE c.nome = nomeCurso;

    -- Apagando os alunos matriculados no curso a ser deletado
    DELETE a
    FROM aluno as a
        INNER JOIN curso as c
        ON a.id_curso = c.id_curso
    WHERE c.nome = nomeCurso;

    -- Apagando os professores que lecionam nas diciplinas do curso a ser deletado
    DELETE p
    FROM professor as p
        INNER JOIN curso as c
        ON p.id_curso = c.id_curso
    WHERE c.nome = nomeCurso;

    -- Apagando os avisos globais do curso a ser deletado
    DELETE ag
    FROM avisoGlobal as ag
        INNER JOIN curso as c
        ON ag.id_curso = c.id_curso
    WHERE c.nome = nomeCurso;

    -- Apagando o curso em si
    DELETE FROM curso WHERE nome = nomeCurso;
END$$

-- Apagar DISCIPLINA BASE a partir de ID
CREATE DEFINER=`root`@`localhost` PROCEDURE deletaDiscBasePorID (idDiscBase int)
BEGIN

    -- Apagando as notas das avaliações da disciplina base a ser deletada
    DELETE n
    FROM nota as n
        INNER JOIN avaliacao as av
        ON n.id_aval = av.id_aval
            INNER JOIN aula as au
            ON av.id_aula = au.id_aula
                INNER JOIN disciplinaAnual as da
                ON au.id_discAnual = da.id_discAnual
                    INNER JOIN disciplinaBase as db
                    ON da.id_discBase = db.id_discBase
    WHERE db.id_discBase = idDiscBase;

    -- Apagando as avaliações da disciplina base a ser deletada
    DELETE av
    FROM avaliacao as av
        INNER JOIN aula as au
        ON av.id_aula = au.id_aula
            INNER JOIN disciplinaAnual as da
            ON au.id_discAnual = da.id_discAnual
                INNER JOIN disciplinaBase as db
                ON da.id_discBase = db.id_discBase
    WHERE db.id_discBase = idDiscBase;

    -- Apagando as frequências das aulas da disciplina base a ser deletada
    DELETE f
    FROM frequencia as f
        INNER JOIN aula as au
        ON f.id_aula = au.id_aula
            INNER JOIN disciplinaAnual as da
            ON au.id_discAnual = da.id_discAnual
                INNER JOIN disciplinaBase as db
                ON da.id_discBase = db.id_discBase
    WHERE db.id_discBase = idDiscBase;

    -- Apagando as aulas da disciplina base a ser deletada
    DELETE au
    FROM aula as au
        INNER JOIN disciplinaAnual as da
        ON au.id_discAnual = da.id_discAnual
            INNER JOIN disciplinaBase as db
            ON da.id_discBase = db.id_discBase
    WHERE db.id_discBase = idDiscBase;

    -- Apagando os avisos da disciplina base a ser deletada
    DELETE av
    FROM aviso as av
        INNER JOIN disciplinaAnual as da
        ON av.id_discAnual = da.id_discAnual
            INNER JOIN disciplinaBase as db
            ON da.id_discBase = db.id_discBase
    WHERE db.id_discBase = idDiscBase;

    -- Apagando as notas dos alunos matriculados na disciplina base a ser deletada
    DELETE n
    FROM nota as n
        INNER JOIN dados_aluno as dl
        ON n.id_dados = dl.id_dados
            INNER JOIN disciplinaAnual as da
            ON dl.id_discAnual = da.id_discAnual
                INNER JOIN disciplinaBase as db
                ON da.id_discBase = db.id_discBase
    WHERE db.id_discBase = idDiscBase;

    -- Apagando as frequências dos alunos matriculados na disciplina base a ser deletada
    DELETE f
    FROM frequencia as f
        INNER JOIN dados_aluno as dl
        ON f.id_dados = dl.id_dados
            INNER JOIN disciplinaAnual as da
            ON dl.id_discAnual = da.id_discAnual
                INNER JOIN disciplinaBase as db
                ON da.id_discBase = db.id_discBase
    WHERE db.id_discBase = idDiscBase;

    -- Apagando os dados dos alunos da disciplina base a ser deletada
    DELETE dl
    FROM dados_aluno as dl
        INNER JOIN disciplinaAnual as da
        ON dl.id_discAnual = da.id_discAnual
            INNER JOIN disciplinaBase as db
            ON da.id_discBase = db.id_discBase
    WHERE db.id_discBase = idDiscBase;

    -- Apagando as disciplinas anuais da disciplina base a ser deletada
    DELETE da
    FROM disciplinaAnual as da
        INNER JOIN disciplinaBase as db
        ON da.id_discBase = db.id_discBase
    WHERE db.id_discBase = idDiscBase;

    -- Apagando a disciplina base em si
    DELETE FROM disciplinaBase WHERE id_discBase = idDiscBase;
END$$

-- Apagar DISCIPLINA BASE a partir de nome e curso 
CREATE DEFINER=`root`@`localhost` PROCEDURE deletaDiscBasePorNome (nomeDiscBase VARCHAR(100), nomeCurso varchar(100))
BEGIN
    DECLARE IdDiscBase int;

    -- Adquirindo ID da disciplina base
    SELECT db.id_discBase INTO IdDiscBase 
        FROM disciplinaBase as db
            INNER JOIN curso as c
            ON db.id_curso = c.id_curso
        WHERE db.nome = nomeDiscBase AND c.nome = nomeCurso;

    -- Apagando as notas das avaliações da disciplina base a ser deletada
    DELETE n
    FROM nota as n
        INNER JOIN avaliacao as av
        ON n.id_aval = av.id_aval
            INNER JOIN aula as au
            ON av.id_aula = au.id_aula
                INNER JOIN disciplinaAnual as da
                ON au.id_discAnual = da.id_discAnual
                    INNER JOIN disciplinaBase as db
                    ON da.id_discBase = db.id_discBase
    WHERE db.id_discBase = IdDiscBase;

    -- Apagando as avaliações da disciplina base a ser deletada
    DELETE av
    FROM avaliacao as av
        INNER JOIN aula as au
        ON av.id_aula = au.id_aula
            INNER JOIN disciplinaAnual as da
            ON au.id_discAnual = da.id_discAnual
                INNER JOIN disciplinaBase as db
                ON da.id_discBase = db.id_discBase
    WHERE db.id_discBase = IdDiscBase;

    -- Apagando as frequências das aulas da disciplina base a ser deletada
    DELETE f
    FROM frequencia as f
        INNER JOIN aula as au
        ON f.id_aula = au.id_aula
            INNER JOIN disciplinaAnual as da
            ON au.id_discAnual = da.id_discAnual
                INNER JOIN disciplinaBase as db
                ON da.id_discBase = db.id_discBase
    WHERE db.id_discBase = IdDiscBase;

    -- Apagando as aulas da disciplina base a ser deletada
    DELETE au
    FROM aula as au
        INNER JOIN disciplinaAnual as da
        ON au.id_discAnual = da.id_discAnual
            INNER JOIN disciplinaBase as db
            ON da.id_discBase = db.id_discBase
    WHERE db.id_discBase = IdDiscBase;

    -- Apagando os avisos da disciplina base a ser deletada
    DELETE av
    FROM aviso as av
        INNER JOIN disciplinaAnual as da
        ON av.id_discAnual = da.id_discAnual
            INNER JOIN disciplinaBase as db
            ON da.id_discBase = db.id_discBase
    WHERE db.id_discBase = IdDiscBase;

    -- Apagando as notas dos alunos matriculados na disciplina base a ser deletada
    DELETE n
    FROM nota as n
        INNER JOIN dados_aluno as dl
        ON n.id_dados = dl.id_dados
            INNER JOIN disciplinaAnual as da
            ON dl.id_discAnual = da.id_discAnual
                INNER JOIN disciplinaBase as db
                ON da.id_discBase = db.id_discBase
    WHERE db.id_discBase = IdDiscBase;

    -- Apagando as frequências dos alunos matriculados na disciplina base a ser deletada
    DELETE f
    FROM frequencia as f
        INNER JOIN dados_aluno as dl
        ON f.id_dados = dl.id_dados
            INNER JOIN disciplinaAnual as da
            ON dl.id_discAnual = da.id_discAnual
                INNER JOIN disciplinaBase as db
                ON da.id_discBase = db.id_discBase
    WHERE db.id_discBase = IdDiscBase;

    -- Apagando os dados dos alunos da disciplina base a ser deletada
    DELETE dl
    FROM dados_aluno as dl
        INNER JOIN disciplinaAnual as da
        ON dl.id_discAnual = da.id_discAnual
            INNER JOIN disciplinaBase as db
            ON da.id_discBase = db.id_discBase
    WHERE db.id_discBase = IdDiscBase;

    -- Apagando as disciplinas anuais da disciplina base a ser deletada
    DELETE da
    FROM disciplinaAnual as da
        INNER JOIN disciplinaBase as db
        ON da.id_discBase = db.id_discBase
    WHERE db.id_discBase = IdDiscBase;

    -- Apagando a disciplina base em si
    DELETE FROM disciplinaBase WHERE id_discBase = IdDiscBase;
END$$

-- Apagar DISCIPLINA ANUAL ATIVA a partir de nome
CREATE DEFINER=`root`@`localhost` PROCEDURE deletaDiscAnualAtivaPorNome (nomeDiscBase VARCHAR(100), nomeCurso varchar(100), nomeProf varchar(100))
BEGIN
    DECLARE IdDiscAnual int;

    -- Adquirindo ID da disciplina anual
    SELECT da.id_discAnual INTO IdDiscAnual 
        FROM disciplinaAnual as da
            INNER JOIN disciplinaBase as db
            ON da.id_discBase = db.id_discBase
                INNER JOIN curso as c
                ON db.id_curso = c.id_curso
            INNER JOIN professor as pr
            ON da.id_prof = pr.id_prof
        WHERE db.nome = nomeDiscBase AND c.nome = nomeCurso AND pr.nome = nomeProf AND da.ativa = 1;
        
    -- Apagando as notas das avaliações da disciplina anual a ser deletada
    DELETE n
    FROM nota as n
        INNER JOIN avaliacao as av
        ON n.id_aval = av.id_aval
            INNER JOIN aula as au
            ON av.id_aula = au.id_aula
                INNER JOIN disciplinaAnual as da
                ON au.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual AND da.ativa = 1;

    -- Apagando as avaliações da disciplina anual a ser deletada
    DELETE av
    FROM avaliacao as av
        INNER JOIN aula as au
        ON av.id_aula = au.id_aula
            INNER JOIN disciplinaAnual as da
            ON au.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual AND da.ativa = 1;

    -- Apagando as frequências das aulas da disciplina anual a ser deletada
    DELETE f
    FROM frequencia as f
        INNER JOIN aula as au
        ON f.id_aula = au.id_aula
            INNER JOIN disciplinaAnual as da
            ON au.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual AND da.ativa = 1;

    -- Apagando as aulas da disciplina anual a ser deletada
    DELETE au
    FROM aula as au
        INNER JOIN disciplinaAnual as da
        ON au.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual AND da.ativa = 1;

    -- Apagando os avisos da disciplina anual a ser deletada
    DELETE av
    FROM aviso as av
        INNER JOIN disciplinaAnual as da
        ON av.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual AND da.ativa = 1;

    -- Apagando as notas dos alunos matriculados na disciplina anual a ser deletada
    DELETE n
    FROM nota as n
        INNER JOIN dados_aluno as dl
        ON n.id_dados = dl.id_dados
            INNER JOIN disciplinaAnual as da
            ON dl.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual AND da.ativa = 1;

    -- Apagando as frequências dos alunos matriculados na disciplina anual a ser deletada
    DELETE f
    FROM frequencia as f
        INNER JOIN dados_aluno as dl
        ON f.id_dados = dl.id_dados
            INNER JOIN disciplinaAnual as da
            ON dl.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual AND da.ativa = 1;

    -- Apagando os dados dos alunos da disciplina anual a ser deletada
    DELETE dl
    FROM dados_aluno as dl
        INNER JOIN disciplinaAnual as da
        ON dl.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual AND da.ativa = 1;

    -- Apagando a disciplina anual em si
    DELETE FROM disciplinaAnual WHERE id_discAnual = IdDiscAnual AND ativa = 1;
END$$

-- Apagar DISCIPLINA ANUAL ATIVA a partir de nome
CREATE DEFINER=`root`@`localhost` PROCEDURE deletaDiscAnualAtivaPorID (idDiscAnual int)
BEGIN
    DECLARE IdDiscAnual int;
        
    -- Apagando as notas das avaliações da disciplina anual a ser deletada
    DELETE n
    FROM nota as n
        INNER JOIN avaliacao as av
        ON n.id_aval = av.id_aval
            INNER JOIN aula as au
            ON av.id_aula = au.id_aula
                INNER JOIN disciplinaAnual as da
                ON au.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual AND da.ativa = 1;

    -- Apagando as avaliações da disciplina anual a ser deletada
    DELETE av
    FROM avaliacao as av
        INNER JOIN aula as au
        ON av.id_aula = au.id_aula
            INNER JOIN disciplinaAnual as da
            ON au.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual AND da.ativa = 1;

    -- Apagando as frequências das aulas da disciplina anual a ser deletada
    DELETE f
    FROM frequencia as f
        INNER JOIN aula as au
        ON f.id_aula = au.id_aula
            INNER JOIN disciplinaAnual as da
            ON au.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual AND da.ativa = 1;

    -- Apagando as aulas da disciplina anual a ser deletada
    DELETE au
    FROM aula as au
        INNER JOIN disciplinaAnual as da
        ON au.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual AND da.ativa = 1;

    -- Apagando os avisos da disciplina anual a ser deletada
    DELETE av
    FROM aviso as av
        INNER JOIN disciplinaAnual as da
        ON av.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual AND da.ativa = 1;

    -- Apagando as notas dos alunos matriculados na disciplina anual a ser deletada
    DELETE n
    FROM nota as n
        INNER JOIN dados_aluno as dl
        ON n.id_dados = dl.id_dados
            INNER JOIN disciplinaAnual as da
            ON dl.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual AND da.ativa = 1;

    -- Apagando as frequências dos alunos matriculados na disciplina anual a ser deletada
    DELETE f
    FROM frequencia as f
        INNER JOIN dados_aluno as dl
        ON f.id_dados = dl.id_dados
            INNER JOIN disciplinaAnual as da
            ON dl.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual AND da.ativa = 1;

    -- Apagando os dados dos alunos da disciplina anual a ser deletada
    DELETE dl
    FROM dados_aluno as dl
        INNER JOIN disciplinaAnual as da
        ON dl.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual AND da.ativa = 1;

    -- Apagando a disciplina anual em si
    DELETE FROM disciplinaAnual WHERE id_discAnual = IdDiscAnual AND ativa = 1;
END$$

-- Apagar DISCIPLINA ANUAL a partir de nome
CREATE DEFINER=`root`@`localhost` PROCEDURE deletaDiscAnualPorID (IdDiscAnual int)
BEGIN
        
    -- Apagando as notas das avaliações da disciplina anual a ser deletada
    DELETE n
    FROM nota as n
        INNER JOIN avaliacao as av
        ON n.id_aval = av.id_aval
            INNER JOIN aula as au
            ON av.id_aula = au.id_aula
                INNER JOIN disciplinaAnual as da
                ON au.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual;

    -- Apagando as avaliações da disciplina anual a ser deletada
    DELETE av
    FROM avaliacao as av
        INNER JOIN aula as au
        ON av.id_aula = au.id_aula
            INNER JOIN disciplinaAnual as da
            ON au.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual;

    -- Apagando as frequências das aulas da disciplina anual a ser deletada
    DELETE f
    FROM frequencia as f
        INNER JOIN aula as au
        ON f.id_aula = au.id_aula
            INNER JOIN disciplinaAnual as da
            ON au.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual;

    -- Apagando as aulas da disciplina anual a ser deletada
    DELETE au
    FROM aula as au
        INNER JOIN disciplinaAnual as da
        ON au.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual;

    -- Apagando os avisos da disciplina anual a ser deletada
    DELETE av
    FROM aviso as av
        INNER JOIN disciplinaAnual as da
        ON av.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual;

    -- Apagando as notas dos alunos matriculados na disciplina anual a ser deletada
    DELETE n
    FROM nota as n
        INNER JOIN dados_aluno as dl
        ON n.id_dados = dl.id_dados
            INNER JOIN disciplinaAnual as da
            ON dl.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual;

    -- Apagando as frequências dos alunos matriculados na disciplina anual a ser deletada
    DELETE f
    FROM frequencia as f
        INNER JOIN dados_aluno as dl
        ON f.id_dados = dl.id_dados
            INNER JOIN disciplinaAnual as da
            ON dl.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual;

    -- Apagando os dados dos alunos da disciplina anual a ser deletada
    DELETE dl
    FROM dados_aluno as dl
        INNER JOIN disciplinaAnual as da
        ON dl.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual;

    -- Apagando a disciplina anual em si
    DELETE FROM disciplinaAnual WHERE id_discAnual = IdDiscAnual;
END$$

-- Apagar DISCIPLINA ANUAL a partir de nome
CREATE DEFINER=`root`@`localhost` PROCEDURE deletaDiscAnualPorNome (nomeDiscBase VARCHAR(100), nomeCurso varchar(100), nomeProf VARCHAR(100), anoLecionada int)
BEGIN
    DECLARE IdDiscAnual int;

    CALL atualizar_ano();

    -- Adquirindo ID da disciplina anual
    SELECT da.id_discAnual INTO IdDiscAnual 
        FROM disciplinaAnual as da
            INNER JOIN disciplinaBase as db
            ON da.id_discBase = db.id_discBase
                INNER JOIN curso as c
                ON db.id_curso = c.id_curso
            INNER JOIN professor as pr
            ON da.id_prof = pr.id_prof
            INNER JOIN ano as an
            ON da.id_ano = an.id_ano
        WHERE db.nome = nomeDiscBase AND c.nome = nomeCurso AND pr.nome = nomeProf AND an.num = anoLecionada;
        
    -- Apagando as notas das avaliações da disciplina anual a ser deletada
    DELETE n
    FROM nota as n
        INNER JOIN avaliacao as av
        ON n.id_aval = av.id_aval
            INNER JOIN aula as au
            ON av.id_aula = au.id_aula
                INNER JOIN disciplinaAnual as da
                ON au.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual;

    -- Apagando as avaliações da disciplina anual a ser deletada
    DELETE av
    FROM avaliacao as av
        INNER JOIN aula as au
        ON av.id_aula = au.id_aula
            INNER JOIN disciplinaAnual as da
            ON au.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual;

    -- Apagando as frequências das aulas da disciplina anual a ser deletada
    DELETE f
    FROM frequencia as f
        INNER JOIN aula as au
        ON f.id_aula = au.id_aula
            INNER JOIN disciplinaAnual as da
            ON au.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual;

    -- Apagando as aulas da disciplina anual a ser deletada
    DELETE au
    FROM aula as au
        INNER JOIN disciplinaAnual as da
        ON au.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual;

    -- Apagando os avisos da disciplina anual a ser deletada
    DELETE av
    FROM aviso as av
        INNER JOIN disciplinaAnual as da
        ON av.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual;

    -- Apagando as notas dos alunos matriculados na disciplina anual a ser deletada
    DELETE n
    FROM nota as n
        INNER JOIN dados_aluno as dl
        ON n.id_dados = dl.id_dados
            INNER JOIN disciplinaAnual as da
            ON dl.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual;

    -- Apagando as frequências dos alunos matriculados na disciplina anual a ser deletada
    DELETE f
    FROM frequencia as f
        INNER JOIN dados_aluno as dl
        ON f.id_dados = dl.id_dados
            INNER JOIN disciplinaAnual as da
            ON dl.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual;

    -- Apagando os dados dos alunos da disciplina anual a ser deletada
    DELETE dl
    FROM dados_aluno as dl
        INNER JOIN disciplinaAnual as da
        ON dl.id_discAnual = da.id_discAnual
    WHERE da.id_discAnual = IdDiscAnual;

    -- Apagando a disciplina anual em si
    DELETE FROM disciplinaAnual WHERE id_discAnual = IdDiscAnual;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE deletaAvisoGlobalPorID (id int)
BEGIN
    DELETE FROM avisoGlobal WHERE id_avisoGlobal = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE deletaAvisoPorID (id int)
BEGIN
    DELETE FROM aviso WHERE id_aviso = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE deletaDadosAlunoPorNomes (nomeCurso VARCHAR(100), nomeDiscBase VARCHAR(100), nomeProf VARCHAR(100), nomeAluno VARCHAR(100), anoLecionada int)
BEGIN
    DECLARE IdDados int;

    CALL atualizar_ano();

     -- Adquirindo ID do dados aluno
    SELECT dl.id_dados INTO IdDados 
        FROM dados_aluno as dl
            INNER JOIN disciplinaAnual as da
            ON dl.id_discAnual = da.id_discAnual
                INNER JOIN disciplinaBase as db
                ON da.id_discBase = db.id_discBase
                    INNER JOIN curso as c
                    ON db.id_curso = c.id_curso
                INNER JOIN professor as pr
                ON da.id_prof = pr.id_prof
                INNER JOIN ano as an
                ON da.id_ano = an.id_ano
            INNER JOIN aluno as al
            ON dl.id_aluno = al.id_aluno
        WHERE db.nome = nomeDiscBase AND c.nome = nomeCurso AND pr.nome = nomeProf AND al.nome = nomeAluno AND an.num = anoLecionada;

    -- Destroindo as notas de dados aluno
    DELETE FROM nota WHERE id_dados = IdDados;

    -- Destroindo as frequencias de dados aluno
    DELETE FROM frequencia WHERE id_dados = IdDados;

    -- Deletando dados alunos em si
    DELETE FROM dados_aluno WHERE id_dados = IdDados;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE deletaDadosAlunoPorID (IdDados int)
BEGIN
    -- Destroindo as notas de dados aluno
    DELETE FROM nota WHERE id_dados = IdDados;

    -- Destroindo as frequencias de dados aluno
    DELETE FROM frequencia WHERE id_dados = IdDados;

    -- Deletando dados alunos em si
    DELETE FROM dados_aluno WHERE id_dados = IdDados;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE deletaAlunoPorNome (nomeAluno VARCHAR(100))
BEGIN
    DECLARE IdAluno int;

    -- Adquirindo ID de aluno
    SELECT id_aluno INTO IdAluno FROM aluno WHERE nome = nomeAluno;

    -- Destroindo as notas de aluno
    DELETE n 
        FROM nota as n
            INNER JOIN dados_aluno as dl
            ON n.id_dados = dl.id_dados
        WHERE dl.id_aluno = IdAluno;

    -- Destroindo as frequencias de aluno
    DELETE fq 
        FROM frequencia as fq
            INNER JOIN dados_aluno as dl
            ON fq.id_dados = dl.id_dados
        WHERE dl.id_aluno = IdAluno;

    -- Deletando os dados do aluno
    DELETE FROM dados_aluno WHERE id_aluno = IdAluno;

    -- Deletando o aluno em si
    DELETE FROM aluno WHERE id_aluno = IdAluno;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE deletaFrequeciaPorID (id int)
BEGIN
    DELETE FROM frequencia WHERE id_freq = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE deletaNotaPorID (id int)
BEGIN
    DELETE FROM nota WHERE id_nota = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE deletaAvaliacaoPorID (id int)
BEGIN
    -- Deletando as notas das avalições
    DELETE FROM nota WHERE id_aval = id;

    -- Deletando as avaliações em si
    DELETE FROM avaliacao WHERE id_aval = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE deletaAulaPorID (id int)
BEGIN
    -- Deletando as notas das avalições das aulas
    DELETE n 
        FROM nota as n
            INNER JOIN avaliacao as av
            ON n.id_aval = av.id_aval
        WHERE av.id_aula = id;

    -- Deletando as avaliações das aulas
    DELETE FROM avaliacao WHERE id_aula = id;

    -- Deletando as aulas em si
    DELETE FROM aula WHERE id_aula = id;
END$$

-- Apagar DISCIPLINA ANUAL a partir de nome
CREATE DEFINER=`root`@`localhost` PROCEDURE deletaProfPorNome (nomeProf VARCHAR(100))
BEGIN
    DECLARE IdProf int;

    -- Adquirindo ID de Professor
    SELECT id_prof INTO IdProf FROM professor WHERE nome = nomeProf;
        
    -- Apagando as notas das avaliações do professor a ser deletado
    DELETE n
    FROM nota as n
        INNER JOIN avaliacao as av
        ON n.id_aval = av.id_aval
            INNER JOIN aula as au
            ON av.id_aula = au.id_aula
                INNER JOIN disciplinaAnual as da
                ON au.id_discAnual = da.id_discAnual
    WHERE da.id_prof = IdProf;

    -- Apagando as avaliações do professor a ser deletado
    DELETE av
    FROM avaliacao as av
        INNER JOIN aula as au
        ON av.id_aula = au.id_aula
            INNER JOIN disciplinaAnual as da
            ON au.id_discAnual = da.id_discAnual
    WHERE da.id_prof = IdProf;

    -- Apagando as frequências das aulas do professor a ser deletado
    DELETE f
    FROM frequencia as f
        INNER JOIN aula as au
        ON f.id_aula = au.id_aula
            INNER JOIN disciplinaAnual as da
            ON au.id_discAnual = da.id_discAnual
    WHERE da.id_prof = IdProf;

    -- Apagando as aulas do professor a ser deletado
    DELETE au
    FROM aula as au
        INNER JOIN disciplinaAnual as da
        ON au.id_discAnual = da.id_discAnual
    WHERE da.id_prof = IdProf;

    -- Apagando os avisos do professor a ser deletado
    DELETE av
    FROM aviso as av
        INNER JOIN disciplinaAnual as da
        ON av.id_discAnual = da.id_discAnual
    WHERE da.id_prof = IdProf;

    -- Apagando as notas dos alunos matriculados na disciplina que o professor a ser deletado ministra
    DELETE n
    FROM nota as n
        INNER JOIN dados_aluno as dl
        ON n.id_dados = dl.id_dados
            INNER JOIN disciplinaAnual as da
            ON dl.id_discAnual = da.id_discAnual
    WHERE da.id_prof = IdProf;

    -- Apagando as frequências dos alunos matriculados na disciplina que o professor a ser deletado ministra
    DELETE f
    FROM frequencia as f
        INNER JOIN dados_aluno as dl
        ON f.id_dados = dl.id_dados
            INNER JOIN disciplinaAnual as da
            ON dl.id_discAnual = da.id_discAnual
    WHERE da.id_prof = IdProf;

    -- Apagando os dados dos alunos da disciplina que o professor a ser deletado ministra
    DELETE dl
    FROM dados_aluno as dl
        INNER JOIN disciplinaAnual as da
        ON dl.id_discAnual = da.id_discAnual
    WHERE da.id_prof = IdProf;

    -- Apagando as disciplinas que o professor ministra/ministrou
    DELETE FROM disciplinaAnual WHERE id_prof = IdProf;

    -- Apagando o professor em si
    DELETE FROM professor WHERE id_prof = IdProf;
END$$

-- SOLICITAÇÕES

-- SOLICITANDO o PEDIDO DE TRANCAMENTO de um aluno em uma disciplina a partir de nomes
CREATE DEFINER=`root`@`localhost` PROCEDURE solicitacaoDeTrancamentoPorNomes (nomeProf VARCHAR(100), nomeDisc varchar(100), anoDado int, nomeCurso varchar(100), nomeAluno varchar(100))
BEGIN
    declare idDiscAnual int;
    declare idAluno int;
    declare idSitu int;

    CALL atualizar_ano();

    -- Obtendo ID de disciplina anual
    SELECT id_discAnual into idDiscAnual 
        FROM disciplinaAnual as da
            INNER JOIN disciplinaBase as db
            ON db.id_discBase = da.id_discBase
                INNER JOIN curso as c
                ON db.id_curso = c.id_curso
            INNER JOIN professor as prof
            ON da.id_prof = prof.id_prof
            INNER JOIN ano as an
            ON da.id_ano = an.id_ano
        WHERE (prof.nome = nomeProf) and (db.nome = nomeDisc) and (an.num = anoDado) AND (c.nome = nomeCurso);

    -- Obtendo ID do aluno
    SELECT id_aluno INTO idAluno FROM aluno WHERE nome = nomeAluno;

    -- Obtendo o ID da situação "Pedido de Trancamento"
    SELECT id_sit INTO idSitu FROM situacao_aluno WHERE situacao_ = 'Pedido de Trancamento';

    -- Atualizando o Status do aluno na disciplina para "Pedido de Trancamento"
    IF (idDiscAnual IS NOT NULL) AND (idAluno IS NOT NULL) AND (idSitu IS NOT NULL) THEN
        UPDATE dados_aluno SET id_sit = idSitu WHERE id_aluno = idAluno AND id_discAnual = idDiscAnual;
    END IF;
END$$

-- SOLICITANDO o PEDIDO DE TRANCAMENTO de um aluno em uma disciplina a partir de ID
CREATE DEFINER=`root`@`localhost` PROCEDURE solicitacaoDeTrancamentoPorID (idDiscAnual int, nomeAluno varchar(100))
BEGIN
    declare idAluno int;
    declare idSitu int;

    CALL atualizar_ano();

    -- Obtendo ID do aluno
    SELECT id_aluno INTO idAluno FROM aluno WHERE nome = nomeAluno;

    -- Obtendo o ID da situação "Pedido de Trancamento"
    SELECT id_sit INTO idSitu FROM situacao_aluno WHERE situacao_ = 'Pedido de Trancamento';

    -- Atualizando o Status do aluno na disciplina para "Pedido de Trancamento"
    IF (idDiscAnual IS NOT NULL) AND (idAluno IS NOT NULL) AND (idSitu IS NOT NULL) THEN
        UPDATE dados_aluno SET id_sit = idSitu WHERE id_aluno = idAluno AND id_discAnual = idDiscAnual;
    END IF;
END$$

-- LISTAR QUANTIDADES

CREATE DEFINER=`root`@`localhost` PROCEDURE listarQuantPessoas (OUT quantCursos tinyint, OUT quantDiscs tinyint, OUT quantFuncs tinyint, OUT quantAlunos tinyint)
BEGIN
    -- Quant Cursos
    SELECT COUNT(id_curso) INTO quantCursos FROM curso;

    -- Quant Disciplinas
    SELECT COUNT(id_discBase) INTO quantDiscs FROM disciplinaBase;

    -- Quant Funcionários
    SELECT (COUNT(id_prof) + (SELECT COUNT(id_adm) FROM administrador)) INTO quantFuncs FROM professor;

    -- Quant Alunos
    SELECT COUNT(id_aluno) INTO quantAlunos FROM aluno;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE listarQuantDiscCoord (nomeCoord varchar(100), OUT quantDiscBase tinyint, OUT quantAlunoCurso tinyint, OUT quantProfCurso tinyint)
BEGIN
    DECLARE idCurso int DEFAULT 0;

    SET quantDiscBase = 0;
    SET quantAlunoCurso = 0;
    SET quantProfCurso = 0;

    -- Adquirindo o ID do curso
    SELECT id_curso INTO idCurso FROM professor WHERE nome = nomeCoord;

    IF idCurso != 0 THEN
        -- Total de disciplinas base no curso daquele coordenador
        SELECT COUNT(id_discBase) INTO quantDiscBase FROM disciplinaBase WHERE id_curso = idCurso;

        -- Total de alunos nas disciplinas daquele curso (ativas)
        SELECT COUNT(al.id_aluno) INTO quantAlunoCurso 
            FROM aluno as al
                INNER JOIN dados_aluno as da
                ON al.id_aluno = da.id_aluno
                    INNER JOIN disciplinaAnual as dl
                    ON da.id_discAnual = dl.id_discAnual
                        INNER JOIN disciplinaBase as db
                        ON dl.id_discBase = db.id_discBase
            WHERE db.id_curso = idCurso AND dl.ativa = 1;

        -- Total de professores nas disciplinas daquele curso (ativas)
        SELECT COUNT(pr.id_prof) INTO quantProfCurso 
            FROM professor as pr
                INNER JOIN disciplinaAnual as dl
                ON pr.id_prof = dl.id_prof
                    INNER JOIN disciplinaBase as db
                    ON dl.id_discBase = db.id_discBase
            WHERE db.id_curso = idCurso AND dl.ativa = 1;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE listarQuantDiscProf (nomeProf varchar(100), OUT quantAlunoDisc tinyint, OUT quantDiscAtiva tinyint, OUT quantDiscCurso tinyint)
BEGIN
    DECLARE idProf int DEFAULT 0;

    SET quantAlunoDisc = 0;
    SET quantDiscAtiva = 0;
    SET quantDiscCurso = 0;

    -- Adquirindo o ID de professor
    SELECT id_prof INTO idProf FROM professor WHERE nome = nomeProf;

    IF idProf != 0 THEN
        -- Total de alunos em suas disciplinas (ativas)
        SELECT COUNT(al.id_aluno) INTO quantAlunoDisc 
            FROM aluno as al
                INNER JOIN dados_aluno as da
                ON al.id_aluno = da.id_aluno
                    INNER JOIN disciplinaAnual as dl
                    ON da.id_discAnual = dl.id_discAnual
            WHERE dl.id_prof = idProf AND dl.ativa = 1;

        -- Total de disciplinas que esta dando (ativas)
        SELECT COUNT(dl.id_discAnual) INTO quantDiscAtiva 
            FROM disciplinaAnual as dl
            WHERE dl.id_prof = idProf AND dl.ativa = 1;

        -- Quantidade de disciplinas que ele já deu desde que entrou na faculdade (ativas + inativas)
        SELECT COUNT(dl.id_discAnual) INTO quantDiscCurso 
            FROM disciplinaAnual as dl
            WHERE dl.id_prof = idProf;
    END IF;
END$$

DELIMITER ;