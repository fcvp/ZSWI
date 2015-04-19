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
            <input type="radio" name="mat" value="1" />
            ne
            <input type="radio" name="mat" value="2" />
            spíše ne
            <input type="radio" name="mat" value="3" checked="checked" />
            nevadí mi
            <input type="radio" name="mat" value="4" />
            spíše ano
            <input type="radio" name="mat" value="5" />
            ano
		      &nbsp;&nbsp;&nbsp;
            <input type="button" title="Hodnocení u oblasti se aplikuje i na klíčová slova, která k ní patří." value="Aplikovat hodnocení" />
        </td>
    </tr>
</table>
