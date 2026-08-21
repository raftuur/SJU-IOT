<?= $this->extend('layouts/user'); ?>

<?= $this->section('styles'); ?>

<style>
    .session-card {
        max-width: 600px;
        margin: 0 auto;
    }

    .qr-wrapper {
        width: 280px;
        height: 280px;
        margin: 30px auto;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 15px;
    }

    .qr-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .session-token {
        word-break: break-all;
        font-size: 12px;
    }
</style>

<?= $this->endSection(); ?>


<?= $this->section('dashboard-content'); ?>

<div class="dashboard-panel session-card">

    <div class="panel-header text-center">

        <h4 class="mb-1">
            Gunakan Mesin
        </h4>

        <p class="text-muted mb-0">
            <?= esc($machine['machine_name']); ?>
        </p>

    </div>

    <div class="panel-body text-center">

        <div class="mb-3">

            <span class="badge bg-success">
                Session Aktif
            </span>

        </div>

        <h5>
            <?= esc($machine['machine_code']); ?>
        </h5>

        <p class="text-muted">
            <?= esc($machine['location']); ?>
        </p>

        <div class="qr-wrapper">

            <img
                src="<?= esc($qrCode); ?>"
                alt="QR Code Machine Session"
            >

        </div>

        <h6>
            Scan QR Code ini pada ESP32-CAM
        </h6>

        <p class="text-muted">
            Arahkan kamera ESP32-CAM ke QR Code di atas
            untuk mengaktifkan mesin.
        </p>

        <hr>

        <div class="text-start">

            <small class="text-muted d-block">
                Session ID
            </small>

            <strong>
                <?= esc($session['uuid']); ?>
            </strong>

        </div>

        <div class="text-start mt-3">

            <small class="text-muted d-block">
                Status
            </small>

            <span class="badge bg-success">
                <?= esc($session['status']); ?>
            </span>

        </div>

        <div class="text-start mt-3">

            <small class="text-muted d-block">
                Session Token
            </small>

            <div class="session-token">
                <?= esc($session['session_token']); ?>
            </div>

        </div>

        <div class="mt-4">

            <a
                href="<?= site_url('user/machine'); ?>"
                class="btn btn-outline-secondary"
            >
                Kembali ke Machine
            </a>

        </div>

    </div>

</div>

<?= $this->endSection(); ?>