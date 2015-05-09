/** 
* zobraz_vizualizaci.js
* -----------------------
* Zobrazi oblast s grafy a seznamem oboru po stisku tlacitka zobrazit vizualizaci.
* ------------
* 
* Vlozeno v index.php
* ------------
*    20.4.2015
*    @version 1.0
*/


/**
 *	Zobrazí výslednou vizualizaci
 *	 @param oblast_arr pole s názvy oblatí
 */
function zobrazit_vizualizaci(id_slova_arr) {

    var str = $("form").serialize();
    //delka pole
    var id_slova_arr_delka = id_slova_arr.length;

    //hodnoty radio buttonu
    var ks_hodnota = new Array();
    //id klicovych slov
    var id_ks = new Array();

    var j = 0;
    //nalezeni vsech zobrazenych klicovych slov
    for (var i = 0; i < id_slova_arr_delka; i++) {
        //id radio buttonu je ve tvaru 1_ks_idSlova az 5_ks_idSlova
        var radio = $('input:radio[id=' + 1 + '_ks_' + id_slova_arr[i] + ']');
        var hodnota=0;
        if (radio.length != 0) {
            for (var k= 1; k <= 5; k++)
            {
                radio = $('input:radio[id=' + k + '_ks_' + id_slova_arr[i] + ']');

                if (radio.is(':checked'))
                {
                    break;
                }
            }
               
            id_ks[j] = id_slova_arr[i];
            ks_hodnota[j] = parseInt(radio.filter(':checked').val());

            j++;

        }
    }

    //-----------------------------

    $("#loading").fadeIn().queue(function (n) {
        $.ajax({
            url: "view/body_parts/vizualizace.php",
            data: { vars: str, id_klicova_slova: id_ks, klicova_slova_hodnota: ks_hodnota },
            cache: false,
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("chyba pri nacitani.");
            }
        }).done(function (html) {


            $("#vizualizace").html(html);

            //odrolovani k tlacitku "zobrazit graf"
            $('html, body').animate({
                scrollTop: $("#vizualizace_nadpis").offset().top
            }, 800);
        });

        n();
    }).queue(function (n) {
        $("#loading").fadeOut();
        n();
    });
}
