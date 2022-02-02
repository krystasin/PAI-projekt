<?php
require_once __DIR__ . '/headers/header.php';
?>


<script type='text/javascript' src='/public/assets/js/mojeTagi.js' defer></script>
<script type='text/javascript' src='/public/assets/js/colors.js' defer></script>


<div class='container'>
    <?php require_once __DIR__ . '/static/navigation.php'; ?>


    <div class="content standard-content">

        <div class="sidebar">
            sidebar-container
        </div>

        <div class="content-right">
            <div class="dodaj-tag-div">
                <form>
                    <div class='tag-calosc tag-calosc-form'>
                        <div class='tag-header tag-header-form'>

                            <div class='tag-nazwa'>
                                <input type="text" name="nazwa" class='tag-nazwa dodaj-tag-input-nazwa'
                                       placeholder="nazwa">
                            </div>
                            <div class='tag-nazwa'>
                                <input type='checkbox' name='aktywny' class='tag-aktywny dodaj-tag-input-aktywny'
                                       checked>
                                <label for='aktywny'>aktywny</label>
                            </div>
                            <div class='dodaj-tag-kolor-h'>
                                <input type='text' name='kolor' class='tag-kolor dodaj-tag-input-kolor'
                                       placeholder='kolor' disabled>
                                <div class="dodaj-tag-picked-color"></div>
                            </div>
                        </div>
                        <div class='dodaj-tag-bottom'>
                            <textarea type='textarea' name='opis' class='dodaj-tag-input-opis'
                                      placeholder='dodaj opis do kuponu' wrap='hard'></textarea>

                            <div class='tag-colors'>
                                <div class='tag-color-row'>
                                    <div class="tag-color-pick red"></div>
                                    <input type="range" min="0" max="255" class='input-color-range input-color-red'
                                           name='red'>
                                </div>
                                <div class='tag-color-row'>
                                    <div class="tag-color-pick green"></div>
                                    <input type="range" min="0" max="255" class='input-color-range input-color-green'
                                           name='green'>
                                </div>
                                <div class='tag-color-row'>
                                    <div class="tag-color-pick blue"></div>
                                    <input type="range" min="0" max="255" class="input-color-range input-color-blue"
                                           name="blue">
                                </div>
                            </div>
                        </div>
                        <button type='button' class='dodaj-tag-button pointer'>dodaj tag</button>

                    </div>

                </form>


            </div>


            <div class="wszystkie-tagi">    <?php
                if (isset($tagi))
                    foreach ($tagi as $t) {

                        ?>

                        <div class='tag-calosc' idTagu="<?= $t->id ?>" iloscUzyc="<?= $t->iloscUzyc ?>">
                            <div class='tag-header'>
                                <div class='tag-nazwa tag-col'><?= $t->nazwa ?></div>
                                <div class='tag-aktywny tag-col'>
                                    <input type='checkbox' class='tag-aktywny-checkbox'
                                           name='<?= $t->nazwa ?>-aktywny' <?php if ($t->aktywny) echo "checked"; ?> />
                                    <span class="tag-aktywny-span <?php if (!$t->aktywny) echo 'nieaktywny-tag'; ?>"/>aktywny</span>
                                </div>
                                <div class='tag-kolor tag-col'><?= $t->kolor ?></div>
                                <div class="tag-color-box" style="background-color:<?= $t->kolor ?>"></div>
                                <div class='bg-icon remove-tag' style="background-image: url(/src/img/trash-solid.svg);"></div>
                            </div>
                            <div class='dodaj-tag-bottom tag-opis'>
                                <?= $t->opis ?>
                            </div>
                        </div> <?php
                    } ?>
            </div>       <!--/wszystkie-tagi-->

        </div>
    </div>

    <?php require_once 'static/footer.php'; ?>


    <template class="template-tag">
        <div class="tag-calosc">
            <div class="tag-header">
                <div class="tag-nazwa tag-col">nazwa</div>
                <div class="tag-aktywny tag-col">
                    <input type='checkbox' class="tag-aktywny-checkbox">
                    <span class="tag-aktywny-span <?php if (!$t->aktywny) echo 'nieaktywny-tag'; ?>">aktywny</span>
                </div>
                <div class="tag-kolor tag-col">kolor</div>


                <div class='tag-color-box'"></div>
                <div class='bg-icon remove-tag' style='background-image: url(/src/img/trash-solid.svg);'></div>

            </div>
            <div class="dodaj-tag-bottom tag-opis">
                lorem ipsum
            </div>
        </div>
    </template>