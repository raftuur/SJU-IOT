<?= $this->extend('layouts/admin'); ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/monitoring.css'); ?>">

<?= $this->endSection(); ?>

<?= $this->section('page-action'); ?>

<div class="d-flex gap-2">

    <a href="<?= site_url('monitoring'); ?>"
       class="btn-custom btn-outline-custom">

        <i class="bi bi-arrow-left"></i>

        Kembali

    </a>

</div>

<?= $this->endSection(); ?>

<?= $this->section('dashboard-content'); ?>

<?= $this->include('admin/components/monitoring/status-card'); ?>

<?= $this->include('admin/components/monitoring/statistic-card'); ?>

<div class="row g-4 mt-1">

    <div class="col-lg-6">

        <?= $this->include('admin/components/monitoring/live-camera-card'); ?>

    </div>

    <div class="col-lg-6">

        <?= $this->include('admin/components/monitoring/sensor-card'); ?>

    </div>

</div>

<div class="row g-4 mt-4">

    <div class="col-lg-6">

        <?= $this->include('admin/components/monitoring/activity-card'); ?>

    </div>

</div>

<?= $this->include('admin/components/monitoring/chart-card'); ?>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="<?= base_url('assets/js/admin/monitoring.js'); ?>"></script>

<?= $this->endSection(); ?>