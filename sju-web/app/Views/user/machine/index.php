<?= $this->extend('layouts/user'); ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/dashboard.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/admin/panel.css'); ?>">

<?= $this->endSection(); ?>


<?= $this->section('dashboard-content'); ?>

<div class="dashboard-panel">

    <div class="panel-header">

        <h5>
            <i class="bi bi-cpu me-2"></i>
            Machine Tersedia
        </h5>

    </div>

    <div class="panel-body">

        <div class="row g-4">

            <?php if (empty($machines)): ?>

                <div class="col-12">

                    <div class="text-center py-5">

                        <i class="bi bi-cpu fs-1 text-muted"></i>

                        <h5 class="mt-3">
                            Belum Ada Machine
                        </h5>

                        <p class="text-muted">
                            Belum ada Reverse Vending Machine yang terdaftar.
                        </p>

                    </div>

                </div>

            <?php else: ?>

                <?php foreach ($machines as $machine): ?>

                    <?php
                        $status = $machine['realtime_status'] ?? 'offline';

                        if ($status === 'online') {
                            $badge = 'success';
                            $statusText = 'Online';
                        } elseif ($status === 'maintenance') {
                            $badge = 'warning';
                            $statusText = 'Maintenance';
                        } else {
                            $badge = 'danger';
                            $statusText = 'Offline';
                        }
                    ?>

                    <div class="col-xl-4 col-md-6">

                        <div class="card h-100">

                            <div class="card-body">

                                <div class="d-flex justify-content-between align-items-start">

                                    <div>

                                        <h5 class="mb-1">
                                            <?= esc($machine['machine_name']); ?>
                                        </h5>

                                        <small class="text-muted">
                                            <?= esc($machine['machine_code']); ?>
                                        </small>

                                    </div>

                                    <span class="badge bg-<?= $badge ?>">
                                        <?= $statusText ?>
                                    </span>

                                </div>

                                <hr>

                                <div class="mb-3">

                                    <small class="text-muted">
                                        <i class="bi bi-geo-alt me-1"></i>
                                        Lokasi
                                    </small>

                                    <div>
                                        <?= esc($machine['location'] ?? '-'); ?>
                                    </div>

                                </div>

                                <div class="mb-3">

                                    <small class="text-muted">
                                        <i class="bi bi-speedometer2 me-1"></i>
                                        Kapasitas Bin
                                    </small>

                                    <div>
                                        <?= number_format(
                                            $machine['last_bin_level'] ?? 0
                                        ); ?>%
                                    </div>

                                </div>

                                <a
                                    href="<?= site_url('user/machine/' . $machine['id']); ?>"
                                    class="btn btn-success w-100"
                                >
                                    Lihat Machine
                                </a>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php endif; ?>

        </div>

    </div>

</div>

<?= $this->endSection(); ?>