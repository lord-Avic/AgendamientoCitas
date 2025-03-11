drop database PROYECTO;

Create DATABASE PROYECTO;

USE PROYECTO;

#tabla usuario------------------------------------------------------------------

create table usuario
(
cedulausuario bigint unsigned primary key,
nombres varchar(255) not null,
apellidos varchar(255) not null,
genero enum ( 'femenino','masculino') not null,
direccion varchar(255) not null,
correo varchar(255) not null,
nombreusuario varchar(255) not null,
contraseñausuario varchar(255) not null,
estadousuario enum('activo','inactivo') not null,
tarjetaprofesional varchar (255) null,
especialidad varchar(255) null,
rol enum ('Administrador','Doctor','Paciente') not null,
ocupacion varchar(255) null,
fechanacimiento date not null,
telefono bigint not null
);
#tabla agenda------------------------------------------------------------------

create table agenda
(
codigoagenda tinyint unsigned primary key auto_increment unique,
ceduladoctor bigint unsigned not null,
foreign key(ceduladoctor) references usuario(cedulausuario)
);

#tabla cita------------------------------------------------------------------

create table cita
(
id_cita tinyint unsigned primary key auto_increment,
codigo_agenda tinyint unsigned,
cedula_doctor_atiende bigint unsigned not null,
hora_atencion time not null,
fecha_atencion date not null,
valor mediumint unsigned not null,
consultorio tinyint unsigned not null,
motivo varchar(10000) not null,
cedula_paciente bigint unsigned not null,
Cedula_Admi Bigint Unsigned null,
foreign key(codigo_agenda) references agenda(codigoagenda),
foreign key(cedula_doctor_atiende) references usuario(cedulausuario),
Foreign Key(Cedula_Admi) References usuario(cedulausuario),
foreign key(cedula_paciente) references usuario(cedulausuario)
);

#tabla historiaclinica------------------------------------------------------------------

create table historiaclinica
(
id_historialclinico tinyint unsigned primary key auto_increment,
cedula bigint unsigned not null unique,
estatura float not null,
peso tinyint not null,
foreign key(cedula) references usuario(cedulausuario)
);

#tabla enfermedadpadecida------------------------------------------------------------------

create table enfermedadpadecida
(
enfermedad_padecida varchar(255) not null,
id_historialclinico tinyint unsigned not null,
foreign key(id_historialclinico) references historiaclinica(id_historialclinico)
);

#tabla alergia------------------------------------------------------------------

create table alergia
(
alergia varchar(255) not null,
id_historialclinico tinyint unsigned not null,
foreign key(id_historialclinico) references historiaclinica(id_historialclinico)
);

#tabla tratamiento ------------------------------------------------------------------

 create table tratamiento 
(
historial_tratamiento varchar(10000) not null,
id_historialclinico tinyint unsigned not null,
foreign key(id_historialclinico) references historiaclinica(id_historialclinico)
);

#tabla diagnostico ------------------------------------------------------------------

create table diagnostico
(
id_diagnostico tinyint unsigned primary key auto_increment,
id_historial tinyint unsigned not null,
descripcioncita varchar(10000) not null,
estadodientes varchar(5000) not null,
foreign key(id_historial) references historiaclinica(id_historialclinico)
);

#tabla rel_genera ------------------------------------------------------------------

create table rel_genera
(
id_cita tinyint unsigned not null auto_increment,
id_diagnostico tinyint unsigned not null,
foreign key(id_cita) references cita(id_cita),
foreign key(id_diagnostico) references diagnostico(id_diagnostico)
);

#procedimiento almacenado RegistrarUsuario--------------------------------------------------------

create procedure RegistrarUsuario
(
in cedulausuario bigint unsigned,
in nombres varchar(255),
in apellidos varchar(255),
in genero enum ('femenino','masculino'),
in direccion varchar(255),
in correo varchar(255),
in nombreusuario varchar(255),
in contraseñausuario varchar(255),
in estadousuario enum('activo','inactivo'),
in tarjetaprofesional varchar (255),
in especialidad varchar (255),
in rol enum ('Administrador','Doctor','Paciente'),
in ocupacion varchar(255),
in fechanacimiento date,
in telefono bigint
)

