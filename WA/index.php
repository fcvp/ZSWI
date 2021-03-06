
<!-- 
    index.php
    -----------
    17.4.2015
    @version 1.0
-->

<!DOCTYPE HTML>
<html>
<head>
    <!-- meta  -->
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
    <meta http-equiv="content-language" content="cs" />
    <!--/meta  -->

    <!-- css  -->
    <link rel="stylesheet" href="style.css" />
    <!-- /css  -->

    <!-- js  -->
    <script type="text/javascript" src="jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart']}]}"></script>

  
    <script type="text/javascript" src="app_code/js_scripts/zobrazit_formular.js"></script>
    <script type="text/javascript" src="app_code/js_scripts/zobrazit_vizualizaci.js"></script>
    <script type="text/javascript" src="app_code/js_scripts/zobrazit_oblast.js"></script>

    <!-- /js  -->

    <title>Výběr studijního oboru na FAV</title>
</head>
<body>

    <?php
    require_once("app_code/config.php");
    
    require_once(LAYOUT."header.php");
    require_once(LAYOUT."body.php");
    require_once(LAYOUT."footer.php");
    ?>

    <table id="loading">
        <tr>
            <td><span>loading</span></td>
        </tr>
    </table>
    <input type='hidden' name='zobrazeni_prvni_casti' id="zobrazeni_prvni_casti" value="0" />
</body>
</html>
