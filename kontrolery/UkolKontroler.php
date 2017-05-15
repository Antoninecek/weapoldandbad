<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'htmlpurifier/library/HTMLPurifier.auto.php';

/**
 * Description of UkolKontroler
 *
 * @author F@nny
 */
class UkolKontroler extends Kontroler {

    public function zpracuj($parametry) {

        $spravceUkolu = new SpravceUkolu();
        $spravceUzivatelu = new SpravceUzivatelu();

        if (isset($_SESSION['uzivatel'])) {
            $this->volbaUzivatel($parametry, $spravceUkolu, $spravceUzivatelu);
        } else {
            $this->volbaNavstevnik();
        }
    }

    function volbaNavstevnik() {
        $this->presmeruj(PATHBASERELATIVE . "uzivatel");
    }

    function volbaUzivatel($parametry, $spravceUkolu, $spravceUzivatelu) {
        switch (empty($parametry[0]) ? "DEFAULT" : $parametry[0]) {
            case "smazani":
                $this->volbaSmazaniUkolu($parametry, $spravceUkolu);
                goto X;
                break;
            case "stav":
                $this->volbaStavUkolu($parametry, $spravceUkolu);
                goto X;
                break;
            case "uprava":
                $this->volbaUpravaUkolu($spravceUkolu);
                goto X;
                break;
            case "pridej":
                $this->volbaPridejUkol($spravceUkolu);
                break;
            case!empty($parametry[0]) && is_numeric($parametry[0]):
                $this->ukazUkol($parametry, $spravceUkolu, $spravceUzivatelu);
                break;
            default :
                X:
                $this->ukazUkoly($spravceUkolu);
                unset($_POST);
                break;
        }
    }

    function volbaPridejUkol($spravceUkolu) {
        if (empty($_POST)) {
            $this->data['titulek'] = "Pridej Ukol";
            $this->pohled = "pridej";
        } else {
            $vstupy = $this->filtrujVstupy(array('nazev' => $_POST['nazev'], 'text' => $_POST['text']));
            if ($this->zkontrolujPrazdneVstupy($vstupy)) {
                $posledniId = $spravceUkolu->vytvorUkol($vstupy['nazev'], $vstupy['text'], $_SESSION['uzivatel']->getId());
//                        $this->data['zprava'] = "Ukol #" . $posledniId . " byl vytvoren.";
                $this->presmeruj(PATHINDEX . "?vytvoren=" . $posledniId);
            } else {
                $this->presmeruj(PATHINDEX . "?vytvoren=false");
//                        $this->data['zprava'] = "Ukol nebyl vytvoren, pouzij validni data.";
            }
        }
    }

    function volbaUpravaUkolu($spravceUkolu) {
        $vstupy = $this->filtrujVstupy(array('nazev' => $_POST['nazev'], 'text' => $_POST['text']));
        $spravceUkolu->zmenUkol($vstupy['nazev'], $vstupy['text'], $_POST['id']);
        $this->data['zprava'] = "Ukol #" . $_POST['id'] . " byl zmenen.";
    }

    function volbaStavUkolu($parametry, $spravceUkolu) {
        $ukol = $spravceUkolu->vratUkol($parametry[1]);
        $ukol->setSplnen(($ukol->getSplnen() + 1) % 2);
        $spravceUkolu->zmenStavUkolu($ukol->getSplnen(), $ukol->getId());
        $this->data['zprava'] = "Ukol #" . $ukol->getId() . " byl oznacen jako " . ($ukol->getSplnen() ? "" : "ne") . "splnen.";
    }

    function volbaSmazaniUkolu($parametry, $spravceUkolu) {
        if ($this->smazUkol($parametry, $spravceUkolu)) {
            $this->data['zprava'] = "Ukol #" . $parametry[1] . " smazan.";
        } else {
            $this->data['zprava'] = "Takovy ukol tu neni.";
        }
    }

    function zkontrolujPrazdneVstupy($vstupy) {
        foreach ($vstupy as $v) {
            if (empty($v)) {
                return FALSE;
            }
        }
        return TRUE;
    }

    function filtrujVstupy($vstupy) {
        $purifier = new HTMLPurifier();
        return $purifier->purifyArray($vstupy);
    }

    function ukazUkoly($spravceUkolu) {
        $seznamUkolu = $spravceUkolu->vratVsechnyUkolyUzivatele($_SESSION['uzivatel']->getId());

        $this->data['titulek'] = "Seznam Ukolu";
        $this->data['obsah'] = $seznamUkolu;

        $this->pohled = 'seznam';
    }

    function smazUkol($parametry, $spravceUkolu) {
        if (isset($parametry[1]) && is_numeric($parametry[1]) && $this->jeUkolUzivatele($parametry[1], $_SESSION['uzivatel']->getId(), $spravceUkolu)) {
            return $spravceUkolu->smazUkol($parametry[1]);
        } else {
            return false;
        }
    }

    function ukazUkol($parametry, $spravceUkolu, $spravceUzivatelu) {
        
        $ukol = $spravceUkolu->vratUkol($parametry[0]);

        if(!$ukol || $ukol->getIdUzivatel() !=  $_SESSION['uzivatel']->getId()){
            $this->presmeruj(PATHCHYBA . "/404");
        }

        $uzivatel = $spravceUzivatelu->vratUzivatele($ukol->getIdUzivatel());

        // Hlavička stránky
        $this->hlavicka = array(
            'titulek' => $ukol->getId() . " " . $ukol->getNazev(),
            'klicova_slova' => $ukol->getNazev(),
            'popis' => $ukol->getNazev(),
        );

        // Naplnění proměnných pro šablonu
        $this->data['titulek'] = "Ukol #" . $ukol->getId();
        $this->data['obsah'] = $ukol;
        $this->data['uzivatel'] = $uzivatel;


        // Nastavení šablony
        $this->pohled = 'ukol';
    }

    function jeUkolUzivatele($idUkolu, $idUzivatele, $spravceUkolu) {
        return $spravceUkolu->vratIdUzivatele($idUkolu)['idUzivatel'] == $idUzivatele;
    }

}

?>