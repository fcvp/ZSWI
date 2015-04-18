<?php	
    /**
     * Zobrazeni formulare pro zadani klicovych slov/oblasti
     * */
    require_once($_SERVER['DOCUMENT_ROOT']."/app_code/config.php");
    //---------------------
    
	if ($_GET["forma"] == "0" || $_GET["typ"] == "0")	{
	    echo "<div class='infobox'>Vyberte formu a typ studia</div>";
	} else {
        //forma a typ studia je vybrana
        
        // formular
          require_once(FORM."vyhledani.php");
          require_once(FORM."oblasti_seznam.php");
          require_once(FORM."vybrane_oblasti_seznam.php");

          //vizualizace
          require_once(FORM."tlacitko_zobrazit_vizualizaci.php");   
          echo "<div id='vizualizace'>";
             //funkce zobrazit_vizualizaci():
                    //require_once(FORM."vizualizace.php");
          
             //zde se zobrazi vizualizace
          echo "</div>";
		
          //naseptavac (js)
	    echo "<script type=\"text/javascript\" src=\"app_code/js_scripts/naseptavac.js\"></script>";

	}
    
    
?>