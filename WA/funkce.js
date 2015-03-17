
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
			});
	}
}
