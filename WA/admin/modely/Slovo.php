<?php
	class Slovo	{
		
		public static function pridejSlovo($nazev, $idOblasti, $vyznam)	{
			if (Db::dotazJeden("select id_klicove_slovo from klicove_slovo where slovo = ?", array($nazev)))	{
				return false;
			}
			else	{
				Db::dotaz("insert into klicove_slovo (slovo, id_oblast, vyznam) values (?, ?, ?);", array($nazev, $idOblasti, $vyznam));
				return true;
			}
		}
		
		public static function smazSlovo($idSlova)	{
			Db::dotaz("delete from obor_slovo where id_klicove_slovo = ?", array($idSlova));
			Db::dotaz("delete from klicove_slovo where id_klicove_slovo = ?", array($idSlova));
		}
		
		public static function upravSlovo($idSlova, $nazev, $idOblasti, $vyznam)	{
			if (Db::dotazJeden("select id_klicove_slovo from klicove_slovo where slovo = ? and id_klicove_slovo != ?", array($nazev, $idSlova)))	{
				return false;
			}
			else	{
				Db::dotaz("update klicove_slovo set slovo = ?, id_oblast = ?, vyznam = ? where id_klicove_slovo = ?", array($nazev, $idOblasti, $vyznam, $idSlova));
				return true;
			}
		}
		
		public static function getVazbaOborSlovo($idSlova, $nazevOboru, $idTypu)	{
			$zaznam = Db::dotazJeden("select id_priorita from obor_slovo join obor on obor_slovo.id_obor = obor.id_obor where id_klicove_slovo = ? and obor_nazev = ? and id_typ = ? order by obor.id_obor", array($idSlova, $nazevOboru, $idTypu));
			if ($zaznam)	{
				return $zaznam["id_priorita"];
			}
			else	{
				return 0;
			}
		}
		
		public static function vazbaOborSlovo($idSlova, $nazevOboru, $idPriority, $idTypu)	{
			$formy = Forma::getVsechnyFormy();
			foreach ($formy as $forma)	{
				$idOboru = Obor::getIdOboru($nazevOboru, $forma["id"], $idTypu);
				if ($idOboru != 0)	{
					if ($idPriority==0)	{
						Db::dotaz("delete from obor_slovo where id_obor = ? and id_klicove_slovo = ?", array($idOboru, $idSlova));
					}
					else	{
						Db::dotaz("insert into obor_slovo (id_obor, id_klicove_slovo, id_priorita) values (?, ?, ?) on duplicate key update id_priorita = ?", array($idOboru, $idSlova, $idPriority, $idPriority));
					}
				}
			}
		}
		
		public static function getIdSlova($slovo)	{
			$zaznam = Db::dotazJeden("select id_klicove_slovo from klicove_slovo where slovo = ?", array($slovo));
			return $zaznam["id_klicove_slovo"];
		}
		
		
		public static function getSlovo($idSlova)	{
			return Db::dotazJeden("select id_klicove_slovo as id,slovo as nazev,vyznam,id_oblast from klicove_slovo where id_klicove_slovo = ?", array($idSlova));
		}
		
		public static function getVsechnaSlova()	{
			return Db::dotazVsechny("select id_klicove_slovo as id,slovo as nazev from klicove_slovo order by nazev;");
		}
		
		public static function getSlovaPodleOboru($idOboru)	{
			return Db::dotazVsechny("select slovo as nazev from klicove_slovo join obor_slovo on obor_slovo.id_klicove_slovo=klicove_slovo.id_klicove_slovo where id_obor = ? order by nazev", array($idOboru));
		}
		
		public static function getSlova($idOblasti)	{
			return Db::dotazVsechny('select id_klicove_slovo as id,slovo as nazev,vyznam from klicove_slovo where id_oblast=? order by nazev', array($idOblasti));
		}
	}
?>