<?php
	class Typ	{
		
		public static function pridejTyp($nazev)	{
			if (Db::dotazJeden("select id_typ from typ_studia where typ_nazev = ?", array($nazev)))	{
				return false;
			}
			else	{
				Db::dotaz("insert into typ_studia (typ_nazev) values (?);", array($nazev));
				return true;
			}
		}
		
		public static function smazTyp($idTypu)	{
			Db::dotaz("delete obor_slovo from obor_slovo join obor on obor_slovo.id_obor=obor.id_obor where obor.id_typ=?", array($idTypu));
			Db::dotaz("delete from obor where id_typ = ?", array($idTypu));
			Db::dotaz("delete from typ_studia where id_typ = ?", array($idTypu));
		}
		
		public static function upravTyp($idTypu, $nazev)	{
			if (Db::dotazJeden("select id_typ from typ_studia where typ_nazev = ? and id_typ != ?", array($nazev, $idTypu)))	{
				return false;
			}
			else	{
				Db::dotaz("update typ_studia set typ_nazev = ? where id_typ = ?", array($nazev, $idTypu));
				return true;
			}
		}
		
		public static function getIdTypu($nazevTypu)	{
			$zaznam = Db::dotazJeden("select id_typ from typ_studia where typ_nazev = ?", array($nazevTypu));
			return $zaznam["id_typ"];
		}
		
		public static function getNazev($idTypu)	{
			$zaznam = Db::dotazJeden("select typ_nazev from typ_studia where id_typ = ?", array($idTypu));
			return $zaznam["typ_nazev"];
		}
		
		public static function getTyp($idTypu)	{
			return Db::dotazJeden("select id_typ as id,typ_nazev as nazev from typ_studia where id_typ = ?", array($idTypu));
		}
		
		public static function getVsechnyTypy()	{
			return Db::dotazVsechny('select id_typ as id,typ_nazev as nazev from typ_studia order by nazev');
		}
	}
?>