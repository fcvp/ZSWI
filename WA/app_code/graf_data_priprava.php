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
    $hodnoceni = sluc_pole($id_slova_arr, $slova_hodnoceni_arr);
    $hodnoceni = multisort(0, 0, $hodnoceni, SORT_ASC);
   
    sort($id_slova_arr);
 
 
    $zobrazena_slova = array();
    $delka = count($klicova_slova_arr);
    
    
    $zobrazena_slova = $klicova_slova_arr;
    $delka_radek = count($zobrazena_slova[0]);
   // echo $delka_radek;
    $shoda[0]=false;
    $shoda[1]=false;
    
    //inicializace hodnoceni na nula
    foreach($zobrazena_slova as $key => $ks)
    {
       $zobrazena_slova[$key][$delka_radek] = 0;
    }
   
    $k = 0;
    $j = 0;
    //for($j = 0; $j < $delka; $j++)
    while($j < $delka)
    {       //pokud se id zobrazeneho rovna id slova nacteneho z databaze
    
            if($hodnoceni[$k][0] === $klicova_slova_arr[$j][0])
            {
                 $shoda[0]=true;
                 $shoda[1]=false;
                 
                 //jako posledni sloupec pridame hodnoceni slova uzivatelem
                 $zobrazena_slova[$j][$delka_radek] = ($hodnoceni[$k][1]-1)/4;
            }
            else if($hodnoceni[$k][0] !== $klicova_slova_arr[$j][0])
            {
                if($shoda[0] == true){
                   $shoda[1]=true;
                }
            }
            
            
            //doslo k prechodu "id1 id1" na "id1 id2" ($id_slova_arr[$k]!=$klicova_slova_arr[$j][0])
            if($shoda[0] == true && $shoda[1] == true)
            {//posuneme se na dalsi radek $hodnoceni[]
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

/**
 * Spoji dv sloupce do jednoho pole
 * @param $arr1 pole s 1 sloupcem
 * @param $arr2 pole s 1 sloupcem
 *
 * @return sloucene pole se 2 sloupci
 */
 function sluc_pole($arr1, $arr2)
 {
    $arr = array();
    for($i = 0; $i < count($arr1); $i++)
    {
      $arr[$i][0] = $arr1[$i];   
      $arr[$i][1] = $arr2[$i];
    }
    
    return $arr;
 }


?>