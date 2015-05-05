<?php
/**
 * graf_data_vypocet.php
 * ---------
 * Vypocet procentualni shody pro jednotlive obory
 * 
 * ------------
 * Vlozeno ve vizualizace.php
 *
 * ------------
 *   3.5.2015
 *   @version 1.0
 * */


/**
* Spocte procentualni shodu vybranych klicovych slov se slovy v databazi pro kazdy obor

* @param $slova_s_hodnocenim pole klicovych slov s ohodnocenim serazene podle nazvu oboru

* @return pole s procentualni shodou, klicem jsou øetìzce "P název oboru" nebo "K název oboru" (s pouzitym normalize_str())
*/
function spocti_shodu($slova_s_hodnocenim){
    $zaklad_obory = spocti_zaklad($slova_s_hodnocenim);
    $cast_obory = spocti_cast($slova_s_hodnocenim);
    
    
    $procenta = array();
    foreach($cast_obory as $key => $cast) 
    {
        $key = normalize_str($key);
        $procenta[$key] = ($cast / $zaklad_obory[$key]) * 100;
    }

    return $procenta; 
}


/**
* Udela vypocet "zakladu": soucet priorit pro jednotlive obory
* @param $serazene_obory_arr pole s obory a jejich klicovymi slovy
*
* @return pole se souctem priorit, klicem jsou øetìzce "P název oboru" nebo "K název oboru"
*/
function spocti_zaklad($serazene_obory_arr)
{
    $delka = count($serazene_obory_arr);
    $delka_radek = count($serazene_obory_arr[0]);
    $zaklad_obory = array();
   
    $soucet = 0;
    $k=0;
    
    //zaklad = soucty priorit jednotlivych oboru
    for($j = 1; $j <= $delka; $j++)
    {
       if($j<$delka){
          $nazev_i1 = $serazene_obory_arr[$j][2];
       }
       else
       {
          $nazev_i1="";
       }
       
        $forma_i0 = substr($serazene_obory_arr[$j-1][$delka_radek-3], 0, 1);
        $nazev_i0 = $serazene_obory_arr[$j-1][2];
        
        $soucet += $serazene_obory_arr[$j-1][$delka_radek-2];  

        if(normalize_str($nazev_i1) !== normalize_str($nazev_i0))
        {
            $zaklad_obory[normalize_str($forma_i0." ".$nazev_i0)] = $soucet;
            $soucet = 0;
        }
        
    }

    return $zaklad_obory;

}


/**
* Udela vypocet "casti": soucet vyrazu (hodnota * priorita) pro jednotlive obory

* @param $serazene_obory_arr pole s obory a jejich klicovymi slovy
*
* @return pole se souctem výrazu (hodnota * priorita), klicem jsou øetìzce "P název oboru" nebo "K název oboru" (s pouzitym normalize_str())
*/
function spocti_cast($serazene_obory_arr)
{
    $delka = count($serazene_obory_arr);
    $delka_radek = count($serazene_obory_arr[0]);
    
    $cast = array();
    $soucet = 0;
        
   
    $k=0;
    
    //cast = hodnota * priorita
    for($j = 1; $j <= $delka; $j++)
    {
       if($j<$delka){
           $nazev_i1 = $serazene_obory_arr[$j][2];
       }
       else
       {
          $nazev_i1="";
       }
    
        $forma_i0 = substr($serazene_obory_arr[$j-1][$delka_radek-3], 0, 1);
        $nazev_i0 = $serazene_obory_arr[$j-1][2];
        
        $priorita = $serazene_obory_arr[$j-1][$delka_radek-2];
        $hodnota_0 = $serazene_obory_arr[$j-1][$delka_radek-1];
        
        //hodnoceni 1 az 5 na 0 az 1= (((1 az 5) - 1) / 4)
        if($hodnota_0 > 0){
            $hodnota = ($hodnota_0-1)/4.0;
        }else{
            $hodnota = 0;
        }
        
        $soucet += ($priorita*$hodnota);
        
        if(normalize_str($nazev_i1) !== normalize_str($nazev_i0))
        {
            $cast[normalize_str($forma_i0." ".$nazev_i0)] = $soucet;
            $soucet = 0;
        }
        
    }
    
    return $cast;

}

?>