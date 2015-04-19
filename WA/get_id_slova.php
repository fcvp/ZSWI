<?php
	/*
		$klicove_slovo = mysql_real_escape_string($_GET["slovo"]);
		$vysledek = mysql_query("select id ...");
		if (mysql_num_rows($vysledek))	{
			echo mysql_result($vysledek, 0);
		}
		else	{
			echo "0";
		}
	*/
	
	/* ---test data - idSlova_idOblasti- */
	switch ($_GET["slovo"])	{
		case "Slovo 1": echo "1_Matematika"; break;
		case "Slovo 2": echo "2_Matematika"; break;
		case "Slovo 3": echo "3_Matematika"; break;
		case "Slovo 4": echo "4_Matematika"; break;
	}
	/* -------------------------------- */
?>