insert into usuario (cedulausuario, nombres, apellidos, genero, direccion, correo, nombreusuario, contraseñausuario, estadousuario, tarjetaprofesional, especialidad, rol, ocupacion, fechanacimiento, telefono)
values (cedulausuario, nombres, apellidos, genero, direccion, correo, nombreusuario, contraseñausuario, estadousuario, tarjetaprofesional, especialidad, rol, ocupacion, fechanacimiento, telefono);


#procedimiento almacenado ConsultarCedula--------------------------------------------------------

create procedure ConsultarCedula
(
in cedulausuario bigint unsigned
)
select cedulausuario from usuario where cedulausuario = cedulausuario;

#procedimiento almacenado AccesoUsuarios--------------------------------------------------------

create procedure AccesoUsuarios
(
in a varchar(255),
in b varchar(255)
)
select rol from usuario where nombreusuario = a and contraseñausuario = b;

#procedimiento almacenado ConsultaUsuarios--------------------------------------------------------

create procedure ConsultaUsuarios
(
in documento bigint unsigned
)
select cedulausuario, nombres, apellidos, genero, direccion, correo, nombreusuario, estadousuario , tarjetaprofesional, especialidad, rol, fechanacimiento, telefono 
from usuario where cedulausuario = documento ;

call ConsultaUsuarios(1023456789);

drop procedure ConsultaUsuarios;

#procedimiento almacenado ConsultaRol--------------------------------------------------------

create procedure ConsultaRol
(
in r enum ('Administrador','Doctor','Paciente')
)
select cedulausuario, nombres, apellidos, genero, direccion, correo, nombreusuario, estadousuario , tarjetaprofesional, especialidad, fechanacimiento, telefono from usuario where rol = r;

#procedimiento almacenado ConsultaHistoria--------------------------------------------------------

create procedure ConsultaHistoria
(
in Doc bigint 
)
select historiaclinica.id_historialclinico, historiaclinica.cedula, usuario.nombres, usuario.apellidos, usuario.rol, historiaclinica.estatura, historiaclinica.peso, enfermedadpadecida.enfermedad_padecida, alergia.alergia, tratamiento.historial_tratamiento
from usuario inner join historiaclinica on usuario.cedulausuario = historiaclinica.cedula inner join enfermedadpadecida
on historiaclinica.id_historialclinico = enfermedadpadecida.id_historialclinico inner join alergia
on enfermedadpadecida.id_historialclinico = alergia.id_historialclinico inner join tratamiento
on alergia.id_historialclinico = tratamiento.id_historialclinico where Doc=historiaclinica.Cedula;

call ConsultaHistoria(1043641374);

drop procedure ConsultaHistoria;

#procedimiento almacenado ConsultaAgenda---------------------------------------------------------

create procedure ConsultaAgenda
(
in Doc bigint
)
select agenda.codigoagenda, agenda.ceduladoctor, cita.id_cita, cita.cedula_paciente, usuario.nombres, usuario.apellidos, cita.hora_atencion, cita.fecha_atencion, cita.consultorio, cita.motivo 
from usuario inner join agenda
on usuario.cedulausuario = agenda.ceduladoctor inner join cita
on agenda.ceduladoctor = cita.cedula_doctor_atiende;

#procedimiento almacenado ConsultaCita---------------------------------------------------------

create procedure ConsultaCita
(
in Doc bigint 
)
select cita.id_cita, agenda.ceduladoctor, cita.codigo_agenda, cita.cedula_paciente, usuario.nombres, usuario.apellidos, usuario.estadousuario, cita.fecha_atencion, cita.hora_atencion, cita.valor, cita.consultorio, cita.motivo
from usuario inner join cita
on usuario.cedulausuario = cita.cedula_doctor_atiende inner join agenda
on cita.codigo_agenda = agenda.codigoagenda;

#REGISTRO USUARIO--------------------------------------------------------------------------------------------------------------------------------------------

