<!--
 * vybrana_oblast.php
 * ---------
 * Vybrana oblast - nazev oblasti (hlavicka) a klicova slova, obory (telo) v seznamu zvolenych oblasti.
 * 
 * ------------
 * Vlozeno v zobraz_oblast.js
 *
 * ------------
 *   20.4.2014
 *   @version 1.0
 * 
 -->

<div class='oblast' id="<?php echo "vybrana_".$_GET["id_vybrana_oblast"];?>">
    

    <?php

    session_start();

    $_GET["typ"] = $_SESSION['typ'];
    $_GET["forma"] =  $_SESSION['forma'];

    
    require_once($_SERVER['DOCUMENT_ROOT']."/app_code/config.php"); 
    
    include(VYBRANE_OBLASTI."VO_oblast_hlavicka.php");
    include(VYBRANE_OBLASTI."VO_oblast_telo.php");
    ?>


</div>
