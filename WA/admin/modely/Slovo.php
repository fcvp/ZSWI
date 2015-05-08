<?php
	/**
	 * Třída, obsahující metody pro práci s klíčovými slovy
	 * 
	 * @author Jan Baxa	 	 
	 */		 	
	class Slovo	{
		
		/**
		 * Přidá klíčové slovo, pokud takové klíčové slovo není v databázi
		 * 
		 * @param String $nazev klíčové slovo
		 * @param int $idOblasti ID oblasti studia
		 * @param String $vyznam význam klíčového slova
		 * @return boolean indikace, zda se přidání slova zdařilo		 		 		 		 		 		 		 
		 */	
		public static function pridejSlovo($nazev, $idOblasti, $vyznam)	{
			if (Db::dotazJeden("select id_klicove_slovo from klicove_slovo where slovo = ?", array($nazev)))	{
				return false;
			}
			else	{
				Db::dotaz("insert into klicove_slovo (slovo, id_oblast, vyznam) values (?, ?, ?);", array($nazev, $idOblasti, $vyznam));
				return true;
			}
		}
		
		/**
		 * Smaže klíčové slovo a všechny vazby k tomuto slovu
		 * 
		 * @param int $idSlova ID mazaného slova		 		 
		 */
		public static function smazSlovo($idSlova)	{
			Db::dotaz("delete from obor_slovo where id_klicove_slovo = ?", array($idSlova));
			Db::dotaz("delete from klicove_slovo where id_klicove_slovo = ?", array($idSlova));
		}
		
		/**
		 * Upraví klíčové slovo, ID oblasti a význam slova, poukd takové klíčové slovo není v databázi
		 * 
		 * @param int $idSlova ID klíčového slova
		 * @param String $nazev nové klíčové slovo
		 * @param int $idOblasti ID nové oblasti studia
		 * @param String $vyznam nový význam klíčového slova
		 * @return boolean indikace, zda se úprava slova zdařila		 		 		 		 		 		 		 		 
		 */	
		public static function upravSlovo($idSlova, $nazev, $idOblasti, $vyznam)	{
			if (Db::dotazJeden("select id_klicove_slovo from klicove_slovo where slovo = ? and id_klicove_slovo != ?", array($nazev, $idSlova)))	{
				return false;
			}
			else	{
				Db::dotaz("update klicove_slovo set slovo = ?, id_oblast = ?, vyznam = ? where id_klicove_slovo = ?", array($nazev, $idOblasti, $vyznam, $idSlova));
				return true;
			}
		}
		
		/**
		 * Vrátí ID priority vazby mezi studijním oborem a klíčovým slovem, pokud žádná neexistuje, vrátí 0
		 * 
		 * @param int $idSlova ID klíčového slova
		 * @param String $nazevOboru Název oboru
		 * @param int $idTypu ID typu studia, ve kterém se název oboru nachází		 
		 * @return int ID priority vazby nebo 0 		 
		 */	
		public static function getVazbaOborSlovo($idSlova, $nazevOboru, $idTypu)	{
			$zaznam = Db::dotazJeden("select id_priorita from obor_slovo join obor on obor_slovo.id_obor = obor.id_obor where id_klicove_slovo = ? and obor_nazev = ? and id_typ = ? order by obor.id_obor", array($idSlova, $nazevOboru, $idTypu));
			if ($zaznam)	{
				return $zaznam["id_priorita"];
			}
			else	{
				return 0;
			}
		}
		
		/**
		 * Nastaví prioritu vazby mezi všemi studijními obory v daném typu studia a klíčovým slovem, pokud žádná vazba není, vymaže jí z databáze (Pokud obor existuje ve více formách, nastaví se vazba u všech)
		 * 
		 * @param int $idSlova ID klíčového slova
		 * @param String $nazevOboru název oboru		 
		 * @param int $idPriority ID priority vazby
		 * @param int $idTypu ID typu studia, ve kterém se název oboru nachází	 	 		 		 		 
		 */	
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
		
		/**
		 * Vrátí ID klíčového slova
		 * 
		 * @param String $slovo klíčové slovo
		 * @return int ID klíčového slova
		 */	
		public static function getIdSlova($slovo)	{
			$zaznam = Db::dotazJeden("select id_klicove_slovo from klicove_slovo where slovo = ?", array($slovo));
			return $zaznam["id_klicove_slovo"];
		}
		
		/**
		 * Vybere klíčové slovo z databáze a vrátí je
		 * 
		 * @param int $idSlova ID klíčového slova
		 * @return mixed[] klíčové slovo
		 */	
		public static function getSlovo($idSlova)	{
			return Db::dotazJeden("select id_klicove_slovo as id,slovo as nazev,vyznam,id_oblast from klicove_slovo where id_klicove_slovo = ?", array($idSlova));
		}
		
		/**
		 * Vybere všechna klíčová slova z databáze a vrátí je
		 * 
		 * @return mixed[][] klíčová slova
		 */
		public static function getVsechnaSlova()	{
			return Db::dotazVsechny("select id_klicove_slovo as id,slovo as nazev from klicove_slovo order by nazev;");
		}
		
		/**
		 * Vybere všechna klíčová slova v daném oboru z databáze a vrátí je
		 * 
		 * @param int $idOboru ID studijního oboru		 
		 * @return mixed[][] klíčová slova
		 */
		public static function getSlovaPodleOboru($idOboru)	{
			return Db::dotazVsechny("select slovo as nazev from klicove_slovo join obor_slovo on obor_slovo.id_klicove_slovo=klicove_slovo.id_klicove_slovo where id_obor = ? order by nazev", array($idOboru));
		}
		
		/**
		 * Vybere klíčová slova v dané oblasti studia z databáze a vrátí je
		 * 
		 * @param int $idOblasti ID oblasti studia		 
		 * @return mixed[][] klíčová slova
		 */
		public static function getSlova($idOblasti)	{
			return Db::dotazVsechny('select id_klicove_slovo as id,slovo as nazev,vyznam from klicove_slovo where id_oblast=? order by nazev', array($idOblasti));
		}
	}
?>