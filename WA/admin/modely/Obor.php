<?php
	class Obor	{
		
		public static function pridejObor($nazev, $idFormy, $idTypu, $url, $popis)	{
			if (Db::dotazJeden("select id_obor from obor where obor_nazev = ? and id_typ = ? and id_forma = ?", array($nazev, $idTypu, $idFormy)))	{
				return false;
			}
			else	{
				Db::dotaz("insert into obor (obor_nazev, url, popis, id_typ, id_forma) values (?, ?, ?, ?, ?);", array($nazev, $url, $popis, $idTypu, $idFormy));
				return true;
			}
		}
		
		public static function getVazbaOborSlovo($idSlova, $idOboru)	{
			$zaznam = Db::dotazJeden("select id_priorita from obor_slovo where id_klicove_slovo = ? and id_obor = ?", array($idSlova, $idOboru));
			if ($zaznam)	{
				return $zaznam["id_priorita"];
			}
			else	{
				return 0;
			}
		}
		
		public static function vazbaOborSlovo($idSlova, $idOboru, $idPriority)	{
			if ($idPriority==0)	{
				Db::dotaz("delete from obor_slovo where id_obor = ? and id_klicove_slovo = ?", array($idOboru, $idSlova));
			}
			else	{
				Db::dotaz("insert into obor_slovo (id_obor, id_klicove_slovo, id_priorita) values (?, ?, ?) on duplicate key update id_priorita = ?", array($idOboru, $idSlova, $idPriority, $idPriority));
			}
		}
		
		public static function smazObor($idOboru)	{
			Db::dotaz("delete from obor_slovo where id_obor = ?", array($idOboru));
			Db::dotaz("delete from obor where id_obor = ?", array($idOboru));
		}
		
		public static function upravObor($idOboru, $nazev, $idFormy, $idTypu, $url, $popis)	{
			if (Db::dotazJeden("select id_obor from obor where obor_nazev = ? and id_forma = ? and id_typ = ? and id_obor != ?", array($nazev, $idFormy, $idTypu, $idOboru)))	{
				return false;
			}
			else	{
				Db::dotaz("update obor set obor_nazev = ?, id_typ = ?, id_forma = ?, url = ?, popis = ? where id_obor = ?", array($nazev, $idTypu, $idFormy, $url, $popis, $idOboru));
				return true;
			}
		}
		
		
		public static function getIdOboru($nazevOboru, $idFormy, $idTypu)	{
			$zaznam = Db::dotazJeden("select id_obor from obor where obor_nazev = ? and id_forma = ? and id_typ = ?", array($nazevOboru, $idFormy, $idTypu));
			if ($zaznam)	{
				return $zaznam["id_obor"];
			}
			else return 0;
		}
		
		
		public static function getObor($idOboru)	{
			return Db::dotazJeden("select id_obor as id,obor_nazev as nazev,url,popis,id_forma,id_typ from obor where id_obor = ?", array($idOboru));
		}
		
		public static function getObory($idTypu)	{
			return Db::dotazVsechny('select id_obor as id,obor_nazev as nazev,forma_nazev as forma from obor join forma_studia on forma_studia.id_forma = obor.id_forma where obor.id_typ=? order by nazev', array($idTypu));
		}
		
		// vrati obory v danem typu a odstrani ty s duplicitnimi nazvy		 		
		public static function getOboryPodleNazvu($idTypu)	{
			return Db::dotazVsechny("select id_obor as id,obor_nazev as nazev from obor where id_typ=? group by obor_nazev order by nazev,id", array($idTypu));
		}
	}
?>