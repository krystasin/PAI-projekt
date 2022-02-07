<?php
require_once __DIR__ . '/headers/header.php';
?>

<script type="text/javascript" src="/public/assets/js/statystyki.js" defer></script>
<script type="text/javascript" src="/public/assets/js/statystykiFiltr.js" defer></script>


<div class='container'>
    <?php require_once __DIR__ . '/static/navigation.php'; ?>

    <div class='content standard-content'>

        <div class='sidebar'>
            <div class='sidebar-content sid-bar-2'>
                <!--
                <input type='text' class='filtr-text s-bar-inp'>


                <?php /*foreach ($statystyki as $s) { */ ?>
                    <div class="stat-filtr-row">
                        <input class="checkbox-tag" type='checkbox'
                               name='<? /*= $s->nazwa */ ?>'
                               id='<? /*= $s->nazwa */ ?>'
                               value='<? /*= $s->nazwa */ ?>'>
                        <label for="<? /*= $s->nazwa */ ?>"><? /*= $s->nazwa */ ?></label>
                    </div>
                --><?php /*} */ ?>


                <div class='stat-filtr-row-head '>
                    Liczba zakładów:
                </div>
                <div class='stat-filtr-row'>
                    <div>
                        <label for="min-razem">Min</label>
                        <input type="number" class="stat-filtr-min-razem  stat-filtr-nmbr" name="min-razem">
                    </div>
                    <div>
                        <label for="max-razem">Max</label>
                        <input type="number" class="stat-filtr-max-razem stat-filtr-nmbr" name="max-razem">
                    </div>
                </div>


                <div class='stat-filtr-row-head '>
                    Liczba wygranych zakładów:
                </div>
                <div class='stat-filtr-row'>
                    <div>
                        <label for="min-razem">Min</label>
                        <input type="number" class="stat-filtr-min-wygrane  stat-filtr-nmbr" name="min-wygranych">
                    </div>
                    <div>
                        <label for="max-razem">Max</label>
                        <input type="number" class="stat-filtr-max-wygrane stat-filtr-nmbr" name="max-wygranych">
                    </div>
                </div>


                <div class='stat-filtr-row-head '>
                    Liczba przegranych zakładów:
                </div>
                <div class='stat-filtr-row'>
                    <div>
                        <label for="min-razem">Min</label>
                        <input type="number" class="stat-filtr-min-przegrane  stat-filtr-nmbr" name="min-przegranych">
                    </div>
                    <div>
                        <label for="max-razem">Max</label>
                        <input type="number" class="stat-filtr-max-przegrane stat-filtr-nmbr" name="max-przegranych">
                    </div>
                </div>


            </div>
        </div>

        <div class='content-right'>

            <?php
            foreach ($statystyki as $s) { ?>
                <div class='statystyka' id="<?= $s->id; ?>" userId="<?= $s->userId; ?>">
                    <div class='statystyka-head'>
                        <div class='stat-head-left'>
                            <div class='stat-procent'><?= round($s->procent, 1) ?>%</div>
                            <div class='stat-nazwa'><?= $s->nazwa; ?></div>
                        </div>
                        <div class='stat-head-right'>
                            <div class='stat-liczby'>

                                <span class='stat-wygrane stat-wygrany bold500'><?= $s->wygrane; ?></span>
                                &#45;
                                <span class='stat-przegrane stat-przegrany bold500'><?= $s->przegrane; ?></span>
                                &#45;
                                <span class='stat-nierozstrzygniety'><?= $s->nierozstrzygniete; ?></span>
                                <span class='stat-wszystkie '>(<?= $s->wszystkie; ?>)</span>
                            </div>
                            <div class='zwin-rozwnin'></div>
                        </div>
                    </div>
                    <div class='stat-opisy' style="display: none" >
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