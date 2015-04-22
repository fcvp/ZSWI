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
    // spojeni s databazi, funkce pro operaci SELECT
    define('DB',APP_CODE."database/");
    
    //scripty v jquery, ajax pro zobrazeni casti stranky
    define('JS',APP_CODE."js_scripts/");

//vzhled
define('VIEW',ROOT."view/");
    //zakladni casti stranky
    define('LAYOUT',VIEW."layout/");
    //casti tela stranky
    define('BODY',VIEW."body_parts/");
        //casti formulare
        define('FORM',BODY."formular/");
            //casti seznamu vybranych oblasti
            define('VYBRANE_OBLASTI',FORM."vybrane_oblasti/");

//naseptavac
define('AUTOSUGGEST',ROOT."autosuggest/");           

//obrazky
define('IMAGE',ROOT."image/");

//-------------------------

//pripojeni databaze
require_once(DB."database.php");


?>