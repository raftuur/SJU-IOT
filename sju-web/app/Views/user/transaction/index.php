<?= $this->extend('layouts/user'); ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/user/transaction.css'); ?>">

<?= $this->endSection(); ?>


<?= $this->section('dashboard-content'); ?>

<?= $this->include('user/components/transaction/filter'); ?>

<?= $this->include('user/components/transaction/list'); ?>

<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>

<script src="<?= base_url('assets/js/user/transaction.js'); ?>"></script>

<?= $this->endSection(); ?>