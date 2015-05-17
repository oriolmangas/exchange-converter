<?php

/**
 * Currency MODEL
 * 
*/

include 'lib/model/base/BaseCurrency.class.php';

class currency extends currencyBase {

    function __toString() {
        
        return($this->currencyName . ' - ' . $this->description);
    
    }

}
