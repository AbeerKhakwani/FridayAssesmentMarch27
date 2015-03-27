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
828	Drupal
829	Dave
830	Sally
831	Harry Potter
\.


--
-- Name: brands_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Guest
--

SELECT pg_catalog.setval('brands_id_seq', 831, true);


--
-- Data for Name: stores; Type: TABLE DATA; Schema: public; Owner: Guest
--

COPY stores (id, name) FROM stdin;
\.


--
-- Data for Name: stores_brands; Type: TABLE DATA; Schema: public; Owner: Guest
--

COPY stores_brands (id, store_id, brand_id) FROM stdin;
244	760	783
245	761	784
246	762	784
248	764	797
249	765	798
250	766	798
252	768	811
253	769	812
254	770	812
256	772	825
257	773	826
258	774	826
260	787	828
261	788	829
262	788	830
263	789	831
\.


--
-- Name: stores_brands_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Guest
--

SELECT pg_catalog.setval('stores_brands_id_seq', 263, true);


--
-- Name: stores_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Guest
--

SELECT pg_catalog.setval('stores_id_seq', 789, true);


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

