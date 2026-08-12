<?= $this->extend('layouts/admin'); ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/dashboard.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/admin/panel.css'); ?>">

<?= $this->endSection(); ?>


<?= $this->section('dashboard-content'); ?>

<?= $this->include('admin/components/dashboard/stats-card'); ?>


<div class="dashboard-section">

    <?= $this->include('admin/components/dashboard/machine-status'); ?>

    <?= $this->include('admin/components/dashboard/active-session'); ?>

</div>


<div class="dashboard-section">

    <?= $this->include('admin/components/dashboard/sensor-monitoring'); ?>

</div>


<div class="dashboard-grid">

    <?= $this->include('admin/components/dashboard/chart'); ?>

    <?= $this->include('admin/components/dashboard/activity'); ?>

</div>

<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?= base_url('assets/js/admin/dashboard.js'); ?>"></script>

<?= $this->endSection(); ?>