<?php
require_once __DIR__ . '/headers/header.php';
require_once __DIR__ . '/static/navigation.php';
?>
    <script type="text/javascript" src="./public/assets/js/mojeZaklady.js" defer></script>


<?php
if (isset($metaData)) { ?>


    <div class="nowy-zaklad-template" style="display: none !important;">
        <div class="nowy-zaklad-template-formularz">
            <div class="nowy-zaklad-collumn">
                <label class="label-mecz">mecz</label>
                <select name="mecz[arrayNumer]" class="input-mecz">
                    <?php foreach ($metaData['mecze'] as $m) { ?>
                        <option value="<?= $m['mecz_id'] ?>">  <?= $m['gospodarz'] . " - " . $m['gosc'] . "&nbsp;&nbsp;&nbsp;" . $m['data_meczu'] ?> </option>  <?php } ?>
                </select>
                <div>
                    <div class="nowy-zaklad-form-podwojny-select">

                        <label>rodzaj zakladu</label>
                        <select name="rodzajZakladu[arrayNumer]" class="rodzaj-zaklad-select">
                            <?php foreach ($metaData['rodzaj_zakladu'] as $m) { ?>
                                <option value="<?= $m['zaklad_rodzaj_id'] ?>"><?= $m['rodzaj_zakladu'] ?></option>  <?php } ?>
                        </select>
                    </div>
                    <div class="nowy-zaklad-form-podwojny-select">

                        <label>wartosc zakladu</label>
                        <select name="wartoscZakladu[arrayNumer]" class="wartosc-zaklad-select">
                            <?php foreach ($metaData['wartosc_zakladu'] as $m) { ?>
                                <option value="<?= $m['zaklad_wartosc_id'] . "_" . $m['zaklad_rodzaj_id'] ?>"><?= $m['wartosc_zakladu'] ?></option>  <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="nowy-zaklad-collumn">
            </div>
            <div class="nowy-zaklad-collumn" style="padding-right: 0px ;">
                <label>kurs</label>
                <input type="number" name="kurs[arrayNumer]" step="0.01" value="1.00" class="nowy-zaklad-input-number">
                <label>status</label>
                <select name="status[arrayNumer]" class="input-status">
                    <?php foreach ($metaData['status'] as $m) { ?>
                        <option value="<?= $m['status_id'] ?>"><?= $m['status'] ?></option>  <?php } ?>
                </select>
            </div>
        </div>
        <div class="formularz-usun-przycisk">
            <i class="fas fa-backspace usun-zaklad-przycisk"></i>
        </div>
    </div>

    <?php
}
?>


    <content>

        <div class="standard-content">

            <div class="sidebar">
                MAIIN-sidebar-container
            </div>


            <div class="content-right">


                <div class="noway-zaklad-all">

                    <div class="dodajNowyZaklad">
                        <form class="nowy-zaklad-form" method="post">

                            <div id="form-header">
                                <div class="form-header-col">
                                    <lebel class="label-stawka" style="display: none;">stawka:</lebel>
                                    <input name="stawka" type="text" class="input-stawka" style="display: none;">
                                </div>

                                <div class="form-header-col nowy-zaklad-button-div">
                                    <button type="button" class="nowy-zaklad-button" style="display: none;">dodaj zakład</button>
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

                <div class="wszystkieKupony">


                    <?php //wypiszanie wszystkich kuponów
                    if (isset($kupony)) {

                        $last = $kupony[0]->id;


                        foreach ($kupony as $kupon) {
                            ?>
                            <div class="kupon">
                                <div class="kupon-header">
                                    <div>#<?= $kupon->id ?></div>
                                    <div><?= $kupon->dataObstawienia->format('Y-m-d H:i'); ?></div>
                                    <div>status:<span class="<?= $kupon->status ?>"> <?= $kupon->status ?></span></div>
                                </div>

                                <?php
                                foreach ($kupon->zaklady as $z) {
                                    ?>
                                    <div class="zaklad">
                                        <div class="kupon-column col1">
                                            <div class="zaklad-properties druzyny"><?= $z->gospodarz ?>-<?= $z->gosc ?></div>
                                            <div class="zaklad-properties bet"><?= $z->rodzajZakladu . "&nbsp;-&nbsp;" . $z->wartoscZakladu ?></div>
                                        </div>
                                        <div class="kupon-column col2">
                                            <div class="zaklad-properties"><?= $z->dataMeczu->format('Y-m-d H:i'); ?></div>
                                            <div class="zaklad-properties">kurs: <?= $z->kurs ?></div>
                                        </div>
                                    </div>      <!-- </zaklad -->
                                    <?php
                                }
                                ?>
                                <div class="kupon-bottom">
                                    <div>stawka <?= $kupon->stawka ?></div>
                                    <div>kurs <?= round($kupon->kurs, 2) ?></div>
                                    <div class="zaklad-properties">potencjalna wygrana:
                                        $<?= money_format('%n', ($z->kurs * $z->dataMeczu)) ?></div>
                                </div>
                            </div>  <!-- </kupon -->
                            <?php
                        }
                    }
                    ?>

                </div>
            </div>  <!--</content-right-->


        </div>  <!-- </div> standard-content -->


    </content>


    <template id="kupon-template">
        <div class="kupon" id="">
            <div class="kupon-header">
                <div class="id-kuponu">#</div>
                <div class="data_meczu"></div>
                <div>status:<span class=""> </span></div>
            </div>
            <!--    TUTAJ    -->
            <!--    <bottom>    -->


        </div>  <!-- </kupon -->


    </template>


    <template id="zaklad-template">
        <div class="zaklad">
            <div class="kupon-column col1">
                <div class="zaklad-properties druzyny"></div>
                <div class="zaklad-properties bet"></div>
            </div>
            <div class="kupon-column col2">
                <div class="zaklad-properties dataMeczu"></div>
                <div class="zaklad-properties zakladu-kurs">kurs:</div>
            </div>
            <div class="kupon-column col3">
                <div class="zaklad-properties tagi"></div>

            </div>
        </div>      <!-- </zaklad -->
    </template>


    <template id="kupon-bottom-template">
        <div class="kupon-bottom">
            <div class="zaklad-properties stawka">stawka</div>
            <div class="zaklad-properties kurs">kurs</div>
            <div class="zaklad-properties pot-wygrana">potencjalna wygrana: $</div>
        </div>
    </template>


<?php
@ include '/public/views/static/footer.php';