<?php
	/**
	 * Kontroler pro odhlašovací stránku
	 * 
	 * @author Jan Baxa	 	 
	 */	 	
	class OdhlasitKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	        
	        // nastavení titulku stránky
	        $this->hlavicka = array(
                'titulek' => "Odhlášení"
        	);
        	
        	// instance uživatele
        	$uzivatel = new Uzivatel();
        	
        	// odhlášení uživatele
        	$uzivatel->odhlasit();
        	
        	// přesměrování zpět na přihlašovací stránku
        	$this->presmeruj("prihlasit");
	    }
	}
?>