-- Database generated with pgModeler (PostgreSQL Database Modeler).
-- pgModeler  version: 0.9.2-beta1
-- PostgreSQL version: 9.6
-- Project Site: pgmodeler.io
-- Model Author: ---


-- Database creation must be done outside a multicommand file.
-- These commands were put in this file only as a convenience.
-- -- object: gym | type: DATABASE --
-- -- DROP DATABASE IF EXISTS gym;
-- CREATE DATABASE gym;
-- -- ddl-end --
-- 

-- object: public.miembro | type: TABLE --
-- DROP TABLE IF EXISTS public.miembro CASCADE;
CREATE TABLE public.miembro (
	id_miembro serial NOT NULL,
	id_tipo_membresia integer NOT NULL,
	primer_nombre character varying(64) NOT NULL,
	segundo_nombre character varying(64) NOT NULL,
	primer_apellido character varying(64) NOT NULL,
	segundo_apellido character varying(64) NOT NULL,
	usuario character varying(32) NOT NULL,
	identificador character varying(10) NOT NULL,
	foto character varying(256),
	correo character varying(64),
	genero boolean NOT NULL,
	telefono character varying(20) NOT NULL,
	altura double precision,
	peso double precision,
	activo boolean NOT NULL,
	fecha_nacimiento date NOT NULL,
	CONSTRAINT miembro_pk PRIMARY KEY (id_miembro)

);
-- ddl-end --

-- object: public.empleado | type: TABLE --
-- DROP TABLE IF EXISTS public.empleado CASCADE;
CREATE TABLE public.empleado (
	id_empleado serial NOT NULL,
	id_tipo_empleado integer NOT NULL,
	primer_nombre character varying(64) NOT NULL,
	segundo_nombre character varying(64) NOT NULL,
	primer_apellido character varying(64) NOT NULL,
	segundo_apellido character varying(64) NOT NULL,
	usuario character varying(32) NOT NULL,
	password character varying(64) NOT NULL,
	correo character varying(64),
	genero boolean NOT NULL,
	telefono character varying(20) NOT NULL,
	activo boolean NOT NULL,
	fecha_nacimiento date NOT NULL,
	CONSTRAINT empleado_pk PRIMARY KEY (id_empleado)

);
-- ddl-end --

-- object: public.tipo_membresia | type: TABLE --
-- DROP TABLE IF EXISTS public.tipo_membresia CASCADE;
CREATE TABLE public.tipo_membresia (
	id_tipo_membresia serial NOT NULL,
	nombre character varying(32) NOT NULL,
	precio numeric(5,2) NOT NULL,
	activo boolean NOT NULL,
	descripcion text,
	CONSTRAINT tipo_membresia_pk PRIMARY KEY (id_tipo_membresia)

);
-- ddl-end --

-- object: public.pago | type: TABLE --
-- DROP TABLE IF EXISTS public.pago CASCADE;
CREATE TABLE public.pago (
	id_pago serial NOT NULL,
	id_miembro integer NOT NULL,
	id_empleado integer,
	id_tipo_membresia integer,
	date_time timestamp DEFAULT CURRENT_TIMESTAMP,
	monto numeric(5,2) NOT NULL,
	CONSTRAINT pago_pk PRIMARY KEY (id_pago)

);
-- ddl-end --

-- object: public.tipo_empleado | type: TABLE --
-- DROP TABLE IF EXISTS public.tipo_empleado CASCADE;
CREATE TABLE public.tipo_empleado (
	id_tipo_empleado serial NOT NULL,
	nombre character varying(32) NOT NULL,
	descripcion text,
	CONSTRAINT tipo_empleado_pk PRIMARY KEY (id_tipo_empleado)

);
-- ddl-end --

-- object: empleado_tipo_empleado_fk | type: CONSTRAINT --
-- ALTER TABLE public.empleado DROP CONSTRAINT IF EXISTS empleado_tipo_empleado_fk CASCADE;
ALTER TABLE public.empleado ADD CONSTRAINT empleado_tipo_empleado_fk FOREIGN KEY (id_tipo_empleado)
REFERENCES public.tipo_empleado (id_tipo_empleado) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: pago_miembro_fk | type: CONSTRAINT --
-- ALTER TABLE public.pago DROP CONSTRAINT IF EXISTS pago_miembro_fk CASCADE;
ALTER TABLE public.pago ADD CONSTRAINT pago_miembro_fk FOREIGN KEY (id_miembro)
REFERENCES public.miembro (id_miembro) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: pago_tipo_membresia_fk | type: CONSTRAINT --
-- ALTER TABLE public.pago DROP CONSTRAINT IF EXISTS pago_tipo_membresia_fk CASCADE;
ALTER TABLE public.pago ADD CONSTRAINT pago_tipo_membresia_fk FOREIGN KEY (id_tipo_membresia)
REFERENCES public.tipo_membresia (id_tipo_membresia) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: pago_empleado_fk | type: CONSTRAINT --
-- ALTER TABLE public.pago DROP CONSTRAINT IF EXISTS pago_empleado_fk CASCADE;
ALTER TABLE public.pago ADD CONSTRAINT pago_empleado_fk FOREIGN KEY (id_empleado)
REFERENCES public.empleado (id_empleado) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


