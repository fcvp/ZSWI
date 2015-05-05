<?php
	class PosledniAkceKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	        
	        // klicova slova a popis by se bral z databaze, pokud by se nejednalo o staticke stranky
	        $this->hlavicka = array(
                'titulek' => "Poslední akce",
                'klicova_slova' => "",
                'popis' => "",
        	);
        	
	        $this->data["posledni_akce"] = Udalost::vypisUdalosti();
        	
	        $this->pohled = 'posledni-akce';
	    }
	}
?>