<?php
	/**
	 * Třída, obsahující metody pro práci s typy studia
	 * 
	 * @author Jan Baxa	 	 
	 */
	class Typ	{
		
		/**
		 * Přidá typ studia pokud typ studia s daným názvem není v databázi
		 * 
		 * @param String $nazev Jméno nového typu studia		 		 
		 * @return boolean indikace, zda se přidání zdařilo
		 */	
		public static function pridejTyp($nazev)	{
			if (Db::dotazJeden("select id_typ from typ_studia where typ_nazev = ?", array($nazev)))	{
				return false;
			}
			else	{
				Db::dotaz("insert into typ_studia (typ_nazev) values (?);", array($nazev));
				return true;
			}
		}
		
		/**
		 * Smaže typ studia, všechny studijní obory, které jsou k dané formě přiřazeny a vazby ke smazaným studijním oborům
		 * 
		 * @param int $idTypu ID mazaného typu studia
		 */	
		public static function smazTyp($idTypu)	{
			Db::dotaz("delete obor_slovo from obor_slovo join obor on obor_slovo.id_obor=obor.id_obor where obor.id_typ=?", array($idTypu));
			Db::dotaz("delete from obor where id_typ = ?", array($idTypu));
			Db::dotaz("delete from typ_studia where id_typ = ?", array($idTypu));
		}
		
		/**
		 * Upraví název typu studia pokud typ studia s daným názvem není v databázi
		 * 
		 * @param int $idTypu ID upravovaného typu studia
		 * @param String $nazev nový název
		 * @return boolean indikace, zda se úprava zdařila		 
		 */	
		public static function upravTyp($idTypu, $nazev)	{
			if (Db::dotazJeden("select id_typ from typ_studia where typ_nazev = ? and id_typ != ?", array($nazev, $idTypu)))	{
				return false;
			}
			else	{
				Db::dotaz("update typ_studia set typ_nazev = ? where id_typ = ?", array($nazev, $idTypu));
				return true;
			}
		}
		
		/**
		 * Vrátí ID typu studia
		 * 
		 * @param String $nazevTypu název typu studia
		 * @return int ID typu studia		 		 		 
		 */	
		public static function getIdTypu($nazevTypu)	{
			$zaznam = Db::dotazJeden("select id_typ from typ_studia where typ_nazev = ?", array($nazevTypu));
			return $zaznam["id_typ"];
		}
		
		/**
		 * Vrátí název typu studia
		 * 
		 * @param int $idTypu ID typu studia
		 * @return String název typu studia		 		 		 
		 */
		public static function getNazev($idTypu)	{
			$zaznam = Db::dotazJeden("select typ_nazev from typ_studia where id_typ = ?", array($idTypu));
			return $zaznam["typ_nazev"];
		}
		
		/**
		 * Vybere typ studia z databáze a vrátí ho
		 * 
		 * @param int $idTypu ID typu studia
		 * @return mixed[] typ studia		 		 
		 */		 
		public static function getTyp($idTypu)	{
			return Db::dotazJeden("select id_typ as id,typ_nazev as nazev from typ_studia where id_typ = ?", array($idTypu));
		}
		
		/**
		 * Vybere všechny typy studia z databáze a vrátí je
		 * 
		 * @return mixed[][] typy studia		 		 
		 */
		public static function getVsechnyTypy()	{
			return Db::dotazVsechny('select id_typ as id,typ_nazev as nazev from typ_studia order by nazev');
		}
	}
?>