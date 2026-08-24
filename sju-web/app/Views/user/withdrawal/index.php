<?= $this->extend('layouts/user'); ?>


<?= $this->section('styles'); ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/user/withdrawal.css'); ?>">

<?= $this->endSection(); ?>


<?= $this->section('dashboard-content'); ?>

<div class="withdrawal-page">

    <?= $this->include(
        'user/components/withdrawal/stats-card'
    ); ?>


    <?= $this->include(
        'user/components/withdrawal/filter'
    ); ?>


    <?= $this->include(
        'user/components/withdrawal/list'
    ); ?>

</div>


<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>

<script
    src="<?= base_url('assets/js/user/withdrawal.js'); ?>">
</script>

<?= $this->endSection(); ?>