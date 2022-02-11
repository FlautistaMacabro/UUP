-- Deletar todo o banco
DROP DATABASE universidade;

-- Deletar todos os TRIGGERS do banco
DROP TRIGGER IF EXISTS `atualizaFreq_Insert`;
DROP TRIGGER IF EXISTS `atualizaFreq_Update`;
DROP TRIGGER IF EXISTS `atualizaMedFinal_Insert`;
DROP TRIGGER IF EXISTS `atualizaMedFinal_Update`;

-- Deletar todas as FUNCTIONS e PROCEDURES do banco
DROP FUNCTION IF EXISTS `abrirSemestre`;
DROP FUNCTION IF EXISTS `abrirRematricula`;
DROP FUNCTION IF EXISTS `fecharSemestre`;
DROP FUNCTION IF EXISTS `fecharDiscAnualPorAno_Prof_NomeDisc`;
DROP FUNCTION IF EXISTS `fecharRematricula`;
DROP FUNCTION IF EXISTS `atualizarCargoCoord`;
DROP FUNCTION IF EXISTS `removerCargoCoord`;

DROP PROCEDURE IF EXISTS `ativarDiscAnualPorAno_Prof_Disc_Curso`;
DROP PROCEDURE IF EXISTS `atualizarAluno`;
DROP PROCEDURE IF EXISTS `atualizarAvaliacao`;
DROP PROCEDURE IF EXISTS `atualizarAvisoGlobal`;
DROP PROCEDURE IF EXISTS `atualizarCursoPorNome`;
DROP PROCEDURE IF EXISTS `atualizarDadosAlunoPorID`;
DROP PROCEDURE IF EXISTS `atualizarDadosAlunoPorNomes`;
DROP PROCEDURE IF EXISTS `atualizarDiscBasePorID`;
DROP PROCEDURE IF EXISTS `atualizarDiscBasePorNome`;
DROP PROCEDURE IF EXISTS `atualizarFrequenciaPorID`;
DROP PROCEDURE IF EXISTS `atualizarFrequenciaPorNomes`;
DROP PROCEDURE IF EXISTS `atualizarNota`;
DROP PROCEDURE IF EXISTS `atualizarSenhaAluno`;
DROP PROCEDURE IF EXISTS `atualizarSenhaProf`;
DROP PROCEDURE IF EXISTS `atualizar_ano`;
DROP PROCEDURE IF EXISTS `deletaAlunoPorNome`;
DROP PROCEDURE IF EXISTS `deletaAulaPorID`;
DROP PROCEDURE IF EXISTS `deletaAvaliacaoPorID`;
DROP PROCEDURE IF EXISTS `deletaAvisoGlobalPorID`;
DROP PROCEDURE IF EXISTS `deletaAvisoPorID`;
DROP PROCEDURE IF EXISTS `deletaCursoPorID`;
DROP PROCEDURE IF EXISTS `deletaCursoPorNome`;
DROP PROCEDURE IF EXISTS `deletaDadosAlunoPorID`;
DROP PROCEDURE IF EXISTS `deletaDadosAlunoPorNomes`;
DROP PROCEDURE IF EXISTS `deletaDiscAnualAtivaPorID`;
DROP PROCEDURE IF EXISTS `deletaDiscAnualAtivaPorNome`;
DROP PROCEDURE IF EXISTS `deletaDiscAnualPorID`;
DROP PROCEDURE IF EXISTS `deletaDiscAnualPorNome`;
DROP PROCEDURE IF EXISTS `deletaDiscBasePorID`;
DROP PROCEDURE IF EXISTS `deletaDiscBasePorNome`;
DROP PROCEDURE IF EXISTS `deletaFrequeciaPorID`;
DROP PROCEDURE IF EXISTS `deletaNotaPorID`;
DROP PROCEDURE IF EXISTS `deletaProfPorNome`;
DROP PROCEDURE IF EXISTS `listarQuantPessoas`;
DROP PROCEDURE IF EXISTS `solicitacaoDeTrancamentoPorID`;
DROP PROCEDURE IF EXISTS `solicitacaoDeTrancamentoPorNomes`;
DROP PROCEDURE IF EXISTS `sp_cadastro_aluno`;
DROP PROCEDURE IF EXISTS `sp_cadastro_aulaPorID`;
DROP PROCEDURE IF EXISTS `sp_cadastro_aulaPorNomes`;
DROP PROCEDURE IF EXISTS `sp_cadastro_avaliacao`;
DROP PROCEDURE IF EXISTS `sp_cadastro_avisoPorID`;
DROP PROCEDURE IF EXISTS `sp_cadastro_avisoPorNomes`;
DROP PROCEDURE IF EXISTS `sp_cadastro_aviso_global`;
DROP PROCEDURE IF EXISTS `sp_cadastro_curso`;
DROP PROCEDURE IF EXISTS `sp_cadastro_dadosAlunoPorID`;
DROP PROCEDURE IF EXISTS `sp_cadastro_dadosAlunoPorNomes`;
DROP PROCEDURE IF EXISTS `sp_cadastro_disciplina_anual`;
DROP PROCEDURE IF EXISTS `sp_cadastro_disciplina_base`;
DROP PROCEDURE IF EXISTS `sp_cadastro_frequenciaPorID`;
DROP PROCEDURE IF EXISTS `sp_cadastro_frequenciaPorNomes`;
DROP PROCEDURE IF EXISTS `sp_cadastro_notaPorID`;
DROP PROCEDURE IF EXISTS `sp_cadastro_notaPorNomes`;
DROP PROCEDURE IF EXISTS `sp_cadastro_professor`;
DROP PROCEDURE IF EXISTS `trocarProfDiscAnualPorIDs`;
DROP PROCEDURE IF EXISTS `trocarProfDiscAnualPorNomes`;
DROP PROCEDURE IF EXISTS `verificaLoginAluno`;
DROP PROCEDURE IF EXISTS `verificaLoginFuncionarios`;

-- Deletar todos os REGISTROS do banco
DELETE FROM frequencia;
DELETE FROM nota;
DELETE FROM avaliacao;
DELETE FROM aula;
DELETE FROM hora_aula;
DELETE FROM dados_aluno;
DELETE FROM situacao_aluno;
DELETE FROM avisoGlobal;
DELETE FROM aviso;
DELETE FROM disciplinaAnual;
DELETE FROM rematricula;
DELETE FROM disciplinaBase;
DELETE FROM professor;
DELETE FROM aluno;
DELETE FROM curso;
DELETE FROM administrador;
DELETE FROM ano;
DELETE FROM semestre;