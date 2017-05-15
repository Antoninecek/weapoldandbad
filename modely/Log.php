<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Log
 *
 * @author František
 */
class Log {

    //put your code here

    function loguj($text) {
        $file = fopen(LOGFILE, "w");
        fwrite($file, $text . "\n");
        fclose($file);
    }

}
