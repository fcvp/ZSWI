<?php
	/**
	 * Třída reprezentující přihlášeného uživatele
	 * 
	 * @author Jan Baxa	 
	 */	 	 	
	class Uzivatel	{
		
		/** @var int $idUzivatele ID uživatele */
		private $idUzivatele;
		
		/**
		 * Konstruktor, zjistí zda je uživatel přihlášen (existuje $_COOKIE["id"]) a přiřadí uživateli jeho ID nebo 0 pokud přihlášen není		 
		 */		 		
		public function __construct()	{
			$this->idUzivatele = isset($_COOKIE["id"]) ? intval($_COOKIE["id"]) : 0;
		}
		
		/**
		 * Vrátí ID uživatele
		 * 
		 * @return int ID uživatele		 		 
		 */		 		
		public function getUserId()	{
			return $this->idUzivatele;
		}
		
		/**
		 * Zjistí, zda je uživatel přihlášen (ID != 0) 
		 *		 
		 * @return boolean indikace, zda je uživatel přihlášen		 
		 */		 		
		public function jePrihlasen()	{
			return !($this->idUzivatele==0);
		}
		
		/**
		 * Změní heslo uživatele, pokud je správně zadáno stávající heslo
		 * 
		 * @param String $nove_heslo nové heslo
		 * @param String $stare_heslo stávající heslo
		 * @return boolean indikace, zda se změna hesla zdařila
		 */		 		
		public function zmenitHeslo($nove_heslo, $stare_heslo)	{
			$zaznam = Db::dotazJeden('select heslo from uzivatele where id = ?', array($this->idUzivatele));
			
			if (crypt($stare_heslo, $zaznam["heslo"])==$zaznam["heslo"])	{
				Db::dotaz('update uzivatele set heslo = ? where id = ?', array(crypt($nove_heslo), $this->idUzivatele));
				return true;
			}
			return false;
		}
		
		/**
		 * Vrátí přezdívku uživatele
		 * 
		 * @param String přezdívka uživatele		 		 		 
		 */		 		
		public function getPrezdivka()	{
			$zaznam = Db::dotazJeden('select prezdivka from uzivatele where id = ?', array($this->idUzivatele));
			return $zaznam["prezdivka"];
		}
		
		/**
		 * Přihlásí uživatele (nastaví $_COOKIE["id"]) pokud souhlasí přezdívka a heslo a vrátí indikaci, zda se přihlášení zdařilo
		 * 
		 * @param String $nickname přezdívka uživatele
		 * @param String $heslo heslo uživatele
		 * @return boolean indikace, zda se přihlášení zdařilo		 		 
		 */		 		
		public function prihlasit($nickname, $heslo)	{
			$zaznam = Db::dotazJeden('select id,heslo from uzivatele where prezdivka = ?', array($nickname));
			
			if (crypt($heslo, $zaznam["heslo"])==$zaznam["heslo"])	{
				$this->idUzivatele = $zaznam["id"];
				setcookie("id", $zaznam["id"]);
				return true;
			}
			
			return false;
		}
		
		/**
		 * Odhlásí uživatele (nastaví platnost $_COOKIE["id"] o hodinu zpátky)
		 */		 		
		public function odhlasit()	{
			$this->idUzivatele=0;
			setcookie("id", 0, time()-3600);
		}
	}
?>