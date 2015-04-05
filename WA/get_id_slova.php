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
		case "Matematika (není hlavní náplní oboru)": echo "1_Matematika"; break;
		case "Finanční matematika": echo "2_Matematika"; break;
		case "Pojistná matematika": echo "3_Matematika"; break;
		case "Statistika a pravděpodobnost": echo "4_Matematika"; break;
	}
	/* -------------------------------- */
?>