<?php
/**
 * remove_diacritic.php
 * -----------------------
 * odstraneni diakritiky a mezer a dalsich znaku z retezce.
 *
 *    20.4.2015
 *    @version 1.0
 */


/**
 * Odstrani vsechny nevhodne znaky a mezery nahradi podtrzitkem
 *
 * @param String $input vstup
 * @return String   retezec 
 */
function normalize_str($input){

   setlocale(LC_ALL, 'czech');
   
   $input =  preg_replace('/[ ]/','_', $input);
   // záleží na použitém systému
   return preg_replace('/[^a-zA-Z0-9_]/','',iconv("utf-8", "us-ascii//TRANSLIT", $input));
}



?>