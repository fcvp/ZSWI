<?php
	/**
	 * Třída, obsahující metody pro práci s prioritami vazeb mezi klíčovými slovy a studijními obory
	 * 
	 * @author Jan Baxa	 	 
	 */	
	class Priorita	{
		
		/**
		 * Vybere všechny priority z databáze a vrátí je
		 * 
		 * @return mixed[][] priority		 		 
		 */	 		
		public static function getVsechnyPriority()	{
			return Db::dotazVsechny('select id_priorita as id,poznamka as nazev from priorita order by nazev');
		}
		
		/**
		 * Vrátí hodnotu vazby
		 * 
		 * @param int $idPriority ID priority
		 * @return double hodnota priority		 		 		 
		 */		 		
		public static function getHodnotaPriority($idPriority)	{
			$zaznam = Db::dotazJeden("select hodnota from priorita where id_priorita = ?", array($idPriority));
			if ($zaznam) return $zaznam["hodnota"];
			else return 0;
		}
	}
?>