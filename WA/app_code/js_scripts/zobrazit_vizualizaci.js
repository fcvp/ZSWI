/**
* zobraz_vizualizaci.js
* -----------------------
* Zobrazi oblast s grafy a seznamem oboru po stisku tlacitka zobrazit vizualizaci.
* ------------
* 
* Vlozeno v index.php
* ------------
*    20.4.2014
*    @version 1.0
*/


/**
 *	Zobrazí výslednou vizualizaci
 *	 
 */
function vybrat_graf() {
    var str = $("form").serialize();


    $("#loading").fadeIn().queue(function (n) {
        $.ajax({
            url: "view/body_parts/vizualizace.php",
            data: { vars: str },
            cache: false,
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("chyba pri nacitani.");
            }
        }).done(function (html) {
            $("#vizualizace").html(html);
        });

        n();
    }).queue(function (n) {
        $("#loading").fadeOut();
        n();
    });
}
