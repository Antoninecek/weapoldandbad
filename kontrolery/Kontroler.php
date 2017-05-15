<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Kontroler
 *
 * @author F@nny
 */
abstract class Kontroler {

    //put your code here
    protected $data = array();
    protected $pohled = "";
    protected $hlavicka = array('titulek' => '', 'klicova_slova' => '', 'popis' => '');

    abstract function zpracuj($parametry);

    public function vypisPohled() {
        if ($this->pohled) {
            extract($this->data);
            require("pohledy/" . $this->pohled . ".php");
        }
    }

    public function presmeruj($url) {
        header("Location: /$url");
        header("Connection: close");
        exit;
    }

}
