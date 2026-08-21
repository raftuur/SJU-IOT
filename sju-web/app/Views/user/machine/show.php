<?= $this->extend('layouts/user'); ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/dashboard.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/admin/panel.css'); ?>">

<?= $this->endSection(); ?>


<?= $this->section('dashboard-content'); ?>

<div class="dashboard-panel">

    <div class="panel-header d-flex justify-content-between align-items-center">

        <h5>
            <i class="bi bi-cpu me-2"></i>
            <?= esc($machine['machine_name']); ?>
        </h5>

        <a href="<?= site_url('user/machine'); ?>"
           class="btn btn-sm btn-outline-secondary">

            <i class="bi bi-arrow-left me-1"></i>
            Kembali

        </a>

    </div>


    <div class="panel-body">

        <!-- STATUS -->

        <div class="row g-4 mb-4">

            <div class="col-md-4">

                <div class="border rounded p-3 h-100">

                    <small class="text-muted">
                        Machine Code
                    </small>

                    <h5 class="mt-2 mb-0">
                        <?= esc($machine['machine_code']); ?>
                    </h5>

                </div>

            </div>


            <div class="col-md-4">

                <div class="border rounded p-3 h-100">

                    <small class="text-muted">
                        Status
                    </small>

                    <div class="mt-2">

                        <?php if ($machine['realtime_status'] === 'online'): ?>

                            <span class="badge bg-success">
                                Online
                            </span>

                        <?php elseif ($machine['realtime_status'] === 'maintenance'): ?>

                            <span class="badge bg-warning">
                                Maintenance
                            </span>

                        <?php else: ?>

                            <span class="badge bg-danger">
                                Offline
                            </span>

                        <?php endif; ?>

                    </div>

                </div>

            </div>


            <div class="col-md-4">

                <div class="border rounded p-3 h-100">

                    <small class="text-muted">
                        Lokasi
                    </small>

                    <h6 class="mt-2 mb-0">
                        <?= esc($machine['location'] ?? '-'); ?>
                    </h6>

                </div>

            </div>

        </div>


        <!-- SENSOR -->

        <h5 class="mb-3">
            <i class="bi bi-speedometer2 me-2"></i>
            Kondisi Machine
        </h5>


        <div class="row g-4">

            <div class="col-md-4">

                <div class="border rounded p-3">

                    <small class="text-muted">
                        Berat Saat Ini
                    </small>

                    <h4 class="mt-2 mb-0">

                        <?= number_format(
                            $machine['sensor']['weight'] ?? 0,
                            2
                        ); ?>

                        Kg

                    </h4>

                </div>

            </div>


            <div class="col-md-4">

                <div class="border rounded p-3">

                    <small class="text-muted">
                        Kapasitas Bin
                    </small>

                    <h4 class="mt-2 mb-0">

                        <?= number_format(
                            $machine['sensor']['bin_level'] ?? 0
                        ); ?>%

                    </h4>

                </div>

            </div>


            <div class="col-md-4">

                <div class="border rounded p-3">

                    <small class="text-muted">
                        Suhu
                    </small>

                    <h4 class="mt-2 mb-0">

                        <?= number_format(
                            $machine['sensor']['temperature'] ?? 0,
                            1
                        ); ?>

                        °C

                    </h4>

                </div>

            </div>


            <div class="col-md-4">

                <div class="border rounded p-3">

                    <small class="text-muted">
                        WiFi RSSI
                    </small>

                    <h4 class="mt-2 mb-0">

                        <?= number_format(
                            $machine['sensor']['wifi_rssi'] ?? 0
                        ); ?>

                        dBm

                    </h4>

                </div>

            </div>


            <div class="col-md-4">

                <div class="border rounded p-3">

                    <small class="text-muted">
                        Tegangan
                    </small>

                    <h4 class="mt-2 mb-0">

                        <?= number_format(
                            $machine['sensor']['voltage'] ?? 0,
                            2
                        ); ?>

                        V

                    </h4>

                </div>

            </div>


            <div class="col-md-4">

                <div class="border rounded p-3">

                    <small class="text-muted">
                        Firmware
                    </small>

                    <h6 class="mt-2 mb-0">

                        <?= esc(
                            $machine['firmware_version'] ?? '-'
                        ); ?>

                    </h6>

                </div>

            </div>

        </div>


        <!-- ACTION -->

        <div class="mt-4">

            <?php if ($machine['realtime_status'] === 'online'): ?>

                <a
                    href="<?= site_url(
                        'user/machine/' . $machine['id'] . '/use'
                    ); ?>"
                    class="btn btn-success"
                >

                    <i class="bi bi-recycle me-1"></i>

                    Gunakan Machine

                </a>

            <?php elseif ($machine['realtime_status'] === 'maintenance'): ?>

                <button
                    class="btn btn-warning"
                    disabled
                >

                    Machine Maintenance

                </button>

            <?php else: ?>

                <button
                    class="btn btn-secondary"
                    disabled
                >

                    Machine Offline

                </button>

            <?php endif; ?>

        </div>

    </div>

</div>

<?= $this->endSection(); ?>