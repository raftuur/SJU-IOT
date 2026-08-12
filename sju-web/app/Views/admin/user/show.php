<?= $this->extend('layouts/admin'); ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/user.css'); ?>">

<?= $this->endSection(); ?>

<?= $this->section('page-action'); ?>

<a href="<?= site_url('user'); ?>" class="btn-custom btn-outline-custom">

    <i class="bi bi-arrow-left"></i>

    Kembali

</a>

<?= $this->endSection(); ?>

<?= $this->section('dashboard-content'); ?>

<div class="card">

    <div class="card-header">

        <div>

            <h5 class="card-title">
                Detail User
            </h5>

            <p class="card-subtitle">
                Informasi lengkap pengguna.
            </p>

        </div>

    </div>

    <div class="card-body">

        <div class="row g-4">

            <div class="col-md-6">

                <label class="form-label-custom">
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    class="form-control-custom"
                    value="<?= esc($user['fullname']); ?>"
                    readonly>

            </div>

            <div class="col-md-6">

                <label class="form-label-custom">
                    Username
                </label>

                <input
                    type="text"
                    class="form-control-custom"
                    value="<?= esc($user['username']); ?>"
                    readonly>

            </div>

            <div class="col-md-6">

                <label class="form-label-custom">
                    Email
                </label>

                <input
                    type="text"
                    class="form-control-custom"
                    value="<?= esc($user['email']); ?>"
                    readonly>

            </div>

            <div class="col-md-6">

                <label class="form-label-custom">
                    Role
                </label>

                <input
                    type="text"
                    class="form-control-custom"
                    value="<?= ucfirst($user['role']); ?>"
                    readonly>

            </div>

            <div class="col-md-6">

                <label class="form-label-custom">
                    Status
                </label>

                <input
                    type="text"
                    class="form-control-custom"
                    value="<?= ucfirst($user['status']); ?>"
                    readonly>

            </div>

            <div class="col-md-6">

                <label class="form-label-custom">
                    Terdaftar
                </label>

                <input
                    type="text"
                    class="form-control-custom"
                    value="<?= date('d F Y H:i', strtotime($user['created_at'])); ?>"
                    readonly>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection(); ?>