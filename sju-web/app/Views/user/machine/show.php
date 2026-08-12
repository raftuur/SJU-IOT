<?= $this->extend('layouts/user'); ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/user/machine.css'); ?>">

<?= $this->endSection(); ?>


<?= $this->section('dashboard-content'); ?>

<?= $this->include('user/components/machine/status-card'); ?>

<div class="row">

    <div class="col-lg-7">

        <?= $this->include('user/components/machine/detail'); ?>

    </div>

    <div class="col-lg-5">

        <?= $this->include('user/components/machine/usage-guide'); ?>

    </div>

</div>

<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>

<script src="<?= base_url('assets/js/user/machine.js'); ?>"></script>

<?= $this->endSection(); ?>