DROP DATABASE IF EXISTS Listado_Tareas;
CREATE DATABASE Listado_Tareas;
USE Listado_Tareas;

CREATE TABLE actividades (
	id int NOT NULL AUTO_INCREMENT,
	nombre varchar(200) NOT NULL,
	descripcion text NOT NULL,
	CONSTRAINT pk_actividades	PRIMARY KEY (id),
	CONSTRAINT uq_actividades UNIQUE (nombre)
);

CREATE TABLE documentos (
	actividad_id int NOT NULL,
	nombre varchar(255) NOT NULL,
	CONSTRAINT pk_documentos	PRIMARY KEY (actividad_id, nombre),
	CONSTRAINT fk_documentos_actividad_id FOREIGN KEY (actividad_id)
	REFERENCES actividades(id)
	ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE grupos (
	id int NOT NULL AUTO_INCREMENT,
	nombre varchar(200) NOT NULL,
	CONSTRAINT pk_actividades	PRIMARY KEY (id),
	CONSTRAINT uq_grupos UNIQUE (nombre)
);

CREATE TABLE personal (
	id int NOT NULL AUTO_INCREMENT,
	grupo_id int,
	nombres varchar(255) NOT NULL,
	apellidos varchar(255) NOT NULL,
	es_jefe int DEFAULT 0,
	CONSTRAINT pk_personal PRIMARY KEY (id),
	CONSTRAINT fk_personal_grupo_id FOREIGN KEY (grupo_id)
	REFERENCES grupos(id)
	ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE tareas (
	id int NOT NULL AUTO_INCREMENT,
	actividad_id int NOT NULL,
	grupo_id int,
	status varchar(50) NOT NULL,
	prioridad varchar(50) NOT NULL,
	fecha_inicio date,
	hora_inicio time,
	fecha_culminacion date,
	hora_culminacion time,
	observaciones text,
	CONSTRAINT pk_tareas PRIMARY KEY (id),
	CONSTRAINT fk_actividad_tarea FOREIGN KEY (actividad_id)
	REFERENCES actividades(id)
	ON UPDATE CASCADE ON DELETE RESTRICT,
	CONSTRAINT fk_grupo_tarea FOREIGN KEY (grupo_id)
	REFERENCES grupos(id)
	ON UPDATE CASCADE ON DELETE SET NULL
);