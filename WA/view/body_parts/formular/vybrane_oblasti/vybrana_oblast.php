

<div class='oblast' id="oblast_<?php echo $_GET["oblast"];?>">

    <?php
    session_start();

    $_GET["typ"] = $_SESSION['typ'];
    $_GET["forma"] =  $_SESSION['forma'];

    
    require_once($_SERVER['DOCUMENT_ROOT']."/app_code/config.php"); 
    
    include(VYBRANE_OBLASTI."oblast_hlavicka.php");
    include(VYBRANE_OBLASTI."oblast_telo.php");
    ?>


</div>
