<?php
	/**
	 * Kontroler pro podstránku Změna hesla
	 * 
	 * @author Jan Baxa	 	 
	 */	 	
	class ZmenaHeslaKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	    		// nastavení titulku stránky
	        $this->hlavicka = array(
                'titulek' => "Změna hesla"
        	);
        	
        	// vytvoření instance Uzivatel
        	$uzivatel = new Uzivatel();
        	
        	// po odeslání formuláře
        	if (!empty($_POST))	{
        		// ověření minimální délky hesla
						if (strlen($_POST["password"])>3)	{
							// ověření, zda uživatel zadal nové heslo 2x shodné
							if ($_POST["password"]==$_POST["password2"])	{
								// Stávající heslo je správné -> úspěšně změněné heslo
								if ($uzivatel->zmenitHeslo($_POST["password"], $_POST["old_password"]))	{
									new Udalost("Edited", "Heslo", "-");
									$this->data["upozorneni"] = "Heslo bylo úspěšně změněno.";
								}
								// stávající heslo není správné -> heslo se nemění
								else	{
									$this->data["upozorneni"] = "Stávající heslo není správné.";
								}
							}
							else	{
								$this->data["upozorneni"] = "Nová hesla nejsou stejná.";
							}
						}
						else	{
							$this->data["upozorneni"] = "Nové heslo musí být delší než 3 znaky.";
						}
					}
        						
					$this->data['prezdivka'] = $uzivatel->getPrezdivka();
					
					// nastavení pohledu
					$this->pohled = 'zmena-hesla';
	    }
	}
?>