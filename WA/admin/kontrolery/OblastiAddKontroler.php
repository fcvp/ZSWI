<?php
	class OblastiAddKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	        $this->hlavicka = array(
                'titulek' => "Přidat oblast studia"
        	);
					
					if (!empty($_POST))	{
						$_POST["nazev"] = trim($_POST["nazev"]);
						if ($_POST["nazev"]=="")	{
							$this->data["upozorneni"] = "Zadejte název oblasti.";
							$this->data["post"] = $_POST;
						}
						else	{
							if (Oblast::pridejOblast($_POST["nazev"]))	{
								$this->data["upozorneni"] = "Oblast byla přidána.";
								new Udalost("Added", "Oblast studia", Oblast::getIdOblasti($_POST["nazev"]));
							}
							else	{
								$this->data["upozorneni"] = "Oblast s tímto názvem již je v databázi.";
								$this->data["post"] = $_POST;
							}
						}
					}
					
					$this->pohled = 'oblasti-add';
	    }
	}
?>