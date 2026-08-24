<?= $this->extend('layouts/admin'); ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/dashboard.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/admin/panel.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/admin/setting.css'); ?>">

<?= $this->endSection(); ?>


<?= $this->section('dashboard-content'); ?>

<form
    action="<?= site_url('setting/update'); ?>"
    method="post">

    <?= csrf_field(); ?>

    <?= $this->include('admin/components/setting/system-card'); ?>

    <?= $this->include('admin/components/setting/point-card'); ?>

    <?= $this->include('admin/components/setting/ai-card'); ?>

    <?= $this->include('admin/components/setting/machine-card'); ?>

    <div class="setting-save-all">

        <button
            type="submit"
            class="btn-custom btn-primary-custom">

            <i class="bi bi-save me-1"></i>

            Simpan Semua Pengaturan

        </button>

    </div>

</form>

<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>

<script src="<?= base_url('assets/js/admin/setting.js'); ?>"></script>

<?= $this->endSection(); ?>