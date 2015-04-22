<?php
/**
 * config.php
 * ---------
 * Definice konstant cest do jednotlivých adresáøù. 
 * Pripojeni databazi.
 * 
 * ------------
 * 
 * Vlozeno v index.php, formular.php, vybrana_oblast.php, generator.php, get_id_slova.php
 * ------------
 *   20.4.2014
 *   @version 1.0
 * 
 * */


/**
 * Definice konstant cest do jednotlivých adresáøù
 * */

define('ROOT', $_SERVER['DOCUMENT_ROOT']."/");


//funkce
define('APP_CODE',ROOT."app_code/");

//vzhled
define('VIEW',ROOT."view/");
    define('LAYOUT',VIEW."layout/");
    define('BODY',VIEW."body_parts/");
    define('FORM',BODY."formular/");
    define('VYBRANE_OBLASTI',FORM."vybrane_oblasti/");

//obrazky
define('IMAGE',ROOT."image/");

//pripojeni databaze
require_once(APP_CODE."database.php");


?>