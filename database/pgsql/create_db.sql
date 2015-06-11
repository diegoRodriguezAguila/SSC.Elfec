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
-- TABLE: contacts
--

CREATE TABLE contacts(
    id             SERIAL UNIQUE         NOT NULL,
    phone          varchar(15)     NOT NULL,
    address        varchar(100)    NOT NULL,
    email          varchar(100)    NOT NULL,
    webpage        varchar(100)    NOT NULL,
    facebook       varchar(100)    NOT NULL,
    facebook_id    varchar(20)     NOT NULL,
    status         integer            NOT NULL,
    insert_date    timestamp       NOT NULL,
    update_date    timestamp,
    CONSTRAINT "PK1_2_2" PRIMARY KEY (id)
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
-- TABLE: location_points
--

CREATE TABLE location_points(
    id                SERIAL UNIQUE      NOT NULL,
    institution_name   varchar(50)       NOT NULL,
    address            varchar(100)      NOT NULL,
    phone              varchar(50),
    start_attention    varchar(25),
    end_attention      varchar(100),
    latitude           decimal(22, 20)   NOT NULL,
    longitude          decimal(22, 20)   NOT NULL,
    type            integer               NOT NULL,
    status         integer           NOT NULL,
    insert_date    timestamp      NOT NULL,
    update_date    timestamp,
    CONSTRAINT "PK12" PRIMARY KEY (id)
)
;

--
-- TABLE: notification_messages
--

CREATE TABLE notification_messages(
  id                    SERIAL UNIQUE         NOT NULL,
  sender_user           varchar(50)     NOT NULL,
  message               varchar(500)    NOT NULL,
  insert_date           timestamp       NOT NULL,
  outage_case_number    varchar(15)     NOT NULL,
  outage_type           integer            NOT NULL,
  CONSTRAINT "PK14" PRIMARY KEY (id)
)
;
COMMENT ON COLUMN notification_messages.outage_type IS '0=Programado, 1=No programado, 2=Por Mora';
COMMENT ON COLUMN notification_messages.outage_case_number IS 'cuando el número de caso es 0 es un mensaje de corte por mora';
--
-- TABLE: notification_details
--

CREATE TABLE notification_details(
  id                 SERIAL UNIQUE        NOT NULL,
  notification_id    integer           NOT NULL,
  nus                varchar(15)    NOT NULL,
  insert_date        timestamp,
  CONSTRAINT "PK13" PRIMARY KEY (id, notification_id)
)
;

--
-- TABLE: application
--

CREATE TABLE application(
  id                integer         NOT NULL,
  version_code      int4            NOT NULL,
  signature_hash    varchar(256)    NOT NULL,
  salt              varchar(128)    NOT NULL,
  status            int4            NOT NULL,
  CONSTRAINT "PK15" PRIMARY KEY (id)
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
-- INDEX: number_index
--

CREATE INDEX number_index ON mobile_phones(number)
;

--
-- INDEX: notification_id_index
--

CREATE INDEX notification_id_index ON notification_details(notification_id)
;

--
-- INDEX: application_id_index
--

CREATE INDEX application_id_index ON application(id)
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

--
-- TABLE: notification_details
--

ALTER TABLE notification_details ADD CONSTRAINT "Refnotification_messages7"
FOREIGN KEY (notification_id)
REFERENCES notification_messages(id)
;
