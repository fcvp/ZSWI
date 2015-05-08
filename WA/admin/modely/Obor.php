<?php
	/**
	 * Třída, obsahující metody pro práci se studijními obory
	 * 
	 * @author Jan Baxa	 	 
	 */	 	
	class Obor	{
		
		/**
		 * Přidá studijní obor, pokud studijní obor s daným názvem, formou studia a typem studia není v databázi
		 * 
		 * @param String $nazev název studijního oboru
		 * @param int $idFormy ID formy studia
		 * @param int $idTypu ID typu studia
		 * @param String $url odkaz na popis oboru
		 * @param String $popis popis oboru
		 * @return boolean indikace, zda se přidání oboru zdařilo		 		 		 		 		 		 		 
		 */		 		
		public static function pridejObor($nazev, $idFormy, $idTypu, $url, $popis)	{
			if (Db::dotazJeden("select id_obor from obor where obor_nazev = ? and id_typ = ? and id_forma = ?", array($nazev, $idTypu, $idFormy)))	{
				return false;
			}
			else	{
				Db::dotaz("insert into obor (obor_nazev, url, popis, id_typ, id_forma) values (?, ?, ?, ?, ?);", array($nazev, $url, $popis, $idTypu, $idFormy));
				return true;
			}
		}
		
		/**
		 * Vrátí ID priority vazby mezi studijním oborem a klíčovým slovem, pokud žádná neexistuje, vrátí 0
		 * 
		 * @param int $idSlova ID klíčového slova
		 * @param int $idOboru ID studijního oboru
		 * @return int ID priority vazby nebo 0 		 
		 */		 		
		public static function getVazbaOborSlovo($idSlova, $idOboru)	{
			$zaznam = Db::dotazJeden("select id_priorita from obor_slovo where id_klicove_slovo = ? and id_obor = ?", array($idSlova, $idOboru));
			if ($zaznam)	{
				return $zaznam["id_priorita"];
			}
			else	{
				return 0;
			}
		}
		
		/**
		 * Nastaví prioritu vazby mezi studijním oborem a klíčovým slovem, pokud žádná vazba není, vymaže jí z databáze
		 * 
		 * @param int $idSlova ID klíčového slova
		 * @param int $idOboru ID studijního oboru
		 * @param int $idPriority ID priority vazby		 		 		 		 
		 */		 		
		public static function vazbaOborSlovo($idSlova, $idOboru, $idPriority)	{
			if ($idPriority==0)	{
				Db::dotaz("delete from obor_slovo where id_obor = ? and id_klicove_slovo = ?", array($idOboru, $idSlova));
			}
			else	{
				Db::dotaz("insert into obor_slovo (id_obor, id_klicove_slovo, id_priorita) values (?, ?, ?) on duplicate key update id_priorita = ?", array($idOboru, $idSlova, $idPriority, $idPriority));
			}
		}
		
		/**
		 * Smaže obor a všechny vazby, které jsou k tomuto oboru
		 * 
		 * @param int $idOboru ID mazaného oboru		 		 
		 */		 		
		public static function smazObor($idOboru)	{
			Db::dotaz("delete from obor_slovo where id_obor = ?", array($idOboru));
			Db::dotaz("delete from obor where id_obor = ?", array($idOboru));
		}
		
		/**
		 * Upraví název, formu studia, typ studia, url a popis studijního oboru, poukd studijní obor se zadaným názvem, formou studia a typem studia není v databázi
		 * 
		 * @param int $idOboru ID studijního oboru
		 * @param String $nazev nový název oboru
		 * @param int $idFormy ID nové formy studia
		 * @param int $idTypu ID nového typu studia
		 * @param String $url nový odkaz na popis oboru
		 * @param String $popis nový popis studia
		 * @return boolean indikace, zda se úprava oboru zdařila		 		 		 		 		 		 		 		 
		 */		 		
		public static function upravObor($idOboru, $nazev, $idFormy, $idTypu, $url, $popis)	{
			if (Db::dotazJeden("select id_obor from obor where obor_nazev = ? and id_forma = ? and id_typ = ? and id_obor != ?", array($nazev, $idFormy, $idTypu, $idOboru)))	{
				return false;
			}
			else	{
				Db::dotaz("update obor set obor_nazev = ?, id_typ = ?, id_forma = ?, url = ?, popis = ? where id_obor = ?", array($nazev, $idTypu, $idFormy, $url, $popis, $idOboru));
				return true;
			}
		}
		
		/**
		 * Vrátí ID studijního oboru
		 * 
		 * @param String $nazevOboru název studijního oboru
		 * @param int $idFormy ID formy studia
		 * @param int $idTypu ID typu studia
		 * @return int ID studijního oboru 		 		 		 		 		 
		 */		 		
		public static function getIdOboru($nazevOboru, $idFormy, $idTypu)	{
			$zaznam = Db::dotazJeden("select id_obor from obor where obor_nazev = ? and id_forma = ? and id_typ = ?", array($nazevOboru, $idFormy, $idTypu));
			if ($zaznam)	{
				return $zaznam["id_obor"];
			}
			else return 0;
		}
		
		/**
		 * Vybere studijní obor z databáze a vrátí ho
		 * 
		 * @param int $idOboru ID studijního oboru
		 * @return mixed[] studijní obor		 		 		 
		 */		 		
		public static function getObor($idOboru)	{
			return Db::dotazJeden("select id_obor as id,obor_nazev as nazev,url,popis,id_forma,id_typ from obor where id_obor = ?", array($idOboru));
		}
		
		/**
		 * Vybere studijní obory v daném typu studia z databáze a vrátí je
		 * 
		 * @param int $idTypu ID typu studia
		 * @return mixed[][] studijní obory		 		 		 
		 */	
		public static function getObory($idTypu)	{
			return Db::dotazVsechny('select id_obor as id,obor_nazev as nazev,forma_nazev as forma from obor join forma_studia on forma_studia.id_forma = obor.id_forma where obor.id_typ=? order by nazev, forma desc', array($idTypu));
		}
		
		/**
		 * Vybere studijní obory v daném typu studia bez duplicitních názvů z databáze a vrátí je
		 * 
		 * @param int $idTypu ID typu studia
		 * @return mixed[][] studijní obory		 		 		 
		 */
		public static function getOboryPodleNazvu($idTypu)	{
			return Db::dotazVsechny("select id_obor as id,obor_nazev as nazev from obor where id_typ=? group by obor_nazev order by nazev,id", array($idTypu));
		}
	}
?>