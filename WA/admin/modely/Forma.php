<?php
	/**
	 * Třída, obsahující metody pro práci s formami studia
	 * 
	 * @author Jan Baxa	 	 
	 */	 	
	class Forma	{
		
		/**
		 * Přidá formu studia pokud forma studia s daným názvem není v databázi
		 * 
		 * @param String $nazev Jméno nové formy studia		 		 
		 * @return boolean indikace, zda se přidání zdařilo
		 */		 		
		public static function pridejFormu($nazev)	{
			if (Db::dotazJeden("select id_forma from forma_studia where forma_nazev = ?", array($nazev)))	{
				return false;
			}
			else	{
				Db::dotaz("insert into forma_studia (forma_nazev) values (?);", array($nazev));
				return true;
			}
		}
		
		/**
		 * Smaže formu studia, všechny studijní obory, které jsou k dané formě přiřazeny a vazby ke smazaným studijním oborům
		 * 
		 * @param int $idFormy ID mazané formy	 		 
		 */		 		
		public static function smazFormu($idFormy)	{
			Db::dotaz("delete obor_slovo from obor_slovo join obor on obor_slovo.id_obor=obor.id_obor where obor.id_forma=?", array($idFormy));
			Db::dotaz("delete from obor where id_forma = ?", array($idFormy));
			Db::dotaz("delete from forma_studia where id_forma = ?", array($idFormy));
		}
		
		/**
		 * Upraví název formy studia pokud forma studia s daným názvem není v databázi
		 * 
		 * @param int $idFormy ID upravované formy
		 * @param String $nazev nový název
		 * @return boolean indikace, zda se úprava zdařila		 
		 */		 		
		public static function upravFormu($idFormy, $nazev)	{
			if (Db::dotazJeden("select id_forma from forma_studia where forma_nazev = ? and id_forma != ?", array($nazev, $idFormy)))	{
				return false;
			}
			else	{
				Db::dotaz("update forma_studia set forma_nazev = ? where id_forma = ?", array($nazev, $idFormy));
				return true;
			}
		}
		
		/**
		 * Vrátí ID formy studia
		 * 
		 * @param String $nazevFormy název formy studia
		 * @return int ID formy studia		 		 		 
		 */		 		
		public static function getIdFormy($nazevFormy)	{
			$zaznam = Db::dotazJeden("select id_forma from forma_studia where forma_nazev = ?", array($nazevFormy));
			return $zaznam["id_forma"];
		}
		
		/**
		 * Vrátí název formy studia
		 * 
		 * @param int $idFormy ID formy studia
		 * @return String název formy studia		 		 		 
		 */		 		
		public static function getNazev($idFormy)	{
			$zaznam = Db::dotazJeden("select forma_nazev from forma_studia where id_forma = ?", array($idFormy));
			return $zaznam["forma_nazev"];
		}
		
		/**
		 * Vybere formu studia z databáze a vrátí jí
		 * 
		 * @param int $idFormy ID formy studia
		 * @return mixed[] forma studia		 		 
		 */		 		
		public static function getForma($idFormy)	{
			return Db::dotazJeden("select id_forma as id,forma_nazev as nazev from forma_studia where id_forma = ?", array($idFormy));
		}
		
		/**
		 * Vybere všechny formy studia z databáze a vrátí je
		 * 
		 * @return mixed[][] formy studia		 		 
		 */		 		
		public static function getVsechnyFormy()	{
			return Db::dotazVsechny('select id_forma as id,forma_nazev as nazev from forma_studia order by nazev');
		}
	}
?>