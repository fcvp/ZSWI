<?php
	/**
	 * Kontroler pro podstránku Přidat studijní obor
	 * 
	 * @author Jan Baxa	 	 
	 */	
	class OboryAddKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	    		// nastavení titulku stránky
	        $this->hlavicka = array(
                'titulek' => "Přidat studijní obor"
        	);
					
					// po odeslání formuláře
					if (!empty($_POST))	{
						// odstranění bílých znaků na konci na začátku názvu
						$_POST["nazev"] = trim($_POST["nazev"]);
						// přiřazení odeslaných hodnot (aby při špatném odeslání formuláře zůstal předvyplněný)
						$this->data["post"] = $_POST;
						
						// kontrola vyplnění názvu
						if ($_POST["nazev"]=="")	{
							$this->data["upozorneni"] = "Zadejte název oboru.";
						}
						// kontrola správnosti názvu
						else if (!Vstup::overNazev($_POST["nazev"]))	{
							$this->data["upozorneni"] = "Název oboru".Vstup::spatnyNazev;
						}
						// kontrola správnosti url
						else if (!Vstup::overUrl($_POST["url"]))	{
							$this->data["upozorneni"] = "Odkaz".Vstup::spatnaUrl;
						}
						// kontrola správnosti popisu oboru
						else if (!Vstup::overPopis($_POST["popis"]))	{
							$this->data["upozorneni"] = "Popis oboru".Vstup::spatnyPopis;
						}
						else	{
							// obor s tímto názvem, formou a typem studia ještě není v databázi -> vloží se do databáze
							if (Obor::pridejObor($_POST["nazev"], $_POST["forma"], $_POST["typ"], $_POST["url"], $_POST["popis"]))	{
								$this->data["upozorneni"] = "Obor <span class='bold'>".$_POST["nazev"]."</span> byl přidán.";
								new Udalost("Added", "Studijní obor", Obor::getIdOboru($_POST["nazev"], $_POST["forma"], $_POST["typ"]));
								$this->data["post"] = null;
							}
							// obor s tímto názvem, formou a typem studia již je v databázi -> vložení se nezdařlo
							else	{
								$this->data["upozorneni"] = "Studijní obor s tímto názvem, formou a typem studia již je v databázi.";
							}
						}
					}
					
					$this->data["formy"] = Forma::getVsechnyFormy();
					$this->data["typy"] = Typ::getVsechnyTypy();
					
					// nastavení pohledu
					$this->pohled = 'obory-add';
	    }
	}
?>