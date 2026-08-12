<?= $this->extend('layouts/admin'); ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/dashboard.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/admin/panel.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/admin/ai-detection.css'); ?>">

<?= $this->endSection(); ?>


<?= $this->section('dashboard-content'); ?>

<?= $this->include('admin/components/ai_detection/stats-card'); ?>

<?= $this->include('admin/components/ai_detection/upload-card'); ?>

<?= $this->include('admin/components/ai_detection/table'); ?>

<?= $this->include('admin/components/ai_detection/detail-modal'); ?>

<?= $this->include('admin/components/ai_detection/image-modal'); ?>

<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>

<script src="<?= base_url('assets/js/admin/ai-detection.js'); ?>"></script>

<?= $this->endSection(); ?>