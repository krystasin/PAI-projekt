<?php
require_once __DIR__ . '/headers/header.php';
require_once __DIR__ . '/static/navigation.php';
?>
<script type="text/javascript" src="/public/assets/js/mojeZaklady.js" defer></script>

<content>
    <div class="nowy-zaklad-template" style="display: none !important;">
        <div class="nowy-zaklad-template-formularz">
            <div class="nowy-zaklad-collumn">
                <label for="mecz[arrayNumer]" class="label-mecz">mecz</label>
                <input type="text" name="mecz[arrayNumer]" class="input-mecz">
                <label for="rodzajZakladu[arrayNumer]">rodzaj zakladu</label>
                <input type="text" name="rodzajZakladu[arrayNumer]">
            </div>
            <div class="nowy-zaklad-collumn">
                <label for="data[arrayNumer]">data</label>
                <input type="date" name="data[arrayNumer]">
                <label for="wartoscZakladu[arrayNumer]">wartosc zakladu</label>
                <input type="text" name="wartoscZakladu[arrayNumer]">
            </div>
            <div class="nowy-zaklad-collumn" style="padding-right: 0px ;">
                <label for="kurs[arrayNumer]">kurs</label>
                <input type="number" name="kurs[arrayNumer]" step="0.01">
                <label for="status[arrayNumer]">status</label>
                <input type="text" name="status[arrayNumer]">
            </div>
        </div>
        <div class="formularz-usun-przycisk">
            <i class="fas fa-backspace usun-zaklad-przycisk"></i>
        </div>
    </div>

    <div class="standard-content">

        <div class="aaa">

        </div>


        <div class="sidebar">
            MAIIN-sidebar-container

        </div>


        <div class="content-right">

            <div class="noway-zaklad-all">

                <div class="dodajNowyZaklad">
                    <form action="dodajZaklad" class="nowy-zaklad-form" method="post">
                        <button type="submit" class="nowy-zaklad-button" style="display: none;">dodaj zakład</button>

                    </form>
                    <i class="fas fa-plus-square dodaj-kolejny-zaklad-przycisk" style="display: none;"></i>
                </div>


                <div class="dodajNowyZakladPrzycisk">
                    <i class="fas fa-plus-square"></i>
                    <span class="text">dodaj nowy zakład</span>
                </div>
            </div>

            <?php


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
                        foreach ($kupon->zaklady as $z)
                        {
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
        </div>  <!--</content-right-->


    </div>  <!-- </div> standard-content -->






</content>



