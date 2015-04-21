//zobrazi graf ve vybrane zalozce
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
