/**
* Aplikovani hodnoceni oblasti na klicova slova
*/
$(document).ready(function () {
    var nazev = $("#oblast_nazev").val();

    $('#btn_aplikovat_' + nazev).on("click", function () {
        //vybrane hodnoceni oblasti
        var oblast_rd = $('input:radio[name=' + nazev + ']');
        var oznaceno = parseInt(oblast_rd.filter(':checked').val());

        var slova_pocet = $(this).data('pocet');

        //------------------
        //aplikovani hodnoceni na klicova slova
        for (i = 0; i < slova_pocet; i++) {
            slovo_jmeno = nazev + "_" + i;

            var slova_rd = $('input:radio[name=' + slovo_jmeno + ']');
            slova_rd.filter("[value=" + oznaceno + "]").prop('checked', true);
        }
    });
});