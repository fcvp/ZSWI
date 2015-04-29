<?php
/**
 * oblasti_seznam.php
 * ---------
 * Seznam oblasti. Zobrazeno ve formulari.
 * 
 * ------------
 * Vlozeno v formular.php
 *
 * ------------
 *   20.4.2014
 *   @version 1.0
 * 
 */

echo "<br />\n";
echo "<span class='bold'>Vyberte jednu nebo více <u>oblastí</u>, která vás zajímají  (nepovinné):</span>\n";
echo "<br /><br />\n";

echo "<select name='oblast' autocomplete=\"off\"  id='zvolena_oblast' onchange='pridat_do_vyberu($(\"#zvolena_oblast\").val(), \"\");' >\n";
echo "<option value='0'>--Vyber oblast--</option>\n";

foreach($result['OBLAST']  as $row)
{
    echo "<option id=\"O_".$row[0]."\" value=\"".normalize_str($row[1])."\">".$row[1]." </option>";
}

echo "</select>";
echo "</select>";
echo "&nbsp;&nbsp;";
//echo "<input type='button' value='Přidat oblast do výběru' name='tlacitko_pridat_do_vyberu' onclick='pridat_do_vyberu($(\"#zvolena_oblast\").val(), \"\");' /><br />";
echo "<span id='hlaska_oblast'></span><br><br>";
//echo "</div>";

?>