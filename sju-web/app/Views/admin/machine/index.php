<?= $this->extend('layouts/admin'); ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/machine.css'); ?>">

<?= $this->endSection(); ?>

<?= $this->section('page-action'); ?>

<div class="d-flex gap-2">

    <a href="<?= site_url('machine/trash'); ?>"
       class="btn-custom btn-danger-custom">

        <i class="bi bi-trash"></i>

        Trash

    </a>

    <a href="<?= site_url('machine/create'); ?>"
       class="btn-custom btn-primary-custom">

        <i class="bi bi-plus-lg"></i>

        Tambah Machine

    </a>

</div>

<?= $this->endSection(); ?>

<?= $this->section('dashboard-content'); ?>

<?= $this->include('admin/components/machine/filter'); ?>

<?= $this->include('admin/components/machine/table'); ?>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>

<script src="<?= base_url('assets/js/admin/machine.js'); ?>"></script>

<?= $this->endSection(); ?>