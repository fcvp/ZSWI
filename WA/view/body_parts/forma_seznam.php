<?php

/**
 * forma_seznam.php
 * ---------
 * Seznam forem studia, zobrazeny v horni casti aplikace.
 * 
 * ------------
 * Vlozeno v body.php
 *
 * ------------
 *   20.4.2015
 *   @version 1.0
 * 
 */


echo "<span class='bold'>Forma studia </span>\n";
echo "<select name=\"forma\" autocomplete=\"off\" id=\"forma_studia\" onchange=\"zobraz_formular();\">\n";
   echo "<option value=\"0\">--Vyber formu studia--</option>\n";

    foreach($result['FORMA']  as $row)
    {
        echo "<option id=\"F_".$row[0]."\" value=\"".$row[1]."\">".$row[1]." </option>\n";
    }
    //Obe formy
    $value = $result['FORMA'][0][1]."_".$result['FORMA'][1][1];
    echo "<option id=\"F_1_2\" value=\"".$value."\">Obě</option>\n";
    
echo "</select>\n";
    
?>
   