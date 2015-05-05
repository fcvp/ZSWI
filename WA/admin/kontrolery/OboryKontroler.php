<?php
	class OboryKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	        $this->hlavicka = array(
                'titulek' => "Studijní obory"
        	);
        						
					
					
					if (!empty($_POST))	{
						if ($_POST["edit"]==1)	{
							$this->presmeruj("obory-edit/".$_POST["edit_polozky"]);
						}
						elseif ($_POST["delete"]==1)	{
							$idPolozek = explode("-", $_POST["delete_polozky"]);
							foreach ($idPolozek as $idPolozky)	{
								Obor::smazObor($idPolozky);
								new Udalost("Deleted", "Studijní obor", $idPolozky);
							}
							$this->data["upozorneni"] = "Studijní obory byly smazány.";
						}
					}
					
					$vsechnyTypy = Typ::getVsechnyTypy();
					
					$typy;
					$i = 0;
					foreach ($vsechnyTypy as $typ)	{
						$typy[$i]["id"] = $typ["id"];
						$typy[$i]["nazev"] = $typ["nazev"];
						$typy[$i++]["radky"] = Obor::getObory($typ["id"]);
					}
					
					$this->data["typy"] = $typy;
					
					$this->pohled = 'obory';
	    }
	}
?>