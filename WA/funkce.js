
$(document).ready(function()	{
	$("#vizualizace .menu .graf").click(function()	{
		if (!$(this).is(".actual"))	{
			if ($(this).is(".kruhovy"))	{
				$("#vizualizace .menu .graf").removeClass("actual");
				$("#paprskovy").hide();
				$("#kruhovy").show();
				$(this).addClass("actual");
			}
			else	{
				$("#vizualizace .menu .graf").removeClass("actual");
				$("#kruhovy").hide();
				$("#paprskovy").show();
				$(this).addClass("actual");
			}
		}
	});
});

function pridat_do_vyberu()	{
	var hodnota = $("#zvolena_oblast").val();
	
	if (hodnota!=0)	{
		$.ajax({
			url: "get_oblast.html",
			data: { oblast: hodnota },
			cache: false,
			error: function(XMLHttpRequest, textStatus, errorThrown)	{
				alert("chyba pri nacitani.");
			}
		}).done(function(html)	{
				$("#oblasti").prepend(html);
				$("#hlaska_oblast").html("Oblast byla přidána do výběru.");
			});
	}
}
