<?php
echo "<table class='oblast_telo'>";


foreach ($result['KLICOVE_SLOVO'] as $row) {
    if(normalize_url($row[3])==$_GET['oblast'])
    {
        require(VYBRANE_OBLASTI."klicove_slovo.php");
    }
}

require(VYBRANE_OBLASTI."souvisejici_obory.php");
// end for

echo "</table>";
?>
