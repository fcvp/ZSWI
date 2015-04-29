INSERT INTO `klicove_slovo` ( `Slovo`, `ID_oblast`, `Vyznam`) VALUES
( 'matematika', 7, '') ,
( 'diskrétní matematika', 7, '') ,
( 'Statistická analýza', 7, '') ,
( 'statistika a pravděpodobnost', 7, '') ,
( 'numerické metody', 7, '') ,
( 'matematická analýza', 7, '') ,
( 'finanční matematika', 7, '') ,
( 'finanční teorie', 7, '') ,
( 'lineární algebra', 7, '') ,
( 'pojistná matematika', 7, '') ,
( 'finance', 7, '') ,
( 'Matematika a její aplikace', 7, '') ,
( 'učitelství matematiky', 7, '') ,
( 'symbolicko-numerické výpočty', 7, '') ,
( 'Jazyk a metody matematiky', 7, '') ,
( 'Numerické modelování', 7, '') ,
( 'analýza dat', 7, '') ;

INSERT INTO `klicove_slovo` ( `Slovo`, `ID_oblast`, `Vyznam`) VALUES
( 'informatika', 9, '') ,
( 'databázové systémy', 9, '') ,
( 'multimédia', 9, '') ,
( 'programování v C', 9, '') ,
( 'teoretická informatika', 9, '') ,
( 'programování', 9, '') ,
( 'softwarové inženýrství', 9, '') ,
( 'operační systémy', 9, '') ,
( 'návrh a vývoj programových systémů', 9, '') ,
( 'objektové programování', 9, '') ,
( 'algoritmizace', 9, '') ,
( 'software', 9, '') ,
( 'programovací techniky', 9, '') ,
( 'programování v Javě', 9, '') ,
( 'webové aplikace', 9, '') ,
( 'Informační systémy', 9, '') ,
( 'informační technologie', 9, '') ,
( 'finanční informatika', 9, '') ,
( 'objektově orientované programování', 9, '') ,
( 'Finanční informatika a analýza', 9, '') ,
( 'teorie informace', 9, '') ,
( 'geoinformatika', 9, '') ;

INSERT INTO `klicove_slovo` ( `Slovo`, `ID_oblast`, `Vyznam`) VALUES
( 'technika vakua', 8, '') ,
( 'fyzika pevných látek', 8, '') ,
( 'fyzikálně-matematické modelování', 8, '') ,
( 'fyzikálně-chemické modelování', 8, '') ,
( 'fyzika technologických procesů', 8, '') ,
( 'tenké vrstvy', 8, '') ,
( 'fyzikální inženýrství', 8, '') ,
( 'elektronické systémy', 8, '') ,
( 'termodynamika', 8, '') ,
( 'fyzikální měření', 8, '') ,
( 'analyzační metody', 8, '') ,
( 'modifikace povrchu', 8, '') ,
( 'diagnostika plazmatu', 8, '') ,
( 'plazma materiály', 8, '') ,
( 'inženýrská fyzika', 8, '') ,
( 'aplikovaná fyzika', 8, '') ,
( 'experimentální fyzika', 8, '') ,
( 'fyzika', 8, '');


INSERT INTO `klicove_slovo` ( `Slovo`, `ID_oblast`, `Vyznam`) VALUES
( 'počítačové sítě', 15, '') ,
( 'výpočetní systémy', 15, '') ,
( 'operační systémy', 15, '') ,
( 'technika', 15, '') ,
( 'hardware', 15, '') ,
( 'Počítačová technika', 15, '');



select id_klicove_slovo into @ks from klicove_slovo where slovo = 'Statistická analýza';

select id_obor into @id from obor where obor_nazev = 'Finanční informatika a statistika';
INSERT INTO `obor_slovo` (`ID_obor`, `ID_klicove_slovo`, `ID_priorita`) VALUES
(@id, @ks, 2);

select id_obor into @id from obor where obor_nazev = 'Finanční informatika a statistika';
INSERT INTO `obor_slovo` (`ID_obor`, `ID_klicove_slovo`, `ID_priorita`) VALUES
(@id, @ks, 2);



								
