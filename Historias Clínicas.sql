--
-- PostgreSQL database dump
--

-- Dumped from database version 9.3.0
-- Dumped by pg_dump version 9.3.0
-- Started on 2013-10-21 10:13:14

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 178 (class 3079 OID 11750)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2006 (class 0 OID 0)
-- Dependencies: 178
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 170 (class 1259 OID 16447)
-- Name: antecedentefamiliar; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE antecedentefamiliar (
    familiar character varying NOT NULL,
    antecedente character varying NOT NULL,
    nrohistoria integer NOT NULL,
    CONSTRAINT antecedente CHECK (((antecedente)::text = ANY (ARRAY[('Cancer'::character varying)::text, ('Alcoholismo'::character varying)::text, ('Tabaquismo'::character varying)::text, ('Drogas'::character varying)::text, ('TrastornosMentales'::character varying)::text, ('Neurologica'::character varying)::text, ('Varices'::character varying)::text, ('Cardiopatia'::character varying)::text, ('HTA'::character varying)::text, ('Asma'::character varying)::text, ('Artritis'::character varying)::text, ('MalformacionCongenita'::character varying)::text, ('VIH/SIDA'::character varying)::text, ('Sifilis/ITS'::character varying)::text, ('Tuberculosis'::character varying)::text, ('Alergia'::character varying)::text, ('Diabetes'::character varying)::text, ('Desnutricion'::character varying)::text, ('Obesidad'::character varying)::text, ('Gastropatia'::character varying)::text, ('InsuficienciaRenal'::character varying)::text]))),
    CONSTRAINT familiar CHECK (((familiar)::text = ANY (ARRAY[('Padre'::character varying)::text, ('Madre'::character varying)::text, ('Hermanos'::character varying)::text, ('Abuelos'::character varying)::text, ('Otros'::character varying)::text])))
);


ALTER TABLE public.antecedentefamiliar OWNER TO postgres;

--
-- TOC entry 171 (class 1259 OID 16455)
-- Name: consulta; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE consulta (
    fecha date NOT NULL,
    ficha integer NOT NULL,
    nrohistoria integer NOT NULL,
    motivoconsultayenfermedadactual character varying NOT NULL,
    hallazgosobjetivos character varying NOT NULL,
    apreciaciondiagnostica character varying NOT NULL,
    plandiagnostico character varying NOT NULL,
    tratamiento character varying NOT NULL,
    observaciones character varying NOT NULL
);


ALTER TABLE public.consulta OWNER TO postgres;

