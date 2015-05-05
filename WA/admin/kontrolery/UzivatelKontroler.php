<?php
	class UzivatelKontroler extends Kontroler	{
	    public function zpracuj($parametry)	{
				$uzivatel = new Uzivatel($_COOKIE["id"]);
				$i = 0;
				$vypisyMenu;
				
				if (!$uzivatel->jePrihlasen())	{
					$vypisyMenu[$i++] = array('registrace', 'REGISTRACE');
	        $vypisyMenu[$i++] = array('prihlasit', 'PŘIHLÁSIT SE');
				}
				else	{
					$vypisyMenu[$i++] = array('odhlasit', 'ODHLÁSIT SE');
	        $vypisyMenu[$i++] = array('moje-prispevky', 'MOJE PŘÍSPĚVKY');
	        if ($uzivatel->jeRecenzent())	$vypisyMenu[$i++] = array('prispevky-k-posouzeni', 'PŘÍSPĚVKY K POSOUZENÍ');
	        if ($uzivatel->jeAdmin())	$vypisyMenu[$i++] = array('vsechny-prispevky', 'VŠECHNY PŘÍSPĚVKY');
	        $vypisyMenu[$i++] = array('moje-udaje', 'MOJE ÚDAJE');
				}
				$this->data['vypisyMenu'] = $vypisyMenu;
          
				$this->pohled = 'user-panel';
	    }
	}
?>