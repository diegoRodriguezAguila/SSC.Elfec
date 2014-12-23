--
-- ER/Studio 8.0 SQL Code Generation
-- Company :      Elfec
-- Project :      ModeloEntidadRelación.dm1
-- Author :       Diego
--
-- Date Created : Tuesday, December 23, 2014 09:07:00
-- Target DBMS : PostgreSQL 8.0
--

-- 
-- TABLE: "Account" 
--

CREATE TABLE "Account"(
    "Id"             numeric(10, 0)    NOT NULL,
    "UserId"         numeric(10, 0)    NOT NULL,
    "AccountNumber"  varchar(12)       NOT NULL,
    "NUS"            varchar(15)       NOT NULL,
    "Status"         int4              NOT NULL,
    "InsertDate"     timestamp         NOT NULL,
    "UpdateDate"     timestamp,
    CONSTRAINT "PK1" PRIMARY KEY ("Id", "UserId"),
    CONSTRAINT "NUS_Index"  UNIQUE ("Id")
)
;



-- 
-- TABLE: "Device" 
--

CREATE TABLE "Device"(
    "Id"          numeric(10, 0)    NOT NULL,
    "UserId"      numeric(10, 0)    NOT NULL,
    "GCMToken"    varchar(4096)     NOT NULL,
    "IMEI"        varchar(16)       NOT NULL,
    "Brand"       varchar(25)       NOT NULL,
    "Model"       varchar(50)       NOT NULL,
    "Status"      int4              NOT NULL,
    "InsertDate"  timestamp         NOT NULL,
    "UpdateDate"  timestamp,
    CONSTRAINT "PK1_1" PRIMARY KEY ("Id", "UserId"),
    CONSTRAINT "IMEI_Index"  UNIQUE ("IMEI")
)
;



-- 
-- TABLE: "MobilePhone" 
--

CREATE TABLE "MobilePhone"(
    "Id"          numeric(10, 0)    NOT NULL,
    "UserId"      numeric(10, 0)    NOT NULL,
    "Number"      varchar(18)       NOT NULL,
    "Status"      int4              NOT NULL,
    "InsertDate"  timestamp         NOT NULL,
    "UpdateDate"  timestamp,
    CONSTRAINT "PK1_1_1" PRIMARY KEY ("Id", "UserId"),
    CONSTRAINT "Number_Index"  UNIQUE ("Id")
)
;



-- 
-- TABLE: "User" 
--

CREATE TABLE "User"(
    "Id"          numeric(10, 0)    NOT NULL,
    "Gmail"       varchar(50)       NOT NULL,
    "Status"      int4              NOT NULL,
    "InsertDate"  timestamp         NOT NULL,
    "UpdateDate"  timestamp,
    CONSTRAINT "PK1_2" PRIMARY KEY ("Id"),
    CONSTRAINT "Gmail_Index"  UNIQUE ("Gmail")
)
;



-- 
-- TABLE: "Account" 
--

ALTER TABLE "Account" ADD CONSTRAINT "RefUser1" 
    FOREIGN KEY ("UserId")
    REFERENCES "User"("Id")
;


-- 
-- TABLE: "Device" 
--

ALTER TABLE "Device" ADD CONSTRAINT "RefUser2" 
    FOREIGN KEY ("UserId")
    REFERENCES "User"("Id")
;


-- 
-- TABLE: "MobilePhone" 
--

ALTER TABLE "MobilePhone" ADD CONSTRAINT "RefUser5" 
    FOREIGN KEY ("UserId")
    REFERENCES "User"("Id")
;


