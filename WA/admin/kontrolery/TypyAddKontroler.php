<?php
	class TypyAddKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	        $this->hlavicka = array(
                'titulek' => "Přidat typ studia"
        	);
					
					if (!empty($_POST))	{
						$_POST["nazev"] = trim($_POST["nazev"]);
						if ($_POST["nazev"]=="")	{
							$this->data["upozorneni"] = "Zadejte název typu.";
							$this->data["post"] = $_POST;
						}
						else	{
							if (Typ::pridejTyp($_POST["nazev"]))	{
								$this->data["upozorneni"] = "Typ studia byl přidán.";
								new Udalost("Added", "Typ studia", Typ::getIdTypu($_POST["nazev"]));
							}
							else	{
								$this->data["upozorneni"] = "Typ studia s tímto názvem již je v databázi.";
								$this->data["post"] = $_POST;
							}
						}
					}
					
					$this->pohled = 'typy-add';
	    }
	}
?>