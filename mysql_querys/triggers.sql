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