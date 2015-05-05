<?php
	class Oblast	{
		
		public static function pridejOblast($nazev)	{
			if (Db::dotazJeden("select id_oblast from oblast where oblast_nazev = ?", array($nazev)))	{
				return false;
			}
			else	{
				Db::dotaz("insert into oblast (oblast_nazev) values (?);", array($nazev));
				return true;
			}
		}
		
		public static function smazOblast($idOblasti)	{
			Db::dotaz("delete from klicove_slovo where id_oblast = ?", array($idOblasti));
			Db::dotaz("delete from oblast where id_oblast = ?", array($idOblasti));
		}
		
		public static function upravOblast($idOblasti, $nazev)	{
			if (Db::dotazJeden("select id_oblast from oblast where oblast_nazev = ? and id_oblast != ?", array($nazev, $idOblasti)))	{
				return false;
			}
			else	{
				Db::dotaz("update oblast set oblast_nazev = ? where id_oblast = ?", array($nazev, $idOblasti));
				return true;
			}
		}
		
		public static function getIdOblasti($nazevOblasti)	{
			$zaznam = Db::dotazJeden("select id_oblast from oblast where oblast_nazev = ?", array($nazevOblasti));
			return $zaznam["id_oblast"];
		}
		
		public static function getOblast($idOblasti)	{
			return Db::dotazJeden("select id_oblast as id,oblast_nazev as nazev from oblast where id_oblast = ?", array($idOblasti));
		}
		
		public static function getVsechnyOblasti()	{
			return Db::dotazVsechny('select id_oblast as id,oblast_nazev as nazev from oblast order by nazev');
		}
	}
?>