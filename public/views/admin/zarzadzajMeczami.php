<?php require_once __DIR__ . '/../headers/header_a.php'; ?>


<div class='container'>

    <script type='text/javascript' src='/public/assets/js/zzzzzzzzzzzzz.js' defer></script>


    <?php require_once __DIR__ . '/../static/navigation_a.php'; ?>
    <div class='admin-content'>


        <div class='message-container' style="display: none">
            zarzadzajZakladami_admin
        </div>
        <div class='zaklady-filter'>
            Przefiltruj zaklady: <input type="text" name="zaklady-search" class="zaklady-search">
        </div>
        <div class='dodaj-nowy-zaklad-btn'>
            DODAJ NOWY MECZ
        </div>


        <form class='nowy-zaklad'>
            <form action="dodajNowyMecz" method="post">
                <div class='row'>

                    <label for="druzyna_1">gospodarz</label>
                    <input type='text' name='druzyna_1' class=''>
                    <select>
                        <option value="t1">t1</option>
                        <option value="t2">t2</option>

                    </select>
                </div>
                <div class='row'>

                    <label for="druzyna_2">gosc</label>
                    <input type='text' name='druzyna_2' class=''>
                    <select>
                        <option value="t1">t1</option>
                        <option value="t2">t2</option>

                    </select>
                </div>
                <div class='row'>

                    <label for="druzyna_2">liga</label>
                    <input type='text' name='liga' class=''>
                    <select>
                        <option value="t1">l1</option>
                        <option value="t2">l2</option>

                    </select>
                </div>

                <div class='row'>

                    <label for="druzyna_2">data</label>
                    <input type='datetime-local' name='data' class=''>

                </div>

            </form>

    </div>


    <!--       mecze      -->
    <!--       mecze      -->
    <!--       mecze      -->


    <div class='wszystki-mecze'>


    </div>


</div>

<?php require_once __DIR__ . '/../static/footer_a.php'; ?>








