--
-- ER/Studio 8.0 SQL Code Generation
-- Company :      Elfec
-- Project :      ModeloEntidadRelación.dm1
-- Author :       Diego
--
-- Date Created : Wednesday, December 24, 2014 11:51:23
-- Target DBMS : PostgreSQL 8.0
--

-- 
-- TABLE: accounts 
--

CREATE TABLE accounts(
    id                SERIAL UNIQUE        NOT NULL,
    client_id         integer           NOT NULL,
    account_number    varchar(20)    NOT NULL,
    nus               varchar(10)    NOT NULL,
    status            integer           NOT NULL,
    insert_date       timestamp      NOT NULL,
    update_date       timestamp,
    CONSTRAINT "PK1" PRIMARY KEY (id, client_id)
)
;



-- 
-- TABLE: clients 
--

CREATE TABLE clients(
    id             SERIAL UNIQUE        NOT NULL,
    gmail          varchar(50)    NOT NULL,
    status         integer           NOT NULL,
    insert_date    timestamp      NOT NULL,
    update_date    timestamp,
    CONSTRAINT "PK1_2" PRIMARY KEY (id),
    CONSTRAINT gmail_index  UNIQUE (gmail)
)
;



-- 
-- TABLE: devices 
--

CREATE TABLE devices(
    id             SERIAL UNIQUE          NOT NULL,
    client_id      integer             NOT NULL,
    gcm_token      varchar(4096)    NOT NULL,
    imei           varchar(16)      NOT NULL,
    brand          varchar(25)      NOT NULL,
    model          varchar(50)      NOT NULL,
    status         integer             NOT NULL,
    insert_date    timestamp        NOT NULL,
    update_date    timestamp,
    CONSTRAINT "PK1_1" PRIMARY KEY (id, client_id)
)
;



-- 
-- TABLE: mobile_phones 
--

CREATE TABLE mobile_phones(
    id             SERIAL UNIQUE        NOT NULL,
    client_id      integer           NOT NULL,
    number         varchar(18)    NOT NULL,
    status         integer           NOT NULL,
    insert_date    timestamp      NOT NULL,
    update_date    timestamp,
    CONSTRAINT "PK1_1_1" PRIMARY KEY (id, client_id)
)
;

--
-- TABLE: pay_points
--

CREATE TABLE pay_points(
    id                SERIAL UNIQUE      NOT NULL,
    address            varchar(100)      NOT NULL,
    phone              varchar(50)       NOT NULL,
    start_attention    varchar(10),
    end_attention      varchar(10),
    latitude           decimal(22, 20)   NOT NULL,
    longitude          decimal(22, 20)   NOT NULL,
    status         integer           NOT NULL,
    insert_date    timestamp      NOT NULL,
    update_date    timestamp,
    CONSTRAINT "PK12" PRIMARY KEY (id)
)
;


-- 
-- INDEX: account_number_index 
--

CREATE INDEX account_number_index ON accounts(account_number)
;
-- 
-- INDEX: nus_index 
--

CREATE INDEX nus_index ON accounts(nus)
;
-- 
-- INDEX: gcm_token_index 
--

CREATE INDEX gcm_token_index ON devices(gcm_token)
;
-- 
-- INDEX: imei_index 
--

CREATE INDEX imei_index ON devices(imei)
;
-- 
-- INDEX: number_index 
--

CREATE INDEX number_index ON mobile_phones(number)
;
-- 
-- TABLE: accounts 
--

ALTER TABLE accounts ADD CONSTRAINT "Refclients1" 
    FOREIGN KEY (client_id)
    REFERENCES clients(id)
;


-- 
-- TABLE: devices 
--

ALTER TABLE devices ADD CONSTRAINT "Refclients2" 
    FOREIGN KEY (client_id)
    REFERENCES clients(id)
;


-- 
-- TABLE: mobile_phones 
--

ALTER TABLE mobile_phones ADD CONSTRAINT "Refclients5" 
    FOREIGN KEY (client_id)
    REFERENCES clients(id)
;


