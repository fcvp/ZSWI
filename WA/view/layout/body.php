<!--
 * body.php
 * ---------
 * Telo aplikace. 
 * 
 * ------------
 * Vlozeno v index.php.
 *
 * ------------
 *   20.4.2015
 *   @version 1.0
 * 
-->



<div id="page_content">
    <div id="page">
        <?php 
        require_once(BODY."uvod.php");
        ?>

        <form onkeypress="return event.keyCode != 13;">
            <div class='bunka noborder' style='padding-bottom: 5px;'>
                <?php
                require_once(BODY."typ_seznam.php");
                echo " &nbsp;&nbsp;&nbsp;";
                require_once(BODY."forma_seznam.php");
                ?>
            </div>
            <div id="cast1">
                <div class='infobox'>Vyberte formu a typ studia</div>
            </div>

            <!--
                Po zvoleni formy a typu funkce zobraz_formular() zobrazi formular pro vyber oblasti:
                   (BODY."formular.php");
             -->
        </form>
    </div>
</div>
