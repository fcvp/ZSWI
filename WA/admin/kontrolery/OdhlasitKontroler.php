<?php
	class OdhlasitKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	        
	        // Hlavička stránky
	        $this->hlavicka = array(
                'titulek' => "Odhlášení"
        	);
        	
        	$uzivatel = new Uzivatel();
        	
        	$uzivatel->odhlasit();
        	
        	$this->presmeruj("prihlasit");
	    }
	}
?>