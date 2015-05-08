<?php
	/**
	 * Kontroler pro podstránku Typy studia
	 * 
	 * @author Jan baxa	 	 
	 */	 
	class TypyKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	    		// nastavení titulku stránky
	        $this->hlavicka = array(
                'titulek' => "Typy studia"
        	);
        	
					// po odeslání formuláře
					if (!empty($_POST))	{
						// pokud uživatel chce editovat -> přesměrování na stránku s editováním
						if ($_POST["edit"]==1)	{
							$this->presmeruj("typy-edit/".$_POST["edit_polozky"]);
						}
						// pokud chce mazat -> smažou se označené záznamy
						elseif ($_POST["delete"]==1)	{
							$idPolozek = explode("-", $_POST["delete_polozky"]);
							foreach ($idPolozek as $idPolozky)	{
								Typ::smazTyp($idPolozky);
								new Udalost("Deleted", "Typ studia", $idPolozky);
							}
							$this->data["upozorneni"] = "Typy studia byly smazány.";
						}
					}
					
					// získání záznamů z databáze
					$this->data["radky"] = Typ::getVsechnyTypy();
					
					// nastavení pohledu
					$this->pohled = 'typy';
	    }
	}
?>