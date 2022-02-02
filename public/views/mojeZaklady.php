<?php require_once __DIR__ . '/headers/header.php'; ?>


<div class="container">
    <?php require_once __DIR__ . '/static/navigation.php';
    setlocale(LC_MONETARY, 'Polish');
    ?>
    <script type="text/javascript" src="/public/assets/js/mojeZaklady.js" defer></script>


    <?php
    if (isset($metaData)) { ?>
        <!--  -->
        <template id="nowy-zaklad-template-t">
            <div class="nowy-zaklad-template">
                <div class="nowy-zaklad-template-formularz">


                    <div class='nowy-zaklad-temp-upper'>
                        <label class='label-mecz' name='mecz[arrayNumer]'>mecz</label>
                        <select name='mecz[arrayNumer]' class='input-mecz'>
                            <?php foreach ($metaData['mecze'] as $m) { ?>
                                <option value="<?= $m['mecz_id'] ?>"> <?= $m['gospodarz'] . ' - ' . $m['gosc'] . '&nbsp;&nbsp;&nbsp;' . $m['data_meczu'] ?> </option> <?php } ?>
                        </select>
                    </div>

                    <div class="nowy-zaklad-temp-lower">

                        <div class="nowy-zaklad-collumn">

                            <div>
                                <div class="nowy-zaklad-form-podwojny-select">

                                    <label>rodzaj zakladu</label>
                                    <select name="rodzajZakladu[arrayNumer]" class="rodzaj-zaklad-select">
                                        <?php foreach ($metaData['rodzaj_zakladu'] as $m) { ?>
                                            <option value="<?= $m['zaklad_rodzaj_id'] ?>"><?= $m['rodzaj_zakladu'] ?></option> <?php } ?>
                                    </select>
                                </div>
                                <div class="nowy-zaklad-form-podwojny-select">

                                    <label>wartosc zakladu</label>
                                    <select name="wartoscZakladu[arrayNumer]" class="wartosc-zaklad-select">
                                        <?php foreach ($metaData['wartosc_zakladu'] as $m) { ?>
                                            <option value="<?= $m['zaklad_wartosc_id'] . "_" . $m['zaklad_rodzaj_id'] ?>"><?= $m['wartosc_zakladu'] ?></option> <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="nowy-zaklad-collumn" style="padding-right: 0;">
                            <label for='kurs[arrayNumer]'>kurs</label>
                            <input type="number" name="kurs[arrayNumer]" step="0.01" value="1.00"
                                   class="nowy-zaklad-input-number">
                            <label for='status[arrayNumer]'>status</label>
                            <select name="status[arrayNumer]" class="input-status">
                                <?php foreach ($metaData['status'] as $m) { ?>
                                    <option value="<?= $m['status_id'] ?>"><?= $m['status'] ?></option> <?php } ?>
                            </select>
                        </div>


                    </div>
                </div>
                <div class="formularz-usun-przycisk">
                    <i class="fas fa-backspace usun-zaklad-przycisk"></i>
                </div>
            </div>
        </template>

    <?php } ?>

    <content>

        <div class="standard-content">

            <div class="sidebar">
                MAIIN-sidebar-container
            </div>


            <div class="content-right">

                <div class="noway-zaklad-all">
                    <div class="dodajNowyZaklad">
                        <form class="nowy-zaklad-form" method="post" style="display: none;">
                            <div id="form-header">
                                <div class="form-header-col stawka-div">
                                    <lebel class="label-stawka">stawka:</lebel>
                                    <input name="stawka" type="number" step='0.01' value='1.00' class="input-stawka">
                                </div>

                                <div class="form-header-col tags-div">
                                    <p class="form-tags-text">dodaj tagi<i class='fas fa-caret-down'></i></p>
                                    <div class="form-tags-all-checkboxs">
                                        <?php foreach ($metaData['tagi'] as $tag) { ?>
                                            <p class="form-tag-p">
                                                <input class="checkbox-tag" type='checkbox'
                                                       name='<?= $tag['nazwa'] ?>'
                                                       id='<?= $tag['nazwa'] ?>'
                                                       value='<?= $tag['tag_id'] ?>'>
                                                <label for="<?= $tag['nazwa'] ?>"><?= $tag['nazwa'] ?></label>
                                            </p>
                                        <?php } ?>
                                    </div>

                                </div>
                                <div class="form-header-col nowy-zaklad-button-div">
                                    <button type="button" class="nowy-zaklad-button">dodaj
                                        zakład
                                    </button>
                                </div>
                            </div>

                        </form>
                        <i class="fas fa-plus-square dodaj-kolejny-zaklad-przycisk" style="display: none;"></i>
                    </div>

                    <div class="dodajNowyZakladPrzycisk">
                        <i class="fas fa-plus-square"></i>
                        <span class="text">dodaj nowy zakład</span>
                    </div>
                </div>


                <!-- WSZYSTKI KUPONY POCZĄTEK -->
                <!-- WSZYSTKI KUPONY POCZĄTEK -->
                <!-- WSZYSTKI KUPONY POCZĄTEK -->


                <div class="wszystkieKupony">

                    <?php //wypiszanie wszystkich kuponów
                    if (isset($kupony)) {
                        $last = $kupony[0]->id;

                        foreach ($kupony as $kupon) {
                            ?>
                            <div class="kupon" idKuponu="<?= $kupon->id ?>" id=kupon-<?= $kupon->id ?>">
                                <div class="kupon-header">
                                    <div class="kupon-properties kupon-id x-c-1">#<?= $kupon->id ?></div>
                                    <div class="kupon-properties data-obstawienia x-c-2"><?= $kupon->dataObstawienia->format('Y-m-d H:i'); ?></div>
                                    <div class="kupon-properties status x-c-3">
                                        <span class="opis-std <?= $kupon->status ?>"> <?= $kupon->status ?></span>
                                    </div>
                                </div>

                                <div class="kupon-mid">
                                    <div class="kupon-mid-L">
                                        <?php foreach ($kupon->zaklady as $z) { ?>
                                            <div class="zaklad">
                                                <div class="zaklad-column col1">
                                                    <div class="zaklad-properties druzyny"><?= $z->gospodarz ?>
                                                        -<?= $z->gosc ?></div>
                                                    <div class="zaklad-properties bet"><?= $z->rodzajZakladu . "&nbsp;-&nbsp;" . $z->wartoscZakladu ?></div>
                                                </div>
                                                <div class="zaklad-column col2">
                                                    <div class="zaklad-properties data-meczu"><?= $z->dataMeczu->format('Y-m-d H:i'); ?></div>
                                                    <div class="zaklad-properties zakladu-kurs"><span class="opis-std">kurs:</span>
                                                        <span class='kurs-val'><?= $z->kurs ?></span></div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class='kupon-mid-R'>
                                        <div class='zaklad-column col3'>
                                            <div class="add-tag"><i class="fa-solid fa-square-plus"></i>dodaj tag</div>
                                            <div class='kupons-tags'>
                                                <?php foreach ($kupon->getTags() as $tag) { ?>
                                                    <p class="kupon-p-tag"
                                                       style="color: <?= $tag->getKolor() ?>"><?= $tag->getNazwa() ?></p> <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="kupon-bottom">
                                    <div class="kupon-properties stawka x-c-1"><span
                                                class="opis-std ">stawka:</span><?= $kupon->stawka ?></div>
                                    <div class="kupon-properties kus x-c-2"><span
                                                class="opis-std ">kurs: </span><?= round($kupon->kurs, 2) ?></div>
                                    <div class="kupon-properties x-c-3"><span
                                                class="opis-std ">potencjalna wygrana:</span>
                                        $<?= number_format(($z->kurs * floatval(substr($kupon->stawka, 1))), 2, ",", " ") ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>

                </div>

                <div class="load-more">
                    load more
                </div>

            </div>

        </div>


    </content>


    <!-- TEMPLATES -->
    <!-- TEMPLATES -->
    <!-- TEMPLATES -->

    <template id="kupon-template">
        <div class="kupon" id="">
            <div class="kupon-header">
                <div class="kupon-properties kupon-id x-c-1">#</div>
                <div class='kupon-properties data-obstawienia x-c-2'></div>
                <div class='kupon-properties status x-c-3'><span class="opis-std"> </span></div>
            </div>


        </div>
    </template>

    <template id="kupon-mid-template">

        <div class="kupon-mid">
            <div class="kupon-mid-L"></div>
            <div class="kupon-mid-R">
                <div class="zaklad-column col3">
                    <div class="add-tag"><i class='fa-solid fa-square-plus'></i>dodaj tag</div>
                    <div class="kupons-tags">
                    </div>
                </div>
            </div>
        </div>
    </template>

    <template id="zaklad-template">
        <div class="zaklad">
            <div class="zaklad-column col1">
                <div class="zaklad-properties druzyny"></div>
                <div class="zaklad-properties bet"></div>
            </div>
            <div class="zaklad-column col2">
                <div class="zaklad-properties data-meczu"></div>
                <div class="zaklad-properties zakladu-kurs">
                    <span class='opis-std'>kurs:</span>
                    <span class='kurs-val'></span>
                </div>
            </div>

        </div>
    </template>

    <template id="kupon-bottom-template">
        <div class="kupon-bottom">
            <div class="zaklad-properties stawka x-c-1"><span class='opis-std '>stawka:</span></div>
            <div class="zaklad-properties kurs x-c-2"><span class='opis-std '>kurs: </span></div>
            <div class="zaklad-properties pot-wygrana  x-c-3"><span class='opis-std '>potencjalna wygrana:</span>$</div>
        </div>
    </template>


    <?php require_once 'static/footer.php'; ?>


