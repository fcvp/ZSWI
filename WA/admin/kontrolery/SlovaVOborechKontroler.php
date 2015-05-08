<?php
	/**
	 * Kontroler pro stránku Přehled klíčových slov v oborech
	 * 
	 * @author Jan Baxa	 	 
	 */	 	
	class SlovaVOborechKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	    		// nastavení titulku stránky
	        $this->hlavicka = array(
                'titulek' => "Přehled klíčových slov v oborech"
        	);
					
					// získání všech typů studia
					$vsechnyTypy = Typ::getVsechnyTypy();
					// získání všech klíčových slov
					$vsechnaKlicovaSlova = Slovo::getVsechnaSlova();
					
					// ke každému typu studia se přiřadí obory
					$typy;
					$i = 0;
					foreach ($vsechnyTypy as $typ)	{
						$typy[$i]["nazev"] = $typ["nazev"];						
						$typy[$i]["obory"] = Obor::getObory($typ["id"]);
						
						// ke každému klíčovému slovu se přiřadí hodnota vazby mezi jednotlivými klíčovými slovy a obory v daném typu studia
						$slova = null;
						$j = 0;
						foreach ($vsechnaKlicovaSlova as $slovo)	{
							$slova[$j]["id"] = $slovo["id"];
							$slova[$j]["nazev"] = $slovo["nazev"];
							
							// získání vazby mezi slovem a každým oborem
							$k = 0;
							$priority = null;
							foreach ($typy[$i]["obory"] as $obor)	{
								$idPriority = Obor::getVazbaOborSlovo($slovo["id"], $obor["id"]);
								$priority[$k] = Priorita::getHodnotaPriority($idPriority);
								$k++;
							}
							
							$slova[$j]["priority"] = $priority;
							$j++;	
						}
						
						$typy[$i]["slova"] = $slova;
						$i++;
					}
					
					
					$this->data["typy"] = $typy;
					
					// nastavení pohledu
					$this->pohled = 'slova-v-oborech';
	    }
	}
?>