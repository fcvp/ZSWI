<?php
	/**
	 * Třída, která zajišťuje komunikaci s databází
	 *
	 * @author Jan Baxa	 
	 */	 	 	
	class Db	{
		/** @var PDO $spojeni instance objektu PDO */
		private static $spojeni;
		
		/** nastavení připojení k databázi */
		private static $nastaveni = array(
    	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
      PDO::ATTR_EMULATE_PREPARES => false,
		);
		
		/**
		 * Metoda, která do proměnné $spojeni uloží připojení k databázi
		 * 
		 * @param String $host Adresa databázového serveru
		 * @param String $uzivatel Uživatelské jméno
		 * @param String $heslo heslo
		 * $param String $databaze databáze		 		 
		 */		 		
		public static function pripoj($host, $uzivatel, $heslo, $databaze) {
    	if (!isset(self::$spojeni)) {
        self::$spojeni = @new PDO(
                "mysql:host=$host;dbname=$databaze",
                $uzivatel,
                $heslo,
                self::$nastaveni
        );
      }
		}
		
		/**
		 * Metoda, která vrátí jeden záznam z databáze
		 * 
		 * @param String $dotaz SQL dotaz
		 * $param mixed[] $paramatery pole parametrů
		 * @return mixed[] záznam jako pole		 		 		 		 
		 */		 		
		public static function dotazJeden($dotaz, $parametry = array()) {
      $navrat = self::$spojeni->prepare($dotaz);
      $navrat->execute($parametry);
      return $navrat->fetch();
		}
		
		/**
		 * Metoda, která vrátí všechny záznamy z databáze
		 * 
		 * @param String $dotaz SQL dotaz
		 * $param mixed[] $paramatery pole parametrů
		 * @return mixed[][] záznamy jako pole		 		 		 		 
		 */
		public static function dotazVsechny($dotaz, $parametry = array()) {
      $navrat = self::$spojeni->prepare($dotaz);
      $navrat->execute($parametry);
      return $navrat->fetchAll();
		}
		
		/**
		 * Metoda, která provede příkaz a vrátí počet ovlivněných záznamů
		 * 
		 * @param String $dotaz SQL dotaz
		 * @param mixed[] $parametry pole parametrů
		 * @return int Počet ovlivněných záznamů		 		 		 		 
		 */		 		
		public static function dotaz($dotaz, $parametry = array()) {
      $navrat = self::$spojeni->prepare($dotaz);
      $navrat->execute($parametry);
      return $navrat->rowCount();
		}
	}
?>