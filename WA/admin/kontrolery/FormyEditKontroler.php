<?php
	class FormyEditKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	        $this->hlavicka = array(
                'titulek' => "Editace forem studia"
        	);
					
					$idPolozek = explode("-", $parametry[0]);
					
					$i = 0;
					foreach ($idPolozek as $idPolozky)	{
						$forma = Forma::getForma($idPolozky);
						if ($forma) $polozky[$i++] = $forma;
					}
					
					$this->data["zvyrazni"] = "";
					
					if (!empty($_POST))	{
						$this->data["upozorneni"] = "";
						
						$i = 0;
						foreach ($idPolozek as $idPolozky)	{
							$nazev = trim($_POST["nazev_".$idPolozky]);
							$upraveno[$i] = 0;
							if ($nazev!="")	{
								if (Vstup::overNazev($nazev))	{
									if (Forma::upravFormu($idPolozky, $nazev))	{
										$this->data["upozorneni"] .= "Forma #".$idPolozky." byla upravena.<br />";
										$polozky[$i] = Forma::getForma($idPolozky);
										
										$upraveno[$i] = 1;
										new Udalost("Edited", "Forma studia", $idPolozky);
									}
									else	{
										$this->data["upozorneni"] .= "Forma #".$idPolozky." <span class='bold'>nebyla upravena</span>, protože forma s názvem <span class='bold'>".$nazev."</span> již existuje.<br />";
									}
								}
								else	{
									$this->data["upozorneni"] .= "Název formy studia #".$idPolozky."".Vstup::spatnyNazev."<br />";
								}
							}
							else	{
								$this->data["upozorneni"] .= "Vyplňte název formy studia #".$idPolozky."<br />";
							}
							
							if ($upraveno[$i]==0)	{
								$polozky[$i] = array(
									"id" => $idPolozky,
									"nazev" => $nazev
								);
								$this->data["zvyrazni"] .= ($this->data["zvyrazni"]=="" ? "" : "-").$idPolozky;
							}
							$i++;
						}
					}				
										
					$this->data["formy"] = $polozky;
					
					$this->pohled = 'formy-edit';
	    }
	}
?>