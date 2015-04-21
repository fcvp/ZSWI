<?php

session_start();

$_GET["typ"] = $_SESSION['typ'];
$_GET["forma"] =  $_SESSION['forma'];
require_once($_SERVER['DOCUMENT_ROOT']."/app_code/config.php"); 


$slovo = "0";
foreach ($result['KLICOVE_SLOVO'] as $row) {
    if($row[1]==$_GET["slovo"])
    {
        $slovo = $row[0]."-".$row[3];
        break;
    }
}

echo $slovo;

/* ---test data - idSlova_idOblasti- */
//switch ($_GET["slovo"])	{
//    case "Slovo 1": echo "1_Matematika"; break;
//    case "Slovo 2": echo "2_Matematika"; break;
//    case "Slovo 3": echo "3_Matematika"; break;
//    case "Slovo 4": echo "4_Matematika"; break;
//}
/* -------------------------------- */
?>