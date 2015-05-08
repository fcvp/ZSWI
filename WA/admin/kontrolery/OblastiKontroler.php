<?php
	/**
	 * Kontroler pro podstránku Oblasti studia
	 * 
	 * @author Jan baxa	 	 
	 */	
	class OblastiKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	    		// nastavení titulku stránky
	        $this->hlavicka = array(
                'titulek' => "Oblasti studia"
        	);
        						
					// po odeslání formuláře
					if (!empty($_POST))	{
						// pokud uživatel chce editovat -> přesměrování na stránku s editováním
						if ($_POST["edit"]==1)	{
							$this->presmeruj("oblasti-edit/".$_POST["edit_polozky"]);
						}
						// pokud chce mazat -> smažou se označené záznamy
						elseif ($_POST["delete"]==1)	{
							$idPolozek = explode("-", $_POST["delete_polozky"]);
							foreach ($idPolozek as $idPolozky)	{
								Oblast::smazOblast($idPolozky);
								new Udalost("Deleted", "Oblast studia", $idPolozky);
							}
							$this->data["upozorneni"] = "Oblasti studia byly smazány.";
						}
					}
					// získání záznamů z databáze
					$this->data["radky"] = Oblast::getVsechnyOblasti();
					
					// nastavení pohledu
					$this->pohled = 'oblasti';
	    }
	}
?>