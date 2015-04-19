<?php
echo "<table class='oblast_telo'>";

//vypisujeme jenom klicova slova a obory z dane oblasti
foreach ($result['KLICOVE_SLOVO'] as $row) {
    if(normalize_url($row[3])==$_GET['oblast'])
    {
        require(VYBRANE_OBLASTI."klicove_slovo.php");
    }
}

foreach ($result['OBOR'] as $row) {
    if(normalize_url($row[3])==$_GET['oblast'])
    {
        require(VYBRANE_OBLASTI."souvisejici_obory.php");
    }
}

// end for

echo "</table>";
?>
