<?php
	/**
	 * Kontroler pro podstránku Přidat formu studia
	 * 
	 * @author Jan Baxa	 	 
	 */	 	
	class FormyAddKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	    		// nstavení titulku stránky
	        $this->hlavicka = array(
                'titulek' => "Přidat formu studia"
        	);
					
					// po odeslání formuláře
					if (!empty($_POST))	{
						// odstranění bílých znaků na konci na začátku názvu
						$_POST["nazev"] = trim($_POST["nazev"]);
						// přiřazení odeslaných hodnot (aby při špatném odeslání formuláře zůstal předvyplněný)
						$this->data["post"] = $_POST;
						
						// kontrola vyplnění názvu
						if ($_POST["nazev"]=="")	{
							$this->data["upozorneni"] = "Zadejte název formy.";
						}
						// kontrola správnosti názvu
						else if (!Vstup::overNazev($_POST["nazev"]))	{
							$this->data["upozorneni"] = "Název formy studia".Vstup::spatnyNazev;
						}
						else	{
							// forma s tímto názvem ještě není v databázi -> vloží se do databáze
							if (Forma::pridejFormu($_POST["nazev"]))	{
								$this->data["upozorneni"] = "Forma byla přidána.";
								// vytvoření události
								new Udalost("Added", "Forma studia", Forma::getIdFormy($_POST["nazev"]));
								
								// vymazání dat z formuláře
								$this->data["post"] = null;
							}
							// forma s tímto názvem již je v databázi -> vložení se nezdařlo
							else	{
								$this->data["upozorneni"] = "Forma s tímto názvem již je v databázi.";
							}
						}
					}
					
					// nastavení pohledu
					$this->pohled = 'formy-add';
	    }
	}
?>