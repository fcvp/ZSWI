<div class='oblast' id="oblast_<?php echo $_GET["oblast"];?>">

    <?php
    require_once($_SERVER['DOCUMENT_ROOT']."/app_code/config.php"); 
    
        require(VYBRANE_OBLASTI."oblast_hlavicka.php");
        require(VYBRANE_OBLASTI."oblast_telo.php");
    ?>

    
</div>
