<?php

echo "<span class='bold'>Forma studia </span>\n";
echo "<select name=\"forma\" id=\"forma_studia\" onchange=\"zobraz_formular();\">\n";
   echo "<option value=\"0\">--Vyber formu studia--</option>\n";

    foreach($result['FORMA']  as $row)
    {
        //$value = strtoupper(substr($row[1],0,1));
        echo "<option id=\"F_".$row[0]."\" value=\"".$row[1]."\">".$row[1]." </option>\n";
    }
    //Obe formy
    $value = $result['FORMA'][0][1]."_".$result['FORMA'][1][1];
    echo "<option id=\"F_1_2\" value=\"".$value."\">Obě</option>\n";
    
echo "</select>\n";
    
?>
   