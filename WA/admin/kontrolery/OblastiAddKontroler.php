<?php
	/**
	 * Kontroler pro podstránku Přidat oblast studia
	 * 
	 * @author Jan Baxa	 	 
	 */	 	
	class OblastiAddKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	    		// nastavení titulku stránky
	        $this->hlavicka = array(
                'titulek' => "Přidat oblast studia"
        	);
					
					// po odeslání formuláře
					if (!empty($_POST))	{
						// odstranení bílých znaků na začátku a na konci řetězce
						$_POST["nazev"] = trim($_POST["nazev"]);
						// uložení odeslaných dat
						$this->data["post"] = $_POST;
						
						// kontrola vyplnění názvu oblasti
						if ($_POST["nazev"]=="")	{
							$this->data["upozorneni"] = "Zadejte název oblasti.";
						}
						// kontrola správnýho vstupu
						else if (!Vstup::overNazev($_POST["nazev"]))	{
							$this->data["upozorneni"] = "Název oblasti studia".Vstup::spatnyNazev;
						}
						else	{
							// Oblast byla přidána
							if (Oblast::pridejOblast($_POST["nazev"]))	{
								$this->data["upozorneni"] = "Oblast <span class='bold'>".$_POST["nazev"]."</span> byla přidána.";
								new Udalost("Added", "Oblast studia", Oblast::getIdOblasti($_POST["nazev"]));
								// vymazání odeslaných dat (vyprázdnění formuláře)
								$this->data["post"] = null;
							}
							// Oblast studia s tímto názvem již existuje -> přidání neproběhlo úspěšně
							else	{
								$this->data["upozorneni"] = "Oblast s tímto názvem již je v databázi.";
							}
						}
					}
					
					
					// nastavení pohledu
					$this->pohled = 'oblasti-add';
	    }
	}
?>