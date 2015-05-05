
/**
* graf_sloupcovy.js
* -----------------------
* Definice sloupcoveho grafu prostrednictvim google charts api.
* ------------
* 
* Vlozeno v graf_sloupcovy.php
* ------------
*    4.5.2015
*    @version 1.0
*/

/**
* Vykresleni sloupcoveho grafu
* @param obory_nazvy pole s obory
*/
function drawChart(obory_nazvy) {
    var dataTable = new google.visualization.DataTable();

    dataTable.addColumn('string', 'Obor');
    // Use custom HTML content for the domain tooltip.
    dataTable.addColumn({ 'type': 'string', 'role': 'tooltip', 'p': { 'html': true } });
    dataTable.addColumn('number', '%');

    /*
    ------------
    DATA
    -----------
    */
    //rozparsovane pole s obory
    var obory = JSON.parse(obory_nazvy);

    for (var i = 0; i < obory.length; i++) {
        var nazev = obory[i][0].replace(" ","\n");

        dataTable.addRow(
           [nazev, createCustomHTMLContent(obory[i][4], obory[i][0]), obory[i][4]]
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
        tooltip: { isHtml: true, trigger: 'selection' },
        legend: { position: 'none' },
        width: 700,
        height: 400,
        bar: { groupWidth: "50%" }

    };

    // Create and draw the visualization.
    new google.visualization.ColumnChart(document.getElementById('chart_div')).draw(dataTable, options);
}


/*
--------
tooltip
--------
*/

function createCustomHTMLContent(procenta, obor) {
    var arr = "Slovo 1<br>" + "Slovo 2<br>";

    return '<div style="padding:5px 5px 5px 5px;">' +
        '<a href="http://www.seznam.cz" target="_blank"  ><h3>' + obor + '</h3></a>' +
        '<br>' + (Math.round(procenta * 100) / 100) + '%<br><br>' +
        arr + "</div>";
}