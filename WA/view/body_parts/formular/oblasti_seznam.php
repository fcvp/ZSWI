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
 *   20.4.2015
 *   @version 1.0
 * 
 */

echo "<br />\n";
echo "<span class='bold'>Vyberte jednu nebo více <u>oblastí</u>, která vás zajímají  (nepovinné):</span>\n";
echo "<br /><br />\n";

//echo "<select autocomplete=\"off\"  id=\"zvolena_oblast\" onchange='pridat_do_vyberu($(\"#zvolena_oblast\").val());' >\n";
//echo "<option value='0'>--Vyber oblast--</option>\n";

//foreach($result['OBLAST']  as $row)
//{   //normalize_str
//    echo "<option id=\"oblast_".$row[0]."\" value=\"".($row[1])."\">".$row[1]." </option>";
//}
$rows = array_chunk($result['OBLAST'],4);

echo "<table style=\"width:600px\">";
foreach($rows as $key => $row)
{
      echo "<tr>";

    foreach($row as $column) {
       echo "<td>";
           echo "<input type=\"checkbox\" id=\"oblast_".$column[0]."\" value=\"".($column[1])."\"
                 onclick='pridat_do_vyberu(\"".$column[1]."\",\"oblast_".$column[0]."\" );' > ".
              $column[1].
           " </input><br/>";
       echo "</td>";
    }
    
    echo "</tr>";
}
echo "</table>";

echo "&nbsp;&nbsp;";
echo "<span id='hlaska_oblast'></span><br><br>";


?>