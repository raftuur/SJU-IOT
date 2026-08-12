<?= $this->extend('layouts/admin'); ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/user.css'); ?>">

<?= $this->endSection(); ?>

<?= $this->section('page-action'); ?>

<a href="<?= site_url('user/create'); ?>" class="btn-custom btn-primary-custom">
    <i class="bi bi-plus-lg"></i>
    Tambah User
</a>

<?= $this->endSection(); ?>

<?= $this->section('dashboard-content'); ?>

<?= $this->include('admin/components/user/filter'); ?>
<?= $this->include('admin/components/user/table'); ?>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>

<script src="<?= base_url('assets/js/admin/user.js'); ?>"></script>

<?= $this->endSection(); ?>