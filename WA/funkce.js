
/**
 * Přidá oblast do výběru
 * hodnota - Označní oblasti
 * id_slova - ID klíčového termínu, kterému se má nastavit hodnota 5   
 **/ 
function pridatDoVyberu(hodnota, id_slova)	{	
	/** zjisti zda uz oblast neni ve vyberu */
	if ($("#oblast_"+hodnota).length == 0)	{
		if (hodnota!=0)	{
			$("#posledni_cast").html("");
			$("#hlaska_oblast").html("<img src='image/loading.gif' alt='' />");
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
					
					if (id_slova!="") nastavSlovo(id_slova);
				});
		}
	}
	else	{
		$("#hlaska_oblast").html("<span class='red'>Oblast již je ve výběru</span>");
	}
}

/**
 *	Přidá klíčový termín do výberu (s celou jeho oblastí) a nastaví mu hodnotu 5
 *	klicove_slovo - klíčový termín, který se má přidat do výberu 
 */ 
function pridejKlicoveSlovo(klicove_slovo)	{
	var id = "0";
	$.ajax({
		url: "get_id_slova.php",
		data: { slovo: klicove_slovo },
		cache: false,
		error: function(XMLHttpRequest, textStatus, errorThrown)	{
			$("#hlaska_klicove_slovo").html("<span class='red'>Při načítání došlo k chybě</span>");
		}
	}).done(function(html)	{
		id = html;
		
		if (id=="0")	{
			$("#hlaska_klicove_slovo").html("<span class='red'>Zadaný klíčový termín nebyl nalezen</span>");
		}
		else	{
			var split = id.split("_");
			
			var oblast = split[1];
			var id_slova = split[0];
			
			if ($("#klicovy_termin_"+id_slova).length == 0)	{
				pridatDoVyberu(oblast, id_slova);
			}
			else	{
				nastavSlovo(id_slova)
			}
						
			$("#hlaska_klicove_slovo").html("Priorita u zadaného klíčového termínu byla nastavena na \"ano\"");
		}
	});
}

/**
 *	Nastaví klíčovému termínu hodnotu 5
 *	id_slova - id klíčového termínu
 */  
function nastavSlovo(id_slova)	{
	var policka = $('input:radio[name=klicovy_termin_'+id_slova+']');
	policka.filter('[value=5]').prop('checked', true);
}

/**
 *	Zobrazí 1. část formuláře
 *	
 */  
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

/**
 *	Zobrazí výslednou vizualizaci
 *	 
 */
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

/**
 *	Odebere oblast z výběru
 *	idOblasti - id oblasti, která se má odebrat 
 */ 
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
/**
 *	Odstraní zobrazenou hlášku
 */ 
function oblast_odstran_hlasku()	{
  $("#hlaska_oblast").html("");
}

/**
 *	Odstraní zobrazenou hlášku
 */ 
function klicovy_termin_odstran_hlasku()	{
  $("#hlaska_klicove_slovo").html("");
}