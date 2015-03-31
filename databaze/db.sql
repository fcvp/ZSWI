-- DatAdmin Native MySQL Dump

/*!40101 SET NAMES utf8 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE TABLE `forma_studia` ( 
    `ID_forma` int AUTO_INCREMENT NOT NULL, 
    `Forma_nazev` varchar(50) NOT NULL,  
    PRIMARY KEY (`ID_forma`)
) ENGINE=InnoDB  AUTO_INCREMENT=8  COLLATE=utf8_general_ci ;
CREATE UNIQUE INDEX `UQ_Forma_studia_Forma_nazev` ON `forma_studia` (`Forma_nazev`);
CREATE UNIQUE INDEX `UQ_Forma_studia_ID_forma` ON `forma_studia` (`ID_forma`);
CREATE TABLE `klicove_slovo` ( 
    `ID_klicove_slovo` int AUTO_INCREMENT NOT NULL, 
    `Slovo` varchar(100) NOT NULL, 
    `ID_oblast` int NOT NULL, 
    `Vyznam` text NOT NULL,  
    PRIMARY KEY (`ID_klicove_slovo`)
) ENGINE=InnoDB  AUTO_INCREMENT=8  COLLATE=utf8_general_ci ;
CREATE UNIQUE INDEX `UQ_Klicove_slovo_ID_klicove_slovo` ON `klicove_slovo` (`ID_klicove_slovo`);
CREATE UNIQUE INDEX `UQ_Klicove_slovo_Slovo` ON `klicove_slovo` (`Slovo`);
CREATE INDEX `ID_oblast` ON `klicove_slovo` (`ID_oblast`);
CREATE TABLE `oblast` ( 
    `ID_oblast` int AUTO_INCREMENT NOT NULL, 
    `Oblast_nazev` varchar(100) NOT NULL,  
    PRIMARY KEY (`ID_oblast`)
) ENGINE=InnoDB  AUTO_INCREMENT=12  COLLATE=utf8_general_ci ;
CREATE UNIQUE INDEX `UQ_Oblast_ID_oblast` ON `oblast` (`ID_oblast`);
CREATE UNIQUE INDEX `UQ_Oblast_Oblast_nazev` ON `oblast` (`Oblast_nazev`);
CREATE TABLE `obor` ( 
    `ID_obor` int AUTO_INCREMENT NOT NULL, 
    `Obor_nazev` varchar(255) NOT NULL, 
    `Url` varchar(255) NOT NULL, 
    `Popis` text NULL, 
    `ID_typ` int NOT NULL, 
    `ID_forma` int NOT NULL,  
    PRIMARY KEY (`ID_obor`)
) ENGINE=InnoDB  AUTO_INCREMENT=12  COLLATE=utf8_general_ci ;
CREATE UNIQUE INDEX `UQ_Obor_ID_obor` ON `obor` (`ID_obor`);
CREATE UNIQUE INDEX `UQ_id_typ_id_forma` ON `obor` (`ID_typ`,`ID_forma`,`Obor_nazev`);
CREATE INDEX `ID_forma` ON `obor` (`ID_forma`);
CREATE INDEX `ID_typ` ON `obor` (`ID_typ`);
CREATE TABLE `obor_slovo` ( 
    `ID_obor` int NOT NULL, 
    `ID_klicove_slovo` int NOT NULL, 
    `ID_priorita` int NOT NULL,  
    PRIMARY KEY (`ID_obor`, `ID_klicove_slovo`)
) ENGINE=InnoDB  COLLATE=utf8_general_ci ;
CREATE UNIQUE INDEX `UQ_OborSlovo_ID_obor_ID_slovo` ON `obor_slovo` (`ID_obor`,`ID_klicove_slovo`);
CREATE INDEX `ID_klicove_slovo` ON `obor_slovo` (`ID_klicove_slovo`);
CREATE INDEX `ID_obor` ON `obor_slovo` (`ID_obor`);
CREATE INDEX `ID_priorita` ON `obor_slovo` (`ID_priorita`);
CREATE TABLE `priorita` ( 
    `ID_priorita` int AUTO_INCREMENT NOT NULL, 
    `Hodnota` float NOT NULL, 
    `Poznamka` varchar(200) NOT NULL,  
    PRIMARY KEY (`ID_priorita`)
) ENGINE=InnoDB  AUTO_INCREMENT=7  COLLATE=utf8_general_ci ;
CREATE UNIQUE INDEX `UQ_Priorita_Hodnota` ON `priorita` (`Hodnota`);
CREATE UNIQUE INDEX `UQ_Priorita_ID_priorita` ON `priorita` (`ID_priorita`);
CREATE TABLE `typ_studia` ( 
    `ID_typ` int AUTO_INCREMENT NOT NULL, 
    `Typ_nazev` varchar(50) NOT NULL,  
    PRIMARY KEY (`ID_typ`)
) ENGINE=InnoDB  AUTO_INCREMENT=6  COLLATE=utf8_general_ci ;
CREATE UNIQUE INDEX `UQ_Typ_studia_Typ_nazev` ON `typ_studia` (`Typ_nazev`);
CREATE UNIQUE INDEX `UQ_Typ_studia_ID_typ` ON `typ_studia` (`ID_typ`);
INSERT INTO `obor_slovo` (`ID_obor`, `ID_klicove_slovo`, `ID_priorita`) VALUES
(1, 4, 1),
(8, 4, 1),
(8, 1, 2),
(1, 1, 5);
INSERT INTO `priorita` (`ID_priorita`, `Hodnota`, `Poznamka`) VALUES
(1, 0, 'malá priorita'),
(2, 0.25, '2'),
(3, 0.5, '3'),
(4, 0.75, '4'),
(5, 1, '5 - klíčová');
INSERT INTO `typ_studia` (`ID_typ`, `Typ_nazev`) VALUES
(2, 'Kombinované'),
(1, 'Prezenční');
INSERT INTO `obor` (`ID_obor`, `Obor_nazev`, `Url`, `Popis`, `ID_typ`, `ID_forma`) VALUES
(1, 'Informatika', 'http://fav.zcu.cz/pro-uchazece/bakalarske-studium/informatika/', 'Obor je určen pro studenty, kteří chtějí získat teoretický základ i praktické 
    znalosti v informatice.', 1, 3),
(8, 'Matematika a její aplikace', 'http://fav.zcu.cz/pro-uchazece/bakalarske-studium/matematika-a-jeji-aplikace/', 'Cílem studia tohoto oboru je vybavit studenty dostatečně všestrannými matematickými kompetencemi
 a umožnit jim orientovat se v základních matematických disciplínách a metodách moderní matematiky.', 2, 1);
INSERT INTO `forma_studia` (`ID_forma`, `Forma_nazev`) VALUES
(1, 'Bakalářské'),
(3, 'Doktorské'),
(2, 'Navazující');
INSERT INTO `klicove_slovo` (`ID_klicove_slovo`, `Slovo`, `ID_oblast`, `Vyznam`) VALUES
(1, 'Programování v C', 1, ''),
(4, 'Matematická analýza', 5, 'Definice, věty, důkazy, integrály, derivace.'),
(6, 'Lineární algebra', 1, 'Prostory, grupy, vlastní čísla.');
INSERT INTO `oblast` (`ID_oblast`, `Oblast_nazev`) VALUES
(2, 'Informatika'),
(8, 'Kybernetika'),
(5, 'Matematika'),
(1, 'NEZAŘAZENO');
ALTER TABLE `klicove_slovo` ADD CONSTRAINT `FK_Klicove_slovo_Oblast` FOREIGN KEY (`ID_oblast`) REFERENCES `oblast`(`ID_oblast`);
ALTER TABLE `obor` ADD CONSTRAINT `FK_Obor_Forma_studia` FOREIGN KEY (`ID_forma`) REFERENCES `forma_studia`(`ID_forma`);
ALTER TABLE `obor` ADD CONSTRAINT `FK_Obor_Typ_studia` FOREIGN KEY (`ID_typ`) REFERENCES `typ_studia`(`ID_typ`);
ALTER TABLE `obor_slovo` ADD CONSTRAINT `FK_OborSlovo_Klicove_slovo` FOREIGN KEY (`ID_klicove_slovo`) REFERENCES `klicove_slovo`(`ID_klicove_slovo`);
ALTER TABLE `obor_slovo` ADD CONSTRAINT `FK_OborSlovo_Obor` FOREIGN KEY (`ID_obor`) REFERENCES `obor`(`ID_obor`);
ALTER TABLE `obor_slovo` ADD CONSTRAINT `FK_OborSlovo_Priorita` FOREIGN KEY (`ID_priorita`) REFERENCES `priorita`(`ID_priorita`);
DELIMITER ;;
/*!50010 CREATE  PROCEDURE `insert_forma`(forma_nazev varchar(50) )
BEGIN
    DECLARE exit handler for sqlexception
  	BEGIN
   		 -- ERROR
   		-- SELECT 'sqlexception';
   		GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
 		@errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
		SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
		SELECT @full_error;

  		ROLLBACK;
	END;
	
	DECLARE exit handler for sqlwarning
	 BEGIN
  		  -- WARNING
  	   SELECT 'sqlwarning: zkontrolujte sql dotaz nebo vstupni data.';
  	   GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
 		@errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
		SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
		SELECT @full_error;
		
 	 	ROLLBACK;
	END;
	
 	START TRANSACTION;
 		INSERT INTO forma_studia (Forma_nazev) VALUES (
    		forma_nazev
		);

	COMMIT; 

END*/;;
DELIMITER ;
DELIMITER ;;
/*!50010 CREATE  PROCEDURE `insert_oblast`(oblast_nazev varchar(50) )
BEGIN
    DECLARE exit handler for sqlexception
  	BEGIN
   		 -- ERROR
   		-- SELECT 'sqlexception';
   		GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
 		@errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
		SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
		SELECT @full_error;

  		ROLLBACK;
	END;
	
	DECLARE exit handler for sqlwarning
	 BEGIN
  		  -- WARNING
  	    -- SELECT 'sqlwarning: zkontrolujte sql dotaz nebo vstupni data.';
  	    GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
 		@errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
		SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
		SELECT @full_error;
		
 	 	ROLLBACK;
	END;
	
 	START TRANSACTION;
 		
		INSERT INTO oblast (Oblast_nazev) VALUES (
		    oblast_nazev -- Oblast_nazev
		);

	COMMIT; 

END*/;;
DELIMITER ;
DELIMITER ;;
/*!50010 CREATE  PROCEDURE `insert_klicove_slovo`(slovo VARCHAR(255), vyznam TEXT)
BEGIN


    DECLARE exit handler for sqlexception
  	BEGIN
   		 -- ERROR
   		-- SELECT 'sqlexception';
   		GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
 		@errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
		SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
		SELECT @full_error;

  		ROLLBACK;
	END;
	
	DECLARE exit handler for sqlwarning
	 BEGIN
  		  -- WARNING
  	    -- SELECT 'sqlwarning: zkontrolujte sql dotaz nebo vstupni data.';
  	    GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
 		@errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
		SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
		SELECT @full_error;
		
 	 	ROLLBACK;
	END;
	
 	START TRANSACTION;
 	
 		IF((SELECT ID_oblast FROM oblast o WHERE Oblast_nazev = 'NEZAŘAZENO') is null) then
 			 call insert_oblast('NEZAŘAZENO');
 		end IF;
 		
		INSERT INTO klicove_slovo (Slovo, Vyznam, ID_oblast) VALUES (
		     slovo, 
		     vyznam,
		     (SELECT ID_oblast FROM oblast o WHERE oblast_nazev = 'NEZAŘAZENO') -- ID_oblast (DEFAULT)
		);
	COMMIT; 

END*/;;
DELIMITER ;
DELIMITER ;;
/*!50010 CREATE  PROCEDURE `insert_obor`(obor_nazev varchar(255), url varchar(255), popis Text, id_typ int, id_forma int )
BEGIN
    DECLARE exit handler for sqlexception
  	BEGIN
   		 -- ERROR
   		-- SELECT 'sqlexception';
   		GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
 		@errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
		SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
		SELECT @full_error;

  		ROLLBACK;
	END;
	
	DECLARE exit handler for sqlwarning
	 BEGIN
  		  -- WARNING
  	    -- SELECT 'sqlwarning: zkontrolujte sql dotaz nebo vstupni data.';
  	    GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
 		@errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
		SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
		SELECT @full_error;
		
 	 	ROLLBACK;
	END;
	
 	START TRANSACTION;
 		IF((SELECT ID_typ FROM typ_studia ts WHERE ts.ID_typ = id_typ) is null) then
 			 SELECT 'typ studia s timto ID neexistuje';
 	 		ROLLBACK;
 		end IF;
 		
 		IF((SELECT ID_forma FROM forma_studia fs WHERE fs.ID_forma = id_forma) is null) then
 			 SELECT 'forma studia s timto ID neexistuje';
 	 		ROLLBACK;
 		end IF;
 	
 		INSERT INTO obor ( Obor_nazev, Url, Popis, ID_typ, ID_forma) VALUES (
   			obor_nazev, url, popis, id_typ, id_forma
		);
	COMMIT; 

END*/;;
DELIMITER ;
DELIMITER ;;
/*!50010 CREATE  PROCEDURE `insert_obor_slovo`( id_obor int , id_klicove_slovo int, id_priorita int )
BEGIN
    DECLARE exit handler for sqlexception
  	BEGIN
   		 -- ERROR
   		-- SELECT 'sqlexception';
   		GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
 		@errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
		SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
		SELECT @full_error;

  		ROLLBACK;
	END;
	
	DECLARE exit handler for sqlwarning
	 BEGIN
  		  -- WARNING
  	    -- SELECT 'sqlwarning: zkontrolujte sql dotaz nebo vstupni data.';
  	    GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
 		@errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
		SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
		SELECT @full_error;
		
 	 	ROLLBACK;
	END;
	
 	START TRANSACTION;
 		IF((SELECT ID_obor FROM obor o WHERE o.ID_obor = id_obor) is null) then
 			 SELECT 'obor s timto ID neexistuje';
 	 		ROLLBACK;
 		end IF;
 		
 		IF((SELECT ID_klicove_slovo FROM klicove_slovo ks WHERE ks.ID_klicove_slovo = id_klicove_slovo) is null) then
 			 SELECT 'klicove slovo s timto ID neexistuje';
 	 		ROLLBACK;
 		end IF;
 		
 		IF((SELECT ID_priorita FROM priorita p WHERE p.ID_priorita = id_priorita) is null) then
 			 SELECT 'priorita s timto ID neexistuje';
 	 		ROLLBACK;
 		end IF;
 	
 		
		INSERT INTO obor_slovo (ID_obor, ID_klicove_slovo, ID_priorita) VALUES (
		    id_obor, id_klicove_slovo, id_priorita
		);

	COMMIT; 

END*/;;
DELIMITER ;
DELIMITER ;;
/*!50010 CREATE  PROCEDURE `insert_priorita`( hodnota float, poznamka varchar(200) )
BEGIN
    DECLARE exit handler for sqlexception
  	BEGIN
   		 -- ERROR
   		-- SELECT 'sqlexception';
   		GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
 		@errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
		SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
		SELECT @full_error;

  		ROLLBACK;
	END;
	
	DECLARE exit handler for sqlwarning
	 BEGIN
  		  -- WARNING
  	    -- SELECT 'sqlwarning: zkontrolujte sql dotaz nebo vstupni data.';
  	    GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
 		@errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
		SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
		SELECT @full_error;
		
 	 	ROLLBACK;
	END;
	
 	START TRANSACTION;
 		
		INSERT INTO priorita (Hodnota, Poznamka) VALUES (
    		hodnota, poznamka
		);

	COMMIT; 

END*/;;
DELIMITER ;
DELIMITER ;;
/*!50010 CREATE  PROCEDURE `insert_typ`(typ_nazev varchar(50) )
BEGIN
    DECLARE exit handler for sqlexception
  	BEGIN
   		 -- ERROR
   		-- SELECT 'sqlexception';
   		GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
 		@errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
		SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
		SELECT @full_error;

  		ROLLBACK;
	END;
	
	DECLARE exit handler for sqlwarning
	 BEGIN
  		  -- WARNING
  	    -- SELECT 'sqlwarning: zkontrolujte sql dotaz nebo vstupni data.';
  	    GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
 		@errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
		SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
		SELECT @full_error;
		
 	 	ROLLBACK;
	END;
	
 	START TRANSACTION;
 		INSERT INTO typ_studia (Typ_nazev) VALUES (
   			typ_nazev
		);
	COMMIT; 

END*/;;
DELIMITER ;
DELIMITER ;;
/*!50010 CREATE  PROCEDURE `update_forma`(id_forma int, forma_nazev varchar(50) )
BEGIN
     DECLARE exit handler for sqlexception
  	BEGIN
   		 -- ERROR
   		-- SELECT 'sqlexception';
   		GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
 		@errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
		SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
		SELECT @full_error;

  		ROLLBACK;
	END;
	
	DECLARE exit handler for sqlwarning
	 BEGIN
  		  -- WARNING
  	    -- SELECT 'sqlwarning: zkontrolujte sql dotaz nebo vstupni data.';
  	    GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
 		@errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
		SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
		SELECT @full_error;
		
 	 	ROLLBACK;
	END;
	
 	START TRANSACTION;
 	    IF((SELECT ID_forma FROM forma_studia f WHERE f.ID_forma = id_forma) is null) then
 			 SELECT 'forma studia s timto ID neexistuje';
 	 		ROLLBACK;
 		end IF;
 	    
 		UPDATE forma_studia fs SET
 		   fs.Forma_nazev = forma_nazev
 		WHERE fs.ID_forma=id_forma;
 		
	COMMIT; 

END*/;;
DELIMITER ;
DELIMITER ;;
/*!50010 CREATE  PROCEDURE `update_klicove_slovo`(id_klicove_slovo int, slovo VARCHAR(255), id_oblast int, vyznam TEXT)
BEGIN


    DECLARE exit handler for sqlexception
  	BEGIN
   		 -- ERROR
   		-- SELECT 'sqlexception';
   		GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
 		@errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
		SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
		SELECT @full_error;

  		ROLLBACK;
	END;
	
	DECLARE exit handler for sqlwarning
	 BEGIN
  		  -- WARNING
  	    -- SELECT 'sqlwarning: zkontrolujte sql dotaz nebo vstupni data.';
  	    GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
 		@errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
		SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
		SELECT @full_error;
		
 	 	ROLLBACK;
	END;
	
 	START TRANSACTION;
 	    
 		IF((SELECT ID_klicove_slovo FROM klicove_slovo ks WHERE ks.ID_klicove_slovo = id_klicove_slovo) is null) then
 			 SELECT 'klicove slovo s timto ID neexistuje';
 	 		ROLLBACK;
 		end IF;
 		
 		IF((SELECT ID_klicove_slovo FROM klicove_slovo ks WHERE ks.ID_klicove_slovo = id_klicove_slovo AND
 				ks.slovo = slovo) is NOT null) then
 			
 			UPDATE IGNORE klicove_slovo  ks SET
		    	ks.Slovo = slovo,
		    	ks.ID_oblast = id_oblast,
		    	ks.Vyznam = vyznam
			WHERE
		    	ID_klicove_slovo = id_klicove_slovo;
		ELSE
		 
		 	UPDATE  klicove_slovo  ks SET
		    	ks.Slovo = slovo,
		    	ks.ID_oblast = id_oblast,
		    	ks.Vyznam = vyznam
			WHERE
		    	ID_klicove_slovo = id_klicove_slovo;
 		end IF;
 		
 		
		
    
	COMMIT; 

END*/;;
DELIMITER ;
DELIMITER ;;
/*!50010 CREATE  PROCEDURE `update_oblast`(id_oblast int, oblast_nazev varchar(50) )
BEGIN
     DECLARE exit handler for sqlexception
  	BEGIN
   		 -- ERROR
   		-- SELECT 'sqlexception';
   		GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
 		@errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
		SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
		SELECT @full_error;

  		ROLLBACK;
	END;
	
	DECLARE exit handler for sqlwarning
	 BEGIN
  		  -- WARNING
  	    -- SELECT 'sqlwarning: zkontrolujte sql dotaz nebo vstupni data.';
  	    GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
 		@errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
		SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
		SELECT @full_error;
		
 	 	ROLLBACK;
	END;
	
 	START TRANSACTION;
 	    IF((SELECT ID_oblast FROM oblast o WHERE o.ID_oblast = id_oblast) is null) then
 			 SELECT 'oblast s timto ID neexistuje';
 	 		ROLLBACK;
 		end IF;
 	    
 		UPDATE oblast o SET
 			o.oblast_nazev = oblast_nazev
 		WHERE o.ID_oblast=id_oblast;
 		
	COMMIT; 

END*/;;
DELIMITER ;
DELIMITER ;;
/*!50010 CREATE  PROCEDURE `update_obor`(id_obor int, obor_nazev varchar(255), url varchar(255), popis Text, id_typ int, id_forma int )
BEGIN
    DECLARE exit handler for sqlexception
  	BEGIN
   		 -- ERROR
   		-- SELECT 'sqlexception';
   		GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
 		@errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
		SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
		SELECT @full_error;

  		ROLLBACK;
	END;
	
	DECLARE exit handler for sqlwarning
	 BEGIN
  		  -- WARNING
  	    -- SELECT 'sqlwarning: zkontrolujte sql dotaz nebo vstupni data.';
  	    GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
 		@errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
		SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
		SELECT @full_error;
		
 	 	ROLLBACK;
	END;
	
 	START TRANSACTION;
 		IF((SELECT ID_typ FROM typ_studia ts WHERE ts.ID_typ = id_typ) is null) then
 			 SELECT 'typ studia s timto ID neexistuje';
 	 		ROLLBACK;
 		end IF;
 		
 		IF((SELECT ID_forma FROM forma_studia fs WHERE fs.ID_forma = id_forma) is null) then
 			 SELECT 'forma studia s timto ID neexistuje';
 	 		ROLLBACK;
 		end IF;
 		
 		IF((SELECT ID_obor FROM obor o WHERE o.ID_obor = id_obor) is null) then
 			 SELECT 'obor s timto ID neexistuje';
 	 		ROLLBACK;
 		end IF;
 	
 		UPDATE obor o SET
		    o.Obor_nazev = obor_nazev,
		    o.Url = url,
		    o.Popis = popis,
		    o.ID_typ = id_typ,
		    o.ID_forma = id_forma
		WHERE
		    o.ID_obor = id_obor;
	COMMIT; 

END*/;;
DELIMITER ;
DELIMITER ;;
/*!50010 CREATE  PROCEDURE `update_obor_slovo`(id_obor int , id_klicove_slovo int, id_priorita int )
BEGIN
    DECLARE exit handler for sqlexception
  	BEGIN
   		 -- ERROR
   		-- SELECT 'sqlexception';
   		GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
 		@errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
		SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
		SELECT @full_error;

  		ROLLBACK;
	END;
	
	DECLARE exit handler for sqlwarning
	 BEGIN
  		  -- WARNING
  	    -- SELECT 'sqlwarning: zkontrolujte sql dotaz nebo vstupni data.';
  	    GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
 		@errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
		SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
		SELECT @full_error;
		
 	 	ROLLBACK;
	END;
	
 	START TRANSACTION;
 		IF((SELECT ID_obor FROM obor o WHERE o.ID_obor = id_obor) is null) then
 			 SELECT 'obor s timto ID neexistuje';
 	 		ROLLBACK;
 		end IF;
 		
 		IF((SELECT ID_klicove_slovo FROM klicove_slovo ks WHERE ks.ID_klicove_slovo = id_klicove_slovo) is null) then
 			 SELECT 'klicove slovo s timto ID neexistuje';
 	 		ROLLBACK;
 		end IF;
 		
 		IF((SELECT ID_priorita FROM priorita p WHERE p.ID_priorita = id_priorita) is null) then
 			 SELECT 'priorita s timto ID neexistuje';
 	 		ROLLBACK;
 		end IF;
 	
 		
		UPDATE obor_slovo os SET
		    os.ID_obor = id_obor,
		    os.ID_klicove_slovo = id_klicove_slovo,
		    os.ID_priorita = id_priorita
		WHERE
		    os.ID_obor = id_obor
		    AND os.ID_klicove_slovo = id_klicove_slovo;

	COMMIT; 

END*/;;
DELIMITER ;
DELIMITER ;;
/*!50010 CREATE  PROCEDURE `update_priorita`(id_priorita int, hodnota varchar(50), poznamka varchar(200) )
BEGIN
     DECLARE exit handler for sqlexception
  	BEGIN
   		 -- ERROR
   		-- SELECT 'sqlexception';
   		GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
 		@errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
		SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
		SELECT @full_error;

  		ROLLBACK;
	END;
	
	DECLARE exit handler for sqlwarning
	 BEGIN
  		  -- WARNING
  	    -- SELECT 'sqlwarning: zkontrolujte sql dotaz nebo vstupni data.';
  	    GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
 		@errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
		SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
		SELECT @full_error;
		
 	 	ROLLBACK;
	END;
	
 	START TRANSACTION;
 	    IF((SELECT ID_priorita FROM priorita p WHERE p.ID_priorita = id_priorita) is null) then
 			 SELECT 'priorita s timto ID neexistuje';
 	 		ROLLBACK;
 		end IF;
 	    
 		UPDATE priorita p SET
 			p.hodnota = hodnota,
 			p.poznamka = poznamka
 		WHERE p.ID_priorita=id_priorita;
 		
	COMMIT; 

END*/;;
DELIMITER ;
DELIMITER ;;
/*!50010 CREATE  PROCEDURE `update_typ`(id_typ int, typ_nazev varchar(50) )
BEGIN
     DECLARE exit handler for sqlexception
  	BEGIN
   		 -- ERROR
   		-- SELECT 'sqlexception';
   		GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
 		@errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
		SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
		SELECT @full_error;

  		ROLLBACK;
	END;
	
	DECLARE exit handler for sqlwarning
	 BEGIN
  		  -- WARNING
  	    -- SELECT 'sqlwarning: zkontrolujte sql dotaz nebo vstupni data.';
  	    GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE,
 		@errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
		SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
		SELECT @full_error;
		
 	 	ROLLBACK;
	END;
	
 	START TRANSACTION;
 	    IF((SELECT ID_typ FROM typ_studia ts WHERE ts.ID_typ = id_typ) is null) then
 			 SELECT 'typ studia s timto ID neexistuje';
 	 		ROLLBACK;
 		end IF;
 	    
 		UPDATE typ_studia ts SET
 			ts.Typ_nazev = typ_nazev
 		WHERE ts.ID_typ=id_typ;
 		
	COMMIT; 

END*/;;
DELIMITER ;


;/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;