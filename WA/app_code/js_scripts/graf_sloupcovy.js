
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
           [nazev, createCustomHTMLContent(obory,i), obory[i][4]]
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
        width: 800,
        height: 400
        /*vAxis: {
            viewWindow: {
                max: 100
            }
        }
        */
    };

    // Create and draw the visualization.
    new google.visualization.ColumnChart(document.getElementById('chart_div')).draw(dataTable, options);
}


/*
--------
tooltip
--------
*/

/**
* Definice toolboxu
* @param obor   pole s obory
* @param i     radek
*/
function createCustomHTMLContent(obor, i) {

    return '<div style="padding:5px 5px 5px 5px;">' +
        '<a href="' + obor[0][1] + '" target="_blank"  ><h3>' + obor[i][0] + '</h3></a>' +
        '<div style="margin-top:-10px">' + obor[i][3] + '</div>' +
        '<br>' + (Math.round(obor[i][4] * 100) / 100) + '%<br><br>' +
        '' + obor[i][2] + '<br><br>' +
        '</div>';
}