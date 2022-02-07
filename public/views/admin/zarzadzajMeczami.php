<?php require_once __DIR__ . '/../headers/header_a.php'; ?>


<div class='container'>

    <script type='text/javascript' src='/public/assets/js/mecze.js' defer></script>


    <?php require_once __DIR__ . '/../static/navigation_a.php'; ?>
    <div class='admin-content'>


        <div class='dodaj-nowy-mecz'>
            DODAJ NOWY MECZ
        </div>


        <div class='a-dodaj-mecz'>
            <form action="dodajNowyMecz" method="post">
                <div class="a-dodaj-mecz-row">

                    <label for="druzyna_1" class='a-mecz-label'>gospodarz</label>
                    <select name="gospodarz">
                        <?php
                        foreach ($metaData['druzyny'] as $d) { ?>
                            <option value='<?= $d->id ?>'><?= $d->nazwa ?></option>
                        <?php } ?>

                    </select>

                    <input type='text' name='druzyna_1' class='a-dodaj-mecz-filtr-inp'>
                </div>
                <div class='a-dodaj-mecz-row'>

                    <label for="druzyna_2" class='a-mecz-label'>gosc</label>
                    <select name="gosc">
                        <?php
                        foreach ($metaData['druzyny'] as $d) { ?>
                            <option value='<?= $d->id ?>'><?= $d->nazwa ?></option>
                        <?php } ?>

                    </select>
                    <input type='text' name='druzyna_2' class='a-dodaj-mecz-filtr-inp'>
                </div>
                <div class='a-dodaj-mecz-row'>

                    <label for="liga" class='a-mecz-label'>liga</label>
                    <select class="a-dodaj-mecz-select" name="liga">

                        <?php
                        foreach ($metaData['ligi'] as $d) { ?>
                            <option value='<?= $d->id ?>'><?= $d->nazwa ?></option>
                        <?php } ?>
                    </select>
                    <input type='text'  class='a-dodaj-mecz-filtr-inp'>
                </div>

                <div class='a-dodaj-mecz-row'>

                    <label for="data" class='a-mecz-label'>data</label>
                    <input type='datetime-local' name='data' class="a-dodaj-mecz-filtr-inp">

                    <button type='submit' class='dodaj-mecz'>dodaj mecz</button>
                </div>

            </form>
        </div>



        <!--       mecze      -->
        <!--       mecze      -->
        <!--       mecze      -->

        <div class='wszystki-mecze'>
            <?php
            foreach ($mecze as $mecz) { ?>
                <div class='a-mecz'>
                    <div class='a-mecz-id a-mecz-col'><?= $mecz['id'] ?></div>
                    <div class='a-mecz-gospodarz a-mecz-col a-team'><?= $mecz['gospodarz'] ?></div>
                    <div class='a-mecz-pausa a-mecz-col'>-</div>
                    <div class='a-mecz-gosc a-mecz-col a-team'><?= $mecz['gosc'] ?></div>
                    <div class='a-mecz-liga a-mecz-col'><?= $mecz['liga'] ?></div>
                    <div class='a-mecz-data a-mecz-col'><?= $mecz['data'] ?></div>

                </div>
            <?php } ?>
        </div>

    </div>





</div>

<?php require_once __DIR__ . '/../static/footer_a.php'; ?>












