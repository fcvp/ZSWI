
<?php
/**
 * Provede sql dotaz a vrati vysledek
 * @param mixed $dbh      connection string
 * @param mixed $query    dotaz
 * @return mixed          pole s daty
 */
function load_data($dbh, $query)
{
    
    try{
        return $dbh->query($query);
    }
    catch (PDOException $e) {
        echo "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}

?>