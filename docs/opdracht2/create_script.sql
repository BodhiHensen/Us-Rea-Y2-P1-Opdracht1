-- Step: 01
-- Goal: Create a new database laravel
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            30-09-2026      Student                     Opdracht 2 - Leveranciers & Producten
-- **********************************************************************************/

-- Check if the database exists
DROP DATABASE IF EXISTS `laravel`;

-- Create a new Database
CREATE DATABASE IF NOT EXISTS `laravel`;

-- Use database laravel
USE `laravel`;


-- ==================================================================================
-- STAMTABELLEN (Tabellen met alleen een Primary Key + extra kolommen)
-- ==================================================================================

-- Step: 02
-- Goal: Create table Product
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            30-09-2026      Student                     New
-- **********************************************************************************/

DROP TABLE IF EXISTS Product;

CREATE TABLE IF NOT EXISTS Product
(
    Id                  SMALLINT        UNSIGNED        NOT NULL    AUTO_INCREMENT
   ,Naam                VARCHAR(50)                     NOT NULL
   ,Barcode             VARCHAR(20)                     NOT NULL
   ,IsActief            BIT                             NOT NULL    DEFAULT 1
   ,Opmerkingen         VARCHAR(255)                        NULL    DEFAULT NULL
   ,DatumAangemaakt     DateTime(6)                     NOT NULL
   ,DatumGewijzigd      DateTime(6)                     NOT NULL

   ,CONSTRAINT      PK_Product_Id   PRIMARY KEY CLUSTERED(Id)
) ENGINE=InnoDB;


-- Step: 03
-- Goal: Fill table Product with data
-- Note: Product Id 10 (Winegums) has IsActief = 0 (Scenario 02: product wordt niet meer gemaakt)
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            30-09-2026      Student                     New
-- **********************************************************************************/

