<?php

echo "<br /><br />";
echo "<span class='bold'>Vyberte jednu nebo více oblastí, která vás zajímají, ze seznamu (nepovinné):</span>";
echo "<br />";
echo "Můžete vybrat i oblast, kterou nechcete a později ji označit \"ne\".";
echo "<br /><br />";

echo "<select name='oblast' id='zvolena_oblast' onchange='oblast_odstran_hlasku()'>";
echo "<option value='0'>--Vyber oblast--</option>";
echo "<option value='Fyzika'>Fyzika</option>";
echo "<option value='Matematika'>Matematika</option>";
echo "<option value='Geomatika'>Geomatika</option>";
echo "<option value='Mechanika'>Mechanika</option>";
echo "<option value='Informatika'>Informatika</option>";
echo "<option value='Kybernetika'>Kybernetika</option>";
echo "</select>";
echo "&nbsp;&nbsp;";
echo "<input type='button' value='Přidat oblast do výběru' name='pridat_do_vyberu' onclick='pridatDoVyberu($(\"#zvolena_oblast\").val(), \"\");' /><br />";
echo "<span id='hlaska_oblast'></span>";
echo "</div>";

?>