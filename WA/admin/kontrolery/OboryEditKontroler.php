<?php
	class OboryEditKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	        $this->hlavicka = array(
                'titulek' => "Editace studijních oborů"
        	);
					
					$vsechnaSlova = Slovo::getVsechnaSlova();
					$idPolozek = explode("-", $parametry[0]);
					
					$i = 0;
					foreach ($idPolozek as $idPolozky)	{
						$obor = Obor::getObor($idPolozky);
						if ($obor) {
							foreach ($vsechnaSlova as $slovo)	{
								$obor["priorita_".$slovo["id"]] = Obor::getVazbaOborSlovo($slovo["id"], $obor["id"]);
							}
							$polozky[$i] = $obor;
							$i++;
						}
					}
					
					$this->data["zvyrazni"] = "";
					
					if (!empty($_POST))	{
						$this->data["upozorneni"] = "";
						
						$i=0;
						foreach ($idPolozek as $idPolozky)	{
							$nazev = trim($_POST["nazev_".$idPolozky]);
							$idFormy = $_POST["forma_".$idPolozky];
							$idTypu = $_POST["typ_".$idPolozky];
							$url = $_POST["url_".$idPolozky];
							$popis = $_POST["popis_".$idPolozky];
							
							$upraveno[$i] = 0;
							if ($nazev!="")	{
								if (Vstup::overNazev($nazev))	{
									if (Vstup::overUrl($url))	{
										if (Vstup::overPopis($popis))	{
											if (Obor::upravObor($idPolozky, $nazev, $idFormy, $idTypu, $url, $popis))	{
												$this->data["upozorneni"] .= "Obor #".$idPolozky." byl upraven.<br />";
												$polozky[$i] = Obor::getObor($idPolozky);
												
												foreach($vsechnaSlova as $slovo)	{
													Obor::vazbaOborSlovo($slovo["id"], $idPolozky, $_POST["priorita_".$slovo["id"]."_".$idPolozky]);
													$polozky[$i]["priorita_".$slovo["id"]] = $_POST["priorita_".$slovo["id"]."_".$idPolozky];
												}
												
												$upraveno[$i] = 1;
												new Udalost("Edited", "Studijní obor", $idPolozky);
											}
											else	{
												$this->data["upozorneni"] .= "Obor #".$idPolozky." <span class='bold'>nebyl upraven</span>, protože obor s názvem <span class='bold'>".$nazev."</span>, formou studia <span class='bold'>".Forma::getNazev($idFormy)."</span> a typem studia <span class='bold'>".Typ::getNazev($idTypu)."</span> již existuje.<br />";
											}
										}
										else	{
											$this->data["upozorneni"] .= "Popis oboru #".$idPolozky."".Vstup::spatnyPopis."<br />";
										}
									}
									else	{
										$this->data["upozorneni"] .= "Odkaz #".$idPolozky."".Vstup::spatnaUrl."<br />";
									}
								}
								else	{
									$this->data["upozorneni"] .= "Název oboru #".$idPolozky."".Vstup::spatnyNazev."<br />";
								}
							}
							else	{
								$this->data["upozorneni"] .= "Vyplňte název oboru #".$idPolozky."<br />";
							}
							
							if ($upraveno[$i]==0)	{
								$polozky[$i] = array(
									"id" => $idPolozky,
									"nazev" => $nazev,
									"url" => $url,
									"id_typ" => $idTypu,
									"id_forma" => $idFormy,
									"popis" => $popis,
								);
								foreach($vsechnaSlova as $slovo)	{
									$polozky[$i]["priorita_".$slovo["id"]] = $_POST["priorita_".$slovo["id"]."_".$idPolozky];
								}
								$this->data["zvyrazni"] .= ($this->data["zvyrazni"]=="" ? "" : "-").$idPolozky;
							}
							$i++;
						}
					}
					
					$this->data["formy"] = Forma::getVsechnyFormy();
					$this->data["typy"] = Typ::getVsechnyTypy();
					$this->data["priority"] = Priorita::getVsechnyPriority();
					$this->data["slova"] = $vsechnaSlova;
					
					$this->data["obory"] = $polozky;
					
					$this->pohled = 'obory-edit';
	    }
	}
?>