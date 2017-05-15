<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ChybaKontroler
 *
 * @author F@nny
 */
class ChybaKontroler extends Kontroler {

    //put your code here
    public function zpracuj($parametry) {

        switch ($parametry[0]):
            case "404":
                // Hlavička požadavku
                header("HTTP/1.0 404 Not Found");
                // Hlavička stránky
                $this->hlavicka['titulek'] = 'Chyba 404';
                // Nastavení šablony
                $this->pohled = 'chyba404';
                break;
            case "500":
                header("HTTP/1.0 500 Internal Server Error");
                $this->hlavicka['titulek'] = 'Chyba 500';
                $this->pohled = 'chyba500';
        endswitch;
    }

}
