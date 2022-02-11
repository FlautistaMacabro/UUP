CREATE DATABASE universidade;

USE universidade;

create table semestre (
    id_sem int not null AUTO_INCREMENT,
    num int not null,
    aberto tinyint not null,
    primary key (id_sem)
);

create table ano (
    id_ano int not null AUTO_INCREMENT,
    num int not null,
    primary key (id_ano)
);

create table administrador (
    id_adm int not null AUTO_INCREMENT,
    salario FLOAT not null,
    cargaHoraria int not null,
    email VARCHAR(100) not null UNIQUE,
    senha VARCHAR(80) not null,
    nome VARCHAR(100) not null UNIQUE,
    cpf CHAR(11) not null UNIQUE,
    rg VARCHAR(15) not null UNIQUE,
    data_nasc date not null,
    primary key (id_adm)
);

create table curso (
    id_curso int not null AUTO_INCREMENT,
    nome VARCHAR(100) not null UNIQUE,
    tipo tinyint not null, -- 0: Bacharelado, 1: Licenciatura, 2: Tecnólogo
    minAnos tinyint not null,
    maxAnos tinyint not null,
    id_adm int not null,
    primary key (id_curso),
    FOREIGN key (id_adm) REFERENCES administrador (id_adm)
);

create table aluno (
    id_aluno int not null AUTO_INCREMENT,
    ra CHAR(6) not null UNIQUE,
    email VARCHAR(100) not null UNIQUE,
    senha VARCHAR(80) not null,
    nome VARCHAR(100) not null UNIQUE,
    cpf CHAR(11) not null UNIQUE,
    rg VARCHAR(15) not null UNIQUE,
    data_nasc date not null,
    id_sem int not null,
    id_ano int not null,
    id_curso int not null,
    primary key (id_aluno),
    FOREIGN key (id_sem) REFERENCES semestre (id_sem),
    FOREIGN key (id_ano) REFERENCES ano (id_ano),
    FOREIGN key (id_curso) REFERENCES curso (id_curso)
);

create table professor (
    id_prof int not null AUTO_INCREMENT,
    salario FLOAT not null,
    cargaHoraria int not null,
    email VARCHAR(100) not null UNIQUE,
    senha VARCHAR(80) not null,
    id_curso INT,
    nome VARCHAR(100) not null UNIQUE,
    cpf CHAR(11) not null UNIQUE,
    rg VARCHAR(15) not null UNIQUE,
    data_nasc date not null,
    primary key (id_prof),
    FOREIGN key (id_curso) REFERENCES curso (id_curso)
);

create table disciplinaBase (
    id_discBase int not null AUTO_INCREMENT,
    nome VARCHAR(100) not null,
    cargaHoraria int not null,
    quantAulasPrev int not null,
    anoMinimo int not null,
    id_sem int not null,
    id_curso int not null, 
    primary key (id_discBase),
    FOREIGN key (id_sem) REFERENCES semestre (id_sem),
    FOREIGN key (id_curso) REFERENCES curso (id_curso)
);

create table rematricula (
    id_remat int not null AUTO_INCREMENT,
    aberta TINYINT not null,
    id_sem int not null, 
    primary key (id_remat),
    FOREIGN key (id_sem) REFERENCES semestre (id_sem)
);

create table disciplinaAnual (
    id_discAnual int not null AUTO_INCREMENT,
    quantAulasDadas int,
    ativa TINYINT NOT NULL,
    id_prof int not null,
    id_ano int not null,
    id_discBase int not null,
    id_remat int not null,
    primary key (id_discAnual),
    FOREIGN key (id_prof) REFERENCES professor (id_prof),
    FOREIGN key (id_ano) REFERENCES ano (id_ano),
    FOREIGN key (id_discBase) REFERENCES disciplinaBase (id_discBase)
);

create table aviso (
    id_aviso int not null AUTO_INCREMENT,
    nome VARCHAR(100) not null,
    descricao VARCHAR(1000) not null,
    dataHora DATETIME not null,
    id_discAnual int not null,
    primary key (id_aviso),
    FOREIGN key (id_discAnual) REFERENCES disciplinaAnual (id_discAnual)
);

create table avisoGlobal (
    id_avisoGlobal int not null AUTO_INCREMENT,
    nome VARCHAR(100) not null,
    descricao VARCHAR(1000) not null,
    dataHora DATETIME not null,
    id_curso int not null,
    primary key (id_avisoGlobal),
    FOREIGN key (id_curso) REFERENCES curso (id_curso)
);

create table situacao_aluno (
    id_sit int not null AUTO_INCREMENT,
    situacao_ varchar(50) not null UNIQUE,
    primary key (id_sit)
);

create table dados_aluno (
    id_dados int not null AUTO_INCREMENT,
    mediaFinal FLOAT,
    freqFinal FLOAT,
    id_aluno int not null,
    id_sit int not null,
    id_discAnual int not null,
    primary key (id_dados),
    FOREIGN key (id_aluno) REFERENCES aluno (id_aluno),
    FOREIGN key (id_sit) REFERENCES situacao_aluno (id_sit),
    FOREIGN key (id_discAnual) REFERENCES disciplinaAnual (id_discAnual)
);

create table hora_aula (
    id_hora int not null AUTO_INCREMENT,
    hora time not null UNIQUE,
    primary key (id_hora)
);

create table aula (
    id_aula int not null AUTO_INCREMENT,
    nome VARCHAR(100) not null,
    descricao VARCHAR(1000),
    dataAula date not null,
    id_hora int not null,
    id_discAnual int not null,
    primary key (id_aula),
    FOREIGN key (id_hora) REFERENCES hora_aula (id_hora),
    FOREIGN key (id_discAnual) REFERENCES disciplinaAnual (id_discAnual)
);

create table avaliacao (
    id_aval int not null AUTO_INCREMENT,
    nome VARCHAR(100) not null,
    id_aula int not null,
    primary key (id_aval),
    FOREIGN key (id_aula) REFERENCES aula (id_aula)
);

create table nota (
    id_nota int not null AUTO_INCREMENT,
    nota FLOAT not null,
    id_aval int not null,
    id_dados int not null,
    primary key (id_nota),
    FOREIGN key (id_aval) REFERENCES avaliacao (id_aval),
    FOREIGN key (id_dados) REFERENCES dados_aluno (id_dados)
);

create table frequencia (
    id_freq int not null AUTO_INCREMENT,
    id_dados int not null,
    id_aula int not null,
    faltou_ BOOLEAN not null,
    primary key (id_freq),
    FOREIGN key (id_dados) REFERENCES dados_aluno (id_dados),
    FOREIGN key (id_aula) REFERENCES aula (id_aula)
);