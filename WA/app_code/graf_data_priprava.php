<?php
/**
 * graf_data_priprava.php
 * ---------
 * Vyber zobrazenych klicovych slov.
 * 
 * ------------
 * Vlozeno ve vizualizace.php
 *
 * ------------
 *   5.5.2015
 *   @version 1.0
 * */


/**
* Prida do pole s klicovymi slovy hodnoceni uzivatele
*   
*   @param $id_slova_arr pole identifikatoru zobrazenych klicovych slov
*   @param $slova_hodnoceni_arr pole hodnoceni jednotlivych slov uzivatelem
*   @param $klicova_slova_arr klicova slova nactena z databaze 
*
*   @return pole s klicovymi slovy s hodnocenim uzivatele
*/
function get_zobrazena_slova($id_slova_arr, $slova_hodnoceni_arr, $klicova_slova_arr)
{
    sort($id_slova_arr);
 
 
    $zobrazena_slova = array();
    $delka = count($klicova_slova_arr);
    $delka_radek = count($klicova_slova_arr[0]);
    
    $shoda[0]=false;
    $shoda[1]=false;

   
    $k=0;
    $j = 0;
    //for($j = 0; $j < $delka; $j++)
    while($j < $delka)
    {       //pokud se id zobrazeneho rovna id slova nacteneho z databaze
    
            if($id_slova_arr[$k] === $klicova_slova_arr[$j][0])
            {
                 $shoda[0]=true;
                 $shoda[1]=false;
                 
                 $zobrazena_slova[$j] = $klicova_slova_arr[$j];
                 //jako posledni sloupec pridame hodnoceni slova uzivatelem
                 $zobrazena_slova[$j][$delka_radek] = $slova_hodnoceni_arr[$k];
            }
            else if($id_slova_arr[$k] !== $klicova_slova_arr[$j][0])
            {
                if($shoda[0] == true){
                   $shoda[1]=true;
                }
                $zobrazena_slova[$j] = $klicova_slova_arr[$j];
                //hodnoceni uzivatele = 0
                $zobrazena_slova[$j][$delka_radek] = 0;
            }
            
            
            //doslo k prechodu "id1 id1" na "id1 id2" ($id_slova_arr[$k]!=$klicova_slova_arr[$j][0])
            if($shoda[0] == true && $shoda[1] == true)
            {//posuneme se na dalsi radek $id_slova_arr[]
               $k++;
               $shoda[0]=false;
               $shoda[1]=false;
               
            }else
            {//dalsi radek $klicova_slova_arr[]
                $j++;
            }
    }

    return $zobrazena_slova;
    
}


/**
* Seradi pole podle zvoleneho klice
* @param klic - cislo sloupce, podle ktereho se bude radit
* @param klic2 - cislo sloupce, podle ktereho se bude radit
* @param pole - razene vicerozmerne pole
*
* @return serazene pole
*/
function multisort($klic, $klic2, $pole, $sort )
{
   foreach ($pole as $key => $row) {
        $sloupec2[$key] = $row[$klic2];
        $sloupec[$key] = $row[$klic];
   }
    
   array_multisort($sloupec2, $sort, $sloupec, $sort, $pole);
   
   return  $pole;
}


?>