<?php
	/**
	 * Kontroler pro přihlašovací stránku
	 */	 	
	class PrihlasitKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	        
	        // nastavení titulku stránky
	        $this->hlavicka = array(
                'titulek' => "Přihlášení"
        	);
        	
        	// instance uživatele
        	$uzivatel = new Uzivatel();
        	
        	// pokud již je uživatel přihlášen -> přesměrování na úvodní stránku administrace
        	if ($uzivatel->jePrihlasen()) $this->presmeruj("uvod");
        	
        	// po odeslání formuláře
        	if (!empty($_POST))	{
						if ($uzivatel->prihlasit($_POST["prezdivka"], $_POST["heslo"]))	{
							// uživatel se úspěšně přihlásil -> přesměrování na úvodní stránku administrace
							$this->presmeruj("");
						}
					}
					
	    }
	}
?>