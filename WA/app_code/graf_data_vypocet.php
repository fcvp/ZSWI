<?php
/**   
 * graf_data_vypocet.php
 * ---------
 * Vypocet procentualni shody pro jednotlive obory 
 *
 * Výpočet:
 * 
 * Hodnocení uživatele je chapano jako: 0 - 100% z priority zadane u slova
 * př.: Hodnoceni = 0.5, Priorita = 1 => 50% z 1 = 0.5
 * 
 * zaklad = suma 1..n [priorit vsech klicovych slov oboru]
 * cast = suma 1..m [(priorita * hodnoceni) pro vybrana slova prislusici oboru]
 * 
 * % = (cast / zaklad) * 100
 * 
 * v grafu se zobrazi jen obory se shodou >= průměr/4
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

* @param array $slova_s_hodnocenim_arr      pole klicovych slov s ohodnocenim serazene podle nazvu oboru

* @return array   pole s procentualni shodou, klicem jsou retezce "P nazev oboru" nebo "K nazev oboru" (s pouzitym normalize_str())
*/
function spocti_shodu($slova_s_hodnocenim_arr){
    $zaklad_obory = spocti_zaklad($slova_s_hodnocenim_arr);
    $cast_obory = spocti_cast($slova_s_hodnocenim_arr);
    
    $procenta = array();
    foreach($cast_obory as $key => $cast) 
    {
        $key = normalize_str($key);
        $procenta[$key] = ($cast / $zaklad_obory[$key]) * 100;
    }
    
    return $procenta; 
}


/**
* Udela vypocet "zakladu": soucet priorit klicovych slov pro jednotlive obory
* @param array $slova_s_hodnocenim_arr      pole s obory a jejich klicovymi slovy
*
* @return array     pole se souctem priorit, klicem jsou retezce "P_nazev_oboru" nebo "K_nazev_oboru" (s pouzitym normalize_str())
*/
function spocti_zaklad($slova_s_hodnocenim_arr)
{
    $delka = count($slova_s_hodnocenim_arr);
    $delka_radek = count($slova_s_hodnocenim_arr[0]);
    $zaklad_obory = array();
   
    $soucet = 0;
    $k=0;
    
    //zaklad = soucty priorit jednotlivych oboru
    for($j = 1; $j <= $delka; $j++)
    {
       if($j<$delka){
          $nazev_i1 = $slova_s_hodnocenim_arr[$j][2];
       }
       else
       {
          $nazev_i1="";
       }
       
        $forma_i0 = substr($slova_s_hodnocenim_arr[$j-1][3], 0, 1);
        $nazev_i0 = $slova_s_hodnocenim_arr[$j-1][2];
        
        $priorita = $slova_s_hodnocenim_arr[$j-1][4];

        $soucet += $priorita;  

        if(normalize_str($nazev_i1) !== normalize_str($nazev_i0))
        {
            $zaklad_obory[normalize_str($forma_i0." ".$nazev_i0)] = $soucet;
            $soucet = 0;
        }
        
    }

    return $zaklad_obory;

}


/**
* Udela vypocet "casti": soucet vyrazu (hodnota * priorita) klicovych slov pro jednotlive obory

* @param array $slova_s_hodnocenim_arr     pole s obory a jejich klicovymi slovy
*
* @return array    pole se sumou vyrazu (hodnota * priorita) pro vsechny obory,
*                  klicem jsou retezce "P_nazev_oboru" nebo "K_nazev_oboru" (s pouzitym normalize_str())
*/
function spocti_cast($slova_s_hodnocenim_arr)
{
    $delka = count($slova_s_hodnocenim_arr);
    $delka_radek = count($slova_s_hodnocenim_arr[0]);
    
    $cast = array();
    $soucet = 0;
        
    $k=0;
    
    //cast = hodnota * priorita
    for($j = 1; $j <= $delka; $j++)
    {
       if($j<$delka){
           $nazev_i1 = $slova_s_hodnocenim_arr[$j][2];
       }
       else
       {
          $nazev_i1="";
       }
    
        $forma_i0 = substr($slova_s_hodnocenim_arr[$j-1][3], 0, 1);
        $nazev_i0 = $slova_s_hodnocenim_arr[$j-1][2];
        
        $priorita = $slova_s_hodnocenim_arr[$j-1][4];
        $hodnota = $slova_s_hodnocenim_arr[$j-1][5];

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