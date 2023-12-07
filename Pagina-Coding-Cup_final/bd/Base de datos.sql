create database ccup;
use ccup;

create table concursos(
id int auto_increment primary key,
nombre varchar(50) not null,
fechaInicio date,
fechaLimite date,
estatus varchar(20)
);

CREATE TABLE usuariosAuxiliar(
	id int auto_increment primary key,
    nombre varchar(50) not null,
    apellido1 varchar(50) not null,
    apellido2 varchar(50),
    email varchar(100) not null unique,
    tipo varchar(100) not null,
    password varchar(60) null
);

CREATE TABLE couch(
    id int auto_increment primary key,
    nombreCompleto varchar(150) not null,
    username varchar(150) not null,
    pass varchar(60) null,
    institucion varchar(150) not null
);

create table equipos(
id int auto_increment primary key,
nombre varchar(50) not null,
integrante1 varchar (70) not null,
integrante2 varchar (70) not null,
integrante3 varchar (70) not null,
coach varchar (70),
estatus varchar(20) not null,
institucion varchar(70) not null,
id_couch int not null,
foreign key (id_couch) references couch(id));