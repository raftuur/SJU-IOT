<?= $this->extend('layouts/admin'); ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/monitoring.css'); ?>">

<?= $this->endSection(); ?>

<?= $this->section('page-action'); ?>

<a href="<?= site_url('machine'); ?>"
   class="btn-custom btn-outline-custom">

    <i class="bi bi-hdd-network"></i>

    Daftar Machine

</a>

<?= $this->endSection(); ?>

<?= $this->section('dashboard-content'); ?>

<div class="row g-4 mb-4">

    <div class="col-lg-3 col-md-6">

        <div class="card">

            <div class="card-body">

                <small class="text-muted">
                    Total Machine
                </small>

                <h2 class="fw-bold mt-2">

                    <?= $totalMachine; ?>

                </h2>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="card">

            <div class="card-body">

                <small class="text-muted">
                    Online
                </small>

                <h2 class="fw-bold text-success mt-2">

                    <?= $online; ?>

                </h2>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="card">

            <div class="card-body">

                <small class="text-muted">
                    Offline
                </small>

                <h2 class="fw-bold text-danger mt-2">

                    <?= $offline; ?>

                </h2>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="card">

            <div class="card-body">

                <small class="text-muted">
                    Maintenance
                </small>

                <h2 class="fw-bold text-warning mt-2">

                    <?= $maintenance; ?>

                </h2>

            </div>

        </div>

    </div>

</div>

<?= $this->include('admin/components/monitoring/machine-card'); ?>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="<?= base_url('assets/js/admin/monitoring.js'); ?>"></script>

<?= $this->endSection(); ?>