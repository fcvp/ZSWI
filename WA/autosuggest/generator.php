<?php

//Naseptavac - nacteni slov
session_start();

$_GET["typ"] = $_SESSION['typ'];
$_GET["forma"] =  $_SESSION['forma'];
require_once($_SERVER['DOCUMENT_ROOT']."/app_code/config.php"); 


$input = strtolower( $_GET['input'] );
$len = strlen($input);
$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 0;


header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header ("Pragma: no-cache"); // HTTP/1.0

$aResults = array();

$pocet=0;
foreach($result['KLICOVE_SLOVO'] as $row){

    $aResults[$pocet]["id"] =$row[0];
    $aResults[$pocet]["value"]=$row[1];
    $aResults[$pocet]["info"]=$row[3];
    $pocet++;
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