--
-- TOC entry 172 (class 1259 OID 16461)
-- Name: examenfisico; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE examenfisico (
    nrohistoria integer NOT NULL,
    fecha date NOT NULL,
    edad integer NOT NULL,
    peso real NOT NULL,
    talla real NOT NULL,
    perimetrocefalico real NOT NULL,
    presionarterialsistolica integer NOT NULL,
    presionarterialdiastolica integer NOT NULL,
    temperatura real NOT NULL,
    frecuenciarespiratoria integer NOT NULL,
    pulso integer NOT NULL,
    perimetrocintura real NOT NULL,
    perimetromediobrazo real NOT NULL,
    desarrollopsicomotor character varying NOT NULL,
    desarrollointelectual character varying NOT NULL,
    cabeza character varying NOT NULL,
    fontanelas character varying NOT NULL,
    cuello character varying NOT NULL,
    oidos character varying NOT NULL,
    ojos character varying NOT NULL,
    nariz character varying NOT NULL,
    boca character varying NOT NULL,
    garganta character varying NOT NULL,
    cardiovascular character varying NOT NULL,
    respiratorio character varying NOT NULL,
    abdomen character varying NOT NULL,
    genitales character varying NOT NULL,
    maduracionsexual character varying NOT NULL,
    tacto character varying NOT NULL,
    urinario character varying NOT NULL,
    huesos_articulaciones character varying NOT NULL,
    extremidades character varying NOT NULL,
    neurologico_psiquico character varying NOT NULL,
    gangliolinfatico character varying NOT NULL,
    piel character varying NOT NULL,
    ectoparasitosis character varying NOT NULL,
    paralitosisintestinal character varying NOT NULL,
    discapacidad character varying NOT NULL,
    observaciones character varying NOT NULL,
    CONSTRAINT normalpatologia CHECK (((((((((((((((((((((((((((desarrollopsicomotor)::text = ANY (ARRAY[('Normal'::character varying)::text, ('Patologia'::character varying)::text])) AND ((desarrollointelectual)::text = ANY (ARRAY[('Normal'::character varying)::text, ('Patologia'::character varying)::text]))) AND ((cabeza)::text = ANY (ARRAY[('Normal'::character varying)::text, ('Patologia'::character varying)::text]))) AND ('Fontanelas'::text = ANY (ARRAY[('Normal'::character varying)::text, ('Patologia'::character varying)::text]))) AND ((cuello)::text = ANY (ARRAY[('Normal'::character varying)::text, ('Patologia'::character varying)::text]))) AND ((oidos)::text = ANY (ARRAY[('Normal'::character varying)::text, ('Patologia'::character varying)::text]))) AND ((ojos)::text = ANY (ARRAY[('Normal'::character varying)::text, ('Patologia'::character varying)::text]))) AND ((nariz)::text = ANY (ARRAY[('Normal'::character varying)::text, ('Patologia'::character varying)::text]))) AND ((boca)::text = ANY (ARRAY[('Normal'::character varying)::text, ('Patologia'::character varying)::text]))) AND ((garganta)::text = ANY (ARRAY[('Normal'::character varying)::text, ('Patologia'::character varying)::text]))) AND ((cardiovascular)::text = ANY (ARRAY[('Normal'::character varying)::text, ('Patologia'::character varying)::text]))) AND ((respiratorio)::text = ANY (ARRAY[('Normal'::character varying)::text, ('Patologia'::character varying)::text]))) AND ((abdomen)::text = ANY (ARRAY[('Normal'::character varying)::text, ('Patologia'::character varying)::text]))) AND ((genitales)::text = ANY (ARRAY[('Normal'::character varying)::text, ('Patologia'::character varying)::text]))) AND ((maduracionsexual)::text = ANY (ARRAY[('Normal'::character varying)::text, ('Patologia'::character varying)::text]))) AND ((tacto)::text = ANY (ARRAY[('Normal'::character varying)::text, ('Patologia'::character varying)::text]))) AND ((urinario)::text = ANY (ARRAY[('Normal'::character varying)::text, ('Patologia'::character varying)::text]))) AND ((huesos_articulaciones)::text = ANY (ARRAY[('Normal'::character varying)::text, ('Patologia'::character varying)::text]))) AND ((extremidades)::text = ANY (ARRAY[('Normal'::character varying)::text, ('Patologia'::character varying)::text]))) AND ((neurologico_psiquico)::text = ANY (ARRAY[('Normal'::character varying)::text, ('Patologia'::character varying)::text]))) AND ((gangliolinfatico)::text = ANY (ARRAY[('Normal'::character varying)::text, ('Patologia'::character varying)::text]))) AND ((piel)::text = ANY (ARRAY[('Normal'::character varying)::text, ('Patologia'::character varying)::text]))) AND ((ectoparasitosis)::text = ANY (ARRAY[('Normal'::character varying)::text, ('Patologia'::character varying)::text]))) AND ((paralitosisintestinal)::text = ANY (ARRAY[('Normal'::character varying)::text, ('Patologia'::character varying)::text]))) AND ((discapacidad)::text = ANY (ARRAY[('Normal'::character varying)::text, ('Patologia'::character varying)::text]))))
);


ALTER TABLE public.examenfisico OWNER TO postgres;

