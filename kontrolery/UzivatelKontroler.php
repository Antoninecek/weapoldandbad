<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'htmlpurifier/library/HTMLPurifier.auto.php';

/**
 * Description of UzivatelKontroler
 *
 * @author František
 */
class UzivatelKontroler extends Kontroler {

    public function zpracuj($parametry) {

        $spravceUzivatelu = new SpravceUzivatelu();

        switch (empty($parametry[0]) ? "DEFAULT" : $parametry[0]) {
            case "registrace":
                if (!isset($_POST['jmeno']) || !isset($_POST['heslo'])) {
                    $this->data['titulek'] = "Registrace";
                    $this->pohled = 'registrace';
                } else {
                    $filtrVstupy = $this->filtrujVstupy(array('jmeno' => $_POST['jmeno'], 'heslo' => $_POST['heslo']));
                    $registrace = $this->registruj($filtrVstupy['jmeno'], $filtrVstupy['heslo'], $spravceUzivatelu);
                    if ($registrace) {
                        $this->presmeruj(PATHBASERELATIVE . "uzivatel?registrace=true");
                    } else {
                        $this->presmeruj(PATHBASERELATIVE . "uzivatel/registrace?registrace=false");
                    }
                    
                }
                break;
            case "prihlaseni":
                $filtrovaneVstupy = $this->filtrujVstupy(array('jmeno' => $_POST['jmeno'], 'heslo' => $_POST['heslo']));
                $uzivatel = $this->prihlas($filtrovaneVstupy['jmeno'], $filtrovaneVstupy['heslo'], $spravceUzivatelu);
                if ($uzivatel) {
                    session_unset();
                    $_SESSION['uzivatel'] = $uzivatel;
                }
                $this->presmeruj(PATHBASERELATIVE . 'uzivatel');
                break;
            case "odhlaseni":
                session_unset();
                $this->presmeruj(PATHBASERELATIVE . "uzivatel");
                break;
            default :
                if (!isset($_SESSION['uzivatel'])) {
                    $this->data['titulek'] = "Prihlaseni";
                    $this->pohled = 'prihlaseni';
                } else {
                    $this->data['titulek'] = 'Profil';
                    $this->pohled = 'profil';
                }


                break;
        }
    }

    function registruj($jmeno, $heslo, $spravceUzivatelu){
        if(!$spravceUzivatelu->vratId($jmeno)){
            $spravceUzivatelu->zapisUzivatele(array("jmeno" => $jmeno, "heslo" => hash("sha256", $heslo)));
            return TRUE;
        }
        return FALSE;
    }
    
    function filtrujVstupy($vstupy) {
        $purifier = new HTMLPurifier();
        return $purifier->purifyArray($vstupy);
    }

    function prihlas($jmeno, $heslo, $spravceUzivatelu) {
        $heslo = hash("sha256", $heslo);
        return $spravceUzivatelu->overUzivatele(array("jmeno" => $jmeno, "heslo" => $heslo));
    }

}
