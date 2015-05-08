<?php
	/**
	 * Směrovací kontroler (router)
	 *
	 * @author Jan Baxa	 
	 */
	class SmerovacKontroler extends Kontroler	{
		
		/** @var Kontroler $kontroler instance kontroleru pro zobrazovanou (pod)stránku */
		protected $kontroler;
		
		public function zpracuj($parametry)	{
			// instance uživatele
			$uzivatel = new Uzivatel();
			// pokud je uživatel přihlášen
			if ($uzivatel->jePrihlasen())	{
				// naparsování url
				$naparsovanaURL = $this->parsujURL($parametry[0]);
				// pokud za lomítkem nic není -> přesměrování na hlavní stránku			
				if (empty($naparsovanaURL[0])) $this->presmeruj('uvod');
				// získání kontroleru (podle zadané url adresy)
	      $tridaKontroleru = $this->pomlckyDoVelbloudiNotace(array_shift($naparsovanaURL)) . 'Kontroler';
	      
	      // pokud kontroler existuje (tedy i podstránka) -> vytvoření instance kontroleru
	      if (file_exists('kontrolery/' . $tridaKontroleru . '.php'))	$this->kontroler = new $tridaKontroleru;
	      // pokud kontroler neexistuje -> přesměrování na chybovou stránkuk
				else	$this->presmeruj('chyba');
				
				// volání hlavní metody kontroleru podstránky
				$this->kontroler->zpracuj($naparsovanaURL);
				
				// přiřazení metadat (titulek, popis stránky a klíčová slova)
				$this->data['titulek'] = $this->kontroler->hlavicka['titulek']." | Admincenter";
				$this->data['popis'] = $this->kontroler->hlavicka['popis'];
				$this->data['klicova_slova'] = $this->kontroler->hlavicka['klicova_slova'];
				
				// získání přezdívky přihlášeného uživatele
				$this->data['prezdivka'] = $uzivatel->getPrezdivka();
				
				// pokud se jedná o podstránku slova-v-oborech -> pohled nastaven na prázdnou stránku
				if ($tridaKontroleru == "SlovaVOborechKontroler")	{
					$this->pohled = 'prazdna-stranka';
				}
				else	{				
					$this->pohled = 'rozlozeni';
				}
			}
			// pokud uživatel není přihlášen -> přesměrování na přihlašovací stránku
			else	{
				$tridaKontroleru = 'PrihlasitKontroler';
				
				$this->kontroler = new $tridaKontroleru;
				$this->kontroler->zpracuj("");
				
				$this->data['titulek'] = $this->kontroler->hlavicka['titulek']." | Admincenter";
				$this->data['popis'] = $this->kontroler->hlavicka['popis'];
				$this->data['klicova_slova'] = $this->kontroler->hlavicka['klicova_slova'];
				
				$this->pohled = 'prihlaseni';
			}
		}
		
		/**
		 * Naparsuje url podle lomítek
		 * 
		 * @param String $url url adresa za prvním lomítkem
		 * @return String[] naparsovaná url bez první hodnoty (admin)		 		 		 
		 */		 				
		private function parsujURL($url)	{
			$naparsovanaURL = parse_url($url);
			$naparsovanaURL["path"] = ltrim($naparsovanaURL["path"], "/");
			$naparsovanaURL["path"] = trim($naparsovanaURL["path"]);
			
			$rozdelenaCesta = explode("/", $naparsovanaURL["path"]);
			
			array_shift($rozdelenaCesta);
			
			return $rozdelenaCesta;
		}
		
		/**
		 * Převede text s pomlčkama na text bez pomlček ve ve vebloudí notaci
		 * 
		 * @param String $text text (url) s pomlčkama
		 * @return String text bez pomlček ve vebloudí notaci		 		 		 
		 */		 		
		private function pomlckyDoVelbloudiNotace($text)	{
			$veta = str_replace('-', ' ', $text);
			$veta = ucwords($veta);
			$veta = str_replace(' ', '', $veta);
			
			return $veta;
		}
}
?>