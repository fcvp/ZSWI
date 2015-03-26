SET FOREIGN_KEY_CHECKS=0;




CREATE TABLE Forma_studia
(
	ID_forma INTEGER NOT NULL,
	Forma_nazev VARCHAR(50) NOT NULL,
	PRIMARY KEY (ID_forma),
	UNIQUE UQ_Forma_studia_Forma_nazev(Forma_nazev),
	UNIQUE UQ_Forma_studia_ID_forma(ID_forma)

) 
;


CREATE TABLE Klicove_slovo
(
	ID_klicove_slovo INTEGER NOT NULL,
	Slovo VARCHAR(100) NOT NULL,
	ID_oblast INTEGER NOT NULL,
	PRIMARY KEY (ID_klicove_slovo),
	UNIQUE UQ_Klicove_slovo_ID_klicove_slovo(ID_klicove_slovo),
	UNIQUE UQ_Klicove_slovo_ID_oblast(ID_oblast),
	UNIQUE UQ_Klicove_slovo_Slovo(Slovo),
	KEY (ID_oblast)

) 
;


CREATE TABLE Oblast
(
	ID_oblast INTEGER NOT NULL,
	Oblast_nazev VARCHAR(100) NOT NULL,
	PRIMARY KEY (ID_oblast),
	UNIQUE UQ_Oblast_ID_oblast(ID_oblast),
	UNIQUE UQ_Oblast_Oblast_nazev(Oblast_nazev)

) 
;


CREATE TABLE Obor
(
	ID_obor INTEGER NOT NULL,
	Obor_nazev VARCHAR(255) NOT NULL,
	Url VARCHAR(255) NOT NULL,
	Popis TEXT,
	ID_typ INTEGER NOT NULL,
	ID_forma INTEGER NOT NULL,
	PRIMARY KEY (ID_obor),
	UNIQUE UQ_Obor_ID_forma(ID_forma),
	UNIQUE UQ_Obor_ID_obor(ID_obor),
	UNIQUE UQ_Obor_ID_typ(ID_typ),
	KEY (ID_forma),
	KEY (ID_typ)

) 
;


CREATE TABLE Obor_slovo
(
	ID_obor INTEGER NOT NULL,
	ID_klicove_slovo INTEGER NOT NULL,
	ID_priorita INTEGER NOT NULL,
	PRIMARY KEY (ID_obor, ID_klicove_slovo),
	UNIQUE UQ_OborSlovo_ID_klicove_slovo(ID_klicove_slovo),
	UNIQUE UQ_OborSlovo_ID_obor(ID_obor),
	UNIQUE UQ_OborSlovo_ID_priorita(ID_priorita),
	KEY (ID_klicove_slovo),
	KEY (ID_obor),
	KEY (ID_priorita)

) 
;


CREATE TABLE Priorita
(
	ID_priorita INTEGER NOT NULL,
	Hodnota FLOAT(0) NOT NULL,
	PRIMARY KEY (ID_priorita),
	UNIQUE UQ_Priorita_Hodnota(Hodnota),
	UNIQUE UQ_Priorita_ID_priorita(ID_priorita)

) 
;


CREATE TABLE Typ_studia
(
	ID_typ INTEGER NOT NULL,
	Typ_nazev VARCHAR(50) NOT NULL,
	PRIMARY KEY (ID_typ),
	UNIQUE UQ_Typ_studia_Typ_nazev(Typ_nazev),
	UNIQUE UQ_Typ_studia_ID_typ(ID_typ)

) 
;



SET FOREIGN_KEY_CHECKS=1;


ALTER TABLE Klicove_slovo ADD CONSTRAINT FK_Klicove_slovo_Oblast 
	FOREIGN KEY (ID_oblast) REFERENCES Oblast (ID_oblast)
;

ALTER TABLE Obor ADD CONSTRAINT FK_Obor_Forma_studia 
	FOREIGN KEY (ID_forma) REFERENCES Forma_studia (ID_forma)
;

ALTER TABLE Obor ADD CONSTRAINT FK_Obor_Typ_studia 
	FOREIGN KEY (ID_typ) REFERENCES Typ_studia (ID_typ)
;

ALTER TABLE Obor_slovo ADD CONSTRAINT FK_OborSlovo_Klicove_slovo 
	FOREIGN KEY (ID_klicove_slovo) REFERENCES Klicove_slovo (ID_klicove_slovo)
;

ALTER TABLE Obor_slovo ADD CONSTRAINT FK_OborSlovo_Obor 
	FOREIGN KEY (ID_obor) REFERENCES Obor (ID_obor)
;

ALTER TABLE Obor_slovo ADD CONSTRAINT FK_OborSlovo_Priorita 
	FOREIGN KEY (ID_priorita) REFERENCES Priorita (ID_priorita)
;
