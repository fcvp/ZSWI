<?php
	class ZmenaHeslaKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	        $this->hlavicka = array(
                'titulek' => "Změna hesla"
        	);
        	
        	$uzivatel = new Uzivatel();
        	
        	if (!empty($_POST))	{
						if (strlen($_POST["password"])>3)	{
							if ($_POST["password"]==$_POST["password2"])	{
								if ($uzivatel->zmenitHeslo($_POST["password"], $_POST["old_password"]))	{
									new Udalost("Edited", "Heslo", "-");
									$this->data["upozorneni"] = "Heslo bylo úspěšně změněno.";
								}
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
					
					$this->pohled = 'zmena-hesla';
	    }
	}
?>