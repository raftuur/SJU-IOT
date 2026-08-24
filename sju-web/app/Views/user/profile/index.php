<?= $this->extend('layouts/user'); ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/user/profile.css'); ?>">

<?= $this->endSection(); ?>


<?= $this->section('dashboard-content'); ?>

<div class="dashboard-panel">

    <div class="panel-header">

        <h5>
            <i class="bi bi-person me-2"></i>
            Profile Saya
        </h5>

    </div>


    <div class="panel-body">

        <div class="row g-4">

            <div class="col-lg-8">

                <?= $this->include('user/components/profile/profile-info'); ?>

            </div>


            <div class="col-lg-4">

                <?= $this->include('user/components/profile/profile-summary'); ?>

            </div>

        </div>


        <div class="mt-4">

            <?= $this->include('user/components/profile/security'); ?>

        </div>

    </div>

</div>

<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>

<script src="<?= base_url('assets/js/user/profile.js'); ?>"></script>

<?= $this->endSection(); ?>