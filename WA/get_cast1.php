<?php	
	if ($_GET["forma"] == "0" || $_GET["typ"] == "0")	{
	 echo "<div class='infobox'>Vyberte formu a typ studia</div>";
	}
	else	{
		echo "<div class='bunka' style='padding-top: 0px;'>";
				echo "<label for='q'>";
      		echo "<span class='bold'>Zadejte klíčová slova (předmět, oblast) nebo (a) vyberte oblasti ze seznamu níže (nepovinné):</span></label>";
      	echo "<br />";
      	echo "Př: matematika, programování, softwarové inženýrství, fyzika plazmatu, ...:<br /><br />";
      	echo "<input type='text' value='' id='q' />";
      	echo "&nbsp;&nbsp;";
      	echo "<input type='button' value='Přidat slovo do výběru'>";
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
	    echo "<input type='button' value='Přidat oblast do výběru' name='pridat_do_vyberu' onclick='pridatDoVyberu();' /><br />";
	    echo "<span id='hlaska_oblast'></span>";
 		echo "</div>";
	
		echo "<div class='bunka noborder' style='padding-bottom: 0px;' id='popis_oblasti'>";
	 		echo "<h2>Vybrané oblasti (a klíčová slova, obory, která k nim patří):</h2>";
			echo "<p>Ohodnoťe klíčová slova od 1 do 5, 1 má nejmenší váhu (nechci) a 5 největší (určitě chci). Hodnocení bude mít vliv při výběru vhodných oborů.</p>";
	 	echo "</div>";
		echo "<div class='bunka noborder' id='oblasti'>";	
		echo "</div>";
		
		echo "<div class='bunka' style='text-align: center;' id='submit_oblasti'><input type='button' value='Zobrazit obory' onclick='zobrazVizualizaci();' name='odeslat_formular' /></div>";
		echo "<div id='posledni_cast'>";
			
		echo "</div>";
	}
?>