--
-- TOC entry 173 (class 1259 OID 16469)
-- Name: examenlaboratorio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE examenlaboratorio (
    nrohistoria integer NOT NULL,
    fecha date NOT NULL,
    tipoexamen character varying NOT NULL,
    resultado character varying NOT NULL,
    CONSTRAINT tipoexamen CHECK (((tipoexamen)::text = ANY (ARRAY[('Hemoglobina'::character varying)::text, ('Hematocrito'::character varying)::text, ('Globulos Blancos'::character varying)::text, ('Plaquetas'::character varying)::text, ('Glicemia (ayunas)'::character varying)::text, ('Glicemia Post Pandrial'::character varying)::text, ('Hemoglobina Glucosilada'::character varying)::text, ('Colesterol'::character varying)::text, ('HDL'::character varying)::text, ('LDL'::character varying)::text, ('Trigliceridos'::character varying)::text, ('VDRL'::character varying)::text, ('VIH'::character varying)::text, ('Orina'::character varying)::text, ('Heces'::character varying)::text, ('Creatinina'::character varying)::text, ('Proteinuria'::character varying)::text, ('BK'::character varying)::text, ('PPD'::character varying)::text, ('Serologia Chagas'::character varying)::text, ('Leishmaniarsis'::character varying)::text, ('Gota Gruesa'::character varying)::text, ('Serologia Dengue'::character varying)::text, ('PCO'::character varying)::text, ('Otros'::character varying)::text])))
);


ALTER TABLE public.examenlaboratorio OWNER TO postgres;

--
-- TOC entry 176 (class 1259 OID 16489)
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE usuario (
    ficha integer NOT NULL,
    nacionalidad character varying NOT NULL,
    cedula bigint NOT NULL,
    pasaporte bigint NOT NULL,
    primerapellido character varying NOT NULL,
    segundoapellido character varying NOT NULL,
    primernombre character varying NOT NULL,
    segundonombre character varying NOT NULL,
    fechanacimiento date NOT NULL,
    lugarnacimiento character varying NOT NULL,
    fechaingreso date NOT NULL,
    especialidad character varying NOT NULL,
    nombreusuario character varying NOT NULL,
    clave character varying NOT NULL,
    tipousuario character varying NOT NULL,
    estadoresidencia character varying NOT NULL,
    ciudadresidencia character varying NOT NULL,
    municipioresidencia character varying NOT NULL,
    parroquiaresidencia character varying NOT NULL,
    urbanizacion_sector_zonaindustrial character varying NOT NULL,
    avenida_carrera_esquina character varying NOT NULL,
    edificio_quinta_galpon character varying NOT NULL,
    piso_planta_local character varying NOT NULL,
    codigopostal integer NOT NULL,
    otradireccion character varying NOT NULL,
    tlfmovil bigint NOT NULL,
    tlfcasa bigint NOT NULL,
    correoelectronico character varying NOT NULL,
    CONSTRAINT nacionalidad CHECK (((nacionalidad)::text = ANY (ARRAY[('V'::character varying)::text, ('E'::character varying)::text]))),
    CONSTRAINT tipousuario CHECK (((tipousuario)::text = ANY (ARRAY[('Administrador'::character varying)::text, ('Medico'::character varying)::text, ('Enfermera'::character varying)::text])))
);


ALTER TABLE public.usuario OWNER TO postgres;

--
-- TOC entry 177 (class 1259 OID 16497)
-- Name: ficha_usuario; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ficha_usuario
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ficha_usuario OWNER TO postgres;

--
-- TOC entry 2007 (class 0 OID 0)
-- Dependencies: 177
-- Name: ficha_usuario; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ficha_usuario OWNED BY usuario.ficha;


