<?php
	/**
	 * Kontroler pro podstránku Editace oblastí studia
	 * 
	 * @author Jan Baxa	 	 
	 */	
	class OblastiEditKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	    		// nastavení titulku stránky
	        $this->hlavicka = array(
                'titulek' => "Editace oblastí studia"
        	);
        	
					// získání editovaných oblastí studia
					$idPolozek = explode("-", $parametry[0]);
					$i = 0;
					foreach ($idPolozek as $idPolozky)	{
						$oblast = Oblast::getOblast($idPolozky);
						if ($oblast) $polozky[$i++] = $oblast;
					}
					
					// pomocná proměnná pro případ, že editace položky selže
					$this->data["zvyrazni"] = "";
					
					// po odeslání formuláře
					if (!empty($_POST))	{
						$this->data["upozorneni"] = "";
						
						// editace všech editovaných položek (oblastí) v cyklu
						$i=0;
						foreach ($idPolozek as $idPolozky)	{
							$nazev = trim($_POST["nazev_".$idPolozky]);
							// pomocná proměnná
							$upraveno = 0;
							if ($nazev!="")	{
								if (Vstup::overNazev($nazev))	{
									if (Oblast::upravOblast($idPolozky, $nazev))	{
										$this->data["upozorneni"] .= "Oblast #".$idPolozky." byla upravena.<br />";
										$polozky[$i] = Oblast::getOblast($idPolozky);
										
										$upraveno = 1;
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
							// pokud se úprava nezdařila, ve formuláři zůstanou odeslaná data a celý upravovaný objekt se označí červeně
							if ($upraveno==0)	{
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
					
					// nastavení pohledu
					$this->pohled = 'oblasti-edit';
	    }
	}
?>