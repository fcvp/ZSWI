<?php
	class OblastiEditKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	        $this->hlavicka = array(
                'titulek' => "Editace oblastí studia"
        	);
					
					$idPolozek = explode("-", $parametry[0]);
					
					$i = 0;
					foreach ($idPolozek as $idPolozky)	{
						$oblast = Oblast::getOblast($idPolozky);
						if ($oblast) $polozky[$i++] = $oblast;
					}
					
					$this->data["zvyrazni"] = "";
					
					if (!empty($_POST))	{
						$this->data["upozorneni"] = "";
						
						$i=0;
						foreach ($idPolozek as $idPolozky)	{
							$nazev = trim($_POST["nazev_".$idPolozky]);
							$upraveno[$i] = 0;
							if ($nazev!="")	{
								if (Vstup::overNazev($nazev))	{
									if (Oblast::upravOblast($idPolozky, $nazev))	{
										$this->data["upozorneni"] .= "Oblast #".$idPolozky." byla upravena.<br />";
										$polozky[$i] = Oblast::getOblast($idPolozky);
										
										$upraveno[$i] = 1;
										new Udalost("Edited", "Oblast studia", $idPolozky);
									}
									else	{
										$this->data["upozorneni"] .= "Název u oblasti #".$idPolozky." nebyl upraven, protože oblast s názvem <span class='bold'>".$nazev."</span> již existuje.<br />";
									}
								}
								else	{
									$this->data["upozorneni"] .= "Název oblasti studia #".$idPolozky."".Vstup::spatnyNazev."<br />";
								}
							}
							else	{
								$this->data["upozorneni"] .= "Vyplňte název oblasti studia #".$idPolozky."<br />";
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
										
					$this->data["oblasti"] = $polozky;
					
					$this->pohled = 'oblasti-edit';
	    }
	}
?>