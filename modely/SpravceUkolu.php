<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SpravceClanku
 *
 * @author F@nny
 */
class SpravceUkolu {

    public function vytvorUkol($nazev, $text, $user) {
        return Db::dotazId('INSERT INTO ukoly (nazev, text, idUzivatel) VALUES (?, ?, ?)', array($nazev, $text, $user));
    }

    public function vratVsechnyUkoly() {
        return Db::dotazVsechnyObjekty('SELECT * FROM ukoly ORDER BY id DESC', 'Ukol');
    }

    public function vratVsechnyUkolyUzivatele($id) {
        return Db::dotazVsechnyObjekty('SELECT * FROM ukoly WHERE idUzivatel = ? ORDER BY id DESC', 'Ukol', array($id));
    }

    public function vratIdUzivatele($idUkolu) {
        $ret = Db::dotazJeden('SELECT idUzivatel FROM ukoly WHERE id = ?', array($idUkolu));
        return $ret;
    }

    public function vratUkol($id) {
        return Db::dotazObjekt('SELECT * FROM ukoly WHERE id = ?', 'Ukol', array($id));
    }

    public function smazUkol($id) {
        return Db::dotaz('DELETE FROM ukoly WHERE id = ?', array($id));
    }

    public function zmenStavUkolu($bool, $id) {
        return Db::dotaz('UPDATE ukoly SET splnen = ? WHERE id = ?', array($bool, $id));
    }

    public function zmenUkol($nazev, $text, $id) {
        return Db::dotaz('UPDATE ukoly SET nazev = ?, text = ? WHERE id = ?', array($nazev, $text, $id));
    }

}
