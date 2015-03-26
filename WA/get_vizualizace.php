<?php
	$vars = $_GET["vars"];
	$pole = split("&", $vars);
	
	/** Vyparsovani jednotlivych promenych a jejich hodnot */
	$i=0;
	foreach ($pole as $p)	{
		$hodnoty[$i] = split("=", $p);
		$i++;
	}
	/*
	// Kontrolni vypis
	foreach ($hodnoty as $hodnota)	{
		echo $hodnota[0]." = ".$hodnota[1]."<br />";
	}
	*/
?>

<div id="vizualizace">
	<div class='menu'>
		<span class='bold'>Zobrazení</span><span class='graf paprskovy actual'>Paprskový graf</span><span class='graf kruhovy'>Kruhový graf</span>
	</div>
      <img src="image/graf_paprskovy.png" id="paprskovy" alt="graf" style="width:700px" />
<img src="image/graf3.bmp" id="kruhovy" alt="graf" style="width:550px" />           
</div>
<div class="socialShare" >
   <a href="https://www.facebook.com/share.php" target="_blank" class="btn facebook">Sdílet na Facebooku</a>
   <a href="https://twitter.com/share?url=#" target="_blank" class="btn twitter">Odeslat na Twitter</a>
   <a href="https://plus.google.com/share?url=#" target="_blank" class="btn googlePlus">Sdílet na Google+</a>
</div>
  
<br>
<br>

<h2>Ostatní obory: </h2>
<ul>
    <li><a href="#">Matematika a finační studie</a></li>
    <li><a href="#">Finanční informatika a statistika</a></li>
    <li><a href="#">Matematika a její aplikace</a></li>
    <li><a href="#">Systeémy pro indefikaci, bezpečnost a komunikaci</a></li>
    <li><a href="#">Informační systémy</a></li>
    <li><a href="#">Výpočetní technika</a></li>
    <li><a href="#">Počítačová grafika a výpočetní systémy</a></li>


</ul>

<script>
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
</script>