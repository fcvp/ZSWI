<?php
	class OboryAddKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	        $this->hlavicka = array(
                'titulek' => "Přidat studijní obor"
        	);
					
					if (!empty($_POST))	{
						$_POST["nazev"] = trim($_POST["nazev"]);
						if ($_POST["nazev"]=="")	{
							$this->data["upozorneni"] = "Zadejte název oboru.";
							$this->data["post"] = $_POST;
						}
						else	{
							if (Obor::pridejObor($_POST["nazev"], $_POST["forma"], $_POST["typ"], $_POST["url"], $_POST["popis"]))	{
								$this->data["upozorneni"] = "Obor byl přidán.";
								new Udalost("Added", "Studijní obor", Obor::getIdOboru($_POST["nazev"], $_POST["forma"], $_POST["typ"]));
							}
							else	{
								$this->data["upozorneni"] = "Studijní obor s tímto názvem, formou a typem studia již je v databázi.";
								$this->data["post"] = $_POST;
							}
						}
					}
					
					$this->data["formy"] = Forma::getVsechnyFormy();
					$this->data["typy"] = Typ::getVsechnyTypy();
					
					$this->pohled = 'obory-add';
	    }
	}
?>