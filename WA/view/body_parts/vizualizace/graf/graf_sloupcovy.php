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

    Kliknutím na jeden ze sloupců zobrazíte detail oboru.
    <br/><br/>
    
    <script type="text/javascript" src="../../../../app_code/js_scripts/graf_sloupcovy.js"></script>
    <div id="chart_div" style="width: 800px;">
       <!-- Zde se zobrazi sloupcovy graf -->
    </div>
    
    <script type="text/javascript">
        //zobrazeni grafu
        $(document).ready(function () {       
           drawChart('<?php echo json_encode($graf_data_final);  ?>');
        });
    </script>
</div>