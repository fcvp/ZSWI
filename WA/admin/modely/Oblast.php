<?php
	/**
	 * Třída, obsahující metody pro práci s oblastmi studia
	 * 
	 * @author Jan Baxa	 	 
	 */	
	class Oblast	{
		
		/**
		 * Přidá oblast studia pokud oblast studia s daným názvem není v databázi
		 * 
		 * @param String $nazev Jméno nové oblasti studia		 		 
		 * @return boolean indikace, zda se přidání zdařilo
		 */	
		public static function pridejOblast($nazev)	{
			if (Db::dotazJeden("select id_oblast from oblast where oblast_nazev = ?", array($nazev)))	{
				return false;
			}
			else	{
				Db::dotaz("insert into oblast (oblast_nazev) values (?);", array($nazev));
				return true;
			}
		}
		
		/**
		 * Smaže oblast, všechna klíčová slova, která jsou k dané oblasti přiřazena a vazby ke smazaným klíčovým slovům
		 * 
		 * @param int $idOblasti ID mazané oblasti	 		 
		 */	
		public static function smazOblast($idOblasti)	{
			Db::dotaz("delete obor_slovo from obor_slovo join klicove_slovo on obor_slovo.id_klicove_slovo=klicove_slovo.id_klicove_slovo where klicove_slovo.id_oblast=?", array($idOblasti));
			Db::dotaz("delete from klicove_slovo where id_oblast = ?", array($idOblasti));
			Db::dotaz("delete from oblast where id_oblast = ?", array($idOblasti));
		}
		
		/**
		 * Upraví název oblasti studia pokud oblast studia s daným názvem není v databázi
		 * 
		 * @param int $idOblasti ID upravované oblasti
		 * @param String $nazev nový název
		 * @return boolean indikace, zda se úprava zdařila		 
		 */		
		public static function upravOblast($idOblasti, $nazev)	{
			if (Db::dotazJeden("select id_oblast from oblast where oblast_nazev = ? and id_oblast != ?", array($nazev, $idOblasti)))	{
				return false;
			}
			else	{
				Db::dotaz("update oblast set oblast_nazev = ? where id_oblast = ?", array($nazev, $idOblasti));
				return true;
			}
		}
		
		/**
		 * Vrátí ID oblasti studia
		 * 
		 * @param String $nazevOblasti název oblasti studia
		 * @return int ID oblasti studia		 		 		 
		 */	
		public static function getIdOblasti($nazevOblasti)	{
			$zaznam = Db::dotazJeden("select id_oblast from oblast where oblast_nazev = ?", array($nazevOblasti));
			return $zaznam["id_oblast"];
		}
		
		/**
		 * Vybere oblasti studia z databáze a vrátí jí
		 * 
		 * @param int $idOblasti ID oblasti studia
		 * @return mixed[] oblast studia		 		 
		 */	
		public static function getOblast($idOblasti)	{
			return Db::dotazJeden("select id_oblast as id,oblast_nazev as nazev from oblast where id_oblast = ?", array($idOblasti));
		}
		
		/**
		 * Vybere všechny oblasti studia z databáze a vrátí je
		 * 
		 * @return mixed[][] oblasti studia		 		 
		 */
		public static function getVsechnyOblasti()	{
			return Db::dotazVsechny('select id_oblast as id,oblast_nazev as nazev from oblast order by nazev');
		}
	}
?>