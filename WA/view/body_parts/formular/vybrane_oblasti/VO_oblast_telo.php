



<?php
/*
 * VO_oblast_telo.php
 * ---------
 * Klicova slova a obory patrici k prislusne oblasti v seznamu vybranych oblasti.
 * 
 * ------------
 * Vlozeno ve vybrana_oblast.php
 *
 * ------------
 *   20.4.2014
 *   @version 1.0
 * 
*/


echo "<table class='oblast_telo'>";

//vypisujeme jenom klicova slova a obory z dane oblasti
$i=0;
foreach ($klicova_slova as $row) {
    require(VYBRANE_OBLASTI."VO_klicove_slovo.php");
    $i++;
}

echo "<tr>";
    echo "<td>";
    echo "<br><label><b>Souvisejici obory:</b></label>";
    
        //
        foreach ($result['OBOR'] as $row) {
            if(/*normalize_str*/($row[3])==$_GET['oblast'])
            {
                require(VYBRANE_OBLASTI."VO_souvisejici_obory.php");
            }
        }
    echo "</td>";
echo "</tr>";

echo "</table>";
?>



<script type="text/javascript" src="../../../../app_code/js_scripts/aplikovat_hodnoceni.js">
</script>

