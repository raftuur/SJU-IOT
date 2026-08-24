<?= $this->extend('layouts/guest'); ?>

<?= $this->section('styles'); ?>

<!-- Admin -->
<link rel="stylesheet" href="<?= base_url('assets/css/admin/dashboard.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/admin/sidebar.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/admin/navbar.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/admin/user.css'); ?>">

<!-- Components -->
<link rel="stylesheet" href="<?= base_url('assets/css/components/page-header.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/components/breadcrumb.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/components/card.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/components/button.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/components/badge.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/components/form.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/components/table.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/components/pagination.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/components/modal.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/components/alert.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/components/empty-state.css'); ?>">

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="dashboard-wrapper">

    <?= $this->include('admin/components/sidebar'); ?>

    <div class="dashboard-content">

        <?= $this->include('admin/components/navbar'); ?>

        <main class="dashboard-main">

            <?= $this->include('admin/components/page-header'); ?>

            <?= $this->include('admin/components/flash-message'); ?>

            <?= $this->renderSection('dashboard-content'); ?>

        </main>

    </div>

</div>

<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>

<?= $this->renderSection('scripts'); ?>

<?= $this->endSection(); ?>