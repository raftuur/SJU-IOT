<?= $this->extend('layouts/user'); ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/user/reward.css'); ?>">

<?= $this->endSection(); ?>


<?= $this->section('dashboard-content'); ?>

<?= $this->include('user/components/reward/stats-card'); ?>

<?= $this->include('user/components/reward/filter'); ?>

<?= $this->include('user/components/reward/list'); ?>

<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>

<script src="<?= base_url('assets/js/user/reward.js'); ?>"></script>

<?= $this->endSection(); ?>