<?php
	/**
	 * Kontroler pro podstránku Formy studia
	 * 
	 * @author Jan baxa	 	 
	 */	 	
	class FormyKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	    		// nastavení titulku stránky
	        $this->hlavicka = array(
                'titulek' => "Formy studia"
        	);
        						
					// po odeslání formuláře
					if (!empty($_POST))	{
						// pokud uživatel chce editovat -> přesměrování na stránku s editováním
						if ($_POST["edit"]==1)	{
							$this->presmeruj("formy-edit/".$_POST["edit_polozky"]);
						}
						// pokud chce mazat -> smažou se označené záznamy
						elseif ($_POST["delete"]==1)	{
							$idPolozek = explode("-", $_POST["delete_polozky"]);
							foreach ($idPolozek as $idPolozky)	{
								Forma::smazFormu($idPolozky);
								new Udalost("Deleted", "Forma studia", $idPolozky);
							}
							$this->data["upozorneni"] = "Formy studia byly smazány.";
						}
					}
					
					// získání záznamů z databáze
					$this->data["radky"] = Forma::getVsechnyFormy();
					
					// nastavení pohledu
					$this->pohled = 'formy';
	    }
	}
?>