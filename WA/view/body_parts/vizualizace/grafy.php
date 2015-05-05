<!--
 * grafy.php
 * ---------
 * Zobrazeni grafu 
 * 
 * ------------
 * Vlozeno ve vizualizace.php
 *
 * ------------
 *   3.5.2015
 *   @version 1.0
 * 
-->

<div id="vizualizace">
    <?php
    echo "<table>";

    foreach($obory_final as $obor)
    {
        echo "<tr>";
        echo "<td>".($obor[0])."</td><td>".$obor[3]."</td><td>".$obor[4]."</td>";
        echo "</tr>";

    }
    echo "</table>";
    
    ?>
    <br/>
    <div class='menu'>
      <span class='graf sloupcovy actual'>Sloupcový graf</span><span class='graf radar'>Paprskový graf</span>
    </div>
    <br/><br/>
    <?php 
    require_once(GRAF."graf_sloupcovy.php"); 
    require_once(GRAF."graf_paprskovy.php"); 
    ?>

</div>
