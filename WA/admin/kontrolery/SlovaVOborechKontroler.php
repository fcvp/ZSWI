<?php
	class SlovaVOborechKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	        $this->hlavicka = array(
                'titulek' => "Přehled klíčových slov v oborech"
        	);
					
					
					$vsechnyTypy = Typ::getVsechnyTypy();
					$vsechnaKlicovaSlova = Slovo::getVsechnaSlova();
					
					$typy;
					$i = 0;
					foreach ($vsechnyTypy as $typ)	{
						$typy[$i]["nazev"] = $typ["nazev"];						
						$typy[$i]["obory"] = Obor::getObory($typ["id"]);
						
						$slova = null;
						$j = 0;
						foreach ($vsechnaKlicovaSlova as $slovo)	{
							$slova[$j]["id"] = $slovo["id"];
							$slova[$j]["nazev"] = $slovo["nazev"];
							
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
					
					$this->pohled = 'slova-v-oborech';
	    }
	}
?>