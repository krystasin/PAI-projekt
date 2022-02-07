<div class='sidebar-content'>

    <input type='text' class='filtr-text s-bar-inp'>
    <div class='filtr-row'>
        <span class='text-font'>Od:</span>
        <input type='datetime-local' class='datetime-query datetime-start s-bar-inp'>
    </div>
    <div class='filtr-row'>
        <span class='text-font'>Do:</span>
        <input type='datetime-local' class='datetime-query datetime-end s-bar-inp '>
    </div>
    <div class='filtr-tags text-font'>
        Tagi (requied / and):
        <?php
        foreach ($metaData['tagi'] as $t) { ?>
            <div class='filtr-row filtr-row-tag'>
                <input type="checkbox" value="<?= $t['tag_id'] ?>" name="<?= $t['nazwa'] ?>"
                       class="z-filtr-tag-checkbox">
                <label for="<?= $t['tag_id'] ?>"><?= $t['nazwa'] ?></label>
            </div>
        <?php } ?>
    </div>

    <div class="filtr-status text-font">
        Status Kuponu (or):
        <?php
        foreach ($metaData['status'] as $s) { ?>
            <div class='filtr-row filtr-row-tag'>
                <input type="checkbox" name="<?= $s['status'] ?>" value="<?= $s['status_id'] ?>"
                       class="z-filtr-status-checkbox" checked>
                <label for="<?= $s['status_id'] ?>"><?= $s['status'] ?></label>
            </div>
        <?php } ?>
    </div>

</div>