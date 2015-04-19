<?php
echo "<div class='bunka' style='padding-top: 0px;'>";
echo "<label for='q'>";
echo "<span class='bold'>Zadejte klíčová slova (předmět, oblast) nebo (a) vyberte oblasti ze seznamu níže (nepovinné):</span>";
echo "</label>";

echo "<br />";

echo "Př: matematika, programování, softwarové inženýrství, fyzika plazmatu, ...:<br /><br />";
echo "<input type='text' value='' name='klicove_slovo' id='klicove_slovo' onchange='klicove_slovo_odstran_hlasku();' />";
echo "&nbsp;&nbsp;";
echo "<input type='button' value='Přidat slovo do výběru' onclick='pridat_klicove_slovo($(\"#klicove_slovo\").val())'>";
echo "<br />";
echo "<span id='hlaska_klicove_slovo'></span>";


echo "<script type=\"text/javascript\" src=\"app_code/js_scripts/naseptavac.js\"></script>";


?>

