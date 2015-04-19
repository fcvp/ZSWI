<?php


echo "<br /><br />\n";
echo "<span class='bold'>Vyberte jednu nebo více oblastí, která vás zajímají, ze seznamu (nepovinné):</span>\n";
echo "<br />\n";
echo "Můžete vybrat i oblast, kterou nechcete a později ji označit \"ne\".\n";
echo "<br /><br />\n";

echo "<select name='oblast' id='zvolena_oblast' onchange='oblast_odstran_hlasku()'>\n";
echo "<option value='0'>--Vyber oblast--</option>\n";

//echo "<option value='Fyzika'>Fyzika</option>";
//echo "<option value='Matematika'>Matematika</option>";

foreach($result['OBLAST']  as $row)
{
    echo "<option id=\"O_".$row[0]."\" value=\"".normalize_url($row[1])."\">".$row[1]." </option>";
}

echo "</select>";
echo "</select>";
echo "&nbsp;&nbsp;";
echo "<input type='button' value='Přidat oblast do výběru' name='tlacitko_pridat_do_vyberu' onclick='pridat_do_vyberu($(\"#zvolena_oblast\").val(), \"\");' /><br />";
echo "<span id='hlaska_oblast'></span>";
echo "</div>";

?>