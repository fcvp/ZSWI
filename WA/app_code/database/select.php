<?php
/** 
 * select.php
 * -----------------------
 * Generovani sql dotazu pro vyber dat z DB (select)
 * 
 * -----------------------
 * 
 * Vlozeno v database.php.
 * -----------------------
 * 
 *    20.4.2015
 *    @version 1.0
 */




/**
 * Vrati pole hodnot nactenych z databaze sql dotazem,
 * sestavenym podle podminek zadanych v parametrech funkce
 * 
 * @param mixed $dbh         instance pripojeni k DB
 * @param String $sloupce    jednotlive nazvy sloupcu oddelene carkami nebo * (pripadne jine vyrazy mezi SELECT a FROM)
 * @param String $tabulka    nazev tabulky (nebo tabulek)
 * @param String $where      "where" podminka
 * @param String $order_by   "order by" - sloupec (sloupce) podle kterych maji byt data razena
 *                              
 * @return mixed             pole nactenych hodnot 
 */
function select($dbh, $sloupce, $tabulka, $where, $order_by )
{
    if (trim($where) != "" or $where!=null){
        $where = "WHERE $where";
    }
    if (trim($order_by) != "" or $order_by != null){
        $order_by = "ORDER BY $order_by";
    }

    $query = "SELECT $sloupce FROM $tabulka $where $order_by ";
    
    
    //-----------------------------------
    try{
         $result =  $dbh->query($query);
         $data = $result->fetchAll(PDO::FETCH_NUM);
    }
    catch (PDOException $e) {
        echo "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    
    
    return $data;
}


?>