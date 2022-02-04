<?php require_once __DIR__ . '/../headers/header_a.php'; ?>


<div class='container'>

    <script type='text/javascript' src='/public/assets/js/zarzadzajZakladami.js' defer></script>


    <?php require_once __DIR__ . '/../static/navigation_a.php'; ?>
    <div class='admin-content'>


        <div class='message-container'>
            zarzadzajZakladami_admin
        </div>
        <div class='zaklady-filter'>
            Przefiltruj zaklady: <input type="text" name="zaklady-search">


        </div>
        <div class='wszystki-zaklady'>
            <?php
            foreach ($zaklady as $z) { ?>
                <div class='zaklad'>
                    <div class='zaklad-header'>
                        <div class='zaklad-id'><?= $z->id ?></div>
                        <div class='zaklad-rodzaj'><?= $z->rodzaj ?></div>

                        <div class='dodaj-waqrtosc-zakladu gb-icon'></div>
                    </div>
                    <div class='zaklad-wartosci'>
                        <?php
                        foreach ($z->wartosci as $w) { ?>
                            <div class='zaklad-wartosc'>
                                <div class='zaklad-wartosc-id'><?= $w->id ?>.</div>
                                <input type="text" class='zaklad-wartosc-wartosc' value="<?= $w->wartosc ?>"
                                       baseValue="<?= $w->wartosc ?>">
                                <div class="usun-waqrtosc-zakladu gb-icon"></div>
                                <div class="undo-waqrtosc-zakladu gb-icon"></div>
                                <div class="save-waqrtosc-zakladu gb-icon"></div>

                            </div>
                        <?php } ?>
                    </div>

                </div>

                <?php
            }
            ?>


        </div>


    </div>

    <?php require_once __DIR__ . '/../static/footer_a.php'; ?>
