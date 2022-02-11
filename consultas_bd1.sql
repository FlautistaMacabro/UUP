-- Consulta 1
select a.nome as 'Nome', a.descricao as 'Descrição', a.dataHora as 'Data e Hora'
    from aviso as a
        inner join disciplina as d
        on  a.id_disc = d.id_disc
            inner join ano as an
            on  d.id_ano = an.id_ano
    where d.nome = 'Engenharia de Software' and an.num = 2021;

-- Consulta 2
select av.nome as 'Avaliação', au.dataAula as 'Data', ha.hora as 'Hora', d.nome as 'Disciplina'
    from avaliacao as av
        inner join aula as au
        on av.id_aula = au.id_aula
            inner join hora_aula as ha
            on au.id_hora = ha.id_hora
            inner join disciplina as d
            on au.id_disc = d.id_disc
    where MONTH(au.dataAula) >= 7 AND YEAR(au.dataAula) = 2021;

-- Consulta 3
select al.ra as 'RA', al.nome as 'Nome', al.email as 'Email'
    from aluno as al 
        inner join dados_aluno as da
        on al.id_aluno = da.id_aluno
            inner join situacao_aluno as sa
            on da.id_sit = sa.id_sit
            inner join disciplina as d
            on da.id_disc = d.id_disc
                inner join ano as an
                on  d.id_ano = an.id_ano
    where sa.situacao_ = 'Aprovado' and 
        d.nome = 'Sistemas Operacionais 1' and 
        an.num = 2020;

-- Consulta 4
select p.cpf as 'CPF', p.nome as 'Nome', p.cargaHoraria as 'Carga Horária', p.email as 'Email'
    from professor as p
        inner join disciplina as d
        on p.id_prof = d.id_prof
            inner join ano as an
            on d.id_ano = an.id_ano
    where an.num != 2021 and d.semestre != 1;

-- Consulta 5
select d.nome as 'Disciplina', p.nome as 'Docente', av.nome as 'Avaliação', n.nota as 'Nota',
    da.freqFinal as 'Frequência', d.quantAulasDadas as 'Aulas Dadas', d.quantAulasDadas as 'Aulas Previstas'
    from disciplina as d
        inner join ano as an
        on  d.id_ano = an.id_ano
        inner join professor as p
        on d.id_prof = p.id_prof
        inner join dados_aluno as da
        on d.id_disc = da.id_disc
            inner join aluno as al
            on da.id_aluno = al.id_aluno
            inner join nota as n
            on da.id_dados = n.id_dados
                inner join avaliacao as av
                on n.id_aval = av.id_aval
    where al.nome = 'Julio' and an.num = 2021 and d.semestre = 1;

SELECT SUM(nota)/COUNT(id_nota) as MediaFinal FROM nota WHERE id_dados = 1;

