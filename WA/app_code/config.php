<?php
/**
 * Definice konstant cest do jednotlivých adresáøù

 * */

define('ROOT', $_SERVER['DOCUMENT_ROOT']."\\");

//funkce
define('APP_CODE',ROOT."app_code\\");

//vzhled
define('VIEW',ROOT."view\\");
    define('LAYOUT',VIEW."layout\\");
    define('BODY',VIEW."body_parts\\");

//obrazky
define('IMAGE',ROOT."image\\");


?>