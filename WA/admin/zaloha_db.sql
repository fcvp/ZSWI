-- phpMyAdmin SQL Dump
-- version 4.2.9
-- http://www.phpmyadmin.net
--
-- Počítač: localhost:3306
-- Vytvořeno: Sob 02. kvě 2015, 16:57
-- Verze serveru: 5.6.23-1~dotdeb.3
-- Verze PHP: 5.6.7-1~dotdeb.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Databáze: `czzswi`
--

DELIMITER $$
--
-- Procedury
--
CREATE DEFINER=`czzswi`@`localhost` PROCEDURE `insert_forma`(forma_nazev varchar(50) )
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

END$$

CREATE DEFINER=`czzswi`@`localhost` PROCEDURE `insert_klicove_slovo`(slovo VARCHAR(255), vyznam TEXT)
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

END$$

CREATE DEFINER=`czzswi`@`localhost` PROCEDURE `insert_oblast`(oblast_nazev varchar(50) )
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

END$$

CREATE DEFINER=`czzswi`@`localhost` PROCEDURE `insert_obor`(obor_nazev varchar(255), url varchar(255), popis Text, id_typ int, id_forma int )
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

END$$

CREATE DEFINER=`czzswi`@`localhost` PROCEDURE `insert_obor_slovo`( id_obor int , id_klicove_slovo int, id_priorita int )
BEGIN
	DECLARE nezarazeno varchar(50);

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
 		
 		SELECT ID_oblast INTO @nezarazeno FROM oblast o WHERE oblast_nazev = 'NEZAŘAZENO';
 		
 		IF((SELECT ID_klicove_slovo FROM klicove_slovo ks WHERE ks.ID_klicove_slovo = id_klicove_slovo
 			AND ID_oblast = @nezarazeno) is NOT null) then
 			 SELECT 'zaradte nejprve klicove slovo do oblasti';
 	 		ROLLBACK;
 		end IF;
 	
		INSERT INTO obor_slovo (ID_obor, ID_klicove_slovo, ID_priorita) VALUES (
		    id_obor, id_klicove_slovo, id_priorita
		);

	COMMIT; 

END$$

CREATE DEFINER=`czzswi`@`localhost` PROCEDURE `insert_priorita`( hodnota float, poznamka varchar(200) )
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

END$$

CREATE DEFINER=`czzswi`@`localhost` PROCEDURE `insert_typ`(typ_nazev varchar(50) )
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

END$$

CREATE DEFINER=`czzswi`@`localhost` PROCEDURE `update_forma`(id_forma int, forma_nazev varchar(50) )
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

END$$

CREATE DEFINER=`czzswi`@`localhost` PROCEDURE `update_klicove_slovo`(id_klicove_slovo int, slovo VARCHAR(255), id_oblast int, vyznam TEXT)
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
 		
 		 IF((SELECT ID_oblast FROM oblast o WHERE o.ID_oblast = id_oblast) is null) then
 			 SELECT 'oblast s timto ID neexistuje';
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

END$$

CREATE DEFINER=`czzswi`@`localhost` PROCEDURE `update_oblast`(id_oblast int, oblast_nazev varchar(50) )
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

END$$

CREATE DEFINER=`czzswi`@`localhost` PROCEDURE `update_obor`(id_obor int, obor_nazev varchar(255), url varchar(255), popis Text, id_typ int, id_forma int )
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

END$$

CREATE DEFINER=`czzswi`@`localhost` PROCEDURE `update_obor_slovo`(id_obor int , id_klicove_slovo int, id_obor_nove int , id_klicove_slovo_nove int,  id_priorita int )
BEGIN
	DECLARE nezarazeno varchar(50);

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
 		IF((SELECT ID_obor FROM obor o WHERE o.ID_obor = id_obor_nove) is null) then
 			 SELECT 'obor (novy) s timto ID neexistuje';
 	 		ROLLBACK;
 		end IF;
 		
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
 		
 		SELECT ID_oblast INTO @nezarazeno FROM oblast o WHERE oblast_nazev = 'NEZAŘAZENO';
 		
 		IF((SELECT ID_klicove_slovo FROM klicove_slovo ks WHERE ks.ID_klicove_slovo = id_klicove_slovo_nove
 			AND ID_oblast = @nezarazeno) is NOT null) then
 			 SELECT 'zaradte nejprve klicove slovo do oblasti';
 	 		ROLLBACK;
 		end IF;
 	
 		
		UPDATE obor_slovo os SET
		    os.ID_obor = id_obor_nove,
		    os.ID_klicove_slovo = id_klicove_slovo_nove,
		    os.ID_priorita = id_priorita
		WHERE
		    os.ID_obor = id_obor
		    AND os.ID_klicove_slovo = id_klicove_slovo;

	COMMIT; 

END$$

CREATE DEFINER=`czzswi`@`localhost` PROCEDURE `update_priorita`(id_priorita int, hodnota varchar(50), poznamka varchar(200) )
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

END$$

