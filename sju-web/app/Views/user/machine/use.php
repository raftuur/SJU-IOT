<?= $this->extend('layouts/user'); ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/dashboard.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/admin/panel.css'); ?>">

<?= $this->endSection(); ?>


<?= $this->section('dashboard-content'); ?>

<div class="dashboard-panel">

    <!-- HEADER -->

    <div class="panel-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">

            <i class="bi bi-recycle me-2"></i>

            Gunakan Machine

        </h5>

        <a
            href="<?= site_url('user/machine/' . $machine['id']); ?>"
            class="btn btn-sm btn-outline-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Kembali

        </a>

    </div>


    <div class="panel-body">


        <!-- MACHINE INFO -->

        <div class="text-center mb-4">

            <i
                class="bi bi-recycle text-success"
                style="font-size: 64px;"
            ></i>

            <h3 class="mt-3 mb-1">

                <?= esc($machine['machine_name']); ?>

            </h3>

            <p class="text-muted mb-2">

                <?= esc($machine['machine_code']); ?>

            </p>

            <span class="badge bg-success">

                Machine Online

            </span>

        </div>


        <!-- QR SECTION -->

        <div class="border rounded p-4 text-center">

            <h5 class="mb-2">

                Scan QR Code ke Machine

            </h5>

            <p class="text-muted mb-4">

                Arahkan QR Code kamu ke kamera
                ESP32-CAM pada Reverse Vending Machine.

            </p>


            <!-- QR CODE -->

            <div class="mb-4">

                <div class="p-3 border rounded bg-white d-inline-block">

                    <img
                        src="<?= esc($qrCode); ?>"
                        alt="QR Code User"
                        style="width:280px;height:280px;"
                    >

                </div>

            </div>


            <!-- USER -->

            <p class="mb-1">

                <strong>

                    <?= esc($user['fullname']); ?>

                </strong>

            </p>


            <small class="text-muted">

                Setelah QR berhasil dipindai,
                machine akan otomatis memulai sesi.

            </small>


            <!-- INSTRUCTION -->

            <div class="alert alert-info mt-4 mb-0">

                <i class="bi bi-camera me-2"></i>

                Arahkan QR Code ke kamera ESP32-CAM
                dan tunggu sampai proses verifikasi selesai.

            </div>

        </div>


        <!-- SCAN STATUS -->

        <div
            id="scanStatus"
            class="text-center mt-4"
        >

            <div
                class="spinner-border text-success"
                role="status"
            ></div>

            <p class="mt-3 mb-0">

                Menunggu QR Code dipindai...

            </p>

        </div>


    </div>

</div>


<!-- DATA MACHINE -->

<input
    type="hidden"
    id="machineId"
    value="<?= esc($machine['id']); ?>"
>

<input
    type="hidden"
    id="machineCode"
    value="<?= esc($machine['machine_code']); ?>"
>

<input
    type="hidden"
    id="userUuid"
    value="<?= esc($user['uuid']); ?>"
>

<input
    type="hidden"
    id="sessionStatusUrl"
    value="<?= site_url(
        'api/machine-session/status/' . $machine['machine_code']
    ); ?>"
>

<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>

<script src="<?= base_url('assets/js/user/machine-use.js'); ?>"></script>

<?= $this->endSection(); ?>