<!--
 * graf_sloupcovy.php
 * ---------
 * Vykresleni sloupcoveho grafu
 * 
 * ------------
 * Vlozeno ve grafy.php
 *
 * ------------
 *   3.5.2015
 *   @version 1.0
 * 
-->

<script src="https://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript">
    google.setOnLoadCallback(drawChart);

    function drawChart() {
      var dataTable = new google.visualization.DataTable();
    
      dataTable.addColumn('string', 'Obor');
      // Use custom HTML content for the domain tooltip.
      dataTable.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
      dataTable.addColumn('number','%');
    
        var obor=["Obor 1", "Obor 2",  "Obor 3", "Obor 4"];
        var hodnoty=[1,5,0.5,1];
  
    
    for(var i=1; i<obor.length; i++){
        dataTable.addRow(
           [ obor[i], createCustomHTMLContent(hodnoty[i],obor[i] ), hodnoty[i]]
        );
    }
    
    /*
    ------------
    Vlastnosti
    -----------
    */
      var options = {
        title: 'Výběr oboru na FAV',
        //colors: ['#000000'],
      
        // This line makes the entire category's tooltip active.
        focusTarget: 'category',
      
        // Use an HTML tooltip.
        tooltip: { isHtml: true, trigger: 'selection'},
        legend: { position: 'none' },
        width:500,
   
      };

      // Create and draw the visualization.
      new google.visualization.ColumnChart(document.getElementById('chart_div')).draw(dataTable, options);
    }
        
 
    /*
    --------
    tooltip
    --------
    */

    function createCustomHTMLContent(procenta,obor) {
        var arr = "Slovo 1<br>"+"Slovo 2<br>";

      return '<div style="padding:5px 5px 5px 5px;">' +
          '<a href="http://www.seznam.cz" target="_blank"  ><h3>'+obor+'</h3></a>' +
          '<br>'+procenta+'%<br><br>'+
          arr;
    }
</script>
    
    
<script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart']}]}"></script>

<labe>Kliknutím na jeden ze sloupců zobrazíte detail oboru.</labe>
<div id="chart_div" style="width: 900px; height: 500px;"></div>



<!-- <img src="image/Sloupcovy.BMP" id="sloupcovy" alt="graf" style="width: 550px" /> -->