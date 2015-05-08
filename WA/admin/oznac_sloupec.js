$(document).ready(function()	{
	$(".table td").hover(function()	{
		var trida = $(this).attr("class");
		$(".table ."+trida).addClass("actual");
	},function()	{
		var trida = $(this).attr("class").split(" ");
		trida = trida[0];
		$(".table ."+trida).removeClass("actual");
	});
});