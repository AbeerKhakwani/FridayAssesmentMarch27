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
-- Name: brands; Type: TABLE; Schema: public; Owner: Guest; Tablespace: 
--

CREATE TABLE brands (
    id integer NOT NULL,
    brand character varying
);


ALTER TABLE brands OWNER TO "Guest";

--
-- Name: brands_id_seq; Type: SEQUENCE; Schema: public; Owner: Guest
--

CREATE SEQUENCE brands_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE brands_id_seq OWNER TO "Guest";

--
-- Name: brands_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Guest
--

ALTER SEQUENCE brands_id_seq OWNED BY brands.id;


--
-- Name: stores; Type: TABLE; Schema: public; Owner: Guest; Tablespace: 
--

CREATE TABLE stores (
    id integer NOT NULL,
    name character varying
);


ALTER TABLE stores OWNER TO "Guest";

--
-- Name: stores_brands; Type: TABLE; Schema: public; Owner: Guest; Tablespace: 
--

CREATE TABLE stores_brands (
    id integer NOT NULL,
    store_id integer,
    brand_id integer
);


ALTER TABLE stores_brands OWNER TO "Guest";

--
-- Name: stores_brands_id_seq; Type: SEQUENCE; Schema: public; Owner: Guest
--

CREATE SEQUENCE stores_brands_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE stores_brands_id_seq OWNER TO "Guest";

--
-- Name: stores_brands_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Guest
--

ALTER SEQUENCE stores_brands_id_seq OWNED BY stores_brands.id;


--
-- Name: stores_id_seq; Type: SEQUENCE; Schema: public; Owner: Guest
--

CREATE SEQUENCE stores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE stores_id_seq OWNER TO "Guest";

--
-- Name: stores_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Guest
--

ALTER SEQUENCE stores_id_seq OWNED BY stores.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: Guest
--

ALTER TABLE ONLY brands ALTER COLUMN id SET DEFAULT nextval('brands_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: Guest
--

ALTER TABLE ONLY stores ALTER COLUMN id SET DEFAULT nextval('stores_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: Guest
--

ALTER TABLE ONLY stores_brands ALTER COLUMN id SET DEFAULT nextval('stores_brands_id_seq'::regclass);


--
-- Data for Name: brands; Type: TABLE DATA; Schema: public; Owner: Guest
--

COPY brands (id, brand) FROM stdin;
8	Abeer
9	dscSZ
\.


--
-- Name: brands_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Guest
--

SELECT pg_catalog.setval('brands_id_seq', 9, true);


--
-- Data for Name: stores; Type: TABLE DATA; Schema: public; Owner: Guest
--

COPY stores (id, name) FROM stdin;
10	azscvdcv
11	Baby
12	Jcpenny
13	Macys
\.


--
-- Data for Name: stores_brands; Type: TABLE DATA; Schema: public; Owner: Guest
--

COPY stores_brands (id, store_id, brand_id) FROM stdin;
1	7	2
2	7	2
3	7	1
4	7	4
5	7	4
6	7	4
7	8	3
8	8	3
9	9	2
10	12	8
11	13	8
12	11	8
13	12	9
\.


--
-- Name: stores_brands_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Guest
--

SELECT pg_catalog.setval('stores_brands_id_seq', 13, true);


--
-- Name: stores_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Guest
--

SELECT pg_catalog.setval('stores_id_seq', 13, true);


--
-- Name: brands_pkey; Type: CONSTRAINT; Schema: public; Owner: Guest; Tablespace: 
--

ALTER TABLE ONLY brands
    ADD CONSTRAINT brands_pkey PRIMARY KEY (id);


--
-- Name: stores_brands_pkey; Type: CONSTRAINT; Schema: public; Owner: Guest; Tablespace: 
--

ALTER TABLE ONLY stores_brands
    ADD CONSTRAINT stores_brands_pkey PRIMARY KEY (id);


--
-- Name: stores_pkey; Type: CONSTRAINT; Schema: public; Owner: Guest; Tablespace: 
--

ALTER TABLE ONLY stores
    ADD CONSTRAINT stores_pkey PRIMARY KEY (id);


--
-- Name: public; Type: ACL; Schema: -; Owner: epicodus
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM epicodus;
GRANT ALL ON SCHEMA public TO epicodus;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

