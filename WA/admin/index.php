<?php
mb_internal_encoding("UTF-8");

/** 
 * Callback pro automatické načítání tříd controllerů a modelů
 * 
 * @param String $trida Název třídy 
 */ 
function autoloadFunkce($trida)	{
  if (file_exists('kontrolery/'.$trida.'.php'))	require("kontrolery/".$trida.".php");
	else require("modely/".$trida.".php");
}

// Registrace callbacku
spl_autoload_register("autoloadFunkce");
// server, userName, password, dbName
Db::pripoj("localhost", "czzswi", "zswi_project01", "czzswi");
$smerovac = new SmerovacKontroler();
$smerovac->zpracuj(array($_SERVER['REQUEST_URI']));
$smerovac->vypisPohled();
?>