insert into usuario (cedulausuario, nombres, apellidos, genero, direccion, correo, nombreusuario, contraseñausuario, estadousuario, tarjetaprofesional, especialidad, rol, fechanacimiento, telefono)
values (9146337, 'rafael', 'calderon','masculino', 'carrera 150 c # 138 - 82', 'rafaelcalderon@gmail.com','rafa123','calderonrafa321','activo','15792634680','odontologo','doctor','1967-06-05', 3134522890);

insert into usuario (cedulausuario, nombres, apellidos, genero, direccion, correo, nombreusuario, contraseñausuario, estadousuario, tarjetaprofesional, rol, fechanacimiento, telefono)
values (33207635, 'Merlis', 'Martinez','femenino', 'carrera 140 b # 108 - 02', 'merlismartinez@gmail.com','33207635','33207635','activo','15792634680','administrador','1972-01-30', 3043412918);

insert into usuario (cedulausuario, nombres, apellidos, genero, direccion, correo, nombreusuario, contraseñausuario, estadousuario, tarjetaprofesional, rol, fechanacimiento, telefono)
values (1043641374, 'Maria Jose', 'Marquez','femenino', 'carrera 100 # 118 - 22', 'mariamarquez@gmail.com','1043641374','2010','activo','1444434680','paciente','2004-10-20', 3203235559);

insert into usuario (cedulausuario, nombres, apellidos, genero, direccion, correo, nombreusuario, contraseñausuario, estadousuario, rol, fechanacimiento, telefono)
values (1023456789, 'Daniel', 'Salgado','masculino', 'carrera 90a # 18 - 12', 'salgado@gmail.com','daniel456','0000','activo','paciente','2004-02-15', 31634435688);

#REGISTRO AGENDA---------------------------------------------------------------------------------------------------------------------------------------------------------------------
       
INSERT INTO agenda (ceduladoctor)
values (9146337);

INSERT INTO agenda (ceduladoctor)
values (9146337);


#REGISTRO CITA--------------------------------------------------------------------------------------------------------------------------------------------------------------------

INSERT INTO cita (codigo_agenda, cedula_doctor_atiende, hora_atencion, fecha_atencion, valor, consultorio, motivo, cedula_paciente, Cedula_Admi)
values(1, 9146337,'01:50:00', '2021-12-10', 15000, 3,'malestar y dolores orales', 1043641374, 33207635);

INSERT INTO cita (codigo_agenda, cedula_doctor_atiende, hora_atencion, fecha_atencion, valor, consultorio, motivo, cedula_paciente, Cedula_Admi)
values(2, 9146337,'02:30:00', '2021-07-09', 15000, 3,'malestar y dolores orales', 1043641374, 33207635);

#REGISTRO HISTORIALCLINICO---------------------------------------------------------------------------------------------------------------------------------------------------------

INSERT INTO historiaclinica (cedula, estatura, peso)
values (1043641374, 1.80, 63);

INSERT INTO historiaclinica (cedula, estatura, peso)
values (1023456789, 1.50, 47);


#REGISTRO TRATAMIENTO---------------------------------------------------------------

insert into tratamiento (id_historialclinico, historial_tratamiento)
values (1,'Periodoncia');

insert into tratamiento (id_historialClinico, Historial_tratamiento)
values (2,'ortodoncia');

#REGISTRO EMFERMEDADPADECIDA-------------------------------------------------------------

insert into EnfermedadPadecida (id_historialClinico, enfermedad_padecida)
values (1,'Periodontopatía');

insert into EnfermedadPadecida (id_historialClinico, enfermedad_padecida)
values (2,'Traumatismo bucodental');


#REGISTRO ALERGIA------------------------------------------------------------------------

insert into Alergia (id_historialClinico,alergia)
values (1,'hipersensibilidad retardada a materiales dentales' );

insert into Alergia (id_historialClinico,alergia)
values (2,'anafilactica');

#CONSULTAS---------------------------------------------------------------------------

select * from usuario;
select * from agenda;
select * from cita;
select * from historiaclinica;
select * from tratamiento;
select * from enfermedadpadecida;
select * from alergia;
select * from rel_genera;
select * from diagnostico;
select * from usuario where cedulausuario = 1043641374;
select * from usuario where rol = 'Paciente';
select * from usuario where rol = 'Doctor';
select * from usuario where rol = 'Administrador';

