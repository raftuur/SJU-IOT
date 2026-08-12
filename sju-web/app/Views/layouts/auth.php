<?= $this->extend('layouts/guest'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">

    <div class="row min-vh-100">

        <?= $this->include('auth/components/branding'); ?>

        <div class="col-lg-6 col-12 d-flex align-items-center justify-content-center">

            <?= $this->renderSection('auth-content'); ?>

        </div>

    </div>

</div>

<?= $this->endSection(); ?>