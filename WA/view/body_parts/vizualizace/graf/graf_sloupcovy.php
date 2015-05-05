<!--
 * graf_sloupcovy.php
 * ---------
 * Vykresleni sloupcoveho grafu
 * 
 * ------------
 * Vlozeno v grafy.php
 *
 * ------------
 *   3.5.2015
 *   @version 1.0
 * 
-->
    
<div id="sloupcovy" align="center"> 
    <?php 
       //$obory_final
    
    ?>

    Kliknutím na jeden ze sloupců zobrazíte detail oboru.
    <br/>
    
    <script type="text/javascript" src="../../../../app_code/js_scripts/graf_sloupcovy.js"></script>
    <div id="chart_div" style="width: 600px;   ">
       <!-- Zde se zobrazi sloupcovy graf -->
    </div>
    
    <script>
        //zobrazeni grafu
        $(document).ready(function () {
           drawChart();
        });
    </script>
</div>
<!-- <img src="image/Sloupcovy.BMP" id="sloupcovy" alt="graf" style="width: 550px" /> -->