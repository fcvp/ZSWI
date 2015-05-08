<?php
	/**
	 * Kontroler pro podstránku Poslední akce
	 * 
	 * @author Jan Baxa	 	 
	 */	 	
	class PosledniAkceKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	        
	        // nastavení titulku stránky
	        $this->hlavicka = array(
                'titulek' => "Poslední akce"
        	);
        	
        	// Získání všech událostí
	        $this->data["posledni_akce"] = Udalost::vypisUdalosti();
        	
        	// nastavení pohledu
	        $this->pohled = 'posledni-akce';
	    }
	}
?>