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
Obory s malým procentem shody jsou zapsány v seznamu pod grafem. Pokud není vybrána žádná oblast, je zobrazen jenom seznam oborů
</div>

    <?php
     echo "<div style=\"text-align: left\">";
     session_start();

    $_GET["typ"] = $_SESSION['typ'];
    $_GET["forma"] =  $_SESSION['forma'];
    
    require_once($_SERVER['DOCUMENT_ROOT']."/app_code/config.php"); 
    require_once(APP_CODE."graf_data_priprava.php"); 
    require_once(VIZUALIZACE."ostatni_obory_seznam.php"); 
    require_once(APP_CODE."graf_data_vypocet.php");
    //-----------------------------
  
   //seznam zobrazenych klicovych slov
   // $id_slovo = $_GET['id_klicova_slova']; $hodnoceni = $_GET['klicova_slova_hodnota'];
   
    //-----------------------------
    //zobrazena klicova slova s ulozenou hodnotou, ostatni s hodnotu = 0
    $slova_s_hodnocenim = get_zobrazena_slova($_GET['id_klicova_slova'], $_GET['klicova_slova_hodnota'],  $result['OBOR_SLOVO']);
    $slova_s_hodnocenim = multisort(2,5, $slova_s_hodnocenim );//seradi slova podle oboru a formy
    
    //------------------
    $obory_procenta = spocti_shodu($slova_s_hodnocenim);
    $obory_final = array();
    
    //do pole s obory jako posledni sloupec zkopirujeme procenta
    foreach($result['OBOR2'] as $key => $obor)
    {
        $forma =   substr($result['OBOR2'][$key][3], 0, 1);
        $procenta = $obory_procenta[normalize_str($forma." ".$obor[0])];

        if($procenta > 0){
           $obory_final[$key] = $obor;
           $obory_final[$key][4] = $procenta;
        }
    }
    
 
    
    //-----------
    $delka = count($slova_s_hodnocenim);
    $delka_radek = count($slova_s_hodnocenim[0]);
    $pocet_vybranych = count($_GET['id_klicova_slova']);
    //------------
    
    if($pocet_vybranych!=0){
        require_once(VIZUALIZACE."grafy.php");  
        require_once(VIZUALIZACE."tlacitka_sdileni.php");  
    }
    
    
    //------------
    // seznam oboru
    //------------
    
    //ostatni obory
    echo "<h2>Ostatní obory: </h2>";
    echo "<ul>";
      if($pocet_vybranych==0){
          //pokud nejsou vybrany zadne oblasti
          foreach($result['OBOR2'] as $row)
          {
               vykresli_nazev_oboru(1, 0, 3, $row);
          }
      }else
      {    //je vybrana alespon jedna oblast
          foreach($result['OBOR2'] as $row)
          {
             $forma =  substr($row[3], 0, 1);
             $procenta = $obory_procenta[normalize_str($forma." ".$row[0])];
             
             if(intval($procenta) < 1)
               vykresli_nazev_oboru(1, 0, 3, $row);
          }
      }
      
      
    echo "</ul>";
    
    echo "</div>";
   
    ?>


<script type="text/javascript" src="../../app_code/js_scripts/vybrat_graf.js"></script>
