<?php
	/**
	 * Kontroler pro podstránku Přidat typ studia
	 * 
	 * @author Jan Baxa	 	 
	 */	 	
	class TypyAddKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	    		// nastavení titulku stránky
	        $this->hlavicka = array(
                'titulek' => "Přidat typ studia"
        	);
					
					// po odeslání formuláře
					if (!empty($_POST))	{
						// odstranění bílých znaků na konci na začátku názvu
						$_POST["nazev"] = trim($_POST["nazev"]);
						// přiřazení odeslaných hodnot (aby při špatném odeslání formuláře zůstal předvyplněný)
						$this->data["post"] = $_POST;
						
						// kontrola vyplnění názvu
						if ($_POST["nazev"]=="")	{
							$this->data["upozorneni"] = "Zadejte název typu.";
						}
						// kontrola správnosti názvu
						else if (!Vstup::overNazev($_POST["nazev"]))	{
							$this->data["upozorneni"] = "Název typu studia".Vstup::spatnyNazev;
						}
						else	{
							// typ studia s tímto názvem ještě není v databázi -> vloží se do databáze
							if (Typ::pridejTyp($_POST["nazev"]))	{
								$this->data["upozorneni"] = "Typ studia byl přidán.";
								new Udalost("Added", "Typ studia", Typ::getIdTypu($_POST["nazev"]));
								$this->data["post"] = null;
							}
							// typ studia s tímto názvem již je v databázi -> vložení se nezdařlo
							else	{
								$this->data["upozorneni"] = "Typ studia s tímto názvem již je v databázi.";
							}
						}
					}
					
					// nastavení pohledu
					$this->pohled = 'typy-add';
	    }
	}
?>