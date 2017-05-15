<header>
    <h1><?= $titulek ?></h1>
</header>
<?php
if (!empty($zprava)) {
    print_r($zprava);
} else if (isset($_GET['vytvoren']) && is_numeric($_GET['vytvoren'])) {
    if ($_GET['vytvoren'] != "false") {
        echo "Ukol #" . $_GET['vytvoren'] . " vytvoren";
    }
}
?>
<section>

    <div class="prepinace">
        <button id="splnene">Splnene</button>
        <button id="nesplnene">Nesplnene</button>
        <button id="vsechny">Vsechny</button>
    </div>
    <table class="seznamUkolu">
        <thead>
            <tr>
                <th width="20%">ID</th>
                <th width="20%">nazev</th>
                <th width="20%">text</th>
                <th width="20%">vytvoren</th>
                <th width="20%">splnen</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($obsah as $o) {
                ?>
                <tr id="<?= $o->getId() ?>" data-splneno="<?= $o->getSplnen() ?>">
                    <td><?= $o->getId() ?></td>
                    <td><?= $o->getNazev() ?></td>
                    <td><?= $o->getText() ?></td>
                    <td><?= $o->getVytvoren() ?></td>
                    <td><?= $o->getSplnen() == 0 ? "NE" : "ANO" ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</section>

<script type="text/javascript">
    $(document).ready(function () {
        $("tr").click(function (event) {
            var obj = $(event.target).parent();
//        console.log(obj.attr('id'));
            window.location.href = "ukol/" + obj.attr('id');
        });

        $(".prepinace button").click(function (event) {
            var str = event.target.id.toLocaleString();
            switch (str.toString()) {
                case "splnene":
                    $("[data-splneno='0']").hide("slow");
                    $("[data-splneno='1']").show("slow");
                    break;
                case "nesplnene":
                    $("[data-splneno='1']").hide("slow");
                    $("[data-splneno='0']").show("slow");
                    break;
                case "vsechny":
                    $("[data-splneno='0']").show("slow");
                    $("[data-splneno='1']").show("slow");
                    break;
                default:
                    break;
            }
        });
    });
</script>
