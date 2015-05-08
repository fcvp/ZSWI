<?php
	class FormyAddKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	        $this->hlavicka = array(
                'titulek' => "Přidat formu studia"
        	);
					
					if (!empty($_POST))	{
						$_POST["nazev"] = trim($_POST["nazev"]);
						$this->data["post"] = $_POST;
						
						if ($_POST["nazev"]=="")	{
							$this->data["upozorneni"] = "Zadejte název formy.";
						}
						else if (!Vstup::overNazev($_POST["nazev"]))	{
							$this->data["upozorneni"] = "Název formy studia".Vstup::spatnyNazev;
						}
						else	{
							if (Forma::pridejFormu($_POST["nazev"]))	{
								$this->data["upozorneni"] = "Forma byla přidána.";
								new Udalost("Added", "Forma studia", Forma::getIdFormy($_POST["nazev"]));
								$this->data["post"] = null;
							}
							else	{
								$this->data["upozorneni"] = "Forma s tímto názvem již je v databázi.";
							}
						}
					}
					
					$this->pohled = 'formy-add';
	    }
	}
?>