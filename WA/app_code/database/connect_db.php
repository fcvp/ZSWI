<?php
/** 
 * connect_db.php
 * ---------
 * Pripojeni k databazi.
 * 
 * ------------
 * Vlozeno v database.php.
 *
 * ------------
 *   20.4.2015
 *   @version 1.0
 * 
 * */

try {
    $dbh = new PDO('mysql:host=localhost;dbname=zswi;charset=utf8', 'root', 'heslo', array(PDO::ATTR_PERSISTENT => true));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>