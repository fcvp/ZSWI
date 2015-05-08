<?php
	/**
	 * Třída, která zpracovává události, které se na webu provádí
	 * 
	 * @author Jan Baxa	 	 
	 */	 	
	class Udalost	{
		/**
		 * Konstruktor, uloží do databáze událost
		 * 
		 * @param String $typ typ akce (Added, Edited, Deleted)
		 * @param String $clanek typ záznamu, kterýho se akce týká (Studijní obor, Forma studia, ...)
		 * @param int $idClanku ID záznamu, kterého se akce týká
		 */		 		
		public function __construct($typ, $clanek, $idClanku)	{
			Db::dotaz("insert into posledni_akce (typ, clanek, id_clanku, datum) values (?, ?, ?, now())", array($typ, $clanek, $idClanku));
		}
		
		/**
		 * Vypíše poslední události na webu, pokud není zadán limit, vypíše všechny
		 * 
		 * @param int $limit počet vypisovaných událostí		 		 
		 */		 		
		public static function vypisUdalosti($limit = 0)	{
			return Db::dotazVsechny("select * from posledni_akce order by datum desc".($limit==0 ? "" : " limit ".$limit).";");
		}
	}
?>