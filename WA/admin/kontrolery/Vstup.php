<?php
	class Vstup	{
		
		const spatnyNazev = " smí obsahovat pouze písmena, číslice, pomlčky a mezery";
		const spatnaUrl = " není ve správném formátu";
		const spatnyPopis = " smí obsahovat pouze písmena, číslice, mezery a znaky . , : -";
		
		
		public static function overNazev($nazev)	{
			return $nazev=="" ? true : preg_match("/^[a-zA-Z0-9ÁáÉéÍíÓóÚúÝýČčĎďĚěŇňŘřŠšŤťŽžŮů \-]*$/",$nazev);
		}
		
		public static function overUrl($url)	{
			return $url=="" ? true : preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url);
		}
		
		public static function overPopis($popis)	{
			return $popis=="" ? true : preg_match("/^[a-zA-Z0-9ÁáÉéÍíÓóÚúÝýČčĎďĚěŇňŘřŠšŤťŽžŮů\.,: \-]*$/",$popis);
		}
	}
?>