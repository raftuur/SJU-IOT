<?= $this->extend('layouts/user'); ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/user/dashboard.css'); ?>">

<?= $this->endSection(); ?>


<?= $this->section('dashboard-content'); ?>

<?= $this->include('user/components/dashboard/stats-card'); ?>

<div class="dashboard-grid">

    <?= $this->include('user/components/dashboard/recent-transaction'); ?>

    <?= $this->include('user/components/dashboard/qrcode-card'); ?>

</div>

<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>

<script src="<?= base_url('assets/js/user/dashboard.js'); ?>"></script>

<?= $this->endSection(); ?>