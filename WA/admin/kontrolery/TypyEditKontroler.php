<?php
	/**
	 * Kontroler pro podstránku Editace typů studia
	 * 
	 * @author Jan Baxa	 	 
	 */	
	class TypyEditKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	    		// nastavení titulku stránky
	        $this->hlavicka = array(
                'titulek' => "Editace typů studia"
        	);
					
					// získání editovaných typů studia
					$idPolozek = explode("-", $parametry[0]);
					$i = 0;
					foreach ($idPolozek as $idPolozky)	{
						$typ = Typ::getTyp($idPolozky);
						if ($typ) $polozky[$i++] = $typ;
					}
					
					// pomocná proměnná pro případ, že editace položky selže
					$this->data["zvyrazni"] = "";
					
					// po odeslání formuláře
					if (!empty($_POST))	{
						$this->data["upozorneni"] = "";
						
						// editace všech editovaných položek (typů studia) v cyklu
						$i = 0;
						foreach ($idPolozek as $idPolozky)	{
							$nazev = trim($_POST["nazev_".$idPolozky]);
							
							// pomocná proměnná
							$upraveno = 0;
							if ($nazev!="")	{
								if (Vstup::overNazev($nazev))	{
									if (Typ::upravTyp($idPolozky, $nazev))	{
										$this->data["upozorneni"] .= "Typ studia #".$idPolozky." byl upraven.<br />";
										$polozky[$i] = Typ::getTyp($idPolozky);
										
										$upraveno = 1;
										new Udalost("Edited", "Typ studia", $idPolozky);
									}
									else	{
										$this->data["upozorneni"] .= "Typ studia #".$idPolozky." <span class='bold'>nebyl upraven</span>, protože typ studia s názvem <span class='bold'>".$nazev."</span> již existuje.<br />";
									}
								}
								else	{
									$this->data["upozorneni"] .= "Název typu studia #".$idPolozky."".Vstup::spatnyNazev."<br />";
								}
							}
							else	{
								$this->data["upozorneni"] .= "Vyplňte název typu studia #".$idPolozky."<br />";
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
										
					$this->data["typy"] = $polozky;
					
					// nastavení pohledu
					$this->pohled = 'typy-edit';
	    }
	}
?>