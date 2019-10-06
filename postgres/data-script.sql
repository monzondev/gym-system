--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.15
-- Dumped by pg_dump version 11.3

-- Started on 2019-10-06 21:06:23 UTC

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
-- TOC entry 2167 (class 0 OID 16395)
-- Dependencies: 188
-- Data for Name: empleado; Type: TABLE DATA; Schema: public; Owner: admin
--



--
-- TOC entry 2165 (class 0 OID 16387)
-- Dependencies: 186
-- Data for Name: miembro; Type: TABLE DATA; Schema: public; Owner: admin
--



--
-- TOC entry 2171 (class 0 OID 16414)
-- Dependencies: 192
-- Data for Name: pago; Type: TABLE DATA; Schema: public; Owner: admin
--



--
-- TOC entry 2173 (class 0 OID 16422)
-- Dependencies: 194
-- Data for Name: tipo_empleado; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO public.tipo_empleado VALUES (1, 'Administrador', NULL);
INSERT INTO public.tipo_empleado VALUES (2, 'Empleado', NULL);


--
-- TOC entry 2169 (class 0 OID 16403)
-- Dependencies: 190
-- Data for Name: tipo_membresia; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO public.tipo_membresia VALUES (1, 'Mensual', 20.00, true, 'Pago de cuota mensual');
INSERT INTO public.tipo_membresia VALUES (2, 'Quincenal', 15.00, true, 'Pago de cuota quincenal');
INSERT INTO public.tipo_membresia VALUES (3, 'Semanal', 10.00, true, 'Pago de cuota semanal');


--
-- TOC entry 2184 (class 0 OID 0)
-- Dependencies: 187
-- Name: empleado_id_empleado_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.empleado_id_empleado_seq', 1, false);


--
-- TOC entry 2185 (class 0 OID 0)
-- Dependencies: 185
-- Name: miembro_id_miembro_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.miembro_id_miembro_seq', 1, false);


--
-- TOC entry 2186 (class 0 OID 0)
-- Dependencies: 191
-- Name: pago_id_pago_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.pago_id_pago_seq', 1, false);


--
-- TOC entry 2187 (class 0 OID 0)
-- Dependencies: 193
-- Name: tipo_empleado_id_tipo_empleado_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.tipo_empleado_id_tipo_empleado_seq', 2, true);


--
-- TOC entry 2188 (class 0 OID 0)
-- Dependencies: 189
-- Name: tipo_membresia_id_tipo_membresia_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.tipo_membresia_id_tipo_membresia_seq', 3, true);


-- Completed on 2019-10-06 21:06:23 UTC

--
-- PostgreSQL database dump complete
--

