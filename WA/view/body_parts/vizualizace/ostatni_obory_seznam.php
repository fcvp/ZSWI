<?php

/**
 * ostatni_obory_seznam.php
 * ---------
 * Seznam oboru pod grafem
 * 
 * ------------
 * Vlozeno ve vizualizace.php
 *
 * ------------
 *   5.5.2015
 *   @version 1.0
 * */
 
require_once(VIZUALIZACE."ostatni_obory_polozka.php"); 

    //ostatni obory
echo "<h2>Ostatní obory: </h2>";
    echo "<ul>";
        if($pocet_vybranych === 0){
            //pokud nejsou vybrany zadne oblasti
            foreach($result['OBOR2'] as $row)
            {
                vykresli_nazev_oboru(0, 0, 1, 0, 3, $row);
            }
        }else
        {    //je vybrana alespon jedna oblast
            foreach($result['OBOR2'] as $row)
            {
                $forma =  substr($row[3], 0, 1);
                $procenta = $obory_s_procenty[normalize_str($forma." ".$row[0])];
             
                if($procenta < $min_zobrazeno)
                {
                   vykresli_nazev_oboru($min_zobrazeno, $procenta, 1, 0, 3, $row);
                }
                   
            }
        }
      
      
    echo "</ul>";
echo "</div>";

?>