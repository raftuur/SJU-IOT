<?= $this->extend('layouts/admin'); ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/dashboard.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/admin/panel.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/admin/voucher.css'); ?>">

<?= $this->endSection(); ?>


<?= $this->section('page-action'); ?>

<div class="d-flex gap-2">

    <a href="<?= site_url('voucher/create'); ?>"
       class="btn-custom btn-primary-custom">

        <i class="bi bi-plus-lg"></i>

        Tambah Voucher

    </a>

</div>

<?= $this->endSection(); ?>


<?= $this->section('dashboard-content'); ?>

<?= $this->include('admin/components/voucher/stats-card'); ?>

<?= $this->include('admin/components/voucher/table'); ?>

<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>

<script src="<?= base_url('assets/js/admin/voucher.js'); ?>"></script>

<?= $this->endSection(); ?>