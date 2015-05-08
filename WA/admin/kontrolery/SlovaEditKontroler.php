<?php
	class SlovaEditKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	        $this->hlavicka = array(
                'titulek' => "Editace klíčových slov"
        	);
					
					$vsechnyTypy = Typ::getVsechnyTypy();
					
					$typy;
					$i = 0;
					foreach ($vsechnyTypy as $typ)	{
						$typy[$i]["id"] = $typ["id"];
						$typy[$i]["nazev"] = $typ["nazev"];
						$typy[$i++]["radky"] = Obor::getOboryPodleNazvu($typ["id"]);
					}
					
					$idPolozek = explode("-", $parametry[0]);
					
					$i = 0;
					foreach ($idPolozek as $idPolozky)	{
						$slovo = Slovo::getSlovo($idPolozky);
						if ($slovo) {
							
							foreach($typy as $typ)	{
								$j = 0;
								foreach ($typ["radky"] as $radek)	{
									$slovo[$typ["id"]."_priorita_".$j] = Slovo::getVazbaOborSlovo($idPolozky, $radek["nazev"], $typ["id"]);
									$j++;
								}
							}
							
							$polozky[$i++] = $slovo;
						}
					}
					
					$this->data["zvyrazni"] = "";
					
					if (!empty($_POST))	{
						$this->data["upozorneni"] = "";
						
						$i=0;
						foreach ($idPolozek as $idPolozky)	{
							$nazev = trim($_POST["nazev_".$idPolozky]);
							$idOblasti = $_POST["oblast_".$idPolozky];
							$vyznam = $_POST["vyznam_".$idPolozky];
							
							$upraveno[$i] = 0;
							if ($nazev!="")	{
								if (Vstup::overNazev($nazev))	{
									if (Vstup::overNazev($vyznam))	{
										if (Slovo::upravSlovo($idPolozky, $nazev, $idOblasti, $vyznam))	{
											$this->data["upozorneni"] .= "Klčové slovo #".$idPolozky." bylo upraveno.<br />";
											$polozky[$i] = Slovo::getSlovo($idPolozky);
											
											foreach($typy as $typ)	{
												$j = 0;
												foreach ($typ["radky"] as $radek)	{
													Slovo::vazbaOborSlovo($idPolozky, $_POST[$typ["id"]."_obor_".$j."_".$idPolozky], $_POST[$typ["id"]."_priorita_".$j."_".$idPolozky], $typ["id"]);
													$polozky[$i][$typ["id"]."_priorita_".$j] = $_POST[$typ["id"]."_priorita_".$j."_".$idPolozky];
													$j++;
												}
											}
											
											$upraveno[$i] = 1;
											new Udalost("Edited", "Klíčové slovo", $idPolozky);
										}
										else	{
											$this->data["upozorneni"] .= "Klíčové slovo #".$idPolozky." <span class='bold'>nebylo upraveno</span>, protože klíčové slovo <span class='bold'>".$nazev."</span> již existuje.<br />";
										}
									}
									else	{
										$this->data["upozorneni"] .= "Význam slova #".$idPolozky."".Vstup::spatnyNazev."<br />";
									}
								}
								else	{
									$this->data["upozorneni"] .= "Klíčové slovo #".$idPolozky."".Vstup::spatnyNazev."<br />";
								}
							}
							else	{
								$this->data["upozorneni"] .= "Zadejte klíčové slovo #".$idPolozky."<br />";
							}
							
							if ($upraveno[$i]==0)	{
								$polozky[$i] = array(
									"id" => $idPolozky,
									"nazev" => $nazev,
									"id_oblast" => $idOblasti,
									"vyznam" => $vyznam
								);
								foreach($typy as $typ)	{
									$j = 0;
									foreach ($typ["radky"] as $radek)	{
										$polozky[$i][$typ["id"]."_priorita_".$j] = $_POST[$typ["id"]."_priorita_".$j."_".$idPolozky];
										$j++;
									}
								}
								$this->data["zvyrazni"] .= ($this->data["zvyrazni"]=="" ? "" : "-").$idPolozky;
							}
							
							$i++;
						}
					}
					
					$this->data["oblasti"] = Oblast::getVsechnyOblasti();
					$this->data["priority"] = Priorita::getVsechnyPriority();
					$this->data["typy"] = $typy;
					
					$this->data["slova"] = $polozky;
					
					$this->pohled = 'slova-edit';
	    }
	}
?>