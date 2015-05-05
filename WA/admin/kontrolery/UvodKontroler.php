<?php
	class UvodKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	        
	        // klicova slova a popis by se bral z databaze, pokud by se nejednalo o staticke stranky
	        $this->hlavicka = array(
                'titulek' => "Úvod",
                'klicova_slova' => "",
                'popis' => "",
        	);
        	
        	$this->data["posledni_akce"] = Udalost::vypisUdalosti(15);
        	
	        $this->pohled = 'uvod';
	    }
	}
?>