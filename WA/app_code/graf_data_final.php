
<?php
/** 
 * graf_data_final.php
 * ---------
 * Priprava dat pro zobrazeni.
 *
 * Spoji pole oboru s procenty. 
 * Pokud jsou vybrany obe formy, budou se vykreslovat 
 * obor jen jednou s popiskem: 'Prezenční, Kombinované'
 * 
 * ------------
 * Vlozeno ve vizualizace.php
 *
 * ------------
 *   5.5.2015
 *   @version 1.0
 * */


/** 
* Spoji pole oboru s procenty. 
* Pokud jsou vybrany obe formy, budou se vykreslovat 
* obory jen jednou s popiskem: 'Prezenční, Kombinované'
*
* @param array $obory_arr              pole s obory
* @param array $obory_procenta_arr     pole s procenty s klici ve forme "P nazev oboru" nebo "K nazev oboru"
* @param array $min_zobrazeno          minimalni pocet procent, pro ktere se bude obor jeste zobrazovat 
*
*  @return array pole s obory s procentualni shodou > $min_zobrazeno
*/
function get_data_final($obory_arr, $obory_procenta_arr, $min_zobrazeno){
    global $KOMBINOVANA_FORMA, $OBE_FORMY; 
  
    $i=0;
    
    foreach($obory_arr as $key => $obor)
    {
        $forma =   substr($obory_arr[$key][3], 0, 1);
        $procenta = $obory_procenta_arr[normalize_str($forma." ".$obor[0])];
        
        //pokud jsou vybrany obe formy studia
        if($obor[3] === $KOMBINOVANA_FORMA && strpos($_GET["forma"],'_')){
           continue;
        }
        
         
        if($procenta > $min_zobrazeno){
        
           $graf_data_final[$i] = $obor;
           $graf_data_final[$i][4] = $procenta;
           
           $je_kombinovane = $obory_procenta_arr[normalize_str("K ".$obor[0])];
           
           //pokud jsou vybrany obe formy studia
           if(strpos($_GET["forma"],'_') && $je_kombinovane!=null ){
              $graf_data_final[$i][3]=$OBE_FORMY;
           }
           
           $i++;
        }
    }
    
    $graf_data_final = multisort(1,4, $graf_data_final,SORT_DESC);//seradi slova podle oboru a procent
    
    return $graf_data_final;
}
?>