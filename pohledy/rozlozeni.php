<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html lang="cs-cz">
    <head>
        <base href=<?= PATHBASE ?> />
        <meta charset="UTF-8" />
        <title><?= $titulek ?></title>
        <meta name="description" content="<?= $popis ?>" />
        <meta name="keywords" content="<?= $klicova_slova ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="style.css" type="text/css"/>
    </head>

    <body>
        <header>
            <img src="<?= PATHBASE ?>media/todo.png">
        </header>
        <nav id="primary_nav_wrap">
            <ul> 
                <li><a href="ukol">UKOLY</a>
                    <?php
                    if (isset($_SESSION['uzivatel'])) {
                        ?>
                        <ul>
                            <li><a href="ukol/pridej">PRIDEJ</a></li>

                        </ul>
                        <?php
                    }
                    ?>
                </li>
                <li><a href="uzivatel"><?= isset($_SESSION['uzivatel']) ? $_SESSION['uzivatel']->getJmeno() : "uzivatel" ?></a>
                    <?php
                    if (!isset($_SESSION['uzivatel'])) {
                        ?>
                        <ul>
                            <li><a href="uzivatel/registrace">REGISTRUJ</a></li>
                        </ul>
                        <?php
                    } else {
                        ?>
                        <ul>
                            <li><a href="uzivatel/odhlaseni">ODHLAS</a></li>
                        </ul>
                        <?php
                    }
                    ?>
                </li>
            </ul>
            <div class = "podpis" >
                Frantisek Jukl
                <br>
                WEAP 2k17
            </div>
        </nav>
        <br clear = "both" />

        <article>
            <?php
            $this->kontroler->vypisPohled();
            ?>
        </article>

    </body>
</html>