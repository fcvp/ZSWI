<?php
/**
 * remove_diacritic.php
 * -----------------------
 * odstraneni diakritiky a mezer a dalsich znaku z retezce.
 *
 *    20.4.2014
 *    @version 1.0
 */



/**
 * Odstrani vsechny nevhodne znaky a mezery nahradi podtrzitkem
 * @param String $input vstup
 * @return String   retezec 
 */
function normalize_str($input){
    $input =  preg_replace('/[ ]/','_', $input);
    
    return preg_replace('/[^a-zA-Z0-9_]/','',iconv('UTF-8', 'ASCII//TRANSLIT', $input));
}



?>