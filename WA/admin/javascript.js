/**
 * JS soubor pro usnadnění práce v administrace
 */ 

/**
 * Pokud na stránce existuje input[name='zvyrazni'], metoda získá jeho hodnotu, vyparsuje jednotlivá ID tabulek, která se mají označit a těm přidá class='chyba' -> (tabulka se označí červeně)
 */ 
$(document).ready(function()	{
	if ($("input[name='zvyrazni']").length==1)	{
		var chybnePolozky = "";
		var tmp = $("input[name='zvyrazni']").val().split("-");
		var idPolozky;
		for (idPolozky in tmp)	{
			$("#tabulka_"+tmp[idPolozky]).addClass("chyba");
		}
	}
	
});

/**
 * Odešle formulář pro editaci záznamů
 */ 
function edituj()	{
	document.forms['formular'].submit();
}

/**
 * Odešle formulář pro přidání záznamu
 */ 
function pridej()	{
	document.forms['formular'].submit();
}

/**
 * Zaškrtne všechny checkboxy v tabulce s daným ID
 * 
 * @param String idTabulky ID tabulky  
 */ 
function vyberVse(idTabulky)	{
	$("#"+idTabulky+" input[type='checkbox']").each(function() {
    $(this).prop("checked", true);
	});
}

/**
 * Zobrazí/Skryje klíčová slova v daném řádku
 * 
 * @param String idRadku ID řádku
 */ 
function zobrazKlicovaSlova(idRadku)	{
	if ($("#"+idRadku).is(":hidden"))	{
		$("#"+idRadku).show();
	}
	else	{
		$("#"+idRadku).hide();
	}
}

/**
 * Zobrazí dotaz, zda si uživatel opravdu přeje smazat označené záznamy a pokud ano, vloží do skrytého inputu jejich ID oddělené pomlčkou a odešle formulář
 * 
 * @param String typ typ, který určuje, jaké záznamy se snažíme smazat (Oblasti, Formy studia, ...)  
 */ 
function smazSeznam(typ)	{
	var pocetVybranych = $("input[name*='radek_']:checked").length; 
	if (pocetVybranych==0)	{
		alert("Nebyly vybrány žádné položky ke smazání");
	}
	else	{
		var upozorneni = "";
		switch (typ)	{
			case "formy":
				upozorneni = "Smažou se při tom i všechny obory, které do dané formy studia patří.";
				break;
			case "typy":
				upozorneni = "Smažou se při tom i všechny obory, které do daného typu studia patří.";
				break;
			case "oblasti":
				upozorneni = "Smažou se při tom i všechna klíčová slova, která do dané oblasti patří.";
				break;				
		}
		
		var smazat = confirm("Opravdu chcete smazat označené položky?\n"+upozorneni);
		if (smazat)	{
			var vybranePolozky="";
			$("input[name*='radek_']:checked").each(function() {
			    var tmp = $(this).attr("name").split("_");
					vybranePolozky += (vybranePolozky=="" ? "" : "-")+tmp[1];
			});
			$("#delete").val(1);
			$("#delete_polozky").val(vybranePolozky);
			document.forms['formular'].submit();
		}
	}
}

/**
 * Do skrytého inputu vloží ID editovaných položek a odešle formulář
 */ 
function editujSeznam()	{
	var pocetVybranych = $("input[name*='radek_']:checked").length; 
	if(pocetVybranych==0)	{
		alert("Nebyly vybrány žádné položky k editaci");
	}
	else	{
		var vybranePolozky="";
		$("input[name*='radek_']:checked").each(function() {
		    var tmp = $(this).attr("name").split("_");
				vybranePolozky += (vybranePolozky=="" ? "" : "-")+tmp[1];
		});
		$("#edit").val(1);
		$("#edit_polozky").val(vybranePolozky);
		document.forms['formular'].submit();
	}
}