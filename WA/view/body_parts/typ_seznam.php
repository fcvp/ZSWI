<?php

echo "<span class='bold'>Typ studia </span>";
echo "<select name=\"typ\" id=\"typ_studia\" onchange=\"zobraz_formular();\">";
echo "<option value=\"0\">--Vyber typ studia--</option>";

    foreach($result['TYP']  as $row)
    {
        echo "<option id=\"T_".$row[0]."\" value=\"".$row[1]."\">".$row[1]." </option>";
    }
    
echo "</select>";
    
?>
   