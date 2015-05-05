<?php
	class SlovaAddKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	        $this->hlavicka = array(
                'titulek' => "Přidat klíčové slovo"
        	);
					
					$vsechnyTypy = Typ::getVsechnyTypy();
					
					$typy;
					$i = 0;
					foreach ($vsechnyTypy as $typ)	{
						$typy[$i]["id"] = $typ["id"];
						$typy[$i]["nazev"] = $typ["nazev"];
						$typy[$i++]["radky"] = Obor::getOboryPodleNazvu($typ["id"]);
					}
					
					if (!empty($_POST))	{
						$_POST["nazev"] = trim($_POST["nazev"]);
						if ($_POST["nazev"]=="")	{
							$this->data["upozorneni"] = "Zadejte klíčové slovo.";
							$this->data["post"] = $_POST;
						}
						else	{
							if (Slovo::pridejSlovo($_POST["nazev"], $_POST["oblast"], $_POST["vyznam"]))	{
								
								$idSlova = Slovo::getIdSlova($_POST["nazev"]);
								
								foreach($typy as $typ)	{
									$i = 0;
									foreach ($typ["radky"] as $radek)	{
										Slovo::vazbaOborSlovo($idSlova, $_POST[$typ["id"]."_obor_".$i], $_POST[$typ["id"]."_priorita_".$i], $typ["id"]);
										$i++;
									}
								}
								
								
								$this->data["upozorneni"] = "Klíčové slovo bylo přidáno.";
								new Udalost("Added", "Klíčové slovo", $idSlova);
							}
							else	{
								$this->data["upozorneni"] = "Toto klíčové slovo již je v databázi.";
								$this->data["post"] = $_POST;
							}
						}
					}
					
					$this->data["oblasti"] = Oblast::getVsechnyOblasti();
					$this->data["priority"] = Priorita::getVsechnyPriority();
					$this->data["typy"] = $typy;
					
					$this->pohled = 'slova-add';
	    }
	}
?>