<!--
 * vizualizace.php
 * ---------
 * Zobrazeni grafu a seznamu oboru.
 * 
 * ------------
 * Vlozeno v zobrazit_vizualizaci.js
 *
 * ------------
 *   20.4.2015
 *   @version 1.0
 * 
-->
<h2 style="text-align: left" id="vizualizace_nadpis">Vizualizace oborů</h2> 
<div style="text-align: left">
Obory s malým procentem shody jsou zapsány v seznamu pod grafem. Pokud není vybrána žádná oblast (nebo není žádný obor se shodou větší než nula), je zobrazen jenom seznam oborů
</div>

    <?php
echo "<div style=\"text-align: left\">";

     session_start();

    $_GET["typ"] = $_SESSION['typ'];
    $_GET["forma"] =  $_SESSION['forma'];
    
    require_once($_SERVER['DOCUMENT_ROOT']."/app_code/config.php"); 
    require_once(APP_CODE."graf_data_priprava.php"); 
    require_once(APP_CODE."graf_data_vypocet.php");
    require_once(APP_CODE."graf_data_final.php");
    
    $pocet_vybranych = count($_GET['id_klicova_slova']);
    
    if($pocet_vybranych != 0){
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
        //do pole s obory jako posledni sloupec zkopirujeme procenta
        $obory_final = array();
        $obory_final = get_data_final($result['OBOR2'], $obory_s_procenty);
    
        $pocet_obory_final = count($obory_final);
    
    

        //echo "<table>";
        //foreach($obory_final as $radek)
        //{
        //    echo "<tr>";
        //    foreach($radek as $slova)
        //    {
        //        echo "<td>";
        //        echo $slova;
        //        echo "</td>";
        
        //    }
        //    echo "</tr>";
        //}
        //echo "</table>";
    
   
        //-----------------------------
        // vykresleni
        //-----------------------------
        $delka = count($slova_s_hodnocenim);
        $delka_radek = count($slova_s_hodnocenim[0]);
    
        //------------
    
        if($pocet_vybranych != 0 && $pocet_obory_final !=0 ){
            require_once(VIZUALIZACE."grafy.php");  
            require_once(VIZUALIZACE."tlacitka_sdileni.php");  
        }
    
    }
    //------------
    // seznam oboru
    //------------
    require_once(VIZUALIZACE."ostatni_obory_seznam.php"); 

   
?>


<script type="text/javascript" src="../../app_code/js_scripts/vybrat_graf.js"></script>
