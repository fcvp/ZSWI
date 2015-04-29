<?php
/**
 * vyhledavani.php
 * ---------
 * Textove pole pro vyhledani klicoveho slova.
 * 
 * ------------
 * Vlozeno v formular.php
 *
 * ------------
 *   20.4.2014
 *   @version 1.0
 * 
 */


echo "Zadejte <u>klíčová slova (předmět, oblast)</u> (nepovinné):";

echo "<br />";

echo "Př: matematika, programování, softwarové inženýrství, fyzika plazmatu, ...:<br /><br />";

echo "<label id=\"hledej_label\">Hledej: </label>";
echo "<input type='text' value='' name='klicove_slovo' id='klicove_slovo' onchange='klicove_slovo_odstran_hlasku();' />";
echo "&nbsp;&nbsp;";//

echo "<input type='button' value='Přidat slovo do výběru' onclick='pridat_klicove_slovo($(\"#klicove_slovo\").val())'>";
echo "<br />";
echo "<span id='hlaska_klicove_slovo'></span><br>";


echo "<script type=\"text/javascript\" src=\"app_code/js_scripts/naseptavac.js\"></script>";


?>

