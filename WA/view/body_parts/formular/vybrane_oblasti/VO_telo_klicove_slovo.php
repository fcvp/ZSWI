<!--
 * VO_telo_souvisejici_obory.php
 * ---------
 * Klicova, souvisejici se zvolenymi oblastmi, zobrazene v seznamu vybranych oblasti.
 * 
 * ------------
 * Vlozeno v VO_oblast_telo.php
 *
 * ------------
 *   20.4.2015
 *   @version 1.0
 * 
 -->
 
 
    
<tr>
    <td  id="<?php echo "ks_".$row[0]; ?>" >
        <b><?php echo  "<label title=\"".$row[4]."\">".$row[1]; ?> </label></b>
    </td>
    <td>
    
        <?php 
            $vyznam = array(1=>"ne", 2=>"spíše ne", 3=>"nevadí mi", 4=>"spíše ano", 5=>"ano");
            for($j=1; $j<=5; $j++)
            {
                if($j==5) {
                    echo "<input type='radio' class='klicove_slovo' id=\"".$j."_ks_".$row[0]."\" checked=\"checked\"  
                    name=\"".$_GET['oblast']."_".$i."\" value='".$j."' >".
                    
                    "<label id=\"ks_".$row[0]."\" for=\"".$j."_ks_".$row[0]."\" >".$vyznam[$j]."</label>".
                    
                    "</input>\n";
                }
                else{
                     echo "<input type='radio' class='klicove_slovo' id=\"".$j."_ks_".$row[0]."\" 
                    name=\"".$_GET['oblast']."_".$i."\" value='".$j."' >".
                    
                    "<label id=\"ks_".$row[0]."\" for=\"".$j."_ks_".$row[0]."\" >".$vyznam[$j]."</label>".
                    
                    "</input>\n";
                } 
            }
            
        ?>

 
    </td>
</tr>

