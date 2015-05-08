<?php
	class OblastiAddKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	        $this->hlavicka = array(
                'titulek' => "Přidat oblast studia"
        	);
					
					if (!empty($_POST))	{
						$_POST["nazev"] = trim($_POST["nazev"]);
						$this->data["post"] = $_POST;
						
						if ($_POST["nazev"]=="")	{
							$this->data["upozorneni"] = "Zadejte název oblasti.";
						}
						else if (!Vstup::overNazev($_POST["nazev"]))	{
							$this->data["upozorneni"] = "Název oblasti studia".Vstup::spatnyNazev;
						}
						else	{
							if (Oblast::pridejOblast($_POST["nazev"]))	{
								$this->data["upozorneni"] = "Oblast byla přidána.";
								new Udalost("Added", "Oblast studia", Oblast::getIdOblasti($_POST["nazev"]));
								$this->data["post"] = null;
							}
							else	{
								$this->data["upozorneni"] = "Oblast s tímto názvem již je v databázi.";
							}
						}
					}
					
					$this->pohled = 'oblasti-add';
	    }
	}
?>