<header>
    <h1><?= $titulek ?></h1>
</header>
<section>
    <?php
    if (isset($_GET['registrace'])) {
        if ($_GET['registrace'] == "true") {
            echo "Nyni se muzete prihlasit.";
        }
    }
    ?>
    <form action="uzivatel/prihlaseni" method="POST">
        <input name="jmeno" placeholder="JMENO">
        <input name="heslo" placeholder="HESLO">
        <input type="submit" value="SUBMIT">
    </form>
</section>