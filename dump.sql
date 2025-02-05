--
-- PostgreSQL database dump
--

-- Dumped from database version 16.6
-- Dumped by pg_dump version 17.2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Data for Name: color; Type: TABLE DATA; Schema: public; Owner: app
--

COPY public.color (id, label, color) FROM stdin;
1	Rouge	danger
2	Vert	success
3	Bleu	info
4	Jaune	warning
\.


--
-- Data for Name: category; Type: TABLE DATA; Schema: public; Owner: app
--

COPY public.category (id, color_id, label) FROM stdin;
1	1	🍗 Viande
2	2	🫑 Légumes
3	4	🍒 Fruits
4	3	🧄 Herbes / Champignons
\.


--
-- Data for Name: doctrine_migration_versions; Type: TABLE DATA; Schema: public; Owner: app
--

COPY public.doctrine_migration_versions (version, executed_at, execution_time) FROM stdin;
DoctrineMigrations\\Version20250205200851	2025-02-05 20:08:55	19
\.


--
-- Data for Name: food; Type: TABLE DATA; Schema: public; Owner: app
--

COPY public.food (id, category_id, label, number, quantity) FROM stdin;
1	1	saucisses	4	\N
2	1	saucisses	5	\N
3	1	bavette	6	\N
4	1	boudin	1	\N
5	1	boudin	2	\N
6	1	lardons	3	\N
7	1	lardons	7	\N
8	1	magrets 2019	8	\N
9	1	magrets 2019	9	\N
10	1	magrets 2019	10	\N
11	1	poulet entier	11	\N
12	1	poulet entier	12	\N
13	1	lapin morceaux	13	\N
14	1	lapin morceaux	14	\N
15	1	lapin morceaux	15	\N
16	1	Rôti de porc	16	\N
17	1	Rôti de porc	17	\N
18	1	Pot au feu petit	18	\N
19	1	Ribs	19	\N
20	1	Ventrèche épaisse	20	\N
21	1	Jarret	21	\N
22	1	Tranches veau	22	\N
23	1	Pot au feu grand	19a	\N
24	1	Bourguignon	20a	\N
25	1	Tranches de veau	21a	\N
26	1	Tranches de veau	22a	\N
27	1	Bourguignon	23	\N
28	1	Aiguillette	24	\N
29	1	Aiguillette	25	\N
30	1	Aiguillette	26	\N
31	1	Magrets anciens	27	\N
32	1	Magrets anciens	28	\N
33	1	Ventrèche épaisse	29	\N
34	1	Bourguignon	30	\N
35	1	Bavettes x2	31	\N
36	1	lapin morceaux	32	\N
37	1	Bavette	33	\N
38	1	Tranche de veau	34	\N
39	1	Tranche de veau	35	\N
40	1	Tranche de veau	36	\N
41	1	Chair à saucisse 500g	37	\N
42	1	Filet mignon	38	\N
43	1	Rôti de beau	39	\N
44	1	Saucisse	40	\N
45	1	Saucisse	41	\N
46	1	Pot au feu grand	42	\N
47	1	Bavettes x2	43	\N
48	1	Tournedos x2	44	\N
49	1	Bavettes x2	45	\N
50	1	Chair à saucisse 500g	46	\N
51	1	Chair à saucisse 500g	47	\N
52	1	Saucisse	48	\N
53	1	Araignée	49	\N
54	1	Bavette	50	\N
55	1	Bavette	51	\N
57	4	Ciboulettes	1	\N
58	4	Persils	2	\N
59	4	Persils	3	\N
60	4	Persils	4	\N
61	4	Persils	5	\N
62	4	Persils	6	\N
63	4	Cèpes 2021	7	\N
64	4	Cèpes 2021	8	\N
65	4	Cèpes 2024	9	\N
66	4	Cèpes 2024	10	\N
67	4	Cèpes 2024	11	\N
68	3	Mirabelle	1	\N
69	3	Figues	2	\N
70	3	Cassis	3	\N
71	3	Framboises 500g	4	\N
72	3	Noix	5	\N
73	3	Compotes	6	\N
74	2	Tomates	1	\N
75	2	Tomates coeur de boeuf	2	2
76	2	Poireaux rondelles	3	\N
77	2	Petit pois	4	\N
78	2	Poivrons verts	5	\N
79	2	Haricots verts	6	\N
80	2	Haricots verts	7	\N
81	2	Haricots verts	8	\N
82	2	Haricots verts	9	\N
83	2	Haricots verts	10	\N
84	2	Haricots verts	24	\N
85	2	Haricots plats	11	\N
86	2	Haricots plats	12	\N
87	2	Haricots plats	13	\N
88	2	Poivrons verts	14	\N
89	2	Poivrons verts	15	\N
90	2	Potimarron	16	\N
91	2	Butternut	17	\N
92	2	Carottes	18	\N
93	2	Carottes	19	\N
94	2	Poivrons rouge	20	\N
95	2	Haricots blancs	21	\N
96	2	Courgettes	22	\N
97	2	Courgettes	23	\N
56	1	Steack de veau	52	15
\.


--
-- Data for Name: foot; Type: TABLE DATA; Schema: public; Owner: app
--

COPY public.foot (id) FROM stdin;
\.


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: app
--

COPY public."user" (id, username, roles, password) FROM stdin;
1	me@julien-clauzel.fr	["ROLE_SUPER_ADMIN"]	$2y$13$6pWlg215t4OZj8v/7SGY8.Gccg6z5jyLDGp49vr13iBqr3Z2NWQ1.
\.


--
-- Name: category_id_seq; Type: SEQUENCE SET; Schema: public; Owner: app
--

SELECT pg_catalog.setval('public.category_id_seq', 4, true);


--
-- Name: color_id_seq; Type: SEQUENCE SET; Schema: public; Owner: app
--

SELECT pg_catalog.setval('public.color_id_seq', 4, true);


--
-- Name: food_id_seq; Type: SEQUENCE SET; Schema: public; Owner: app
--

SELECT pg_catalog.setval('public.food_id_seq', 97, true);


--
-- Name: foot_id_seq; Type: SEQUENCE SET; Schema: public; Owner: app
--

SELECT pg_catalog.setval('public.foot_id_seq', 1, false);


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: app
--

SELECT pg_catalog.setval('public.user_id_seq', 1, true);


--
-- PostgreSQL database dump complete
--

