<?php

$communicationInterval = 10;
$offlineTimeout        = 60;

foreach ($settings ?? [] as $setting) {

    if ($setting['key'] === 'communication_interval') {
        $communicationInterval = $setting['value'];
    }

    if ($setting['key'] === 'offline_timeout') {
        $offlineTimeout = $setting['value'];
    }

}

?>

<div class="setting-card">

    <div class="setting-card-header">

        <i class="bi bi-cpu"></i>

        <h5>Pengaturan Machine</h5>

    </div>

    <div class="setting-card-body">

        <div class="setting-group">

            <label for="communicationInterval">
                Interval Komunikasi
            </label>

            <input
                type="number"
                id="communicationInterval"
                name="communication_interval"
                class="setting-input"
                value="<?= esc($communicationInterval); ?>"
                min="1">

            <small>
                Interval komunikasi machine dengan server dalam detik.
            </small>

        </div>

        <div class="setting-group">

            <label for="offlineTimeout">
                Batas Offline
            </label>

            <input
                type="number"
                id="offlineTimeout"
                name="offline_timeout"
                class="setting-input"
                value="<?= esc($offlineTimeout); ?>"
                min="1">

            <small>
                Machine dianggap offline setelah tidak mengirim data
                selama batas waktu ini.
            </small>

        </div>

    </div>

</div>