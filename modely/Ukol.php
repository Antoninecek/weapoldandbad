<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PHPClass
 *
 * @author František
 */
class Ukol {

    //put your code here

    private $id, $nazev, $text, $vytvoren, $zacatek, $konec, $splnen, $idUzivatel;

    function __construct() {
        
    }

    function __construct1($id, $nazev, $text, $vytvoren, $zacatek, $konec, $splnen) {
        $this->id = $id;
        $this->nazev = $nazev;
        $this->text = $text;
        $this->vytvoren = $vytvoren;
        $this->zacatek = $zacatek;
        $this->konec = $konec;
        $this->splnen = $splnen;
    }

    function getIdUzivatel() {
        return $this->idUzivatel;
    }

    public function getId() {
        return $this->id;
    }

    function getNazev() {
        return $this->nazev;
    }

    function getText() {
        return $this->text;
    }

    function getVytvoren() {
        return $this->vytvoren;
    }

    function getZacatek() {
        return $this->zacatek;
    }

    function getKonec() {
        return $this->konec;
    }

    function getSplnen() {
        return $this->splnen;
    }

    function setSplnen($var) {
        $this->splnen = $var;
    }

    function toString() {
        return "id: " . $this->id . " nazev: " . $this->nazev . " text: " . $this->text . " vytvoren: " . $this->vytvoren . " zacatek: " . $this->zacatek . " konec: " . $this->konec . " splnen: " . $this->splnen;
    }

}
