<?php
require_once __DIR__ . '/headers/header.php';
?>

<script type="text/javascript" src="/public/assets/js/statystyki.js" defer></script>


<div class='container'>
    <?php require_once __DIR__ . '/static/navigation.php'; ?>

    <div class='content standard-content'>

        <div class='sidebar'>
            sidebar-container
        </div>

        <div class='content-right'>

            <?php
            foreach ($statystyki as $s) { ?>
                <div class='statystyka' id="<?= $s->id; ?>" userId="<?= $s->userId; ?>">
                    <div class='statystyka-head'>
                        <div class='stat-head-left'>
                            <div class='stat-procent'><?= round(100 * $s->wygrane / $s->wszystkie); ?>%</div>
                            <div class='stat-nazwa'><?= $s->nazwa; ?></div>
                        </div>
                        <div class='stat-head-right'>
                            <div class='stat-liczby'>

                                <span class='stat-wygrane stat-wygrany bold500'><?= $s->wygrane; ?></span>
                                &#45;
                                <span class='stat-przegrane stat-przegrany bold500'><?= $s->przegrane; ?></span>
                                &#45;
                                <span class='stat-wszystkie stat-nierozstrzygniety'><?= $s->nierozstrzygniete; ?></span>
                                <span class='stat-nierozstrzygniete'>(<?= $s->wszystkie; ?>)</span>
                            </div>
                            <div class='zwin-rozwnin'></div>
                        </div>
                    </div>
                    <div class='stat-opisy'>
                        <div class='stat-id'>id</div>
                        <div class='stat-data'>data meczu</div>
                        <div class='stat-gospodarz'>gospodarz</div>
                        <div class='stat-pausa'>&#45;</div>
                        <div class='stat-gosc'>gość</div>
                        <div class='stat-zaklad-wartosc'>wartość zakładu</div>
                        <div class='stat-kurs'>kurs</div>


                    </div>

                    <div class='statystyka-body' hidden>
                        <div class="loading-gif" style="text-align: center">
                            <img class="loading" src="/public/css/img/loading.gif" alt="loading.gif">
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php require_once 'static/footer.php'; ?>



    <template id="stat-zaklad-template-row">
        <div class='stat-zaklad'>
            <div class='stat-id'></div>
            <div class='stat-data'></div>
            <div class='stat-gospodarz'></div>
            <div class='stat-pausa'>&#45;</div>
            <div class='stat-gosc'></div>
            <div class='stat-zaklad-wartosc'></div>
            <div class='stat-kurs'></div>

        </div>
    </template>