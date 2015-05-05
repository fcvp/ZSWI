<?php
	class PrihlasitKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	        
	        // Hlavička stránky
	        $this->hlavicka = array(
                'titulek' => "Přihlášení"
        	);
        	
        	$uzivatel = new Uzivatel();
        	
        	if ($uzivatel->jePrihlasen()) $this->presmeruj("uvod");
        	        	
					$this->data['prihlaseni'] = "";
        	
        	
        	if (!empty($_POST))	{
						if ($uzivatel->prihlasit($_POST["prezdivka"], $_POST["heslo"]))	{
							
							$this->presmeruj("uvod");
						}
						else	{
							$this->data['prihlaseni'] = "Přihlášení se nezdařilo";
						}
					}
					
					$this->pohled = 'prihlaseni';
	    }
	}
?>