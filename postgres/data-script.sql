--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.15
-- Dumped by pg_dump version 11.3

-- Started on 2019-10-24 00:06:17 UTC

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;


--
-- TOC entry 2172 (class 0 OID 16414)
-- Dependencies: 192
-- Data for Name: pago; Type: TABLE DATA; Schema: public; Owner: admin
--



--
-- TOC entry 2174 (class 0 OID 16423)
-- Dependencies: 194
-- Data for Name: tipo_empleado; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO public.tipo_empleado VALUES (1, 'Administrador', NULL);
INSERT INTO public.tipo_empleado VALUES (2, 'Empleado', NULL);


--
-- TOC entry 2170 (class 0 OID 16403)
-- Dependencies: 190
-- Data for Name: tipo_membresia; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO public.tipo_membresia VALUES (1, 'Mensual', 20.00, true, 'Pago de cuota mensual');
INSERT INTO public.tipo_membresia VALUES (2, 'Quincenal', 15.00, true, 'Pago de cuota quincenal');
INSERT INTO public.tipo_membresia VALUES (3, 'Semanal', 10.00, true, 'Pago de cuota semanal');

--
-- TOC entry 2168 (class 0 OID 16395)
-- Dependencies: 188
-- Data for Name: empleado; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO public.empleado VALUES (1, 1, 'Monzon ', 'Masariego', 'Rigoberto', 'Alexander', 'monzon', '$2y$10$SFX.zuOrNRIBjHMl4TEo1ueQuCmK8uP7lFijJyogVHU2DjZgzPz5a', 'c@g.com', true, '87654321', true, '2000-01-01');
INSERT INTO public.empleado VALUES (2, 2, 'Juan', 'Carlos', 'Pleitez', 'Cortez', 'juan', '$2y$10$3MNB48FRYcEzWEeEF7ad2.Fe/2HGNmwwzeSJ50eRKkqPONHYXH7WK', 'j@g.com', true, '12345678', true, '1996-11-07');
INSERT INTO public.empleado VALUES (3, 2, 'Jc', 'Alber', 'Pleitez', 'Cortez', 'jc', '$2y$10$3MNB48FRYcEzWEeEF7ad2.Fe/2HGNmwwzeSJ50eRKkqPONHYXH7WK', 'j@g.com', true, '12345678', true, '1996-11-07');
INSERT INTO public.empleado VALUES (4, 2, 'usuario', 'nombre2', 'apellidos', 'apellido2', 'user', '$2y$10$3MNB48FRYcEzWEeEF7ad2.Fe/2HGNmwwzeSJ50eRKkqPONHYXH7WK', 'u@g.com', true, '67895421', true, '1997-07-12');
INSERT INTO public.empleado VALUES (5, 2, 'Roberto', 'Carlos', 'Menendez', 'Castro', 'carlos', '$2y$10$3MNB48FRYcEzWEeEF7ad2.Fe/2HGNmwwzeSJ50eRKkqPONHYXH7WK', 'r@g.com', true, '73719834', false, '1997-10-10');
INSERT INTO public.empleado VALUES (6, 2, 'Robert', 'Carloos', 'Menéndez', 'Castro', 'rcarloos', '$2y$10$v97ozyzHiaODfOkYdCN7..gdQe9jCVjAIQbWVVS3wf6ERdVoRd4fu', 'rcarloos@gmail.com', true, '73729861', true, '2000-01-25');
INSERT INTO public.empleado VALUES (7, 2, 'Juan', 'Jose', 'Mendez', 'Cortez', 'jcpleitez96', '$2y$10$I1cSYmyAuqnVGS5tufRFE.L7XrXmLpepn/SfA8uYeB54YcmIpV0pG', 'juanpc13lolol@gmail.com', true, '76876868', true, '1996-11-07');
INSERT INTO public.empleado VALUES (8, 2, 'ivan', 'armando', 'guerra', 'portillo', 'IVANgfgf', '$2y$10$Bq2gM.tygVhDK6MEO8f6E.0lYc2DycSDasyx0cBulLuPVJTPvqqyG', 'i@hot.com', true, '77777777', false, '2019-10-18');
INSERT INTO public.empleado VALUES (9, 2, 'Ivan', 'armando', 'asdss', 'dsssdd', 'ivan', '$2y$10$W3jvRJqElMT8T0wKZ9UjPOL9oJe.A4zKGhRTxzmcOdckGWvWfgZHm', 'armando@gmail.com', true, '66666666', true, '2019-11-09');
INSERT INTO public.empleado VALUES (10, 2, 'Carlos', 'Roberto', 'Castro', 'Menéndez', 'rcarlosdeb', '$2y$10$AgUVSCysjxY.XfdZVEgZEerGjU2qE3oTN2S3SaWJjPHHPmLakhE8.', 'i@hot.com', true, '73729862', false, '1998-07-26');


