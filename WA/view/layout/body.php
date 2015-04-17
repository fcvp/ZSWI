
<div id="page_content">
    <div id="page">
        <?php 
        require_once(BODY."uvod.php");
        ?>

        <form onkeypress="return event.keyCode != 13;">
            <div class='bunka noborder' style='padding-bottom: 5px;'>
                <?php
                require_once(BODY."forma_seznam.php");
                echo " &nbsp;&nbsp;&nbsp;";
                require_once(BODY."typ_seznam.php");
                ?>
            </div>
            <div id="cast1">
                <div class='infobox'>Vyberte formu a typ studia</div>
            </div>
        </form>
    </div>
</div>
