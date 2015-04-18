<?php
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
//nacteni dat
require_once(APP_CODE."load_data.php");


?>