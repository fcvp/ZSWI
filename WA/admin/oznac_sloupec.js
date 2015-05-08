/**
 * Tento js soubor zajišťuje, že po najetí na buňku v tabulce se označí celý sloupec, ve kterém buňka je, aby tak byla zlepšena přehlednost v tabulce
 */ 
$(document).ready(function()	{
	$(".table td").hover(function()	{
		// získání atributu class buňky
		var trida = $(this).attr("class");
		// označení všech buněk se stejným atributem class
		$(".table ."+trida).addClass("actual");
	},function()	{
		// získání atributu class (první třídy)
		var trida = $(this).attr("class").split(" ");
		trida = trida[0];
		// odoznačení všech buněk se stejným atributem class
		$(".table ."+trida).removeClass("actual");
	});
});