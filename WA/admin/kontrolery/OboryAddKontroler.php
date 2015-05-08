<?php
	class OboryAddKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	        $this->hlavicka = array(
                'titulek' => "Přidat studijní obor"
        	);
					
					if (!empty($_POST))	{
						$_POST["nazev"] = trim($_POST["nazev"]);
						$this->data["post"] = $_POST;
						if ($_POST["nazev"]=="")	{
							$this->data["upozorneni"] = "Zadejte název oboru.";
						}
						else if (!Vstup::overNazev($_POST["nazev"]))	{
							$this->data["upozorneni"] = "Název oboru".Vstup::spatnyNazev;
						}
						else if (!Vstup::overUrl($_POST["url"]))	{
							$this->data["upozorneni"] = "Odkaz".Vstup::spatnaUrl;
						}
						else if (!Vstup::overPopis($_POST["popis"]))	{
							$this->data["upozorneni"] = "Popis oboru".Vstup::spatnyPopis;
						}
						else	{
							if (Obor::pridejObor($_POST["nazev"], $_POST["forma"], $_POST["typ"], $_POST["url"], $_POST["popis"]))	{
								$this->data["upozorneni"] = "Obor byl přidán.";
								new Udalost("Added", "Studijní obor", Obor::getIdOboru($_POST["nazev"], $_POST["forma"], $_POST["typ"]));
								$this->data["post"] = null;
							}
							else	{
								$this->data["upozorneni"] = "Studijní obor s tímto názvem, formou a typem studia již je v databázi.";
							}
						}
					}
					
					$this->data["formy"] = Forma::getVsechnyFormy();
					$this->data["typy"] = Typ::getVsechnyTypy();
					
					$this->pohled = 'obory-add';
	    }
	}
?>