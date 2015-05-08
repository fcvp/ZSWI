<?php
	/**
	 * Kontroler pro podstránku Editace forem studia
	 * 
	 * @author Jan Baxa	 	 
	 */	 
	class FormyEditKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	    		// nastavení titulku stránky
	        $this->hlavicka = array(
                'titulek' => "Editace forem studia"
        	);
					
					// získání editovaných forem studia
					$idPolozek = explode("-", $parametry[0]);
					$i = 0;
					foreach ($idPolozek as $idPolozky)	{
						$forma = Forma::getForma($idPolozky);
						if ($forma) $polozky[$i++] = $forma;
					}
					
					// pomocná proměnná pro případ, že editace položky selže
					$this->data["zvyrazni"] = "";
					
					// po odeslání formuláře
					if (!empty($_POST))	{
						$this->data["upozorneni"] = "";
						
						// editace všech editovaných položek (forem) v cyklu
						$i = 0;
						foreach ($idPolozek as $idPolozky)	{
							$nazev = trim($_POST["nazev_".$idPolozky]);
							// pomocná proměnná
							$upraveno = 0;
							if ($nazev!="")	{
								if (Vstup::overNazev($nazev))	{
									if (Forma::upravFormu($idPolozky, $nazev))	{
										$this->data["upozorneni"] .= "Forma #".$idPolozky." byla upravena.<br />";
										$polozky[$i] = Forma::getForma($idPolozky);
										
										$upraveno = 1;
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
					
					$this->data["formy"] = $polozky;
					
					// nastavení pohledu
					$this->pohled = 'formy-edit';
	    }
	}
?>