<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SpravceUzivatelu
 *
 * @author František
 */
class SpravceUzivatelu {

    public function vratId($jmeno) {
        return Db::dotazJeden('SELECT id FROM uzivatele WHERE jmeno = ?', array($jmeno));
    }
    
    public function vratUzivatele($id) {
        return Db::dotazObjekt('SELECT * FROM uzivatele WHERE id = ?', 'Uzivatel', array($id));
    }

    public function overUzivatele($udaje){
        return Db::dotazObjekt('SELECT * FROM uzivatele WHERE jmeno = ? AND heslo = ?', 'Uzivatel', array($udaje['jmeno'], $udaje['heslo']));
    }
    
    public function zapisUzivatele($udaje){
        return Db::dotazId('INSERT INTO uzivatele (jmeno, heslo) VALUES (?, ?)', array($udaje['jmeno'], $udaje['heslo']));
    }
}
