<?= $this->extend('layouts/admin'); ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/machine.css'); ?>">

<?= $this->endSection(); ?>

<?= $this->section('page-action'); ?>

<a href="<?= site_url('machine'); ?>" class="btn-custom btn-outline-custom">

    <i class="bi bi-arrow-left"></i>

    Kembali

</a>

<?= $this->endSection(); ?>

<?= $this->section('dashboard-content'); ?>

<?= $this->include('admin/components/machine/detail'); ?>

<?= $this->endSection(); ?>