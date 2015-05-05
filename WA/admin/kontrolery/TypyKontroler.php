<?php
	class TypyKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	        $this->hlavicka = array(
                'titulek' => "Typy studia"
        	);
        						
					
					
					if (!empty($_POST))	{
						if ($_POST["edit"]==1)	{
							$this->presmeruj("typy-edit/".$_POST["edit_polozky"]);
						}
						elseif ($_POST["delete"]==1)	{
							$idPolozek = explode("-", $_POST["delete_polozky"]);
							foreach ($idPolozek as $idPolozky)	{
								Typ::smazTyp($idPolozky);
								new Udalost("Deleted", "Typ studia", $idPolozky);
							}
							$this->data["upozorneni"] = "Typy studia byly smazány.";
						}
					}
					
					$this->data["radky"] = Typ::getVsechnyTypy();
					
					$this->pohled = 'typy';
	    }
	}
?>