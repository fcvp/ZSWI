<?php
echo "<table class='oblast_telo'>";

//vypisujeme jenom klicova slova a obory z dane oblasti
$i=0;
foreach ($klicova_slova as $row) {
    require(VYBRANE_OBLASTI."VO_klicove_slovo.php");
    $i++;
}

foreach ($result['OBOR'] as $row) {
    if(normalize_url($row[3])==$_GET['oblast'])
    {
        require(VYBRANE_OBLASTI."VO_souvisejici_obory.php");
    }
}
echo "</table>";
?>



<script type="text/javascript" src="../../../../app_code/js_scripts/aplikovat_hodnoceni.js">
</script>

