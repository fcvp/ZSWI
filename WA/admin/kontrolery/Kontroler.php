<?php

abstract class Kontroler
{

  protected $data = array();
	
  protected $pohled = "";
	
	protected $hlavicka = array('titulek' => '', 'klicova_slova' => '', 'popis' => '');

	
  public function vypisPohled()	{
    if ($this->pohled)	{
      extract($this->osetri($this->data));
      extract($this->data, EXTR_PREFIX_ALL, "");
      require("pohledy/" . $this->pohled . ".phtml");
    }
  }
	
	
	public function presmeruj($url)	{
		header("Location: ./$url");
		header("Connection: close");
    exit;
	}
	
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
	
	
  abstract function zpracuj($parametry);

}