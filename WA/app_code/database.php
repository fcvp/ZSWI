<?php
/**
 * Pripojeni k databazi a priprava dotazu
 * 
 * */

try {
    /*persistent connection - spojeni neni po skonceni skriptu uzavreno - lze ho sdilet ve vice skriptech*/
    $dbh = new PDO('mysql:host=localhost;dbname=zswi;charset=utf8', 'root', 'heslo', array(PDO::ATTR_PERSISTENT => true));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>";
    die();
}

//----------------

require_once(APP_CODE."remove_diacritic.php");
require_once(APP_CODE."select.php");
//----------------

$result['FORMA'] = select($dbh,"*", "forma_studia",null,"id_forma");
$result['TYP'] = select($dbh,"*", "typ_studia",null,"id_typ");

//---------------------
//seznam oblasti filtrovany podle formy a typu
if (($_GET["forma"]!=null) and ($_GET["typ"]!=null )){
    $from ="oblast JOIN
              klicove_slovo ON oblast.ID_oblast = klicove_slovo.ID_oblast JOIN
              obor_slovo ON klicove_slovo.ID_klicove_slovo = obor_slovo.ID_klicove_slovo JOIN
              obor ON obor_slovo.ID_obor = obor.ID_obor  JOIN
              typ_studia ON obor.ID_typ = typ_studia.ID_typ  JOIN
              forma_studia ON obor.ID_forma = forma_studia.ID_forma";

    $typ = $_GET["typ"];
    $forma = $_GET["forma"];
    
  
    if (strpos($forma,'_')) {
        //jsou vybrany obe formy studia
        $where = "typ_nazev='".$typ."'";
    } else{
        $where = "typ_nazev='".$typ."' AND forma_nazev='".$forma."'";
    }
    $result['OBLAST'] = select($dbh,"DISTINCT oblast.*",$from, $where,"oblast_nazev");
    //---------------------
    
    //seznam klicovych slov
    $result['KLICOVE_SLOVO'] = select($dbh,"DISTINCT klicove_slovo.id_klicove_slovo, Slovo, oblast.id_oblast, oblast_nazev",$from, $where,"klicove_slovo.id_oblast");
 
    //---------------------
    
    //seznam oboru
    $from = $from." JOIN priorita ON obor_slovo.ID_priorita = priorita.ID_priorita";
    $where = $where." AND  (priorita.Hodnota >= 0.5)";
    
    $result['OBOR'] = select($dbh,"DISTINCT obor_nazev, url, popis, oblast_nazev ",$from, $where,"obor_nazev");
    //---------------------
}    




?>