function pridatDoVyberu()	{	
	var hodnota = $("#zvolena_oblast").val();
	/** zjisti zda uz oblast neni ve vyberu */
	if ($("#oblast_"+hodnota).length == 0)	{
		if (hodnota!=0)	{
			$("#posledni_cast").html("");
			$("#hlaska_oblast").html("<img src='loading.gif' alt='' />");
			$.ajax({
				url: "get_oblast.php",
				data: { oblast: hodnota },
				cache: false,
				error: function(XMLHttpRequest, textStatus, errorThrown)	{
					$("#hlaska_oblast").html("<span class='red'>Při načítání došlo k chybě</span>");
				}
			}).done(function(html)	{
				if ($("#popis_oblasti").is(":hidden"))	{
					$("#popis_oblasti").show();
					$("#submit_oblasti").show();
				}
					$("#oblasti").prepend(html);
					$("#hlaska_oblast").html("Oblast byla přidána do výběru.");
				});
		}
	}
	else	{
		$("#hlaska_oblast").html("<span class='red'>Oblast již je ve výběru</span>");
	}
}

function zobrazCast1()	{
	var forma = $("#forma_studia").val();
	var typ = $("#typ_studia").val();
	// Pro zjištění zda už je první část zobrazena
	var zobrazeno = $("#zobrazeni_prvni_casti").val();
		
	if (zobrazeno == "1" || (forma != 0 && typ != 0))	{
		$("#zobrazeni_prvni_casti").val("1");
		$("#loading").fadeIn().queue(function(n) {
			$.ajax({
				url: "get_cast1.php",
				data: { forma: forma, typ: typ },
				cache: false,
				error: function(XMLHttpRequest, textStatus, errorThrown)	{
					alert("chyba pri nacitani.");
				}
			}).done(function(html)	{
					$("#cast1").html(html);
			});
			
			n();
		}).queue(function(n)	{
			$("#loading").fadeOut();
			n();
		});
	}
}

function zobrazVizualizaci()	{
		var str = $( "form" ).serialize();
		
		
		$("#loading").fadeIn().queue(function(n) {
			$.ajax({
				url: "get_vizualizace.php",
				data: { vars: str },
				cache: false,
				error: function(XMLHttpRequest, textStatus, errorThrown)	{
					alert("chyba pri nacitani.");
				}
			}).done(function(html)	{
					$("#posledni_cast").html(html);
			});
			
			n();
		}).queue(function(n)	{
			$("#loading").fadeOut();
			n();
		});
}

function odeberOblast(idOblasti)	{
	$("#posledni_cast").html("");
	$("#"+idOblasti).detach();
	$("#hlaska_oblast").html("<span class='red'>Oblast byla z výběru odebrána</span>");
	
	var pocet = $("div.oblast").length;

	if (pocet==0)	{
		$("#popis_oblasti").hide();
		$("#submit_oblasti").hide();
	}
}
