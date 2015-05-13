<!--
 * VO_oblast_hlavicka.php
 * ---------
 * Oblasti v seznamu vybranych oblasti.
 * 
 * ------------
 * Vlozeno ve vybrana_oblast.php
 *
 * ------------
 *   20.4.2015
 *   @version 1.0
 * 
-->

<table class='oblast_hlavicka'>
    <tr>
        <td style='width: 20px;'>
            <img src='image/cross.png' alt='Odebrat oblast' title='Odebrat oblast' class='odebrat_oblast' onclick="odeber_oblast('<?php echo "".$_GET["id_vybrana_oblast"];?>');" />
        </td>
        <td>
            <b>
                <?php 
               // session_start();
 
                echo $_GET["oblast"];    ?>
            </b>
        </td>
        <td>
            <?php 
            $pocet_slov=0;
            $klicova_slova = array();
            foreach ($result['KLICOVE_SLOVO'] as $row) {
                if(($row[3])==$_GET['oblast'])
                {
                    $klicova_slova[$pocet_slov]=$row;
                    $pocet_slov++;
                }
            }
            
          //  $vyznam = array(1=>"ne", 2=>"spíše ne", 3=>"nevadí mi", 4=>"spíše ano", 5=>"ano");
            for($j=1; $j<=5; $j++)
            {
                if($j==5) {
                    echo "<input type='radio' class='klicove_slovo'  checked=\"checked\" id=\"".$j."_".$_GET['oblast']."\" name=\"".$_GET['oblast']."\" value='".$j."' >".
                    "<label id=\"".$j."_".$_GET['oblast']."\" for=\"".$j."_".$_GET['oblast']."\" >".$vyznam[$j]."</label>".
                    "</input>\n";
                }
                else{
                   echo "<input type='radio' class='klicove_slovo'  id=\"".$j."_".$_GET['oblast']."\" name=\"".$_GET['oblast']."\" value='".$j."' >".
                    "<label id=\"".$j."_".$_GET['oblast']."\" for=\"".$j."_".$_GET['oblast']."\" >".$vyznam[$j]."</label>".
                    "</input>\n";
                }
            }
            
            ?>

            &nbsp;&nbsp;&nbsp;

            <!-- skryte pole obsahujici nazev oblasti pro identifikaci tlacitka a radio buttonu v JS -->
            <input type="hidden" id="oblast_nazev" value="<?php echo $_GET["oblast"];?>"  />

            <!-- ...................... -->
            <input type="button" id="btn_aplikovat_<?php echo $_GET["oblast"];?>" data-pocet="<?php echo $pocet_slov;?>"
                 title="Hodnocení u oblasti se aplikuje i na klíčová slova, která k ní patří." value="Aplikovat hodnocení" />

            <label id="text"></label>
        </td>
    </tr>
</table>

