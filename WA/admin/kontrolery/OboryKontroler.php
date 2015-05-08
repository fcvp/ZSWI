<?php
	/**
	 * Kontroler pro podstránku Studijní obory
	 * 
	 * @author Jan baxa	 	 
	 */	
	class OboryKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	    		// nastavení titulku stránky
	        $this->hlavicka = array(
                'titulek' => "Studijní obory"
        	);
        						
					// po odeslání formuláře
					if (!empty($_POST))	{
						if ($_POST["edit"]==1)	{
							// pokud uživatel chce editovat -> přesměrování na stránku s editováním
							$this->presmeruj("obory-edit/".$_POST["edit_polozky"]);
						}
						// pokud chce mazat -> smažou se označené záznamy
						elseif ($_POST["delete"]==1)	{
							$idPolozek = explode("-", $_POST["delete_polozky"]);
							foreach ($idPolozek as $idPolozky)	{
								Obor::smazObor($idPolozky);
								new Udalost("Deleted", "Studijní obor", $idPolozky);
							}
							$this->data["upozorneni"] = "Studijní obory byly smazány.";
						}
					}
					
					// získání typů studia z databáze - Obory jsou seřazeny do skupin podle typu studia
					$vsechnyTypy = Typ::getVsechnyTypy();
					
					// ke každému typu studia jsou přiřazeny jeho obory
					$typy;
					$i = 0;
					foreach ($vsechnyTypy as $typ)	{
						$typy[$i]["id"] = $typ["id"];
						$typy[$i]["nazev"] = $typ["nazev"];
						
						// získání oborů z daného typu studia
						$vsechnyObory = Obor::getObory($typ["id"]);
						
						// ke každému oboru jsou přiřazeny jeho klíčová slova
						$obory = "";
						$j = 0;
						foreach ($vsechnyObory as $obor)	{
							$obory[$j]["id"] = $obor["id"];
							$obory[$j]["nazev"] = $obor["nazev"];
							$obory[$j]["forma"] = $obor["forma"];
							$obory[$j++]["slova"] = Slovo::getSlovaPodleOboru($obor["id"]);
						}
						
						$typy[$i++]["radky"] =$obory;
					}
					
					$this->data["typy"] = $typy;
					
					// nastevní pohledu
					$this->pohled = 'obory';
	    }
	}
?>