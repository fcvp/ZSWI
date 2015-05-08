<?php
	/**
	 * Kontroler pro úvodní stránku
	 * 
	 * @author Jan Baxa	 	 
	 **/	 	
	class UvodKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	        
	        // nastavení titulku stránky
	        $this->hlavicka = array(
                'titulek' => "Úvod"
        	);
        	
        	// získání posledních 15 událostí
        	$this->data["posledni_akce"] = Udalost::vypisUdalosti(15);
        	
        	// nastavení pohledu
	        $this->pohled = 'uvod';
	    }
	}
?>