<?php

//Naseptavac - nacteni slov
session_start();

$_GET["typ"] = $_SESSION['typ'];
$_GET["forma"] =  $_SESSION['forma'];
require_once($_SERVER['DOCUMENT_ROOT']."/app_code/config.php"); 


$input = strtolower( $_GET['input'] );
$len = strlen($input);
$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 0;


//$aResults = array();        // pole klicovych slov a jejich kategorii   ID = id ktere bude vracet submit, VALUE = klicove slovo, INFO = hlavni kategorie (matematika,fyzika,...)

//$pocet=0;
//while ($zaznam=MySQL_Fetch_Array($vysledek))	{     

//    $aResults[$pocet]["id"]=$zaznam["ID_klicove_slovo"];
//    $aResults[$pocet]["value"]=$zaznam["Slovo"];
//    $aResults[$pocet]["info"]=$zaznam["Oblast_nazev"];
//    $pocet++;
//}



header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header ("Pragma: no-cache"); // HTTP/1.0

$aResults = array();

foreach($result['KLICOVE_SLOVO'] as $row){

    $aResults[0]["id"] =$row[0];
    $aResults[0]["value"]=$row[1];
    $aResults[0]["info"]=$row[3];
}



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