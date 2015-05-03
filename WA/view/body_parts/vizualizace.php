<!--
 * vizualizace.php
 * ---------
 * Zobrazeni grafu a seznamu oboru.
 * 
 * ------------
 * Vlozeno v zobrazit_vizualizaci.js
 *
 * ------------
 *   20.4.2014
 *   @version 1.0
 * 
-->
<label id="lab_viz"></label>


<h2 style="text-align: left" id="vizualizace_nadpis">Vizualizace oborů</h2> 
<div style="text-align: left">
Obory s malým procentem shody jsou zapsány v seznamu pod grafem.
</div>

<label id="viz" name="viz"></label>

<div id="vizualizace">
    <br/>
    <div class='menu'>
       <!--  <span class='bold'>Zobrazení</span> --><span class='graf paprskovy actual'>Sloupcový graf</span><span class='graf kruhovy'>Kruhový graf</span>
    </div>
    <br/><br/>
    <img src="image/Sloupcovy.BMP" id="paprskovy" alt="graf" style="width: 550px" />
    <img src="image/graf3.bmp" id="kruhovy" alt="graf" style="width: 550px" />
</div>
<div class="socialShare">
    <a href="https://www.facebook.com/share.php" target="_blank" class="btn facebook">Sdílet na Facebooku</a>
    <a href="https://twitter.com/share?url=#" target="_blank" class="btn twitter">Odeslat na Twitter</a>
    <a href="https://plus.google.com/share?url=#" target="_blank" class="btn googlePlus">Sdílet na Google+</a>
</div>




<br>
<br>
<div style="text-align: left">
    <h2>Ostatní obory: </h2>
    <ul>
        <li><a href="#">Matematika a finanční studie</a></li>
        <li><a href="#">Finanční informatika a statistika</a></li>
        <li><a href="#">Matematika a její aplikace</a></li>
        <li><a href="#">Systémy pro identifikaci, bezpečnost a komunikaci</a></li>
        <li><a href="#">Informační systémy</a></li>
        <li><a href="#">Výpočetní technika</a></li>
        <li><a href="#">Počítačová grafika a výpočetní systémy</a></li>
    </ul>
    
    <?php
    
     session_start();

    $_GET["typ"] = $_SESSION['typ'];
    $_GET["forma"] =  $_SESSION['forma'];

    
    require_once($_SERVER['DOCUMENT_ROOT']."/app_code/config.php"); 
    require_once($_SERVER['DOCUMENT_ROOT']."/app_code/graf_priprava_dat.php"); 
    
    //-----------------------------
  
   //seznam zobrazenych klicovych slov
   // $id_slovo = $_GET['id_klicova_slova'][0];
   // $hodnoceni = $_GET['klicova_slova_hodnota'][0];
   
    $delka = count($result['OBOR_SLOVO']);
    $delka_radek = count($result['OBOR_SLOVO'][0]);
    
    //-----------------------------

    $zobrazena_slova = get_zobrazena_slova($_GET['id_klicova_slova'],$result['OBOR_SLOVO']);
    
    //------------
    $delka = count($zobrazena_slova);
    $delka_radek = count($zobrazena_slova[0]);
        
    //razeni podle oboru
    //foreach ($zobrazena_slova as $key => $row) {
    //    $obor_nazev[$key] = $row[2];
    //}
    
    //array_multisort($obor_nazev, SORT_DESC, $zobrazena_slova);
    multisort(2, $zobrazena_slova );
    
    for($j=0; $j<$delka;$j++)
    {
        if($j>0 && $zobrazena_slova[$j][2] != $zobrazena_slova[$j-1][2])
        {
               echo "<br>";
        }
        for($i=0; $i<$delka_radek; $i++)
        {
            echo $zobrazena_slova[$j][$i]."   ";
        }
        echo "<br>";
    }
   
    ?>

</div>

<script type="text/javascript" src="../../app_code/js_scripts/vybrat_graf.js"></script>
