




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

                                <div class='zaklad-column col0 bg-icon-zaklad bg-<?= $z->status ?>'></div>
                                <div class="zaklad-column col1">

                                    <div class="zaklad-properties druzyny">
                                        <?= $z->gospodarz ?>-<?= $z->gosc ?></div>
                                    <div class="zaklad-properties bet"><?= $z->rodzajZakladu . '&nbsp;-&nbsp;' . $z->wartoscZakladu ?></div>
                                </div>
                                <div class="zaklad-column col2">
                                    <div class="zaklad-properties data-meczu"><?= $z->dataMeczu->format('Y-m-d H:i'); ?></div>
                                    <div class="zaklad-properties zakladu-kurs"><span
                                                class="opis-std">kurs:</span>
                                        <span class='kurs-val'><?= $z->kurs ?></span></div>
                                </div>
                                </div><?php

                            } ?>
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
                            $<?= number_format(($z->kurs * floatval(substr($kupon->stawka, 1))), 2, ',', ' ') ?>
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
