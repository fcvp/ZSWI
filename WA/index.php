<!DOCTYPE HTML>
<html>
<head>
    <!-- meta  -->
    <meta http-equiv="Content-Type" content="text/html"; charset="UTF-8" />
    <meta http-equiv="content-language" content="cs" />
    <meta name="generator" content="PSPad editor, www.pspad.com" />
    <!--/meta  -->

    <!-- css  -->
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="autosuggest/autosuggest_inquisitor.css" type="text/css" media="screen" />
    <!-- /css  -->

    <!-- js  -->
    <script type="text/javascript" src="jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="autosuggest/autos.js" charset="utf-8"></script>

    <script type="text/javascript" src="app_code/js_scripts/zobrazit_formular.js"></script>
    <script type="text/javascript" src="app_code/js_scripts/zobrazit_vizualizaci.js"></script>
    <script type="text/javascript" src="app_code/js_scripts/zobraz_oblast.js"></script>
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
