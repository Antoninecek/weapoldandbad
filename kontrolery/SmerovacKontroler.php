<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SmerovacKontroler
 *
 * @author F@nny
 */
class SmerovacKontroler extends Kontroler {

    protected $kontroler;

    public function zpracuj($parametry) {
        $naparsovanaURL = $this->parsujURL($parametry[0]);
        if (empty($naparsovanaURL[0])) {
            $this->presmeruj(PATHINDEX);
        }
        $tridaKontroleru = $this->pomlckyDoVelbloudiNotace(array_shift($naparsovanaURL)) . "Kontroler";
        if (file_exists("kontrolery/" . $tridaKontroleru . ".php")) {
            $this->kontroler = new $tridaKontroleru;
        } else {
            $this->presmeruj(PATHCHYBA . "/404");
        }
        $this->kontroler->zpracuj($naparsovanaURL);
        $this->data['titulek'] = TITULEK . " " . $this->kontroler->hlavicka['titulek'];
        $this->data['popis'] = $this->kontroler->hlavicka['popis'];
        $this->data['klicova_slova'] = $this->kontroler->hlavicka['klicova_slova'];
        $this->pohled = 'rozlozeni';
    }

    private function pomlckyDoVelbloudiNotace($text) {
        $veta = str_replace('-', ' ', $text);
        $veta = ucwords($veta);
        $veta = str_replace(' ', '', $veta);
        return $veta;
    }

    private function parsujURL($url) {
        $naparsovanaURL = parse_url($url);
        $naparsovanaURL["path"] = ltrim($naparsovanaURL["path"], "/");
        $naparsovanaURL["path"] = trim($naparsovanaURL["path"]);
        $rozdelenaCesta = explode("/", $naparsovanaURL["path"]);
        if (TESTSERVER) {
            array_shift($rozdelenaCesta);
            array_shift($rozdelenaCesta);
        }
        return $rozdelenaCesta;
    }

//put your code here
}
