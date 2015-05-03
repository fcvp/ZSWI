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
    
     session_start();

    $_GET["typ"] = $_SESSION['typ'];
    $_GET["forma"] =  $_SESSION['forma'];
    require_once($_SERVER['DOCUMENT_ROOT']."/app_code/config.php"); 
    require_once(APP_CODE."graf_priprava_dat.php"); 
    require_once(VIZUALIZACE."ostatni_obory_seznam.php");  
    //-----------------------------
  
   //seznam zobrazenych klicovych slov
   // $id_slovo = $_GET['id_klicova_slova'][0];
   // $hodnoceni = $_GET['klicova_slova_hodnota'][0];
   
    $delka = count($result['OBOR_SLOVO']);
    $delka_radek = count($result['OBOR_SLOVO'][0]);
    
    //-----------------------------

    $zobrazena_slova = get_zobrazena_slova($_GET['id_klicova_slova'],$result['OBOR_SLOVO']);
    $zobrazena_slova = multisort(2, $zobrazena_slova );//seradi slova podle oboru
    
    $delka = count($zobrazena_slova);
    $delka_radek = count($zobrazena_slova[0]);
    //------------
    
    if($delka!=0){
        require_once(VIZUALIZACE."grafy.php");  
        require_once(VIZUALIZACE."tlacitka_sdileni.php");  
    }
    
     //------------
      //------------
    
    //ostatni obory
    echo "<div style=\"text-align: left\">";
    echo "<h2>Ostatní obory: </h2>";
    echo "<ul>";
    
    
      if($delka==0){
          //pokud nejsou vybrany zadne oblasti
          foreach($result['OBOR2'] as $row)
          {
               vypis_obor(1, 0, 3, $row);
          }
      }else
      {
          foreach($zobrazena_slova as $row)
          {
               //vypis_obor(1, 0, 3, $row);
          }
      }
    echo "</ul>";
    echo "</div>";

    
    

        
    //for($j=0; $j<$delka;$j++)
    //{
    //    if($j>0 && $zobrazena_slova[$j][2] != $zobrazena_slova[$j-1][2])
    //    {
    //           echo "<br>";
    //    }
    //    for($i=0; $i<$delka_radek; $i++)
    //    {
    //        echo $zobrazena_slova[$j][$i]."   ";
    //    }
    //    echo "<br>";
    //}
   
    ?>


<script type="text/javascript" src="../../app_code/js_scripts/vybrat_graf.js"></script>
