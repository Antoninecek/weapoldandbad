<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Uzivatel
 *
 * @author František
 */
class Uzivatel {

    private $id, $jmeno, $opravneni;

    function __construct() {
        $this->heslo = null;
    }

    function getId() {
        return $this->id;
    }

    function getJmeno() {
        return $this->jmeno;
    }

    function getOpravneni() {
        return $this->opravneni;
    }

    function getSlovniOpravneni() {
        switch ($this->opravneni) {
            case 0:
                return "Admin";
            case 1:
                return "Operator";
            case 2:
                return "User";
            default:
                return "Unknown";
        }
    }

}
