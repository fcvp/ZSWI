<?php
	/**
	 * Kontroler pro podstránku Přidat klíčové slovo
	 * 
	 * @author Jan Baxa	 	 
	 */
	class SlovaAddKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	    		// nastavení titulku stránky
	        $this->hlavicka = array(
                'titulek' => "Přidat klíčové slovo"
        	);
					
					// získání typů studia - protože obory jsou pod klíčovými slovy seřazeny do skupin podle typu studia
					$vsechnyTypy = Typ::getVsechnyTypy();
					
					// ke každému typu studia se přiřadí obory, které do daného typu patří
					$typy;
					$i = 0;
					foreach ($vsechnyTypy as $typ)	{
						$typy[$i]["id"] = $typ["id"];
						$typy[$i]["nazev"] = $typ["nazev"];
						$typy[$i++]["radky"] = Obor::getOboryPodleNazvu($typ["id"]);
					}
					
					// po odeslání formuláře
					if (!empty($_POST))	{
						// vymazání bílých znaků na začátku a na konci klíčového slova
						$_POST["nazev"] = trim($_POST["nazev"]);
						// přiřazení odeslaných hodnot (aby při špatném odeslání formuláře zůstal předvyplněný)
						$this->data["post"] = $_POST;
						
						// kontrola vyplnění klíčového slova
						if ($_POST["nazev"]=="")	{
							$this->data["upozorneni"] = "Zadejte klíčové slovo.";
						}
						// kontrola správnosti klíčového slova
						else if (!Vstup::overNazev($_POST["nazev"]))	{
							$this->data["upozorneni"] = "Klíčové slovo".Vstup::spatnyNazev;
						}
						// kontrola správnosti významu slova
						else if (!Vstup::overNazev($_POST["vyznam"]))	{
							$this->data["upozorneni"] = "Význam slova".Vstup::spatnyNazev;
						}
						else	{
							// klíčové slovo ještě není v databázi -> vloží se do databáze
							if (Slovo::pridejSlovo($_POST["nazev"], $_POST["oblast"], $_POST["vyznam"]))	{
								
								$idSlova = Slovo::getIdSlova($_POST["nazev"]);
								
								// v cyklu se projedou typy studia a v nich jednotlivé obory a vytvoří se vazby mezi obory a nově přidaným klíčovým slovem
								foreach($typy as $typ)	{
									$i = 0;
									foreach ($typ["radky"] as $radek)	{
										Slovo::vazbaOborSlovo($idSlova, $_POST[$typ["id"]."_obor_".$i], $_POST[$typ["id"]."_priorita_".$i], $typ["id"]);
										$i++;
									}
								}
								
								$this->data["upozorneni"] = "Klíčové slovo bylo přidáno.";
								new Udalost("Added", "Klíčové slovo", $idSlova);
								// vymazání odeslaných dat
								$this->data["post"] = null;
							}
							// klíčové slovo již je v databázi -> vložení se nezdařilo
							else	{
								$this->data["upozorneni"] = "Toto klíčové slovo již je v databázi.";
							}
						}
					}
					
					$this->data["oblasti"] = Oblast::getVsechnyOblasti();
					$this->data["priority"] = Priorita::getVsechnyPriority();
					$this->data["typy"] = $typy;
					
					// nastavení pohledu
					$this->pohled = 'slova-add';
	    }
	}
?>