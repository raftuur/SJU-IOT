<?= $this->extend('layouts/user'); ?>


<?= $this->section('styles'); ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/user/withdrawal.css'); ?>">

<?= $this->endSection(); ?>


<?= $this->section('dashboard-content'); ?>

<div class="withdrawal-create-page">

    <?= $this->include(
        'user/components/withdrawal/form'
    ); ?>

</div>

<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>

<script
    src="<?= base_url('assets/js/user/withdrawal.js'); ?>">
</script>

<?= $this->endSection(); ?>