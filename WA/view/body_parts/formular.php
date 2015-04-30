<?php	
/**
 * formular.php
 * ---------
 * Formular pro zadani klicovych slov a oblasti a prostor pro zobrazeni vizualizace.
 * 
 * ------------
 * Vlozeno v zobrazit_formular.js
 *
 * ------------
 *   20.4.2014
 *   @version 1.0
 * 
 */
          
  echo  "<h2 id=\"formular_nadpis\">Výběr oblastí</h2>";
   echo "<p>";
  echo  "      Vyberte ze seznamu níže oblasti, které Vás baví a rádi byste je studovali. 
            Oblast se po výběru zobrazí spolu s klíčovými slovy a názvy oborů. V seznamu můžete upřesnit svoje priority. ";
  echo  "</p>";

    /**
     * Zobrazeni formulare pro zadani klicovych slov/oblasti
     * */
    require_once($_SERVER['DOCUMENT_ROOT']."/app_code/config.php");
    //---------------------
    
	if ($_GET["forma"] == "0" || $_GET["typ"] == "0")	{
	    echo "<div class='infobox'>Vyberte formu a typ studia</div>";
	} else {
        //forma a typ studia je vybrana
        session_start();
        
        //ulozeni formy a typu pro pouziti v ajaxem nacitanych castech
        $_SESSION['typ'] = $_GET["typ"];
        $_SESSION['forma'] = $_GET["forma"];

        // formular
          require_once(FORM."oblasti_seznam.php");
        //  require_once(FORM."vyhledavani.php");
          
          echo "<br><hr>";
          
          require_once(FORM."vybrane_oblasti_seznam.php");

          
          
          //vizualizace
          require_once(FORM."tlacitko_zobrazit_vizualizaci.php");   
          echo "<div id='vizualizace'>";
             //funkce vybrat_graf():
                    //(FORM."vizualizace.php");
          
             //zde se zobrazi vizualizace
          echo "</div>";

	}
    
    
?>