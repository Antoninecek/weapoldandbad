<?php
$ukol = $obsah;
?>

<header>
    <h1><?= $titulek ?></h1>
</header>
<section>
    <div class="navUkol">
        <a href="ukol/stav/<?= $ukol->getId() ?>"><button id="stav">Zmenit stav</button></a>
        <button id="uprava">Upravit</button>
        <a href="ukol/smazani/<?= $ukol->getId() ?>"><button id="smazani">Smazat</button></a>
    </div>
    <form action="ukol/uprava" method="POST">
        <table class="ukol">
            <tr>
                <td>ID: <span data-zadavani="false"><?= $ukol->getId() ?></span><span style="display: none" data-zadavani="true"><input type="text" name="id" value="<?= $ukol->getId() ?>" readOnly="true"></span>
                    <span style="float: right"><?= $ukol->getSplnen() == 0 ? "NESPLNEN" : "SPLNEN" ?></span></td>
                <td rowspan="4" colspan="3">TEXT: <span data-zadavani="false"><?= $ukol->getText() ?></span><span style="display: none" data-zadavani="true"><input type="text" name="text" value="<?= $ukol->getText() ?>"></span></td>
            </tr>
            <tr>
                <td>Nazev: <span data-zadavani="false"><?= $ukol->getNazev() ?></span><span style="display: none" data-zadavani="true"><input type="text" name="nazev" value="<?= $ukol->getNazev() ?>"></span></td>
            </tr>
            <tr>
                <td>Uzivatel: <?= $uzivatel->getJmeno() ?> (<?= $uzivatel->getSlovniOpravneni() ?>)</td>
            </tr>
            <tr>
                <td>Vytvoren: <?= $ukol->getVytvoren() ?></td>
            </tr>
            <tr>

            </tr>
        </table>
        <div class="navUkol" data-zadavani="true" style="display: none; margin-top: 10px;"><button type="submit">UPRAV</button></div>
    </form>
</section>

<script type="text/javascript">
    $(document).ready(function () {
        $('#uprava').click(function () {
            $("[data-zadavani='false']").toggle();
            $("[data-zadavani='true']").toggle();
        });
    });
</script>