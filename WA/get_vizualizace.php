<?php
require_once("app_code/config.php");
/*________________*/
/*
$vars = $_GET["vars"];
$pole = split("&", $vars);
*/
/** 
 * Vyparsovani jednotlivych promenych a jejich hodnot 
 * */
/*$i=0;
foreach ($pole as $p)	{
    $hodnoty[$i] = split("=", $p);
    $i++;
}*/

// Kontrolni vypis
/*foreach ($hodnoty as $hodnota)	{
echo $hodnota[0]." = ".$hodnota[1]."<br />";
}*/
 

require(BODY."vizualizace.php");
?>


<script> 
    //
    $(document).ready(function () {
        $("#vizualizace .menu .graf").click(function () {
            if (!$(this).is(".actual")) {
                if ($(this).is(".kruhovy")) {
                    $("#vizualizace .menu .graf").removeClass("actual");
                    $("#paprskovy").hide();
                    $("#kruhovy").show();
                    $(this).addClass("actual");
                }
                else {
                    $("#vizualizace .menu .graf").removeClass("actual");
                    $("#kruhovy").hide();
                    $("#paprskovy").show();
                    $(this).addClass("actual");
                }
            }
        });
    });
</script>
