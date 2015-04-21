/**
 *	Zobrazí formulář
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
                $("#submit_oblasti").show();
            });

            n();
        }).queue(function (n) {
            $("#loading").fadeOut();
            n();
        });
    }
}