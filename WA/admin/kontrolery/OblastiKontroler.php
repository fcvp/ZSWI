<?php
	class OblastiKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	        $this->hlavicka = array(
                'titulek' => "Oblasti studia"
        	);
        						
					
					
					if (!empty($_POST))	{
						if ($_POST["edit"]==1)	{
							$this->presmeruj("oblasti-edit/".$_POST["edit_polozky"]);
						}
						elseif ($_POST["delete"]==1)	{
							$idPolozek = explode("-", $_POST["delete_polozky"]);
							foreach ($idPolozek as $idPolozky)	{
								Oblast::smazOblast($idPolozky);
								new Udalost("Deleted", "Oblast studia", $idPolozky);
							}
							$this->data["upozorneni"] = "Oblasti studia byly smazány.";
						}
					}
					
					$this->data["radky"] = Oblast::getVsechnyOblasti();
					
					$this->pohled = 'oblasti';
	    }
	}
?>