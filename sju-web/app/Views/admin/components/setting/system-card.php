<?php

$systemName = 'Sampah Jadi Uang';

$systemDescription = 'Sistem Reverse Vending Machine berbasis Internet of Things.';

foreach ($settings ?? [] as $setting) {

    if ($setting['key'] === 'system_name') {
        $systemName = $setting['value'];
    }

    if ($setting['key'] === 'system_description') {
        $systemDescription = $setting['value'];
    }

}

?>

<div class="setting-card">

    <div class="setting-card-header">

        <i class="bi bi-gear"></i>

        <h5>Pengaturan Sistem</h5>

    </div>

    <div class="setting-card-body">

        <div class="setting-group">

            <label for="systemName">
                Nama Sistem
            </label>

            <input
                type="text"
                id="systemName"
                name="system_name"
                class="setting-input"
                value="<?= esc($systemName); ?>">

        </div>

        <div class="setting-group">

            <label for="systemDescription">
                Deskripsi Sistem
            </label>

            <textarea
                id="systemDescription"
                name="system_description"
                class="setting-input setting-textarea"><?= esc($systemDescription); ?></textarea>

        </div>

    </div>

</div>