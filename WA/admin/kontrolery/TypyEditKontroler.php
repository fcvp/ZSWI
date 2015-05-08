<?php
	class TypyEditKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	        $this->hlavicka = array(
                'titulek' => "Editace typů studia"
        	);
					
					$idPolozek = explode("-", $parametry[0]);
					
					$i = 0;
					foreach ($idPolozek as $idPolozky)	{
						$typ = Typ::getTyp($idPolozky);
						if ($typ) $polozky[$i++] = $typ;
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
									if (Typ::upravTyp($idPolozky, $nazev))	{
										$this->data["upozorneni"] .= "Typ studia #".$idPolozky." byl upraven.<br />";
										$polozky[$i] = Typ::getTyp($idPolozky);
										
										$upraveno[$i] = 1;
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
										
					$this->data["typy"] = $polozky;
					
					$this->pohled = 'typy-edit';
	    }
	}
?>