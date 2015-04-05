<?php

/*
note:
this is just a static test version using a hard-coded countries array.
normally you would be populating the array out of a database

the returned xml has the following structure
<results>
	<rs>foo</rs>
	<rs>bar</rs>
</results>
*/

/// NASTAVENI DB
  DEFINE("SQL_HOST","");
  DEFINE("SQL_USERNAME","");
  DEFINE("SQL_PASSWORD","");
  DEFINE("SQL_DBNAME","");
	
	
	$input = strtolower( $_GET['input'] );
	$len = strlen($input);
	$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 0;
	
	
	$aResults = array();        // pole klicovych slov a jejich kategorii   ID = id ktere bude vracet submit, VALUE = klicove slovo, INFO = hlavni kategorie (matematika,fyzika,...)
		
      //SQL DOTAZ
 
      mysql_connect(SQL_HOST, SQL_USERNAME, SQL_PASSWORD);
      mysql_select_db(SQL_DBNAME);
      $vysledek=mysql_query("select ID_klicove_slovo, Slovo, Oblast_nazev from Klicove_slovo, Oblast where Klicove_slovo.ID_oblast=Oblast.ID_oblast");
      $pocet=0;
      while ($zaznam=MySQL_Fetch_Array($vysledek))	{        
        $aResults[$pocet]["id"]=$zaznam["ID_klicove_slovo"];
        $aResults[$pocet]["value"]=$zaznam["Slovo"];
        $aResults[$pocet]["info"]=$zaznam["Oblast_nazev"];
        $pocet++;
			}
 
    
	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
	header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header ("Pragma: no-cache"); // HTTP/1.0
	
	////// TADY PRIDAVAM POLE HODNOT
	
	//test data
	
	$aResults[0]["id"] = 1;
	$aResults[0]["value"]="Matematika (není hlavní náplní oboru)";
  $aResults[0]["info"]="Matematika";
  
  $aResults[1]["id"] = 2;
	$aResults[1]["value"]="Finanční matematika";
  $aResults[1]["info"]="Matematika";
  
  $aResults[2]["id"] = 3;
	$aResults[2]["value"]="Pojistná matematika";
  $aResults[2]["info"]="Matematika";
  
  $aResults[3]["id"] = 4;
	$aResults[3]["value"]="Statistika a pravděpodobnost";
  $aResults[3]["info"]="Matematika";
	
	header("Content-Type: application/json");

	echo "{\"results\": [";
	$arr = array();
  $pocetslov=count($aResults);
	for ($i=0;$i<$pocetslov;$i++)
	{
		$arr[] = "{\"id\": \"".$aResults[$i]['id']."\", \"value\": \"".$aResults[$i]['value']."\", \"info\": \"".$aResults[$i]['info']."\"}";
	}
	echo implode(", ", $arr);
	echo "]}";
?>