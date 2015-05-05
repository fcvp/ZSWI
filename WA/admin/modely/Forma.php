<?php
	class Forma	{
		
		public static function pridejFormu($nazev)	{
			if (Db::dotazJeden("select id_forma from forma_studia where forma_nazev = ?", array($nazev)))	{
				return false;
			}
			else	{
				Db::dotaz("insert into forma_studia (forma_nazev) values (?);", array($nazev));
				return true;
			}
		}
		
		public static function smazFormu($idFormy)	{
			Db::dotaz("delete obor_slovo from obor_slovo join obor on obor_slovo.id_obor=obor.id_obor where obor.id_forma=?", array($idFormy));
			Db::dotaz("delete from obor where id_forma = ?", array($idFormy));
			Db::dotaz("delete from forma_studia where id_forma = ?", array($idFormy));
		}
		
		public static function upravFormu($idFormy, $nazev)	{
			if (Db::dotazJeden("select id_forma from forma_studia where forma_nazev = ? and id_forma != ?", array($nazev, $idFormy)))	{
				return false;
			}
			else	{
				Db::dotaz("update forma_studia set forma_nazev = ? where id_forma = ?", array($nazev, $idFormy));
				return true;
			}
		}
		
		public static function getIdFormy($nazevFormy)	{
			$zaznam = Db::dotazJeden("select id_forma from forma_studia where forma_nazev = ?", array($nazevFormy));
			return $zaznam["id_forma"];
		}
		
		public static function getNazev($idFormy)	{
			$zaznam = Db::dotazJeden("select forma_nazev from forma_studia where id_forma = ?", array($idFormy));
			return $zaznam["forma_nazev"];
		}
		
		public static function getForma($idFormy)	{
			return Db::dotazJeden("select id_forma as id,forma_nazev as nazev from forma_studia where id_forma = ?", array($idFormy));
		}
		
		public static function getVsechnyFormy()	{
			return Db::dotazVsechny('select id_forma as id,forma_nazev as nazev from forma_studia order by nazev');
		}
	}
?>