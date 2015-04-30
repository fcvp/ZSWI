<!--
 * VO_souvisejici_obory.php
 * ---------
 * Klicova, souvisejici se zvolenymi oblastmi, zobrazene v seznamu vybranych oblasti.
 * 
 * ------------
 * Vlozeno v VO_oblast_telo.php
 *
 * ------------
 *   20.4.2014
 *   @version 1.0
 * 
 -->
 
 
    
<tr>
    <td  id="<?php echo "ks_".$row[0]; ?>" >
        <b><?php echo $row[1]; ?> </b>
    </td>
    <td>
    
        <?php 
            $vyznam = array(1=>"ne", 2=>"spíše ne", 3=>"nevadí mi", 4=>"spíše ano", 5=>"ano");
            for($j=1; $j<=5; $j++)
            {
                if($j==3) {
                    echo "<input type='radio' class='klicove_slovo' id=\"ks_".$row[0]."\" checked=\"checked\"  name=\"".$_GET['oblast']."_".$i."\" value='".$j."' >".$vyznam[$j]."</input>\n";
                }
                else{
                    echo "<input type='radio' class='klicove_slovo' id=\"ks_".$row[0]."\" name=\"".$_GET['oblast']."_".$i."\" value='".$j."' >".$vyznam[$j]."</input>\n";
                } 
            }
            
        ?>

 
    </td>
</tr>

