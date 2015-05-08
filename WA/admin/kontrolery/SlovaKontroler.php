<?php
	/**
	 * Kontroler pro podstránku Klíčová slova
	 * 
	 * @author Jan baxa	 	 
	 */
	class SlovaKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	    		// nastevení titulku stránky
	        $this->hlavicka = array(
                'titulek' => "Klíčová slova"
        	);
        						
					// po odeslání formuláře
					if (!empty($_POST))	{
						// pokud uživatel chce editovat -> přesměrování na stránku s editováním
						if ($_POST["edit"]==1)	{
							$this->presmeruj("slova-edit/".$_POST["edit_polozky"]);
						}
						// pokud chce mazat -> smažou se označené záznamy
						elseif ($_POST["delete"]==1)	{
							$idPolozek = explode("-", $_POST["delete_polozky"]);
							foreach ($idPolozek as $idPolozky)	{
								Slovo::smazSlovo($idPolozky);
								new Udalost("Deleted", "Klíčové slovo", $idPolozky);
							}
							$this->data["upozorneni"] = "Klíčová slova byla smazána.";
						}
					}
					
					// získání oblastí z databáze protože klíčová slova jsou ve výpisu řazena do kategorií podle oblastí studia
					$vsechnyOblasti = Oblast::getVsechnyOblasti();
					
					// ke každé oblasti studia jsou přiřazeny klíčová slova, která do dané oblasti patří
					$oblasti;
					$i = 0;
					foreach ($vsechnyOblasti as $oblast)	{
						$oblasti[$i]["id"] = $oblast["id"];
						$oblasti[$i]["nazev"] = $oblast["nazev"];
						$oblasti[$i++]["radky"] = Slovo::getSlova($oblast["id"]);
					}
					
					$this->data["oblasti"] = $oblasti;
					
					// nastavení pohledu
					$this->pohled = 'slova';
	    }
	}
?>