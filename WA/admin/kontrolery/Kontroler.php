<?php
/**
 * Abstraktní třída kontroler, od které další kontrolery dědí
 * 
 * @author Jan Baxa  
 */ 
abstract class Kontroler
{
	/** @var mixed[] $data data, která se posílají do pohledu */	
  protected $data = array();
	/** @var String $pohled název souboru pohledu */
  protected $pohled = "";
	/** @var String[] $hlavicka titulek, klicova slova a popis podstránky */
	protected $hlavicka = array('titulek' => '', 'klicova_slova' => '', 'popis' => '');

	/**
	 * Vykreslí pohled a pošle mu data	 
	 */	 	
  public function vypisPohled()	{
    if ($this->pohled)	{
    	// ošetřené proměnné (pokud je chceme používat například po výstupu z formulářů)
      extract($this->osetri($this->data));
      // neošetřené proměnné (s prefixem _) pokud chceme aby proměnné obsahovaly html tagy
      extract($this->data, EXTR_PREFIX_ALL, "");
      require("pohledy/" . $this->pohled . ".phtml");
    }
  }
	
	/**
	 * Přesmeruje stránku na zadanou adresu
	 * 
	 * @param String $url adresa	 	 
	 */	 	
	public function presmeruj($url)	{
		header("Location: /admin/$url");
		header("Connection: close");
    exit;
	}
	
	/**
	 * Ošetří obsahy proměnných proti nebezpečným html znakům
	 * 
	 * @param mixed $x proměná k ošetření	
	 * @return mixed ošetřená proměnná	  	 
	 */	 	
	private function osetri($x = null)	{
    if (!isset($x))	return null;
    elseif (is_string($x))	return htmlspecialchars($x, ENT_QUOTES);
    elseif (is_array($x))	{
      foreach($x as $k => $v)	{
        $x[$k] = $this->osetri($v);
      }
      return $x;
    }
    else	return $x;
	}
	
	/**
	 * Hlavní metoda kontroleru
	 * 
	 * @param String $parametry parametry (url adresa za lomítkem)	 	 
	 */	 	
  abstract function zpracuj($parametry);

}