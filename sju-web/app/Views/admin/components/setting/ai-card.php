<?php

$aiServiceUrl        = 'http://127.0.0.1:8000';
$aiConfidence        = 70;
$aiDetectionStatus   = 1;

foreach ($settings ?? [] as $setting) {

    if ($setting['key'] === 'ai_service_url') {
        $aiServiceUrl = $setting['value'];
    }

    if ($setting['key'] === 'ai_confidence') {
        $aiConfidence = $setting['value'];
    }

    if ($setting['key'] === 'ai_detection_status') {
        $aiDetectionStatus = (int) $setting['value'];
    }

}

?>

<div class="setting-card">

    <div class="setting-card-header">

        <i class="bi bi-robot"></i>

        <h5>Pengaturan AI Detection</h5>

    </div>

    <div class="setting-card-body">

        <div class="setting-group">

            <label for="aiServiceUrl">
                AI Service URL
            </label>

            <input
                type="text"
                id="aiServiceUrl"
                name="ai_service_url"
                class="setting-input"
                value="<?= esc($aiServiceUrl); ?>">

            <small>
                URL service AI yang digunakan untuk pengujian deteksi.
            </small>

        </div>

        <div class="setting-group">

            <label for="aiConfidence">
                Minimum Confidence (%)
            </label>

            <input
                type="number"
                id="aiConfidence"
                name="ai_confidence"
                class="setting-input"
                value="<?= esc($aiConfidence); ?>"
                min="0"
                max="100">

            <small>
                Nilai confidence minimum yang digunakan saat pengujian AI.
            </small>

        </div>

        <div class="setting-toggle">

            <div class="setting-toggle-info">

                <strong>AI Detection</strong>

                <small>
                    Aktifkan fitur pengujian AI dari halaman admin.
                </small>

            </div>

            <div class="form-check form-switch">

                <input
                    class="form-check-input"
                    type="checkbox"
                    id="aiDetectionStatus"
                    name="ai_detection_status"
                    <?= $aiDetectionStatus ? 'checked' : ''; ?>>

            </div>

        </div>

    </div>

</div>