--
-- TOC entry 174 (class 1259 OID 16476)
-- Name: paciente; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE paciente (
    nrohistoria integer NOT NULL,
    nacionalidad character varying NOT NULL,
    cedula bigint NOT NULL,
    pasaporte bigint NOT NULL,
    primerapellido character varying NOT NULL,
    segundoapellido character varying NOT NULL,
    primernombre character varying NOT NULL,
    segundonombre character varying NOT NULL,
    etnia character varying NOT NULL,
    fechadenacimiento date NOT NULL,
    sexo character varying NOT NULL,
    paisnacimiento character varying NOT NULL,
    situacionconyugal character varying NOT NULL,
    analfabeta boolean NOT NULL,
    educacion character varying NOT NULL,
    profesion character varying NOT NULL,
    ocupacion character varying NOT NULL,
    seguridadsocial boolean NOT NULL,
    correoelectronico character varying NOT NULL,
    estadoreside character varying NOT NULL,
    ciudadreside character varying NOT NULL,
    municipioreside character varying NOT NULL,
    parroquiareside character varying NOT NULL,
    localidadreside character varying NOT NULL,
    urbanizacion_sector_zonaindustrial character varying NOT NULL,
    avenida_carrera_esquina character varying NOT NULL,
    edificio_quinta_galpon character varying NOT NULL,
    piso_planta_local character varying NOT NULL,
    codigopostal integer NOT NULL,
    puntoreferencia character varying NOT NULL,
    tlfdomicilio bigint NOT NULL,
    tlfmovil bigint NOT NULL,
    carnetprenatal character varying NOT NULL,
    nroconsultasprenatal integer NOT NULL,
    nombremadre character varying NOT NULL,
    nombrepadre character varying NOT NULL,
    trastornosembarazo boolean NOT NULL,
    embarazoatermino boolean NOT NULL,
    partounicoespontaneo boolean NOT NULL,
    partoforceps boolean NOT NULL,
    compliacionesparto boolean NOT NULL,
    complicacionpuerperio boolean NOT NULL,
    trastornosreciennacido boolean NOT NULL,
    reanimacion boolean NOT NULL,
    pesoalnacer real NOT NULL,
    tallaalnacer real NOT NULL,
    perimetrocefalico real NOT NULL,
    lactanciaexclusiva integer NOT NULL,
    lactanciamixta integer NOT NULL,
    ablactacion integer NOT NULL,
    egresoreciennacidopatologico boolean NOT NULL,
    asfixia boolean NOT NULL,
    egresoreciennacidosano boolean NOT NULL,
    telarquia integer NOT NULL,
    pubarquia integer NOT NULL,
    menarquia integer NOT NULL,
    iniciocrecimientotesticular integer NOT NULL,
    ciclomenstrual integer NOT NULL,
    primerarelacionsexual integer NOT NULL,
    frecuenciarelacionessexualesmes integer NOT NULL,
    numparejasultimoanio integer NOT NULL,
    relsexualsatisfactoria boolean NOT NULL,
    anticoncepcion boolean NOT NULL,
    aco boolean NOT NULL,
    diu boolean NOT NULL,
    otroanticonceptivo character varying NOT NULL,
    numerogestas integer NOT NULL,
    numeropartos integer NOT NULL,
    numerocesareas integer NOT NULL,
    numeroabortos integer NOT NULL,
    legradouterino boolean NOT NULL,
    menopausia_andropausia boolean NOT NULL,
    otrosantecedentessexuales character varying NOT NULL,
    fuma boolean NOT NULL,
    desdecuandofuma integer NOT NULL,
    cigarrillosdia integer NOT NULL,
    alcohol boolean NOT NULL,
    alcoholsemana integer NOT NULL,
    drogasilicitas boolean NOT NULL,
    actividadfisica boolean NOT NULL,
    sedentarismo boolean NOT NULL,
    manejoestres boolean NOT NULL,
    otrosestilovida character varying NOT NULL,
    tumorbenigno boolean NOT NULL,
    tumormaligno boolean NOT NULL,
    enferuptivas boolean NOT NULL,
    its boolean NOT NULL,
    meningitis boolean NOT NULL,
    chagas boolean NOT NULL,
    tuberculosis boolean NOT NULL,
    dengue boolean NOT NULL,
    hansen boolean NOT NULL,
    leishmaniasis boolean NOT NULL,
    leptospirosis boolean NOT NULL,
    malaria boolean NOT NULL,
    desnutricion boolean NOT NULL,
    diabetes boolean NOT NULL,
    dislipidemias boolean NOT NULL,
    obesidad boolean NOT NULL,
    trastornoapetito boolean NOT NULL,
    enuresis boolean NOT NULL,
    chupadedo boolean NOT NULL,
    onicofagia boolean NOT NULL,
    trastornollanto boolean NOT NULL,
    htasistemica boolean NOT NULL,
    tromboembolismo boolean NOT NULL,
    varices boolean NOT NULL,
    cardiopatia boolean NOT NULL,
    asma boolean NOT NULL,
    neumonia boolean NOT NULL,
    gastroenteropatias boolean NOT NULL,
    hepatopatias boolean NOT NULL,
    trastornosdeevacuacion boolean NOT NULL,
    colagenopatias boolean NOT NULL,
    artritis boolean NOT NULL,
    trastornosmiccionales boolean NOT NULL,
    enfermedadrenal boolean NOT NULL,
    alergias boolean NOT NULL,
    trastornossuenio boolean NOT NULL,
    violenciapsicologica boolean NOT NULL,
    violenciafisica boolean NOT NULL,
    violenciasexual boolean NOT NULL,
    accidentes boolean NOT NULL,
    otraspatologias character varying NOT NULL,
    gruposanguineo character varying NOT NULL,
    hospitalizacion boolean NOT NULL,
    intervencionquirurgica boolean NOT NULL,
    observaciones character varying NOT NULL,
    cabeza integer NOT NULL,
    social integer NOT NULL,
    sesento integer NOT NULL,
    gateo integer NOT NULL,
    separo integer NOT NULL,
    camino integer NOT NULL,
    comio integer NOT NULL,
    palabras integer NOT NULL,
    controlesfintervesical integer NOT NULL,
    controlesfinteranal integer NOT NULL,
    ficha integer NOT NULL,
    CONSTRAINT educacion CHECK (((educacion)::text = ANY (ARRAY[('Primaria'::character varying)::text, ('Secundaria'::character varying)::text, ('Diversificada'::character varying)::text, ('Media'::character varying)::text, ('Pregrado'::character varying)::text, ('Postgrado'::character varying)::text]))),
    CONSTRAINT gruposanguineo CHECK (((gruposanguineo)::text = ANY (ARRAY[('O-'::character varying)::text, ('O+'::character varying)::text, ('A-'::character varying)::text, ('A+'::character varying)::text, ('B-'::character varying)::text, ('B+'::character varying)::text, ('AB-'::character varying)::text, ('AB+'::character varying)::text]))),
    CONSTRAINT nacionalidad CHECK (((nacionalidad)::text = ANY (ARRAY[('V'::character varying)::text, ('E'::character varying)::text]))),
    CONSTRAINT sexo CHECK (((sexo)::text = ANY (ARRAY[('Masculino'::character varying)::text, ('Femenino'::character varying)::text]))),
    CONSTRAINT situacion CHECK (((situacionconyugal)::text = ANY (ARRAY[('Soltero'::character varying)::text, ('Casado'::character varying)::text, ('Viudo'::character varying)::text, ('Divorciado'::character varying)::text])))
);


