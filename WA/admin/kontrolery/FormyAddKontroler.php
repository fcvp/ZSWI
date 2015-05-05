<?php
	class FormyAddKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	        $this->hlavicka = array(
                'titulek' => "Přidat formu studia"
        	);
					
					if (!empty($_POST))	{
						$_POST["nazev"] = trim($_POST["nazev"]);
						if ($_POST["nazev"]=="")	{
							$this->data["upozorneni"] = "Zadejte název formy.";
							$this->data["post"] = $_POST;
						}
						else	{
							if (Forma::pridejFormu($_POST["nazev"]))	{
								$this->data["upozorneni"] = "Forma byla přidána.";
								new Udalost("Added", "Forma studia", Forma::getIdFormy($_POST["nazev"]));
							}
							else	{
								$this->data["upozorneni"] = "Forma s tímto názvem již je v databázi.";
								$this->data["post"] = $_POST;
							}
						}
					}
					
					$this->pohled = 'formy-add';
	    }
	}
?>