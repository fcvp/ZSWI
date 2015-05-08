/**
* zobrazit_oblast.js
* -----------------------
* Pridani/smazani oblasti do/ze seznamu vybranych oblasti, zobrazovane pod formularem,
* po stisknuti tlacitka vedle vyhledavani (pridat_klicove_slovo), seznamu oblasti (pridat_do_vyberu) 
* nebo krizku vedle nazvu oblasti v seznamu vybranych oblasti (odeber_oblast)
* ------------
* 
* Vlozeno v index.php
* ------------
*    20.4.2015
*    @version 1.0
*/


/**
 * Přidá oblast do výběru
 *
 * @param nazev_oblast - Označní oblasti 
 **/
function pridat_do_vyberu(nazev_oblast, id_oblast) {
    var oblast_chb = $('input:checkbox[id=' + id_oblast + ']');
    var oznaceno = oblast_chb.filter(':checked').length;


    //pokud checkbox neni zaskrtnut oblast se prida
    if (oznaceno == 1) {

        if (nazev_oblast != 0) {
            /** zjisti zda uz oblast neni ve vyberu */
            if ($("#vybrana_" + id_oblast).length == 0) {

                if (id_oblast != 0) {
                    $("#posledni_cast").html("");
                    $("#hlaska_oblast").html("<img src='image/loading.gif' alt='' />");
                    $.ajax({
                        url: "view/body_parts/formular/vybrane_oblasti/vybrana_oblast.php",
                        type: 'GET',
                        data: { oblast: nazev_oblast, id_vybrana_oblast: id_oblast },

                        cache: false,
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            $("#hlaska_oblast").html("<span class='red'>Při načítání došlo k chybě</span>");
                        }
                    }).done(function (html) {
                        if ($("#popis_oblasti").is(":hidden")) {
                            $("#popis_oblasti").show();
                            $("#submit_oblasti").show();
                        }
                        $("#oblasti").prepend(html);
                        $("#hlaska_oblast").html("Oblast " + nazev_oblast + " byla přidána do výběru.");
                    });
                }
            }
            else {
                $("#hlaska_oblast").html("<span class='red'>Oblast již je ve výběru</span><br>");
            }
        }
    } else {
        //jinak se odebere
        odeber_oblast(id_oblast);
        
    }

}


/**
 *	Odebere oblast z výběru
 *	id_oblast - id oblasti, která se má odebrat 
 */
function odeber_oblast(id_oblast) {

    $("#posledni_cast").html("");

    $("#vybrana_" + id_oblast).detach();
    $("#hlaska_oblast").html("<span class='red'>Oblast byla z výběru odebrána</span>");

    //odznaceni checkboxu v seznamu oblasti
    var oblast_chb = $('input:checkbox[id=' + id_oblast + ']');
    oblast_chb.attr('checked', false);
    oblast_chb.checkboxradio('refresh');

    

    var pocet = $("div.oblast").length;

    if (pocet == 0) {
        $("#popis_oblasti").hide();
    }
}
/**
 *	Odstraní zobrazenou hlášku
 */
function oblast_odstran_hlasku() {
    $("#hlaska_oblast").html("");
}

/**
 *	Odstraní zobrazenou hlášku
 */
//function klicove_slovo_odstran_hlasku() {
//    $("#hlaska_klicove_slovo").html("");
//}



