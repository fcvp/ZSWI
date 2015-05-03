/**
* zobrazit_formular.js
* -----------------------
* Zobrazi formular pro vybrani klicoveho slova a oblasti. Provede se po vybrani formy a typu studia.
* ------------
* 
* Vlozeno v index.php
* ------------
*    20.4.2015
*    @version 1.0
*/


/**
 *	Zobrazi formular
 *	
 */
function zobraz_formular() {
    var forma = $("#forma_studia").val();
    var typ = $("#typ_studia").val();
    // Pro zjištění zda už je první část zobrazena
    var zobrazeno = $("#zobrazeni_prvni_casti").val();

    if (zobrazeno == "1" || (forma != 0 && typ != 0)) {
        $("#zobrazeni_prvni_casti").val("1");
        $("#loading").fadeIn().queue(function (n) {
            $.ajax({
                url: "view/body_parts/formular.php",
                data: { forma: forma, typ: typ },
                cache: false,
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert("chyba pri nacitani.");
                }
            }).done(function (html) {
                $("#cast1").html(html);

                //odrolovani k nadpisu "Vyber oblasti"
                $('html, body').animate({
                    scrollTop: $("#formular_nadpis").offset().top
                }, 800);

                $("#submit_oblasti").show();
            });

            n();
        }).queue(function (n) {
            $("#loading").fadeOut();
            n();
        });

        
    }
}