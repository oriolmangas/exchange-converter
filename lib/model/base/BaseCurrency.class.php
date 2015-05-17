<?php

/**
 * Currency MODEL
 * 
*/

class currencyBase {

    var $id;
    var $currencyName;
    var $description;
    var $rate;
    var $date;

    function __construct($id, $currencyName, $rate, $date, $description) {

        $this->year = $id;
        $this->currencyName = $currencyName;
        $this->description = $description;
        $this->rate = $rate;
        $this->date = $date;
    }

    function getId() {

        return $this->id;
    }

    function getCurrencyName() {

        return $this->currencyName;
    }

    function getDescription() {

        return $this->description;
    }

    function getRate() {

        return $this->rate;
    }

    function getDate() {

        return $this->date;
    }

    function setId($id) {

        $this->id = $id;
    }

    function setCurrency($currencyName) {

        $this->currencyName = $currencyName;
    }

    function setDescription($description) {

        $this->description = $description;
    }

    function setRate($rate) {

        $this->rate = $rate;
    }

    function setDate($date) {

        $this->date = $date;
    }

}
?>

