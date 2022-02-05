<?php require_once __DIR__ . '/../headers/header_a.php'; ?>


<div class='container'>

    <script type='text/javascript' src='/public/assets/js/zarzadzajZakladami.js' defer></script>


    <?php require_once __DIR__ . '/../static/navigation_a.php'; ?>
    <div class='admin-content'>


        <div class='message-container' style="display: none">
            zarzadzajZakladami_admin
        </div>
        <div class='zaklady-filter'>
            Przefiltruj zaklady: <input type="text" name="zaklady-search" class="zaklady-search">
        </div>
        <div class='dodaj-nowy-zaklad-btn'>
            DODAJ NOWY ZAKLAD
        </div>
        <div class='nowy-zaklad'>
            <div class='nz-head'>
                <label for="nazwaZakladu">nazwa zakladu</label>
                <input type='text' name='nz-nazwa' class='nz-nazwa'>
                <div class='dodaj-nz-wartosc save-nowy-zaklad gb-icon'></div>
            </div>
            <div class="nz-dodaj-wartosc-row">
                <div class='plus-nz-wartosc gb-icon'></div><div>watości zakładu:</div>
            </div>
            <div class='wartosci'></div>
        </div>

        <template id="zaklad-wartosc">
            <div class='nz-zw-row'>
                <input type='text' name='watosc' class="nz-wartosc-inp">
                <div class='usun-nz-wartosc gb-icon'></div>
            </div>
        </template>





<!--       ZAKLADY      -->
<!--       ZAKLADY      -->
<!--       ZAKLADY      -->


        <div class='wszystki-zaklady'>
            <?php
            foreach ($zaklady as $z) { ?>
                <div class='zaklad' id="<?= $z->id ?>">
                    <div>
                        <div class='zaklad-header' id="<?= $z->id ?>">
                            <div class='zaklad-id'><?= $z->id ?>.</div>
                            <input type='text' class='zaklad-wartosc-wartosc input-wartosc' value="<?= $z->rodzaj ?>"
                                   lastValue="<?= $z->rodzaj ?>"
                                   baseValue="<?= $z->rodzaj ?>">
                            <div class='usun usun-wartosc-zakladu gb-icon'></div>
                            <div class='undo undo-wartosc-zakladu gb-icon'></div>
                            <div class='save save-wartosc-zakladu gb-icon' href="a_zmienRodzajZakladu"></div>
                        </div>
                    </div>
                    <div class='zaklad-wartosci'>
                        <?php
                        foreach ($z->wartosci as $w) { ?>
                            <div class='zaklad-wartosc' id="<?= $w->id ?>">
                                <div class='zaklad-wartosc-id'><?= $w->id ?>.</div>
                                <input type="text" class='zaklad-wartosc-wartosc input-wartosc'
                                       value="<?= $w->wartosc ?>" lastValue="<?= $w->wartosc ?>"
                                       baseValue="<?= $w->wartosc ?>">
                                <div class="usun usun-wartosc-zakladu gb-icon"></div>
                                <div class="undo undo-wartosc-zakladu gb-icon"></div>
                                <div class="save save-wartosc-zakladu gb-icon" href="a_zmienWartoscZakladu"></div>

                            </div>
                        <?php } ?>
                    </div>
<!--                    <div class='dodaj-waqrtosc-zakladu gb-icon'></div>      -->

                </div>

                <?php
            }
            ?>


        </div>


    </div>

    <?php require_once __DIR__ . '/../static/footer_a.php'; ?>










    <template id="template-zaklad">
        <div class='zaklad' id="">
            <div>
                <div class='zaklad-header' id="">
                    <div class='zaklad-id'></div>
                    <input type='text' class='zaklad-wartosc-wartosc input-wartosc'
                           value=""
                           lastValue=""
                           baseValue="">
                    <div class='usun usun-wartosc-zakladu gb-icon'></div>
                    <div class='undo undo-wartosc-zakladu gb-icon'></div>
                    <div class='save save-wartosc-zakladu gb-icon' href="a_zmienRodzajZakladu"></div>
                </div>
            </div>
            <div class='zaklad-wartosci'>

            </div>
            <div class='dodaj-waqrtosc-zakladu gb-icon'></div>
        </div>
    </template>


    <template id="template-single-wartosc">
        <div class='zaklad-wartosc' id="<?= $w->id ?>">
            <div class='zaklad-wartosc-id'><?= $w->id ?>.</div>
            <input type="text" class='zaklad-wartosc-wartosc input-wartosc'
                   value="" lastValue="" baseValue="">
            <div class="usun usun-wartosc-zakladu gb-icon"></div>
            <div class="undo undo-wartosc-zakladu gb-icon"></div>
            <div class="save save-wartosc-zakladu gb-icon" href="a_zmienWartoscZakladu"></div>

        </div>
    </template>


