<?php

/**
 * graf_data.php
 * ---------
 * Priprava a vypocet dat pro zobrazeni.
 *
 * ------------
 * Vlozeno ve vizualizace.php
 *
 * ------------
 *   8.5.2015
 *   @version 1.0
 * */
 
//-----------------------------
// priprava dat
//-----------------------------
//zobrazena klicova slova s ulozenou hodnotou, ostatni s hodnotu = 0
$slova_s_hodnocenim = array();
$slova_s_hodnocenim = get_zobrazena_slova($_GET['id_klicova_slova'], $_GET['klicova_slova_hodnota'],  $result['OBOR_SLOVO']);
    
$slova_s_hodnocenim = multisort(2,3, $slova_s_hodnocenim,SORT_ASC );//seradi slova podle oboru a formy

   
//-----------------------------
// vypocet
//-----------------------------
$obory_s_procenty = array();
$obory_s_procenty = spocti_shodu($slova_s_hodnocenim);

//-----------------------------
// data - final
//-----------------------------
$min_zobrazeno = 0;
$pocet_nenulovych = 0;

/*VSECHNY OBORY - cast se zobrazi v grafu, cast v seznamu*/
$serazene_obory = array();

foreach($result['OBOR2'] as $key => $obor)
{

   $forma =   substr($obor[3], 0, 1);
   $procenta = $obory_s_procenty[normalize_str($forma." ".$obor[0])];

   $serazene_obory[$key] = $obor;
   $serazene_obory[$key][4] = $procenta;
   
   $min_zobrazeno += $procenta;
   
   if($procenta != 0 ){
     $pocet_nenulovych++;
   }
}
 //min. procenta, pro ktere se jeste zobrazi obor v grafu   
$min_zobrazeno = round(($min_zobrazeno/$pocet_nenulovych)/4,2);

/**
* Data pro graf: "Nazev oboru", "url", "popis", "forma", "%"
**/
$graf_data_final = array();
$graf_data_final = get_data_final($result['OBOR2'], $obory_s_procenty, $min_zobrazeno);

$pocet_obory_final = count($graf_data_final);



        
  ?>