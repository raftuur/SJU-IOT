<?= $this->extend('layouts/admin'); ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/dashboard.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/admin/user.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/components/table.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/components/button.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/components/card.css'); ?>">

<?= $this->endSection(); ?>


<?= $this->section('dashboard-content'); ?>

<?= $this->include('admin/components/withdrawal/stats-card'); ?>

<?= $this->include('admin/components/withdrawal/table'); ?>

<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>

<?= $this->endSection(); ?>