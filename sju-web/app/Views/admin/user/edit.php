<?= $this->extend('layouts/admin'); ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/user.css'); ?>">

<?= $this->endSection(); ?>

<?= $this->section('page-action'); ?>

<a href="<?= site_url('user'); ?>" class="btn-custom btn-outline-custom">

    <i class="bi bi-arrow-left"></i>

    Kembali

</a>

<?= $this->endSection(); ?>

<?= $this->section('dashboard-content'); ?>

<?= $this->include('admin/components/user/edit-form'); ?>

<?= $this->endSection(); ?>