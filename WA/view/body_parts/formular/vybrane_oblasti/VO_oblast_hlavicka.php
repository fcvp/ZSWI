<table class='oblast_hlavicka'>
    <tr>
        <td style='width: 20px;'>
            <img src='image/cross.png' alt='Odebrat oblast' title='Odebrat oblast' class='odebrat_oblast' onclick="odeberOblast('oblast_<?php echo $_GET["oblast"];?>');" />
        </td>
        <td>
            <b>
                <?php echo $_GET["oblast"];?>
            </b>
        </td>
        <td>
            <?php 
            $pocet_slov=0;
            foreach ($result['KLICOVE_SLOVO'] as $row) {
                if(normalize_url($row[3])==$_GET['oblast'])
                {
                    $klicova_slova[$pocet_slov]=$row;
                    $pocet_slov++;
                }
            }
            
            ?>

            <input type="radio" name="<?php echo $_GET["oblast"];?>" value="1"/>
            ne 
            <input type="radio" name="<?php echo $_GET["oblast"];?>" value="2" />
            spíše ne
            <input type="radio" name="<?php echo $_GET["oblast"];?>" value="3" checked="checked" />
            nevadí mi
            <input type="radio" name="<?php echo $_GET["oblast"];?>" value="4" />
            spíše ano
            <input type="radio" name="<?php echo $_GET["oblast"];?>" value="5" />
            ano
		      &nbsp;&nbsp;&nbsp;

            <!-- skryte pole obsahujici nazev oblasti pro identifikaci tlacitka a radio buttonu v JS -->
            <input type="hidden" id="oblast_nazev" value="<?php echo $_GET["oblast"];?>"  />

            <input type="button" id="btn_aplikovat_<?php echo $_GET["oblast"];?>" data-pocet="<?php echo $pocet_slov;?>"
                 title="Hodnocení u oblasti se aplikuje i na klíčová slova, která k ní patří." value="Aplikovat hodnocení" />

            <label id="text"></label>
        </td>
    </tr>
</table>