ALTER TABLE public.paciente OWNER TO postgres;

--
-- TOC entry 175 (class 1259 OID 16487)
-- Name: nrohistoria_paciente; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE nrohistoria_paciente
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.nrohistoria_paciente OWNER TO postgres;

--
-- TOC entry 2008 (class 0 OID 0)
-- Dependencies: 175
-- Name: nrohistoria_paciente; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE nrohistoria_paciente OWNED BY paciente.nrohistoria;


--
-- TOC entry 1855 (class 2604 OID 16499)
-- Name: nrohistoria; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paciente ALTER COLUMN nrohistoria SET DEFAULT nextval('nrohistoria_paciente'::regclass);


--
-- TOC entry 1861 (class 2604 OID 16500)
-- Name: ficha; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario ALTER COLUMN ficha SET DEFAULT nextval('ficha_usuario'::regclass);


--
-- TOC entry 1991 (class 0 OID 16447)
-- Dependencies: 170
-- Data for Name: antecedentefamiliar; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY antecedentefamiliar (familiar, antecedente, nrohistoria) FROM stdin;
\.


--
-- TOC entry 1992 (class 0 OID 16455)
-- Dependencies: 171
-- Data for Name: consulta; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY consulta (fecha, ficha, nrohistoria, motivoconsultayenfermedadactual, hallazgosobjetivos, apreciaciondiagnostica, plandiagnostico, tratamiento, observaciones) FROM stdin;
\.


