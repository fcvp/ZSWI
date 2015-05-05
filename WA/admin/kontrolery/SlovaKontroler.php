<?php
	class SlovaKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	        $this->hlavicka = array(
                'titulek' => "Klíčová slova"
        	);
        						
					
					
					if (!empty($_POST))	{
						if ($_POST["edit"]==1)	{
							$this->presmeruj("slova-edit/".$_POST["edit_polozky"]);
						}
						elseif ($_POST["delete"]==1)	{
							$idPolozek = explode("-", $_POST["delete_polozky"]);
							foreach ($idPolozek as $idPolozky)	{
								Slovo::smazSlovo($idPolozky);
								new Udalost("Deleted", "Klíčové slovo", $idPolozky);
							}
							$this->data["upozorneni"] = "Klíčová slova byla smazána.";
						}
					}
					
					$vsechnyOblasti = Oblast::getVsechnyOblasti();
					
					$oblasti;
					$i = 0;
					foreach ($vsechnyOblasti as $oblast)	{
						$oblasti[$i]["id"] = $oblast["id"];
						$oblasti[$i]["nazev"] = $oblast["nazev"];
						$oblasti[$i++]["radky"] = Slovo::getSlova($oblast["id"]);
					}
					
					$this->data["oblasti"] = $oblasti;
					
					$this->pohled = 'slova';
	    }
	}
?>