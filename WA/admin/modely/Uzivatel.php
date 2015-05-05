<?php
	class Uzivatel	{
		
		private $idUzivatele;
		
		public function __construct()	{
			$this->idUzivatele = isset($_COOKIE["id"]) ? intval($_COOKIE["id"]) : 0;
		}
		
		public function getUserId()	{
			return $this->idUzivatele;
		}
		
		public function jePrihlasen()	{
			return !($this->idUzivatele==0);
		}
		
		public function zmenitHeslo($nove_heslo, $stare_heslo)	{
			$zaznam = Db::dotazJeden('select heslo from uzivatele where id = ?', array($this->idUzivatele));
			
			if (crypt($stare_heslo, $zaznam["heslo"])==$zaznam["heslo"])	{
				Db::dotaz('update uzivatele set heslo = ? where id = ?', array(crypt($nove_heslo), $this->idUzivatele));
				return true;
			}
			return false;
		}
		
		public function getPrezdivka()	{
			$zaznam = Db::dotazJeden('select prezdivka from uzivatele where id = ?', array($this->idUzivatele));
			return $zaznam["prezdivka"];
		}
		
		public function prihlasit($nickname, $heslo)	{
			$zaznam = Db::dotazJeden('select id,heslo from uzivatele where prezdivka = ?', array($nickname));
			
			if (crypt($heslo, $zaznam["heslo"])==$zaznam["heslo"])	{
				$this->idUzivatele = $zaznam["id"];
				setcookie("id", $zaznam["id"]);
				return true;
			}
			
			return false;
		}
		
		public function odhlasit()	{
			$this->idUzivatele=0;
			setcookie("id", 0, time()-3600);
		}
	}
?>