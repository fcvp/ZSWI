<?php
	class FormyKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	        $this->hlavicka = array(
                'titulek' => "Formy studia"
        	);
        						
					
					
					if (!empty($_POST))	{
						if ($_POST["edit"]==1)	{
							$this->presmeruj("formy-edit/".$_POST["edit_polozky"]);
						}
						elseif ($_POST["delete"]==1)	{
							$idPolozek = explode("-", $_POST["delete_polozky"]);
							foreach ($idPolozek as $idPolozky)	{
								Forma::smazFormu($idPolozky);
								new Udalost("Deleted", "Forma studia", $idPolozky);
							}
							$this->data["upozorneni"] = "Formy studia byly smazány.";
						}
					}
					
					$this->data["radky"] = Forma::getVsechnyFormy();
					
					$this->pohled = 'formy';
	    }
	}
?>