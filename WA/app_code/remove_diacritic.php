<?php

/**
 * Odstrani vsechny nevhodne znaky a mezery nahradi podtrzitkem
 * @param mixed $input vstup
 * @return mixed   retezec 
 */
function normalize_str($input){
    $input =  preg_replace('/[ ]/','_', $input);
    
    return preg_replace('/[^a-zA-Z0-9_]/','',iconv('UTF-8', 'ASCII//TRANSLIT', $input));
}



?>