CREATE DEFINER=`czzswi`@`localhost` PROCEDURE `update_typ`(id_typ int, typ_nazev varchar(50) )
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

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabulky `forma_studia`
--

CREATE TABLE IF NOT EXISTS `forma_studia` (
`ID_forma` int(11) NOT NULL,
  `Forma_nazev` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `forma_studia`
--

INSERT INTO `forma_studia` (`ID_forma`, `Forma_nazev`) VALUES
(2, 'Kombinovaná'),
(1, 'Prezenční');

-- --------------------------------------------------------

--
-- Struktura tabulky `klicove_slovo`
--

CREATE TABLE IF NOT EXISTS `klicove_slovo` (
`ID_klicove_slovo` int(11) NOT NULL,
  `Slovo` varchar(100) NOT NULL,
  `ID_oblast` int(11) NOT NULL,
  `Vyznam` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=182 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `klicove_slovo`
--

INSERT INTO `klicove_slovo` (`ID_klicove_slovo`, `Slovo`, `ID_oblast`, `Vyznam`) VALUES
(19, 'matematika', 7, 'popis'),
(20, 'diskrétní matematika', 7, 'popis'),
(21, 'statistická analýza', 7, 'popis'),
(22, 'statistika a pravděpodobnost', 7, 'popis'),
(23, 'numerické metody', 7, 'popis'),
(24, 'matematická analýza', 7, 'popis'),
(25, 'finanční matematika', 7, 'popis'),
(26, 'finanční teorie', 7, 'popis'),
(27, 'lineární algebra', 7, 'popis'),
(28, 'pojistná matematika', 7, 'popis'),
(29, 'finance', 7, 'popis'),
(30, 'Matematika a její aplikace', 7, 'popis'),
(31, 'učitelství matematiky', 7, 'popis'),
(32, 'symbolicko-numerické výpočty', 7, 'popis'),
(33, 'Jazyk a metody matematiky', 7, 'popis'),
(34, 'Numerické modelování', 7, 'popis'),
(35, 'analýza dat', 7, 'popis'),
(36, 'informatika', 9, 'popis'),
(37, 'klicove_slovobázové systémy', 9, 'popis'),
(38, 'multimédia', 9, 'popis'),
(39, 'programování v C', 9, 'popis'),
(40, 'teoretická informatika', 9, 'popis'),
(41, 'programování', 9, 'popis'),
(42, 'softwarové inženýrství', 9, 'popis'),
(44, 'návrh a vývoj programových systémů', 9, 'popis'),
(45, 'objektové programování', 9, 'popis'),
(46, 'algoritmizace', 9, 'popis'),
(47, 'software', 9, 'popis'),
(48, 'programovací techniky', 9, 'popis'),
(49, 'programování v Javě', 9, 'popis'),
(50, 'webové aplikace', 9, 'popis'),
(51, 'Informační systémy', 9, 'popis'),
(52, 'informační technologie', 9, 'popis'),
(53, 'finanční informatika', 9, 'popis'),
(54, 'objektově orientované programování', 9, 'popis'),
(55, 'Finanční informatika a analýza', 9, 'popis'),
(56, 'teorie informace', 9, 'popis'),
(57, 'geoinformatika', 9, 'popis'),
(58, 'technika vakua', 8, 'popis'),
(59, 'fyzika pevných látek', 8, 'popis'),
(60, 'fyzikálně-matematické modelování', 8, 'popis'),
(61, 'fyzikálně-chemické modelování', 8, 'popis'),
(62, 'fyzika technologických procesů', 8, 'popis'),
(63, 'tenké vrstvy', 8, 'popis'),
(64, 'fyzikální inženýrství', 8, 'popis'),
(65, 'elektronické systémy', 8, 'popis'),
(66, 'termodynamika', 8, 'popis'),
(67, 'fyzikální měření', 8, 'popis'),
(68, 'analyzační metody', 8, 'popis'),
(69, 'modifikace povrchu', 8, 'popis'),
(70, 'diagnostika plazmatu', 8, 'popis'),
(71, 'plazma materiály', 8, 'popis'),
(72, 'inženýrská fyzika', 8, 'popis'),
(73, 'aplikovaná fyzika', 8, 'popis'),
(74, 'experimentální fyzika', 8, 'popis'),
(75, 'fyzika', 8, 'popis'),
(88, 'počítačové sítě', 15, 'popis'),
(89, 'výpočetní systémy', 15, 'popis'),
(90, 'operační systémy', 15, 'popis'),
(91, 'technika', 15, 'popis'),
(92, 'hardware', 15, 'popis'),
(93, 'Počítačová technika', 15, 'popis'),
(95, 'číslicové systémy', 20, 'popis'),
(96, 'elektrotechnika', 20, 'popis'),
(97, 'číslicové elektronické systémy', 20, 'popis'),
(98, 'Logické systémy', 20, 'popis'),
(99, 'ekonomika', 13, 'popis'),
(100, 'marketing', 13, 'popis'),
(101, 'ekonomie', 13, 'popis'),
(102, 'management', 13, 'popis'),
(103, 'obchod', 13, 'popis'),
(104, 'podniková ekonomika', 13, 'popis'),
(105, 'makroekonomie', 13, 'popis'),
(106, 'podnikové procesy', 13, 'popis'),
(107, 'účetnictví', 13, 'popis'),
(108, 'národní hospodářství', 13, 'popis'),
(109, 'finance a daňový systém', 13, 'popis'),
(110, 'mikroekonomie', 13, 'popis'),
(111, 'podnikatelské projekty', 13, 'popis'),
(112, 'řízení investic', 13, 'popis'),
(113, 'matematická ekonomie', 13, 'popis'),
(114, 'geomatika', 19, 'popis'),
(115, 'geografické informační systémy', 19, 'popis'),
(116, 'kosmická geodézie', 19, 'popis'),
(117, 'analýza geodat', 19, 'popis'),
(118, 'zeměměřictví', 19, 'popis'),
(119, 'GIS', 19, 'popis'),
(120, 'mapování', 19, 'popis'),
(121, 'tvorba geografických informačních systémů', 19, 'popis'),
(122, 'geodézie', 19, 'popis'),
(123, 'sběr geodat', 19, 'popis'),
(124, 'dálkový průzkum Země', 19, 'popis'),
(125, 'kartografie', 19, 'popis'),
(126, 'zpracování geodat', 19, 'popis'),
(127, 'fotogrammetrie', 19, 'popis'),
(128, 'geoprostorová klicove_slovo', 19, 'popis'),
(129, 'zeměpis', 19, 'popis'),
(130, 'územní plánování', 19, 'popis'),
(131, 'urbanismus', 19, 'popis'),
(132, 'plánování staveb', 19, 'popis'),
(133, 'geografie', 19, 'popis'),
(147, 'optimalizace', 14, ''),
(148, 'biomechanika', 14, ''),
(149, 'mechanika tekutin', 14, ''),
(150, 'dynamika', 14, ''),
(151, 'mechatronika', 14, ''),
(152, 'vibrace a hluk', 14, ''),
(153, 'statika', 14, ''),
(154, 'experimentální mechanika', 14, ''),
(155, 'kompozitní materiály', 14, ''),
(157, 'proudění a interakce', 14, ''),
(160, 'mechanika', 14, ' '),
(161, 'aerodynamika', 14, ''),
(164, 'deskriptivní geometrie', 21, 'popis'),
(165, 'geometrie', 21, 'popis'),
(166, 'geometrické modelování', 21, 'popis'),
(167, 'stavební technologie', 16, 'popis'),
(168, 'stavební materiály', 16, 'popis'),
(169, 'stavební konstrukce', 16, 'popis'),
(170, 'technické zařízení budov', 16, 'popis'),
(171, 'projektová dokumentace', 16, 'popis'),
(172, 'ekonomika staveb', 16, 'popis'),
(173, 'dějiny stavitelství', 16, 'popis'),
(174, 'architektura', 16, 'popis'),
(175, 'bezpečnost a spolehlivost staveb', 16, 'popis'),
(176, 'dřevostavby', 16, 'popis'),
(177, 'rekonstrukce a sanace staveb', 16, 'popis'),
(178, 'management staveb a stavebních provozů', 16, 'popis'),
(179, 'inteligentní konstrukce', 16, 'popis'),
(180, 'CAD', 16, 'popis'),
(181, 'stavitelství', 16, 'popis');

-- --------------------------------------------------------

--
-- Struktura tabulky `oblast`
--

CREATE TABLE IF NOT EXISTS `oblast` (
`ID_oblast` int(11) NOT NULL,
  `Oblast_nazev` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `oblast`
--

INSERT INTO `oblast` (`ID_oblast`, `Oblast_nazev`) VALUES
(11, 'Biologie'),
(12, 'Chemie'),
(13, 'Ekonomika'),
(20, 'Elektrotechnika'),
(8, 'Fyzika'),
(21, 'Geometrie'),
(9, 'Informatika'),
(17, 'Jazyky'),
(18, 'Kybernetika'),
(7, 'Matematika'),
(14, 'Mechanika'),
(10, 'Počítačová grafika'),
(16, 'Stavitelství'),
(15, 'Výpočetní technika'),
(19, 'Zeměpis');

-- --------------------------------------------------------

--
-- Struktura tabulky `obor`
--

CREATE TABLE IF NOT EXISTS `obor` (
`ID_obor` int(11) NOT NULL,
  `Obor_nazev` varchar(255) NOT NULL,
  `Url` varchar(255) NOT NULL,
  `Popis` text,
  `ID_typ` int(11) NOT NULL,
  `ID_forma` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `obor`
--

INSERT INTO `obor` (`ID_obor`, `Obor_nazev`, `Url`, `Popis`, `ID_typ`, `ID_forma`) VALUES
(9, 'Aplikovaná a inženýrská fyzika', 'http://fav.zcu.cz/pro-uchazece/bakalarske-studium/aplikovana-a-inzenyrska-fyzika/', '<p>\r\n	Z&aacute;kladem tohoto interdisciplin&aacute;rn&iacute;ho oboru je př&iacute;prava pro studium v navazuj&iacute;c&iacute;ch magistersk&yacute;ch studijn&iacute;ch programech</p>\r\n', 1, 1),
(10, 'Finanční informatika a statistika', 'http://fav.zcu.cz/pro-uchazece/bakalarske-studium/financni-informatika-a-statistika/', 'Cílem oboru je připravit odborníky se vzděláním na pomezí informatiky a moderních ekonomických metod. ', 1, 1),
(11, 'Geomatika', 'http://fav.zcu.cz/pro-uchazece/bakalarske-studium/geomatika/', 'Geomatika je interdisciplinární obor zabývající se sběrem, distribucí, ukládáním, analýzou, zpracováním a prezentací geoprostorových dat nebo geoprostorových informací. ', 1, 1),
(12, 'Informatika', 'http://fav.zcu.cz/pro-uchazece/bakalarske-studium/informatika/', 'Obor je určen pro studenty, kteří chtějí získat teoretický základ i praktické znalosti v informatice. ', 1, 1),
(13, 'Informační systémy', 'http://fav.zcu.cz/pro-uchazece/bakalarske-studium/informacni-systemy/', 'Studium tohoto oboru je velkou příležitostí pro studenty se zájmem o práci na rozhraní informatiky a ekonomie. ', 1, 1),
(14, 'Inteligentní komunikace člověk-stroj', 'http://fav.zcu.cz/pro-uchazece/bakalarske-studium/inteligentni-komunikace-clove-stroj/', 'Studijní obor „Inteligentní komunikace člověk-stroj“ poskytne studentům vedle studia předmětů teoretického základu i zevrubnou průpravu v oborových předmětech z oblasti umělé inteligence, automatizace řídicích a rozhodovacích procesů a počítačových předmětů. ', 1, 1),
(15, 'Kybernetika a řídicí technika', 'http://fav.zcu.cz/pro-uchazece/bakalarske-studium/kybernetika-a-ridici-technika/', 'Obsahem studia je řízení procesů technického i netechnického charakteru, dále návrhy řídicích systémů a v aplikace umělé inteligence. ', 1, 1),
(16, 'Matematika a finanční studia', 'http://fav.zcu.cz/pro-uchazece/bakalarske-studium/matematika-financni-studia/', 'Příznakem současné doby je využívání informací, matematických, statistických a jiných metod ve firemní praxi. ', 1, 1),
(17, 'Matematika a její aplikace', 'http://fav.zcu.cz/pro-uchazece/bakalarske-studium/matematika-a-jeji-aplikace/', 'Cílem studia tohoto oboru je vybavit studenty dostatečně všestrannými matematickými kompetencemi a umožnit jim orientovat se v základních matematických disciplínách a metodách moderní matematiky. ', 1, 1),
(18, 'Počítačové modelování', 'http://fav.zcu.cz/pro-uchazece/bakalarske-studium/pocitacove-modelovani/', 'Cílem oboru je poskytnout základní znalosti v oblasti počítačového modelování úloh aplikované mechaniky, biomechaniky a mechatroniky. ', 1, 1),
(19, 'Počítačové řízení strojů a procesů', 'http://fav.zcu.cz/pro-uchazece/bakalarske-studium/pocitacove-rizeni-stroju-a-procesu/', 'Studijní obor „Počítačové řízení strojů a procesů“ poskytne studentům vedle studia předmětů teoretického základu i zevrubnou průpravu v oborových předmětech z oblasti automatického řízení a automatizace řídicích a rozhodovacích procesů. ', 1, 1),
(20, 'Stavitelství', 'http://fav.zcu.cz/pro-uchazece/bakalarske-studium/stavitelstvi/', 'Čtyřleté bakalářské studium má za cíl připravit studenty pro práci na návrhu, přípravě a realizaci staveb a vychovat samostatné vysokoškolsky vzdělané odborníky zejména pro projektování staveb, výrobu stavebních hmot, přípravu a řízení staveb a práci na stavebních úřadech a správních orgánech města Plzně a ostatních měst a obcí. ', 1, 1),
(21, 'Systémy pro identifikaci, bezpečnost a komunikaci', 'http://fav.zcu.cz/pro-uchazece/bakalarske-studium/systemy-identifikace-bezpecnost-komunikace/', 'Bakalářský studijní obor „Systémy pro identifikaci, bezpečnost a komunikaci“ je charakterizován využíváním informace pro počítačem realizované rozhodování, řízení, monitorování, identifikaci a diagnostiku. ', 1, 1),
(22, 'Územní plánování', 'http://fav.zcu.cz/pro-uchazece/bakalarske-studium/uzemni-planovani/', 'Cílem studia je získání vzdělání pro navrhování v urbanismu a územním plánování a v souvisejících manažerských činnostech územního plánování, re-spektive investiční výstavbě. ', 1, 1),
(23, 'Výpočetní technika', 'http://fav.zcu.cz/pro-uchazece/bakalarske-studium/vypocetni-technika/', 'Obor je určen pro studenty, kteří chtějí získat teoretický základ i praktické znalosti v výpočetní technice. ', 1, 1),
(24, 'Výpočty a design', 'http://fav.zcu.cz/pro-uchazece/bakalarske-studium/vypocty-a-design/', 'Základním cílem tohoto oboru je poskytnout studentům ucelené bakalářské vzdělání v oblasti aplikované mechaniky, konstrukce a designu. ', 1, 1),
(25, 'Finanční informatika a statistika', 'http://fav.zcu.cz/pro-uchazece/bakalarske-studium/financni-informatika-a-statistika/', 'Cílem oboru je připravit odborníky se vzděláním na pomezí informatiky a moderních ekonomických metod. ', 1, 2),
(26, 'Geomatika', 'http://fav.zcu.cz/pro-uchazece/bakalarske-studium/geomatika/', 'Geomatika je interdisciplinární obor zabývající se sběrem, distribucí, ukládáním, analýzou, zpracováním a prezentací geoprostorových dat nebo geoprostorových informací. ', 1, 2),
(27, 'Informatika', 'http://fav.zcu.cz/pro-uchazece/bakalarske-studium/informatika/', 'Obor je určen pro studenty, kteří chtějí získat teoretický základ i praktické znalosti v informatice. ', 1, 2),
(28, 'Kybernetika a řídicí technika', 'http://fav.zcu.cz/pro-uchazece/bakalarske-studium/kybernetika-a-ridici-technika/', 'Obsahem studia je řízení procesů technického i netechnického charakteru, dále návrhy řídicích systémů a v aplikace umělé inteligence. ', 1, 2),
(29, 'Matematika a finanční studia', 'http://fav.zcu.cz/pro-uchazece/bakalarske-studium/matematika-financni-studia/', 'Příznakem současné doby je využívání informací, matematických, statistických a jiných metod ve firemní praxi. ', 1, 2),
(30, 'Matematika a její aplikace', 'http://fav.zcu.cz/pro-uchazece/bakalarske-studium/matematika-a-jeji-aplikace/', 'Cílem studia tohoto oboru je vybavit studenty dostatečně všestrannými matematickými kompetencemi a umožnit jim orientovat se v základních matematických disciplínách a metodách moderní matematiky. ', 1, 2),
(31, 'Výpočetní technika', 'http://fav.zcu.cz/pro-uchazece/bakalarske-studium/vypocetni-technika/', 'Obor je určen pro studenty, kteří chtějí získat teoretický základ i praktické znalosti v výpočetní technice. ', 1, 2);

-- --------------------------------------------------------

--
-- Struktura tabulky `obor_slovo`
--

CREATE TABLE IF NOT EXISTS `obor_slovo` (
  `ID_obor` int(11) NOT NULL,
  `ID_klicove_slovo` int(11) NOT NULL,
  `ID_priorita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `obor_slovo`
--

INSERT INTO `obor_slovo` (`ID_obor`, `ID_klicove_slovo`, `ID_priorita`) VALUES
(9, 19, 1),
(9, 36, 1),
(9, 41, 1),
(12, 19, 1),
(12, 22, 1),
(12, 23, 1),
(12, 27, 1),
(12, 75, 1),
(12, 93, 1),
(12, 160, 1),
(13, 27, 1),
(13, 41, 1),
(16, 20, 1),
(16, 22, 1),
(16, 24, 1),
(16, 25, 1),
(16, 27, 1),
(16, 28, 1),
(16, 29, 1),
(16, 36, 1),
(16, 53, 1),
(16, 105, 1),
(16, 110, 1),
(16, 113, 1),
(17, 20, 1),
(17, 22, 1),
(17, 23, 1),
(17, 24, 1),
(17, 36, 1),
(17, 165, 1),
(18, 148, 1),
(18, 149, 1),
(18, 150, 1),
(18, 151, 1),
(18, 152, 1),
(18, 157, 1),
(18, 160, 1),
(18, 161, 1),
(20, 75, 1),
(20, 147, 1),
(20, 153, 1),
(20, 160, 1),
(20, 164, 1),
(20, 167, 1),
(20, 168, 1),
(20, 169, 1),
(20, 170, 1),
(20, 171, 1),
(20, 173, 1),
(20, 174, 1),
(20, 175, 1),
(20, 176, 1),
(20, 177, 1),
(20, 178, 1),
(20, 181, 1),
(22, 19, 1),
(22, 34, 1),
(22, 114, 1),
(22, 115, 1),
(22, 116, 1),
(22, 117, 1),
(22, 122, 1),
(22, 125, 1),
(22, 130, 1),
(22, 131, 1),
(22, 132, 1),
(22, 133, 1),
(22, 165, 1),
(22, 166, 1),
(23, 19, 1),
(23, 36, 1),
(23, 41, 1),
(23, 42, 1),
(23, 48, 1),
(23, 75, 1),
(23, 88, 1),
(23, 89, 1),
(23, 90, 1),
(23, 91, 1),
(23, 92, 1),
(23, 93, 1),
(23, 95, 1),
(23, 96, 1),
(23, 97, 1),
(23, 98, 1),
(24, 147, 1),
(24, 150, 1),
(24, 151, 1),
(24, 154, 1),
(24, 155, 1),
(24, 179, 1),
(24, 180, 1),
(25, 20, 1),
(25, 21, 1),
(25, 22, 1),
(25, 23, 1),
(25, 24, 1),
(25, 25, 1),
(25, 26, 1),
(25, 27, 1),
(25, 28, 1),
(25, 36, 1),
(25, 37, 1),
(25, 46, 1),
(25, 53, 1),
(25, 99, 1),
(25, 101, 1),
(25, 105, 1),
(25, 110, 1),
(26, 57, 1),
(26, 114, 1),
(26, 115, 1),
(26, 116, 1),
(26, 117, 1),
(26, 118, 1),
(26, 120, 1),
(26, 122, 1),
(26, 123, 1),
(26, 124, 1),
(26, 125, 1),
(26, 127, 1),
(26, 128, 1),
(26, 129, 1),
(27, 19, 1),
(27, 20, 1),
(27, 22, 1),
(27, 23, 1),
(27, 27, 1),
(27, 75, 1),
(29, 20, 1),
(29, 22, 1),
(29, 24, 1),
(29, 25, 1),
(29, 27, 1),
(29, 28, 1),
(29, 29, 1),
(29, 36, 1),
(29, 53, 1),
(29, 105, 1),
(29, 110, 1),
(29, 113, 1),
(30, 20, 1),
(30, 22, 1),
(30, 23, 1),
(30, 24, 1),
(30, 36, 1),
(31, 36, 1),
(31, 41, 1),
(31, 42, 1),
(31, 48, 1),
(31, 88, 1),
(31, 89, 1),
(31, 90, 1),
(31, 91, 1),
(31, 92, 1),
(31, 93, 1),
(31, 95, 1),
(31, 96, 1),
(31, 97, 1),
(31, 98, 1),
(11, 19, 2),
(12, 20, 2),
(12, 88, 2),
(12, 90, 2),
(13, 19, 2),
(27, 88, 2),
(9, 58, 3),
(9, 59, 3),
(9, 60, 3),
(9, 61, 3),
(9, 62, 3),
(9, 63, 3),
(9, 64, 3),
(9, 65, 3),
(9, 66, 3),
(9, 67, 3),
(9, 68, 3),
(9, 69, 3),
(9, 70, 3),
(9, 71, 3),
(9, 72, 3),
(9, 73, 3),
(9, 74, 3),
(9, 75, 3),
(9, 160, 3),
(10, 19, 3),
(10, 20, 3),
(10, 21, 3),
(10, 22, 3),
(10, 23, 3),
(10, 24, 3),
(10, 25, 3),
(10, 26, 3),
(10, 27, 3),
(10, 28, 3),
(10, 36, 3),
(10, 37, 3),
(10, 46, 3),
(10, 53, 3),
(10, 99, 3),
(10, 100, 3),
(10, 101, 3),
(10, 102, 3),
(10, 105, 3),
(10, 107, 3),
(10, 110, 3),
(11, 57, 3),
(11, 114, 3),
(11, 115, 3),
(11, 116, 3),
(11, 117, 3),
(11, 118, 3),
(11, 120, 3),
(11, 122, 3),
(11, 123, 3),
(11, 124, 3),
(11, 125, 3),
(11, 127, 3),
(11, 128, 3),
(11, 129, 3),
(11, 164, 3),
(11, 165, 3),
(12, 36, 3),
(12, 37, 3),
(12, 39, 3),
(12, 40, 3),
(12, 41, 3),
(12, 42, 3),
(12, 45, 3),
(12, 46, 3),
(12, 47, 3),
(12, 48, 3),
(12, 49, 3),
(12, 50, 3),
(12, 51, 3),
(13, 29, 3),
(13, 34, 3),
(13, 36, 3),
(13, 37, 3),
(13, 51, 3),
(13, 52, 3),
(13, 99, 3),
(13, 100, 3),
(13, 102, 3),
(13, 104, 3),
(13, 105, 3),
(13, 107, 3),
(13, 109, 3),
(13, 110, 3),
(17, 19, 3),
(25, 19, 3),
(26, 19, 3),
(27, 36, 3),
(27, 37, 3),
(27, 39, 3),
(27, 40, 3),
(27, 41, 3),
(27, 42, 3),
(27, 45, 3),
(27, 46, 3),
(27, 47, 3),
(27, 48, 3),
(27, 49, 3),
(27, 50, 3),
(27, 51, 3),
(29, 19, 3),
(30, 19, 3);

-- --------------------------------------------------------

--
-- Struktura tabulky `posledni_akce`
--

CREATE TABLE IF NOT EXISTS `posledni_akce` (
  `typ` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `clanek` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `id_clanku` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `datum` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `posledni_akce`
--

INSERT INTO `posledni_akce` (`typ`, `clanek`, `id_clanku`, `datum`) VALUES
('Edited', 'Heslo', '-', 201504231626),
('Edited', 'Heslo', '-', 201504272203),
('Added', 'Oblast studia', '24', 201504272350),
('Edited', 'Oblast studia', '11', 201504280011),
('Edited', 'Oblast studia', '12', 201504280011),
('Edited', 'Oblast studia', '12', 201504280012),
('Edited', 'Oblast studia', '11', 201504280012),
('Edited', 'Oblast studia', '12', 201504280012),
('Edited', 'Oblast studia', '11', 201504280012),
('Edited', 'Oblast studia', '12', 201504280012),
('Added', 'Forma studia', '4', 201504281832),
('Edited', 'Forma studia', '4', 201504281836),
('Deleted', 'Forma studia', '4', 201504281857),
('Added', 'Forma studia', '5', 201504281857),
('Deleted', 'Forma studia', '5', 201504281901),
('Added', 'Oblast studia', '25', 201504281904),
('Deleted', 'Oblast studia', '25', 201504281905),
('Added', 'Forma studia', '6', 201504281907),
('Deleted', 'Forma studia', '6', 201504281907),
('Added', 'Oblast studia', '26', 201504281907),
('Deleted', 'Oblast studia', '26', 201504281907),
('Added', 'Typ studia', '4', 201504281922),
('Edited', 'Typ studia', '4', 201504281922),
('Deleted', 'Typ studia', '4', 201504281922),
('Added', 'Forma studia', '7', 201504282202),
('Edited', 'Forma studia', '7', 201504282202),
('Deleted', 'Forma studia', '7', 201504282203),
('Deleted', 'Studijní obor', '55', 201505011447),
('Added', 'Studijní obor', '56', 201505011448),
('Edited', 'Forma studia', '1', 201505011458),
('Edited', 'Forma studia', '1', 201505011509),
('Edited', 'Forma studia', '1', 201505011529),
('Edited', 'Forma studia', '1', 201505011530),
('Edited', 'Forma studia', '1', 201505011532),
('Edited', 'Forma studia', '1', 201505011532),
('Edited', 'Typ studia', '1', 201505011535),
('Edited', 'Typ studia', '1', 201505011535),
('Edited', 'Oblast studia', '11', 201505011536),
('Edited', 'Oblast studia', '11', 201505011536),
('Edited', 'Studijní obor', '56', 201505011545),
('Edited', 'Studijní obor', '56', 201505011545),
('Edited', 'Studijní obor', '56', 201505011548),
('Edited', 'Studijní obor', '56', 201505011551),
('Edited', 'Studijní obor', '56', 201505011552),
('Deleted', 'Studijní obor', '56', 201505011552),
('Edited', 'Studijní obor', '9', 201505011556),
('Edited', 'Studijní obor', '9', 201505011605),
('Added', 'Studijní obor', '57', 201505011605),
('Edited', 'Studijní obor', '57', 201505011612),
('Deleted', 'Studijní obor', '57', 201505011617),
('Added', 'Forma studia', '8', 201505011619),
('Deleted', 'Forma studia', '8', 201505011619),
('Edited', 'Forma studia', '1', 201505011620),
('Edited', 'Forma studia', '1', 201505011620),
('Edited', 'Forma studia', '2', 201505011620),
('Edited', 'Typ studia', '1', 201505011840);

-- --------------------------------------------------------

--
-- Struktura tabulky `priorita`
--

CREATE TABLE IF NOT EXISTS `priorita` (
`ID_priorita` int(11) NOT NULL,
  `Hodnota` float NOT NULL,
  `Poznamka` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `priorita`
--

INSERT INTO `priorita` (`ID_priorita`, `Hodnota`, `Poznamka`) VALUES
(1, 0.5, '1 - nejnižší'),
(2, 0.75, '2'),
(3, 1, '3 - nejvyšší');

-- --------------------------------------------------------

--
-- Struktura tabulky `typ_studia`
--

CREATE TABLE IF NOT EXISTS `typ_studia` (
`ID_typ` int(11) NOT NULL,
  `Typ_nazev` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `typ_studia`
--

INSERT INTO `typ_studia` (`ID_typ`, `Typ_nazev`) VALUES
(1, 'Bakalářské'),
(3, 'Doktorské'),
(2, 'Navazující');

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatele`
--

CREATE TABLE IF NOT EXISTS `uzivatele` (
`id` int(11) NOT NULL,
  `prezdivka` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `heslo` varchar(50) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `uzivatele`
--

INSERT INTO `uzivatele` (`id`, `prezdivka`, `heslo`) VALUES
(1, 'admin', '$1$N9RE4wYb$F4RsF30h4HIZ4x2GLZxmc0');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `forma_studia`
--
ALTER TABLE `forma_studia`
 ADD PRIMARY KEY (`ID_forma`), ADD UNIQUE KEY `UQ_Forma_studia_Forma_nazev` (`Forma_nazev`), ADD UNIQUE KEY `UQ_Forma_studia_ID_forma` (`ID_forma`);

--
-- Klíče pro tabulku `klicove_slovo`
--
ALTER TABLE `klicove_slovo`
 ADD PRIMARY KEY (`ID_klicove_slovo`), ADD UNIQUE KEY `UQ_Klicove_slovo_ID_klicove_slovo` (`ID_klicove_slovo`), ADD UNIQUE KEY `UQ_Klicove_slovo_Slovo` (`Slovo`), ADD KEY `ID_oblast` (`ID_oblast`);

--
-- Klíče pro tabulku `oblast`
--
ALTER TABLE `oblast`
 ADD PRIMARY KEY (`ID_oblast`), ADD UNIQUE KEY `UQ_Oblast_ID_oblast` (`ID_oblast`), ADD UNIQUE KEY `UQ_Oblast_Oblast_nazev` (`Oblast_nazev`);

--
-- Klíče pro tabulku `obor`
--
ALTER TABLE `obor`
 ADD PRIMARY KEY (`ID_obor`), ADD UNIQUE KEY `UQ_Obor_ID_obor` (`ID_obor`), ADD UNIQUE KEY `UQ_id_typ_id_forma` (`ID_typ`,`ID_forma`,`Obor_nazev`), ADD KEY `ID_forma` (`ID_forma`), ADD KEY `ID_typ` (`ID_typ`);

--
-- Klíče pro tabulku `obor_slovo`
--
ALTER TABLE `obor_slovo`
 ADD PRIMARY KEY (`ID_obor`,`ID_klicove_slovo`), ADD UNIQUE KEY `UQ_OborSlovo_ID_obor_ID_slovo` (`ID_obor`,`ID_klicove_slovo`), ADD KEY `ID_klicove_slovo` (`ID_klicove_slovo`), ADD KEY `ID_obor` (`ID_obor`), ADD KEY `ID_priorita` (`ID_priorita`);

--
-- Klíče pro tabulku `priorita`
--
ALTER TABLE `priorita`
 ADD PRIMARY KEY (`ID_priorita`), ADD UNIQUE KEY `UQ_Priorita_Hodnota` (`Hodnota`), ADD UNIQUE KEY `UQ_Priorita_ID_priorita` (`ID_priorita`);

--
-- Klíče pro tabulku `typ_studia`
--
ALTER TABLE `typ_studia`
 ADD PRIMARY KEY (`ID_typ`), ADD UNIQUE KEY `UQ_Typ_studia_Typ_nazev` (`Typ_nazev`), ADD UNIQUE KEY `UQ_Typ_studia_ID_typ` (`ID_typ`);

--
-- Klíče pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `forma_studia`
--
ALTER TABLE `forma_studia`
MODIFY `ID_forma` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pro tabulku `klicove_slovo`
--
ALTER TABLE `klicove_slovo`
MODIFY `ID_klicove_slovo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=182;
--
-- AUTO_INCREMENT pro tabulku `oblast`
--
ALTER TABLE `oblast`
MODIFY `ID_oblast` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT pro tabulku `obor`
--
ALTER TABLE `obor`
MODIFY `ID_obor` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT pro tabulku `priorita`
--
ALTER TABLE `priorita`
MODIFY `ID_priorita` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pro tabulku `typ_studia`
--
ALTER TABLE `typ_studia`
MODIFY `ID_typ` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `klicove_slovo`
--
ALTER TABLE `klicove_slovo`
ADD CONSTRAINT `FK_Klicove_slovo_Oblast` FOREIGN KEY (`ID_oblast`) REFERENCES `oblast` (`ID_oblast`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `obor`
--
ALTER TABLE `obor`
ADD CONSTRAINT `FK_Obor_Forma_studia` FOREIGN KEY (`ID_forma`) REFERENCES `forma_studia` (`ID_forma`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_Obor_Typ_studia` FOREIGN KEY (`ID_typ`) REFERENCES `typ_studia` (`ID_typ`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `obor_slovo`
--
ALTER TABLE `obor_slovo`
ADD CONSTRAINT `FK_OborSlovo_Klicove_slovo` FOREIGN KEY (`ID_klicove_slovo`) REFERENCES `klicove_slovo` (`ID_klicove_slovo`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_OborSlovo_Obor` FOREIGN KEY (`ID_obor`) REFERENCES `obor` (`ID_obor`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_OborSlovo_Priorita` FOREIGN KEY (`ID_priorita`) REFERENCES `priorita` (`ID_priorita`) ON DELETE CASCADE ON UPDATE CASCADE;
