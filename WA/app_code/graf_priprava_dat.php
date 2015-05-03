<?php
/**
 * get_zobrazena_slova.php
 * ---------
 * Vyber zobrazenych klicovych slov.
 * 
 * ------------
 * Vlozeno ve vizualizace.php
 *
 * ------------
 *   20.4.2014
 *   @version 1.0
 * */


/**
*  Vyfiltruje, ze slov nactenych z databaze,
*  jenom ta klicova slova ktera jsou vybrana uzivatelem.
*   
*   @param $id_slova_arr pole identifikatoru zobrazenych klicovych slov
*   @param $klicova_slova_arr klicova slova nactena z databaze 
*
*   @return pole se zobrazenymi klicovymi slovy
*/
function get_zobrazena_slova($id_slova_arr, $klicova_slova_arr)
{
    sort($id_slova_arr);
 
    $zobrazena_slova = array();
    $delka = count($klicova_slova_arr);
  //  $delka_radek = count($result_obor_slovo[0]);
   
    $k=0;
    for($j=0; $j<$delka;$j++)
    {        
            if($id_slova_arr[$k] === $klicova_slova_arr[$j][0] )
            {
                $zobrazena_slova[$k] = $klicova_slova_arr[$j];
                $k++;
            }
    }
    
    return $zobrazena_slova;
    
}

/**
* Seradi pole podle zvoleneho klice
* @param klic - cislo sloupce, podle ktereho se bude radit
* @param pole - razene vicerozmerne pole
*/
function multisort($klic, $pole )
{
   foreach ($pole as $key => $row) {
        $sloupec[$key] = $row[$klic];
   }
    
   array_multisort($sloupec, SORT_DESC, $pole);
   
   return  $pole;
}


?>