<?php

if ($_SERVER['SERVER_NAME'] == "127.0.0.1") {
    define('TESTSERVER', TRUE);
    define('PATHBASE', "http://127.0.0.1:8080/projects/weaptodo/");
    define('PATHINDEX', "projects/weaptodo/ukol");
    define('PATHBASERELATIVE', "projects/weaptodo/");
    define('PATHCHYBA', "projects/weaptodo/chyba");
    define('DBHOST', "127.0.0.1");
    define('DBUSER', "root");
    define('DBPASSWD', "");
    define("DBNAME", "weaptodo");
    define("TITULEK", "TODO");
    define("LOGFILE", "F:\EasyPHP-DevServer-14.1VC11\data\localweb\projects\weaptodo\logfile.txt");
} else {
    define('TESTSERVER', FALSE);
}

function autoloadFunkce($trida) {
    if (preg_match('/Kontroler$/', $trida)) {
        require("kontrolery/" . $trida . ".php");
    } else {
        require("modely/" . $trida . ".php");
    }
}

require_once('\FirePHPCore\FirePHP.class.php');
$firephp = FirePHP::getInstance(true);

spl_autoload_register("autoloadFunkce");

session_start();

$smerovac = new SmerovacKontroler();

try {
    Db::pripoj(DBHOST, DBUSER, DBPASSWD, DBNAME);
    $smerovac->zpracuj(array($_SERVER['REQUEST_URI']));
} catch (Exception $e) {
    $smerovac->zpracuj(array(PATHCHYBA . "/500"));
}

$smerovac->vypisPohled();
?>
