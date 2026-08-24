<?php

$pointPerBottle = 30;
$minimumPoint   = 100;

foreach ($settings ?? [] as $setting) {

    if ($setting['key'] === 'point_per_bottle') {
        $pointPerBottle = $setting['value'];
    }

    if ($setting['key'] === 'minimum_point') {
        $minimumPoint = $setting['value'];
    }

}

?>

<div class="setting-card">

    <div class="setting-card-header">

        <i class="bi bi-coin"></i>

        <h5>Pengaturan Point</h5>

    </div>

    <div class="setting-card-body">

        <div class="setting-group">

            <label for="pointPerBottle">
                Point per Botol
            </label>

            <input
                type="number"
                id="pointPerBottle"
                name="point_per_bottle"
                class="setting-input"
                value="<?= esc($pointPerBottle); ?>"
                min="0">

            <small>
                Jumlah point yang diberikan untuk setiap botol valid.
            </small>

        </div>

        <div class="setting-group">

            <label for="minimumPoint">
                Minimal Point
            </label>

            <input
                type="number"
                id="minimumPoint"
                name="minimum_point"
                class="setting-input"
                value="<?= esc($minimumPoint); ?>"
                min="0">

            <small>
                Minimal point yang diperlukan pengguna untuk melakukan penukaran.
            </small>

        </div>

    </div>

</div>