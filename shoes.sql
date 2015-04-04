--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: brands; Type: TABLE; Schema: public; Owner: abeer; Tablespace: 
--

CREATE TABLE brands (
    id integer NOT NULL,
    brand character varying
);


ALTER TABLE brands OWNER TO abeer;

--
-- Name: brands_id_seq; Type: SEQUENCE; Schema: public; Owner: abeer
--

CREATE SEQUENCE brands_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE brands_id_seq OWNER TO abeer;

--
-- Name: brands_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: abeer
--

ALTER SEQUENCE brands_id_seq OWNED BY brands.id;


--
-- Name: brands_stores; Type: TABLE; Schema: public; Owner: abeer; Tablespace: 
--

CREATE TABLE brands_stores (
    id integer NOT NULL,
    brand_id integer,
    store_id integer
);


ALTER TABLE brands_stores OWNER TO abeer;

--
-- Name: brands_stores_id_seq; Type: SEQUENCE; Schema: public; Owner: abeer
--

CREATE SEQUENCE brands_stores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE brands_stores_id_seq OWNER TO abeer;

--
-- Name: brands_stores_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: abeer
--

ALTER SEQUENCE brands_stores_id_seq OWNED BY brands_stores.id;


--
-- Name: stores; Type: TABLE; Schema: public; Owner: abeer; Tablespace: 
--

CREATE TABLE stores (
    id integer NOT NULL,
    name character varying
);


ALTER TABLE stores OWNER TO abeer;

--
-- Name: stores_id_seq; Type: SEQUENCE; Schema: public; Owner: abeer
--

CREATE SEQUENCE stores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE stores_id_seq OWNER TO abeer;

--
-- Name: stores_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: abeer
--

ALTER SEQUENCE stores_id_seq OWNED BY stores.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: abeer
--

ALTER TABLE ONLY brands ALTER COLUMN id SET DEFAULT nextval('brands_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: abeer
--

ALTER TABLE ONLY brands_stores ALTER COLUMN id SET DEFAULT nextval('brands_stores_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: abeer
--

ALTER TABLE ONLY stores ALTER COLUMN id SET DEFAULT nextval('stores_id_seq'::regclass);


--
-- Data for Name: brands; Type: TABLE DATA; Schema: public; Owner: abeer
--

COPY brands (id, brand) FROM stdin;
3	hello
4	Bye bye
\.


--
-- Name: brands_id_seq; Type: SEQUENCE SET; Schema: public; Owner: abeer
--

SELECT pg_catalog.setval('brands_id_seq', 4, true);


--
-- Data for Name: brands_stores; Type: TABLE DATA; Schema: public; Owner: abeer
--

COPY brands_stores (id, brand_id, store_id) FROM stdin;
1	3	1
2	3	1
3	3	1
4	3	1
5	3	1
6	3	1
7	3	1
8	3	1
9	3	2
10	3	2
11	3	2
12	4	1
13	4	1
14	4	1
15	4	1
16	4	1
17	4	1
18	4	1
19	4	2
20	4	1
21	4	2
22	4	2
23	4	3
\.


--
-- Name: brands_stores_id_seq; Type: SEQUENCE SET; Schema: public; Owner: abeer
--

SELECT pg_catalog.setval('brands_stores_id_seq', 23, true);


--
-- Data for Name: stores; Type: TABLE DATA; Schema: public; Owner: abeer
--

COPY stores (id, name) FROM stdin;
1	nnn
2	cedc
3	dandxac
\.


--
-- Name: stores_id_seq; Type: SEQUENCE SET; Schema: public; Owner: abeer
--

SELECT pg_catalog.setval('stores_id_seq', 3, true);


--
-- Name: brands_pkey; Type: CONSTRAINT; Schema: public; Owner: abeer; Tablespace: 
--

ALTER TABLE ONLY brands
    ADD CONSTRAINT brands_pkey PRIMARY KEY (id);


--
-- Name: brands_stores_pkey; Type: CONSTRAINT; Schema: public; Owner: abeer; Tablespace: 
--

ALTER TABLE ONLY brands_stores
    ADD CONSTRAINT brands_stores_pkey PRIMARY KEY (id);


--
-- Name: stores_pkey; Type: CONSTRAINT; Schema: public; Owner: abeer; Tablespace: 
--

ALTER TABLE ONLY stores
    ADD CONSTRAINT stores_pkey PRIMARY KEY (id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

