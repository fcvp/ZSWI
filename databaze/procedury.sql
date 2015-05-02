-- DatAdmin Native MySQL Dump

/*!40101 SET NAMES utf8 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

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
/*!50010 CREATE  PROCEDURE `insert_klicove_slovo`(slovo VARCHAR(255), oblast varchar(50), vyznam TEXT)
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
 	
 		select id_oblast into @id from oblast where oblast.oblast_nazev = oblast_nazev;
 		
		INSERT INTO klicove_slovo (Slovo, Vyznam, ID_oblast) VALUES (
		     slovo, 
		     vyznam,
		     @id
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
/*!50010 CREATE  PROCEDURE `update_obor_slovo`(id_obor int , id_klicove_slovo int, id_obor_nove int , id_klicove_slovo_nove int,  id_priorita int )
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

END*/;;
DELIMITER ;
DELIMITER ;;
/*!50010 CREATE  PROCEDURE `update_obor_slovo_2`(obor_nazev VARCHAR(255), slovo VARCHAR(255), priorita int, forma varchar(100))
BEGIN
	DECLARE ks varchar(200);
	DECLARE id varchar(200);
	
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
 	    
 		select id_klicove_slovo into @ks from klicove_slovo where klicove_slovo.slovo = slovo;
		
		select id_obor into @id from obor where obor.obor_nazev = obor_nazev and forma_nazev=forma;
		
		INSERT INTO obor_slovo (ID_obor, ID_klicove_slovo, ID_priorita) VALUES
		(@id, @ks, priorita);
		
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