--
-- TOC entry 1993 (class 0 OID 16461)
-- Dependencies: 172
-- Data for Name: examenfisico; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY examenfisico (nrohistoria, fecha, edad, peso, talla, perimetrocefalico, presionarterialsistolica, presionarterialdiastolica, temperatura, frecuenciarespiratoria, pulso, perimetrocintura, perimetromediobrazo, desarrollopsicomotor, desarrollointelectual, cabeza, fontanelas, cuello, oidos, ojos, nariz, boca, garganta, cardiovascular, respiratorio, abdomen, genitales, maduracionsexual, tacto, urinario, huesos_articulaciones, extremidades, neurologico_psiquico, gangliolinfatico, piel, ectoparasitosis, paralitosisintestinal, discapacidad, observaciones) FROM stdin;
\.


--
-- TOC entry 1994 (class 0 OID 16469)
-- Dependencies: 173
-- Data for Name: examenlaboratorio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY examenlaboratorio (nrohistoria, fecha, tipoexamen, resultado) FROM stdin;
\.


--
-- TOC entry 2009 (class 0 OID 0)
-- Dependencies: 177
-- Name: ficha_usuario; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ficha_usuario', 2, true);


--
-- TOC entry 2010 (class 0 OID 0)
-- Dependencies: 175
-- Name: nrohistoria_paciente; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('nrohistoria_paciente', 1, false);


--
-- TOC entry 1995 (class 0 OID 16476)
-- Dependencies: 174
-- Data for Name: paciente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY paciente (nrohistoria, nacionalidad, cedula, pasaporte, primerapellido, segundoapellido, primernombre, segundonombre, etnia, fechadenacimiento, sexo, paisnacimiento, situacionconyugal, analfabeta, educacion, profesion, ocupacion, seguridadsocial, correoelectronico, estadoreside, ciudadreside, municipioreside, parroquiareside, localidadreside, urbanizacion_sector_zonaindustrial, avenida_carrera_esquina, edificio_quinta_galpon, piso_planta_local, codigopostal, puntoreferencia, tlfdomicilio, tlfmovil, carnetprenatal, nroconsultasprenatal, nombremadre, nombrepadre, trastornosembarazo, embarazoatermino, partounicoespontaneo, partoforceps, compliacionesparto, complicacionpuerperio, trastornosreciennacido, reanimacion, pesoalnacer, tallaalnacer, perimetrocefalico, lactanciaexclusiva, lactanciamixta, ablactacion, egresoreciennacidopatologico, asfixia, egresoreciennacidosano, telarquia, pubarquia, menarquia, iniciocrecimientotesticular, ciclomenstrual, primerarelacionsexual, frecuenciarelacionessexualesmes, numparejasultimoanio, relsexualsatisfactoria, anticoncepcion, aco, diu, otroanticonceptivo, numerogestas, numeropartos, numerocesareas, numeroabortos, legradouterino, menopausia_andropausia, otrosantecedentessexuales, fuma, desdecuandofuma, cigarrillosdia, alcohol, alcoholsemana, drogasilicitas, actividadfisica, sedentarismo, manejoestres, otrosestilovida, tumorbenigno, tumormaligno, enferuptivas, its, meningitis, chagas, tuberculosis, dengue, hansen, leishmaniasis, leptospirosis, malaria, desnutricion, diabetes, dislipidemias, obesidad, trastornoapetito, enuresis, chupadedo, onicofagia, trastornollanto, htasistemica, tromboembolismo, varices, cardiopatia, asma, neumonia, gastroenteropatias, hepatopatias, trastornosdeevacuacion, colagenopatias, artritis, trastornosmiccionales, enfermedadrenal, alergias, trastornossuenio, violenciapsicologica, violenciafisica, violenciasexual, accidentes, otraspatologias, gruposanguineo, hospitalizacion, intervencionquirurgica, observaciones, cabeza, social, sesento, gateo, separo, camino, comio, palabras, controlesfintervesical, controlesfinteranal, ficha) FROM stdin;
\.


