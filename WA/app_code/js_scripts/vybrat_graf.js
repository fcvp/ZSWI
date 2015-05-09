/** 
* vybrat_graf.js
* -----------------------
* Zobrazeni prislusneho grafu po vybrani jedne ze zalozek.
* ------------
* 
* Vlozeno v vizualizace.php
* ------------
*    20.4.2015
*    @version 1.0
*/

//zobrazi graf ve vybrane zalozce
$(document).ready(function () {
    $("#vizualizace .menu .graf").click(function () {
        if (!$(this).is(".actual")) {
            if ($(this).is(".radar")) {
                $("#vizualizace .menu .graf").removeClass("actual");
                $("#sloupcovy").hide();
                $("#radar").show();
                $(this).addClass("actual");
                
            }
            else {
                google.setOnLoadCallback(drawChart);
                $("#vizualizace .menu .graf").removeClass("actual");
                $("#radar").hide();
                $("#sloupcovy").show();
                $(this).addClass("actual");
            }
        }
    });
});