INSERT INTO Product
(
     Naam
    ,Barcode
    ,IsActief
    ,Opmerkingen
    ,DatumAangemaakt
    ,DatumGewijzigd
)
VALUES
     ('Mintnopjes', '8719587231278', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Schoolkrijt', '8719587326713', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Honingdrop', '8719587327836', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Zure Beren', '8719587321441', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Cola Flesjes', '8719587321237', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Turtles', '8719587322245', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Witte Muizen', '8719587328256', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Reuzen Slangen', '8719587325641', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Zoute Rijen', '8719587322739', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Winegums', '8719587327527', 0, 'Wordt niet meer geproduceerd', SYSDATE(6), SYSDATE(6))
    ,('Drop Munten', '8719587322345', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Kruis Drop', '8719587322265', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Zoute Ruitjes', '8719587323256', 1, NULL, SYSDATE(6), SYSDATE(6));


-- Step: 04
-- Goal: Create table Allergeen
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            30-09-2026      Student                     New
-- **********************************************************************************/

DROP TABLE IF EXISTS Allergeen;

CREATE TABLE IF NOT EXISTS Allergeen
(
    Id                  SMALLINT        UNSIGNED        NOT NULL    AUTO_INCREMENT
   ,Naam                VARCHAR(50)                     NOT NULL
   ,Omschrijving        VARCHAR(255)                    NOT NULL
   ,IsActief            BIT                             NOT NULL    DEFAULT 1
   ,Opmerkingen         VARCHAR(255)                        NULL    DEFAULT NULL
   ,DatumAangemaakt     DateTime(6)                     NOT NULL
   ,DatumGewijzigd      DateTime(6)                     NOT NULL

   ,CONSTRAINT      PK_Allergeen_Id   PRIMARY KEY CLUSTERED(Id)
) ENGINE=InnoDB;


-- Step: 05
-- Goal: Fill table Allergeen with data
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            30-09-2026      Student                     New
-- **********************************************************************************/

INSERT INTO Allergeen
(
     Naam
    ,Omschrijving
    ,IsActief
    ,Opmerkingen
    ,DatumAangemaakt
    ,DatumGewijzigd
)
VALUES
     ('Gluten', 'Dit product bevat gluten', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Gelatine', 'Dit product bevat gelatine', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('AZO-Kleurstof', 'Dit product bevat AZO-kleurstoffen', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Lactose', 'Dit product bevat lactose', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Soja', 'Dit product bevat soja', 1, NULL, SYSDATE(6), SYSDATE(6));


-- Step: 06
-- Goal: Create table Leverancier
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            30-09-2026      Student                     New
-- **********************************************************************************/

DROP TABLE IF EXISTS Leverancier;

CREATE TABLE IF NOT EXISTS Leverancier
(
    Id                  SMALLINT        UNSIGNED        NOT NULL    AUTO_INCREMENT
   ,Naam                VARCHAR(50)                     NOT NULL
   ,ContactPersoon      VARCHAR(50)                     NOT NULL
   ,LeverancierNummer   VARCHAR(20)                     NOT NULL
   ,Mobiel              VARCHAR(15)                     NOT NULL
   ,IsActief            BIT                             NOT NULL    DEFAULT 1
   ,Opmerkingen         VARCHAR(255)                        NULL    DEFAULT NULL
   ,DatumAangemaakt     DateTime(6)                     NOT NULL
   ,DatumGewijzigd      DateTime(6)                     NOT NULL

   ,CONSTRAINT      PK_Leverancier_Id   PRIMARY KEY CLUSTERED(Id)
) ENGINE=InnoDB;


-- Step: 07
-- Goal: Fill table Leverancier with data
-- Note: Record 6 (Quality Street) added for Opdracht 2
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            30-09-2026      Student                     New
-- **********************************************************************************/

INSERT INTO Leverancier
(
     Naam
    ,ContactPersoon
    ,LeverancierNummer
    ,Mobiel
    ,IsActief
    ,Opmerkingen
    ,DatumAangemaakt
    ,DatumGewijzigd
)
VALUES
     ('Venco', 'Bert van Linge', 'L1029384719', '06-28493827', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Astra Sweets', 'Jasper del Monte', 'L1029284315', '06-39398734', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Haribo', 'Sven Stalman', 'L1029324748', '06-24383291', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Basset', 'Joyce Stelterberg', 'L1023845773', '06-48293823', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('De Bron', 'Remco Veenstra', 'L1023857736', '06-34291234', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Quality Street', 'Johan Nooij', 'L1029234586', '06-23458456', 1, NULL, SYSDATE(6), SYSDATE(6));


-- ==================================================================================
-- KOPPELTABELLEN (Tabellen met PK + Foreign Keys)
-- ==================================================================================

-- Step: 08
-- Goal: Create table Magazijn
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            30-09-2026      Student                     New
-- **********************************************************************************/

DROP TABLE IF EXISTS Magazijn;

CREATE TABLE IF NOT EXISTS Magazijn
(
    Id                  SMALLINT        UNSIGNED        NOT NULL    AUTO_INCREMENT
   ,ProductId           SMALLINT        UNSIGNED        NOT NULL
   ,VerpakkingsEenheid  DECIMAL(4,1)                    NOT NULL
   ,AantalAanwezig      INT             UNSIGNED            NULL    DEFAULT NULL
   ,IsActief            BIT                             NOT NULL    DEFAULT 1
   ,Opmerkingen         VARCHAR(255)                        NULL    DEFAULT NULL
   ,DatumAangemaakt     DateTime(6)                     NOT NULL
   ,DatumGewijzigd      DateTime(6)                     NOT NULL

   ,CONSTRAINT      PK_Magazijn_Id   PRIMARY KEY CLUSTERED(Id)
   ,CONSTRAINT      FK_Magazijn_ProductId_Product_Id  FOREIGN KEY (ProductId) REFERENCES Product(Id)
) ENGINE=InnoDB;


-- Step: 09
-- Goal: Fill table Magazijn with data
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            30-09-2026      Student                     New
-- **********************************************************************************/

INSERT INTO Magazijn
(
     ProductId
    ,VerpakkingsEenheid
    ,AantalAanwezig
    ,IsActief
    ,Opmerkingen
    ,DatumAangemaakt
    ,DatumGewijzigd
)
VALUES
     (1, 5.0, 453, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(2, 2.5, 400, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(3, 5.0, 1, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(4, 1.0, 800, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(5, 3.0, 234, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(6, 2.0, 345, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(7, 1.0, 795, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(8, 10.0, 233, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(9, 2.5, 123, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(10, 3.0, NULL, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(11, 2.0, 367, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(12, 1.0, 467, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(13, 5.0, 20, 1, NULL, SYSDATE(6), SYSDATE(6));


-- Step: 10
-- Goal: Create table ProductPerAllergeen
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            30-09-2026      Student                     New
-- **********************************************************************************/

DROP TABLE IF EXISTS ProductPerAllergeen;

CREATE TABLE IF NOT EXISTS ProductPerAllergeen
(
    Id                  SMALLINT        UNSIGNED        NOT NULL    AUTO_INCREMENT
   ,ProductId           SMALLINT        UNSIGNED        NOT NULL
   ,AllergeenId         SMALLINT        UNSIGNED        NOT NULL
   ,IsActief            BIT                             NOT NULL    DEFAULT 1
   ,Opmerkingen         VARCHAR(255)                        NULL    DEFAULT NULL
   ,DatumAangemaakt     DateTime(6)                     NOT NULL
   ,DatumGewijzigd      DateTime(6)                     NOT NULL

   ,CONSTRAINT      PK_ProductPerAllergeen_Id   PRIMARY KEY CLUSTERED(Id)
   ,CONSTRAINT      FK_ProductPerAllergeen_ProductId_Product_Id    FOREIGN KEY (ProductId) REFERENCES Product(Id)
   ,CONSTRAINT      FK_ProductPerAllergeen_AllergeenId_Allergeen_Id  FOREIGN KEY (AllergeenId) REFERENCES Allergeen(Id)
) ENGINE=InnoDB;


-- Step: 11
-- Goal: Fill table ProductPerAllergeen with data
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            30-09-2026      Student                     New
-- **********************************************************************************/

INSERT INTO ProductPerAllergeen
(
     ProductId
    ,AllergeenId
    ,IsActief
    ,Opmerkingen
    ,DatumAangemaakt
    ,DatumGewijzigd
)
VALUES
     (1, 2, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(1, 1, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(1, 3, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(3, 4, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(6, 5, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(9, 2, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(9, 5, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(10, 2, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(12, 4, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(13, 1, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(13, 4, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(13, 5, 1, NULL, SYSDATE(6), SYSDATE(6));


-- Step: 12
-- Goal: Create table ProductPerLeverancier
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            30-09-2026      Student                     New
-- **********************************************************************************/

DROP TABLE IF EXISTS ProductPerLeverancier;

CREATE TABLE IF NOT EXISTS ProductPerLeverancier
(
    Id                          SMALLINT        UNSIGNED        NOT NULL    AUTO_INCREMENT
   ,LeverancierId               SMALLINT        UNSIGNED        NOT NULL
   ,ProductId                   SMALLINT        UNSIGNED        NOT NULL
   ,DatumLevering               DATE                            NOT NULL
   ,Aantal                      INT             UNSIGNED        NOT NULL
   ,DatumEerstVolgendeLevering  DATE                                NULL    DEFAULT NULL
   ,IsActief                    BIT                             NOT NULL    DEFAULT 1
   ,Opmerkingen                 VARCHAR(255)                        NULL    DEFAULT NULL
   ,DatumAangemaakt             DateTime(6)                     NOT NULL
   ,DatumGewijzigd              DateTime(6)                     NOT NULL

   ,CONSTRAINT      PK_ProductPerLeverancier_Id   PRIMARY KEY CLUSTERED(Id)
   ,CONSTRAINT      FK_ProductPerLeverancier_LeverancierId_Leverancier_Id  FOREIGN KEY (LeverancierId) REFERENCES Leverancier(Id)
   ,CONSTRAINT      FK_ProductPerLeverancier_ProductId_Product_Id          FOREIGN KEY (ProductId) REFERENCES Product(Id)
) ENGINE=InnoDB;


-- Step: 13
-- Goal: Fill table ProductPerLeverancier with data (Opdracht 2 - November 2024 dates)
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            30-09-2026      Student                     New
-- **********************************************************************************/

INSERT INTO ProductPerLeverancier
(
     LeverancierId
    ,ProductId
    ,DatumLevering
    ,Aantal
    ,DatumEerstVolgendeLevering
    ,IsActief
    ,Opmerkingen
    ,DatumAangemaakt
    ,DatumGewijzigd
)
VALUES
     (1, 1, '2024-11-09', 23, '2024-11-16', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(1, 1, '2024-11-18', 21, '2024-11-25', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(1, 2, '2024-11-09', 12, '2024-11-16', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(1, 3, '2024-11-10', 11, '2024-11-17', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(2, 4, '2024-11-14', 16, '2024-11-21', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(2, 4, '2024-11-21', 23, '2024-11-28', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(2, 5, '2024-11-14', 45, '2024-11-21', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(2, 6, '2024-11-14', 30, '2024-11-21', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(3, 7, '2024-11-12', 12, '2024-11-19', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(3, 7, '2024-11-19', 23, '2024-11-26', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(3, 8, '2024-11-10', 12, '2024-11-17', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(3, 9, '2024-11-11', 1, '2024-11-18', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(4, 10, '2024-11-16', 24, '2024-11-30', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(5, 11, '2024-11-10', 47, '2024-11-17', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(5, 11, '2024-11-19', 60, '2024-11-26', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(5, 12, '2024-11-11', 45, NULL, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(5, 13, '2024-11-12', 23, NULL, 1, NULL, SYSDATE(6), SYSDATE(6));


-- ==================================================================================
-- STORED PROCEDURES (Verplicht voor BE-opdracht 02)
-- ==================================================================================

-- Step: 14
-- Goal: Stored Procedure sp_GetLeveranciersOverzicht
-- Selecteert alle leveranciers gesorteerd op het aantal verschillende geleverde producten (aflopend)
-- **********************************************************************************
DROP PROCEDURE IF EXISTS sp_GetLeveranciersOverzicht;

DELIMITER $$
CREATE PROCEDURE sp_GetLeveranciersOverzicht()
BEGIN
    SELECT 
        L.Id,
        L.Naam,
        L.ContactPersoon,
        L.LeverancierNummer,
        L.Mobiel,
        COUNT(DISTINCT PPL.ProductId) AS AantalVerschillendeProducten
    FROM Leverancier L
    LEFT JOIN ProductPerLeverancier PPL ON L.Id = PPL.LeverancierId
    GROUP BY L.Id, L.Naam, L.ContactPersoon, L.LeverancierNummer, L.Mobiel
    ORDER BY AantalVerschillendeProducten DESC, L.Naam ASC;
END $$
DELIMITER ;


-- Step: 15
-- Goal: Stored Procedure sp_GetGeleverdeProductenByLeverancierId
-- Selecteert de geleverde producten van een leverancier, gesorteerd op Aantal in Magazijn aflopend
-- **********************************************************************************
DROP PROCEDURE IF EXISTS sp_GetGeleverdeProductenByLeverancierId;

DELIMITER $$
CREATE PROCEDURE sp_GetGeleverdeProductenByLeverancierId(IN p_LeverancierId SMALLINT)
BEGIN
    SELECT 
        P.Id AS ProductId,
        P.Naam AS NaamProduct,
        P.IsActief AS IsActief,
        M.AantalAanwezig,
        M.VerpakkingsEenheid,
        MAX(PPL.DatumLevering) AS LaatsteLevering
    FROM ProductPerLeverancier PPL
    INNER JOIN Product P ON PPL.ProductId = P.Id
    LEFT JOIN Magazijn M ON P.Id = M.ProductId
    WHERE PPL.LeverancierId = p_LeverancierId
    GROUP BY P.Id, P.Naam, P.IsActief, M.AantalAanwezig, M.VerpakkingsEenheid
    ORDER BY M.AantalAanwezig DESC;
END $$
DELIMITER ;


-- Step: 16
-- Goal: Stored Procedure sp_AddProductLevering
-- Voegt een nieuwe levering toe en werkt de voorraad in Magazijn bij
-- **********************************************************************************
DROP PROCEDURE IF EXISTS sp_AddProductLevering;

DELIMITER $$
CREATE PROCEDURE sp_AddProductLevering(
    IN p_LeverancierId SMALLINT,
    IN p_ProductId SMALLINT,
    IN p_Aantal INT,
    IN p_DatumEerstVolgendeLevering DATE
)
BEGIN
    -- Voeg levering toe
    INSERT INTO ProductPerLeverancier
    (
        LeverancierId,
        ProductId,
        DatumLevering,
        Aantal,
        DatumEerstVolgendeLevering,
        IsActief,
        DatumAangemaakt,
        DatumGewijzigd
    )
    VALUES
    (
        p_LeverancierId,
        p_ProductId,
        CURDATE(),
        p_Aantal,
        p_DatumEerstVolgendeLevering,
        1,
        SYSDATE(6),
        SYSDATE(6)
    );

    -- Werk voorraad bij in Magazijn
    UPDATE Magazijn
    SET 
        AantalAanwezig = COALESCE(AantalAanwezig, 0) + p_Aantal,
        DatumGewijzigd = SYSDATE(6)
    WHERE ProductId = p_ProductId;
END $$
DELIMITER ;

