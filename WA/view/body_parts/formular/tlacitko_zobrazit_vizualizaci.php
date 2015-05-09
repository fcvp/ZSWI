<?php

/**
 * tlacitko_zobrazit_vizualizaci.php
 * ---------
 * Tlacitko pro zobrazeni vizualizace.
 * 
 * ------------
 * Vlozeno v formular.php
 *
 * ------------
 *   20.4.2015
 *   @version 1.0
 * 
 */
 
 //id klicovych slov
 $i=0;
 $id_ks = array();
 
 foreach($result['KLICOVE_SLOVO'] as $row)
 {
    $id_ks[$i] = $row[0];
    $i++;
 }

echo "<div class='bunka' style='text-align: center;' id='submit_oblasti'>";
echo "<input type='button' value='Zobrazit/aktualizovat obory' onclick='zobrazit_vizualizaci(".json_encode($id_ks).");' id='zobrazit_grafy' name='zobrazit_grafy' />";
echo "</div>";

?>