--
-- TOC entry 2166 (class 0 OID 16387)
-- Dependencies: 186
-- Data for Name: miembro; Type: TABLE DATA; Schema: public; Owner: admin
-- 

INSERT INTO public.estado VALUES(1, 'Activo', 'Estado para los miembros que asisten al gym y tienen sus pagos al dia');
INSERT INTO public.estado VALUES(2, 'Pendiente', 'Estado para los miembros que tienen pagos pendientes');
INSERT INTO public.estado VALUES(3, 'Inactivo', 'Estado para los miembros que dejaron de realizar los pagos');

INSERT INTO public.miembro VALUES (1, 1, 1, 'Victor', 'Victor2', 'Umaña', 'Umaña2', 'vic123', 'UU19001', 'default.jpg', 'test123@gmail.com', true, '75645323', 1.68999999999999995, 150.5, true, '2019-10-10', '2019-10-10');
INSERT INTO public.miembro VALUES (2, 1, 1, 'Juan Carlos', 'Juan Carlos', 'Pleitez Cortez', 'Pleitez Cortez', 'juanpc13', 'PP19001', 'default.gif', 'juanpc13lolol@gmail.com', true, '76876868', 172, 160, true, '1996-11-07', '2019-11-04');
INSERT INTO public.miembro VALUES (3, 3, 2, 'Carlos', 'Luis', 'Gonzalez', 'Mendez', 'cl13', 'GM19001', 'default.jpg', 'carlos@gmail.com', true, '12345678', 170, 160, true, '2019-11-05', '2019-11-04');
INSERT INTO public.miembro VALUES (4, 2, 3, 'Eduardo', 'Jose', 'Linares', 'Rojas', 'edu96', 'LR19001', 'default.jpg', 'edu96@gmail.com', true, '12345678', 160, 180, true, '2019-11-13', '2019-11-05');
INSERT INTO public.miembro VALUES (5, 3, 3, 'Jose', 'Carlos', 'Campos', 'Mendez', 'jc1234', 'CM19001', 'default.jpg', 'jaja@g.com', true, '12345678', 1234567, 140, true, '2019-11-13', '2019-11-05');


--
-- TOC entry 2185 (class 0 OID 0)
-- Dependencies: 187
-- Name: empleado_id_empleado_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--
SELECT pg_catalog.setval('public.estado_id_estado_seq', 3, true);
SELECT pg_catalog.setval('public.empleado_id_empleado_seq', 10, true);


--
-- TOC entry 2186 (class 0 OID 0)
-- Dependencies: 185
-- Name: miembro_id_miembro_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.miembro_id_miembro_seq', 5, true);


--
-- TOC entry 2187 (class 0 OID 0)
-- Dependencies: 191
-- Name: pago_id_pago_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.pago_id_pago_seq', 1, false);


--
-- TOC entry 2188 (class 0 OID 0)
-- Dependencies: 193
-- Name: tipo_empleado_id_tipo_empleado_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.tipo_empleado_id_tipo_empleado_seq', 2, true);


--
-- TOC entry 2189 (class 0 OID 0)
-- Dependencies: 189
-- Name: tipo_membresia_id_tipo_membresia_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.tipo_membresia_id_tipo_membresia_seq', 3, true);


-- Completed on 2019-10-24 00:06:18 UTC

--
-- PostgreSQL database dump complete
--

