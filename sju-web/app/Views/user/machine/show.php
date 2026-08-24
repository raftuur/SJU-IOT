<?= $this->extend('layouts/user'); ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/user/machine.css'); ?>">

<?= $this->endSection(); ?>


<?= $this->section('dashboard-content'); ?>

<?= $this->include('user/components/machine/detail'); ?>

<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>

<?= $this->endSection(); ?>