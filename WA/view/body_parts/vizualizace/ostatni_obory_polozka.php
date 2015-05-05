<?php

/**
 * ostatni_obory_polozka.php
 * ---------
 * Název oboru s odkazem, v seznamu ostatních oborů, pod grafem.
 * 
 * ------------
 * Vlozeno v ostatni_obory_seznam.php
 *
 * ------------
 *   3.5.2015
 *   @version 1.0
 * */
 
/**
* Vykresli polozku seznamu "ostatni obory"
*
* @param $url_id - cislo sloupce s url adresou
* @param $nazev_id - cislo sloupce s nazvem oboru
* @param $forma_id - cislo sloupce s nazvem formy
* @param $row      - data
*/
function vykresli_nazev_oboru($url_id, $nazev_id, $forma_id, $row){
     echo "<li><a href=\"$row[$url_id]\" target=\"_blank\">$row[$nazev_id]</a> ($row[$forma_id])</li>";
}


?>