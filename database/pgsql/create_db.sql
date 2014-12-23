--
-- ER/Studio 8.0 SQL Code Generation
-- Company :      Elfec
-- Project :      ModeloEntidadRelación.dm1
-- Author :       Diego
--
-- Date Created : Tuesday, December 23, 2014 15:00:42
-- Target DBMS : PostgreSQL 8.0
--

-- 
-- TABLE: Account 
--

CREATE TABLE Account(
    Id             SERIAL UNIQUE    NOT NULL,
    ClientId       integer    NOT NULL,
    AccountNumber  varchar(12)       NOT NULL,
    NUS            varchar(15)       NOT NULL,
    Status         int4              NOT NULL,
    InsertDate     timestamp         NOT NULL,
    UpdateDate     timestamp,
    CONSTRAINT PK1 PRIMARY KEY (Id, ClientId)
)
;



-- 
-- TABLE: Client 
--

CREATE TABLE Client(
    Id          SERIAL UNIQUE    NOT NULL,
    Gmail       varchar(50)       NOT NULL,
    Status      int4              NOT NULL,
    InsertDate  timestamp         NOT NULL,
    UpdateDate  timestamp,
    CONSTRAINT PK1_2 PRIMARY KEY (Id),
    CONSTRAINT Gmail_Index  UNIQUE (Gmail)
)
;



-- 
-- TABLE: Device 
--

CREATE TABLE Device(
    Id           SERIAL UNIQUE    NOT NULL,
    ClientId    integer    NOT NULL,
    GCMToken    varchar(4096)     NOT NULL,
    IMEI        varchar(16)       NOT NULL,
    Brand       varchar(25)       NOT NULL,
    Model       varchar(50)       NOT NULL,
    Status      int4              NOT NULL,
    InsertDate  timestamp         NOT NULL,
    UpdateDate  timestamp,
    CONSTRAINT PK1_1 PRIMARY KEY (Id, ClientId)
)
;



-- 
-- TABLE: MobilePhone 
--

CREATE TABLE MobilePhone(
    Id          SERIAL UNIQUE    NOT NULL,
    ClientId    integer    NOT NULL,
    Number      varchar(18)       NOT NULL,
    Status      int4              NOT NULL,
    InsertDate  timestamp         NOT NULL,
    UpdateDate  timestamp,
    CONSTRAINT PK1_1_1 PRIMARY KEY (Id, ClientId)
)
;



-- 
-- INDEX: NUS_Index 
--

CREATE UNIQUE INDEX NUS_Index ON Account(NUS)
;
-- 
-- INDEX: IMEI_Index 
--

CREATE UNIQUE INDEX IMEI_Index ON Device(IMEI)
;
-- 
-- INDEX: Number_Index 
--

CREATE UNIQUE INDEX Number_Index ON MobilePhone(Number)
;
-- 
-- TABLE: Account 
--

ALTER TABLE Account ADD CONSTRAINT RefClient1 
    FOREIGN KEY (ClientId)
    REFERENCES Client(Id)
;


-- 
-- TABLE: Device 
--

ALTER TABLE Device ADD CONSTRAINT RefClient2 
    FOREIGN KEY (ClientId)
    REFERENCES Client(Id)
;


-- 
-- TABLE: MobilePhone 
--

ALTER TABLE MobilePhone ADD CONSTRAINT RefClient5 
    FOREIGN KEY (ClientId)
    REFERENCES Client(Id)
;


