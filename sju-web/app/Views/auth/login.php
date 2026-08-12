<?= $this->extend('layouts/auth'); ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/auth/login.css'); ?>">

<?= $this->endSection(); ?>


<?= $this->section('auth-content'); ?>

<?= $this->include('auth/components/login-form'); ?>

<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>

<script src="<?= base_url('assets/js/auth/login.js'); ?>"></script>

<?= $this->endSection(); ?>