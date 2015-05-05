<?php
	class Priorita	{		
		public static function getVsechnyPriority()	{
			return Db::dotazVsechny('select id_priorita as id,poznamka as nazev from priorita order by nazev');
		}
	}
?>