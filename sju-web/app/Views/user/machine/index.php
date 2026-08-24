<?= $this->extend('layouts/user'); ?>

<?= $this->section('styles'); ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/user/machine.css'); ?>">

<?= $this->endSection(); ?>


<?= $this->section('dashboard-content'); ?>

<div class="machine-page">

    <div class="machine-panel">

        <div class="machine-panel-header">

            <h5>
                <i class="bi bi-cpu"></i>
                Machine Tersedia
            </h5>

        </div>

        <div class="machine-panel-body">

            <?= $this->include(
                'user/components/machine/list'
            ); ?>

        </div>

    </div>

</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>

<?= $this->endSection(); ?>