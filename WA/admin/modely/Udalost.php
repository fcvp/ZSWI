<?php
	class Udalost	{
		public function __construct($typ, $clanek, $id_clanku)	{
			Db::dotaz("insert into posledni_akce (typ, clanek, id_clanku, datum) values (?, ?, ?, now())", array($typ, $clanek, $id_clanku));
		}
		
		public static function vypisUdalosti($limit = 0)	{
			return Db::dotazVsechny("select * from posledni_akce order by datum desc".($limit==0 ? "" : " limit ".$limit).";");
		}
	}
?>