<?php
	/**
	 * Kontroler pro podstránku s chybou (pokud zadaná stránka nebyla nalezena)
	 */	 	
	class ChybaKontroler extends Kontroler	{
	    public function zpracuj($parametry)
	    {
	    		// nastavení headeru
	        header("HTTP/1.0 404 Not Found");
	        // nastavení titulku stránku
	        $this->hlavicka['titulek'] = 'Chyba 404';
	        // nastavení pohledu
	        $this->pohled = 'chyba';
	    }
	}
?>