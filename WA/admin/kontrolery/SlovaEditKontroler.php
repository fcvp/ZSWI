<?php
	/**
	 * Kontroler pro podstránku Editace klíčových slov
	 * 
	 * @author Jan Baxa	 	 
	 */	
	class SlovaEditKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	    		// nastavení titulku stránky
	        $this->hlavicka = array(
                'titulek' => "Editace klíčových slov"
        	);
					
					// získání typů studia, protože obory jsou pod klíčovými slovy řazeny do skupin podle typu studia
					$vsechnyTypy = Typ::getVsechnyTypy();
					
					// ke každému typu studia jsou přiřazeny obory
					$typy;
					$i = 0;
					foreach ($vsechnyTypy as $typ)	{
						$typy[$i]["id"] = $typ["id"];
						$typy[$i]["nazev"] = $typ["nazev"];
						$typy[$i++]["radky"] = Obor::getOboryPodleNazvu($typ["id"]);
					}
					
					$idPolozek = explode("-", $parametry[0]);
					
					// získání editovaných klíčových slov a vazeb k jednotlivým oborům
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
					
					// pomocná proměnná pro případ, že editace položky selže
					$this->data["zvyrazni"] = "";
					
					// po odeslání formuláře
					if (!empty($_POST))	{
						$this->data["upozorneni"] = "";
						
						// editace všech editovaných položek (klíčových slov a vazeb k oborům) v cyklu
						$i=0;
						foreach ($idPolozek as $idPolozky)	{
							$nazev = trim($_POST["nazev_".$idPolozky]);
							$idOblasti = $_POST["oblast_".$idPolozky];
							$vyznam = $_POST["vyznam_".$idPolozky];
							
							// pomocná proměnná
							$upraveno = 0;
							// ověření vstupu
							if ($nazev!="")	{
								// ověření vstupu
								if (Vstup::overNazev($nazev))	{
									// ověření vstupu
									if (Vstup::overNazev($vyznam))	{
										// úprava oboru proběhla úspěšně
										if (Slovo::upravSlovo($idPolozky, $nazev, $idOblasti, $vyznam))	{
											$this->data["upozorneni"] .= "Klčové slovo #".$idPolozky." bylo upraveno.<br />";
											$polozky[$i] = Slovo::getSlovo($idPolozky);
											
											// nastavení vazeb mezi klíčovým slovem a všemi obory
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
							
							// úprava neproběhla z nějakého důvodu úspěšne -> celý objekt se obarví červeně a ve formuláři zůstanou odeslaná data
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
					
					// nastavení pohledu
					$this->pohled = 'slova-edit';
	    }
	}
?>