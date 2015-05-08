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
    
    //---------------------------
    
    if($pocet_vybranych != 0){
       require_once(APP_CODE."graf_data.php");
   
        //-----------------------------
        // vykresleni
        //-----------------------------    
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
