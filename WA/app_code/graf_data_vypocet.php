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
* @param $slova_s_hodnocenim pole s obory a jejich klicovymi slovy
*
* @return pole se souctem priorit, klicem jsou øetìzce "P název oboru" nebo "K název oboru"
*/
function spocti_zaklad($slova_s_hodnocenim)
{
    $delka = count($slova_s_hodnocenim);
    $delka_radek = count($slova_s_hodnocenim[0]);
    $zaklad_obory = array();
   
    $soucet = 0;
    $k=0;
    
    //zaklad = soucty priorit jednotlivych oboru
    for($j = 1; $j <= $delka; $j++)
    {
       if($j<$delka){
          $nazev_i1 = $slova_s_hodnocenim[$j][2];
       }
       else
       {
          $nazev_i1="";
       }
       
        $forma_i0 = substr($slova_s_hodnocenim[$j-1][3], 0, 1);
        $nazev_i0 = $slova_s_hodnocenim[$j-1][2];
        $soucet += $slova_s_hodnocenim[$j-1][4];  

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

* @param $slova_s_hodnocenim pole s obory a jejich klicovymi slovy
*
* @return pole se souctem výrazu (hodnota * priorita), klicem jsou øetìzce "P název oboru" nebo "K název oboru" (s pouzitym normalize_str())
*/
function spocti_cast($slova_s_hodnocenim)
{
    $delka = count($slova_s_hodnocenim);
    $delka_radek = count($slova_s_hodnocenim[0]);
    
    $cast = array();
    $soucet = 0;
        
    $k=0;
    
    //cast = hodnota * priorita
    for($j = 1; $j <= $delka; $j++)
    {
       if($j<$delka){
           $nazev_i1 = $slova_s_hodnocenim[$j][2];
       }
       else
       {
          $nazev_i1="";
       }
    
        $forma_i0 = substr($slova_s_hodnocenim[$j-1][3], 0, 1);
        $nazev_i0 = $slova_s_hodnocenim[$j-1][2];
        
        $priorita = $slova_s_hodnocenim[$j-1][4];
        $hodnota = $slova_s_hodnocenim[$j-1][5];

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