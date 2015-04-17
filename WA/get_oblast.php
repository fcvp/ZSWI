<div class='oblast' id="oblast_<?php echo $_GET["oblast"];?>">

    <?php
    require_once($_SERVER['DOCUMENT_ROOT']."/app_code/config.php"); 
    
        require(VYBRANE_OBLASTI."oblasti_hlavicka.php");
        require(VYBRANE_OBLASTI."oblasti_telo.php");
    ?>

    
</div>