--
-- TOC entry 1997 (class 0 OID 16489)
-- Dependencies: 176
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY usuario (ficha, nacionalidad, cedula, pasaporte, primerapellido, segundoapellido, primernombre, segundonombre, fechanacimiento, lugarnacimiento, fechaingreso, especialidad, nombreusuario, clave, tipousuario, estadoresidencia, ciudadresidencia, municipioresidencia, parroquiaresidencia, urbanizacion_sector_zonaindustrial, avenida_carrera_esquina, edificio_quinta_galpon, piso_planta_local, codigopostal, otradireccion, tlfmovil, tlfcasa, correoelectronico) FROM stdin;
1	V	20774959	100	Moussa	Magallanes	Moises	David	1993-08-14	Ciudad Bolívar	2013-09-23	Doctor	Mdsse	ed2b1f468c5f915f3f1cf75d7068baae	Administrador	Bolívar	Ciudad Bolívar	Heres	Vista Hermosa	Andres Eloy Blanco	Mara	Soraya	Casa	8001	Ninguna	4148790654	2856546960	moises_1_2_3@hotmail.com
2	V	5646054	5495	jhg	jhg	jhg	jhg	1990-08-20	kjh	1990-08-20	knhjj	Jose	7815696ecbf1c96e6894b779456d330e	Administrador	hgv	hgv	hgv	hgv	hgv	hgv	hgv	hgv	165	jhbjh	654	654	vhgv
\.


--
-- TOC entry 1865 (class 2606 OID 16502)
-- Name: claveantecedentefamiliar; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY antecedentefamiliar
    ADD CONSTRAINT claveantecedentefamiliar PRIMARY KEY (familiar, antecedente, nrohistoria);


--
-- TOC entry 1867 (class 2606 OID 16504)
-- Name: claveconsulta; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY consulta
    ADD CONSTRAINT claveconsulta PRIMARY KEY (ficha, nrohistoria, fecha);


--
-- TOC entry 1869 (class 2606 OID 16506)
-- Name: claveexamenfisico; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY examenfisico
    ADD CONSTRAINT claveexamenfisico PRIMARY KEY (nrohistoria, fecha);


--
-- TOC entry 1871 (class 2606 OID 16508)
-- Name: claveexamenlab; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY examenlaboratorio
    ADD CONSTRAINT claveexamenlab PRIMARY KEY (nrohistoria, fecha, tipoexamen);


--
-- TOC entry 1875 (class 2606 OID 16510)
-- Name: claveusuario; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT claveusuario PRIMARY KEY (ficha);


--
-- TOC entry 1873 (class 2606 OID 16512)
-- Name: nrohistoria; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY paciente
    ADD CONSTRAINT nrohistoria PRIMARY KEY (nrohistoria);


--
-- TOC entry 1877 (class 2606 OID 16514)
-- Name: unico; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT unico UNIQUE (nombreusuario);


--
-- TOC entry 1880 (class 2606 OID 16515)
-- Name: da; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY consulta
    ADD CONSTRAINT da FOREIGN KEY (ficha) REFERENCES usuario(ficha);


--
-- TOC entry 1882 (class 2606 OID 16520)
-- Name: presenta; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY examenlaboratorio
    ADD CONSTRAINT presenta FOREIGN KEY (nrohistoria) REFERENCES paciente(nrohistoria);


--
-- TOC entry 1879 (class 2606 OID 16525)
-- Name: recibe; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY consulta
    ADD CONSTRAINT recibe FOREIGN KEY (nrohistoria) REFERENCES paciente(nrohistoria);


--
-- TOC entry 1883 (class 2606 OID 16530)
-- Name: registra; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY paciente
    ADD CONSTRAINT registra FOREIGN KEY (ficha) REFERENCES usuario(ficha);


--
-- TOC entry 1881 (class 2606 OID 16535)
-- Name: selerealiza; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY examenfisico
    ADD CONSTRAINT selerealiza FOREIGN KEY (nrohistoria) REFERENCES paciente(nrohistoria);


--
-- TOC entry 1878 (class 2606 OID 16540)
-- Name: tiene; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY antecedentefamiliar
    ADD CONSTRAINT tiene FOREIGN KEY (nrohistoria) REFERENCES paciente(nrohistoria);


--
-- TOC entry 2005 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2013-10-21 10:13:14

--
-- PostgreSQL database dump complete
--

