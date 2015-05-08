<?php
	/**
	 * Třída, která ověřuje správnost vstupů
	 * 
	 * @author Jan Baxa	 	 
	 */	 	
	class Vstup	{
		/** @var String $spatnyNazev hláška s výpisem povolených znaků pro názvy */
		const spatnyNazev = " smí obsahovat pouze písmena, číslice, pomlčky a mezery";
		/** @var String $spatnyNazev hláška s výpisem, že URL adresa není ve správném formátu */
		const spatnaUrl = " není ve správném formátu";
		/** @var String $spatnyNazev hláška s výpisem povolených znaků pro popis (oboru) */
		const spatnyPopis = " smí obsahovat pouze písmena, číslice, mezery a znaky . , : -";
		
		/**
		 * Ověří, zda vstup obsahuje pouze povoléné znaky
		 * 
		 * @param String $nazev testovaný řetězec
		 * @return boolean indikace, zda testovaný řetězec obsahuje pouze povolené znaky	 		 
		 */		 		
		public static function overNazev($nazev)	{
			return $nazev=="" ? true : preg_match("/^[a-zA-Z0-9ÁáÉéÍíÓóÚúÝýČčĎďĚěŇňŘřŠšŤťŽžŮů \-]*$/",$nazev);
		}
		
		/**
		 * Ověří, zda vstup je ve správném formátu
		 * 
		 * @param String $url testovaná url adresa
		 * @return boolean indikace, zda je url adresa ve správném formátu		 		 		 
		 */		 		
		public static function overUrl($url)	{
			return $url=="" ? true : preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url);
		}
		
		
		/**
		 * Ověří, zda vstup obsahuje pouze povoléné znaky
		 * 
		 * @param String $popis testovaný řetězec
		 * @return boolean indikace, zda testovaný řetězec obsahuje pouze povolené znaky		 		 		 
		 */		 		
		public static function overPopis($popis)	{
			return $popis=="" ? true : preg_match("/^[a-zA-Z0-9ÁáÉéÍíÓóÚúÝýČčĎďĚěŇňŘřŠšŤťŽžŮů\.,: \-]*$/",$popis);
		}
	}
?>