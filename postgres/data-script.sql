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
INSERT INTO public.empleado VALUES (4, 2, 'usuario', 'nombre2', 'apellidos', 'apellido2', 'user', '$2y$10$3MNB48FRYcEzWEeEF7ad2.Fe/2HGNmwwzeSJ50eRKkqPONHYXH7WK', 'u@g.com', true, '67895421', true, '1997-07-12');
INSERT INTO public.empleado VALUES (5, 2, 'Roberto', 'Carlos', 'Menendez', 'Castro', 'carlos', '$2y$10$3MNB48FRYcEzWEeEF7ad2.Fe/2HGNmwwzeSJ50eRKkqPONHYXH7WK', 'r@g.com', true, '73719834', true, '1997-10-10');


--
-- TOC entry 2166 (class 0 OID 16387)
-- Dependencies: 186
-- Data for Name: miembro; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO public.miembro VALUES (1, 1, 'Victor', 'Victor2', 'Umaña', 'Umaña2', 'vic123', 'UU19001', 'foto.png', 'test123@gmail.com', true, '75645323', 1.69999999999999996, 150.5, true, '2019-10-10');

--
-- TOC entry 2185 (class 0 OID 0)
-- Dependencies: 187
-- Name: empleado_id_empleado_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.empleado_id_empleado_seq', 5, true);


--
-- TOC entry 2186 (class 0 OID 0)
-- Dependencies: 185
-- Name: miembro_id_miembro_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.miembro_id_miembro_seq', 1, true);


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

