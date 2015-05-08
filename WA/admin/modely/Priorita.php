<?php
	class Priorita	{		
		public static function getVsechnyPriority()	{
			return Db::dotazVsechny('select id_priorita as id,poznamka as nazev from priorita order by nazev');
		}
		
		public static function getHodnotaPriority($idPriority)	{
			$zaznam = Db::dotazJeden("select hodnota from priorita where id_priorita = ?", array($idPriority));
			if ($zaznam) return $zaznam["hodnota"];
			else return 0;
		}
	}
?>