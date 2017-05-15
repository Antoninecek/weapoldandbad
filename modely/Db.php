<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Db
 *
 * @author F@nny
 */
class Db {

//put your code here

    private static $spojeni;
    private static $nastaveni = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_EMULATE_PREPARES => false,
    );

    public static function pripoj($host, $uzivatel, $heslo, $databaze) {

        if (!isset(self::$spojeni)) {
            self::$spojeni = @new PDO(
                    "mysql:host=$host;dbname=$databaze", $uzivatel, $heslo, self::$nastaveni
            );
        }
    }

    public static function dotazJeden($dotaz, $parametry = array()) {
        $navrat = self::$spojeni->prepare($dotaz);
        $navrat->execute($parametry);
        return $navrat->fetch();
    }

    public static function dotazId($dotaz, $parametry = array()) {
        $navrat = self::$spojeni->prepare($dotaz);
        $navrat->execute($parametry);
        return self::$spojeni->lastInsertId();
    }

    public static function dotazVsechny($dotaz, $parametry = array()) {
        $navrat = self::$spojeni->prepare($dotaz);
        $navrat->execute($parametry);
        return $navrat->fetchAll();
    }

    public static function dotazSamotny($dotaz, $parametry = array()) {
        $vysledek = self::dotazJeden($dotaz, $parametry);
        return $vysledek[0];
    }

    public static function dotaz($dotaz, $parametry = array()) {
        $navrat = self::$spojeni->prepare($dotaz);
        $navrat->execute($parametry);
        return $navrat->rowCount();
    }

    public static function dotazVsechnyObjekty($dotaz, $typ, $parametry = array()) {
        $stmt = self::$spojeni->prepare($dotaz);
        $stmt->execute($parametry);
        return $stmt->fetchAll(PDO::FETCH_CLASS, $typ);
    }

    public static function dotazObjekt($dotaz, $typ, $parametry = array()) {
        $stmt = self::$spojeni->prepare($dotaz);
        $stmt->execute($parametry);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $typ);
        return $stmt->fetch();
    }

}
