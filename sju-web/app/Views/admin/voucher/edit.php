<?= $this->extend('layouts/admin'); ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/dashboard.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/admin/form.css'); ?>">

<?= $this->endSection(); ?>


<?= $this->section('dashboard-content'); ?>

<div class="dashboard-panel">

    <div class="panel-header">

        <h5>

            <i class="bi bi-pencil-square me-2"></i>

            Edit Voucher

        </h5>

    </div>

    <div class="panel-body">

        <?php if (session()->has('error')): ?>

            <div class="alert alert-danger">

                <?= session('error'); ?>

            </div>

        <?php endif; ?>

        <?php if (session()->has('errors')): ?>

            <div class="alert alert-danger">

                <ul class="mb-0">

                    <?php foreach (session('errors') as $error): ?>

                        <li><?= esc($error) ?></li>

                    <?php endforeach; ?>

                </ul>

            </div>

        <?php endif; ?>

        <form action="<?= site_url('voucher/edit/'.$voucher['id']); ?>" method="post" enctype="multipart/form-data">

            <?= csrf_field(); ?>

            <div class="mb-3">

                <label class="form-label">Nama Voucher</label>

                <input
                    type="text"
                    name="title"
                    class="form-control"
                    value="<?= esc($voucher['title']); ?>"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">Kode Voucher</label>

                <input
                    type="text"
                    name="code"
                    class="form-control"
                    value="<?= esc($voucher['code']); ?>"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">Deskripsi</label>

                <textarea
                    name="description"
                    rows="4"
                    class="form-control"><?= esc($voucher['description']); ?></textarea>

            </div>

            <div class="row">

                <div class="col-md-6">

                    <label class="form-label">Point</label>

                    <input
                        type="number"
                        name="point"
                        class="form-control"
                        value="<?= $voucher['point']; ?>"
                        required>

                </div>

                <div class="col-md-6">

                    <label class="form-label">Stok</label>

                    <input
                        type="number"
                        name="stock"
                        class="form-control"
                        value="<?= $voucher['stock']; ?>"
                        required>

                </div>

            </div>

            <div class="row mt-3">

                <div class="col-md-6">

                    <label class="form-label">Mulai Berlaku</label>

                    <input
                        type="datetime-local"
                        name="start_date"
                        class="form-control"
                        value="<?= !empty($voucher['start_date']) ? date('Y-m-d\TH:i', strtotime($voucher['start_date'])) : ''; ?>">

                </div>

                <div class="col-md-6">

                    <label class="form-label">Berakhir</label>

                    <input
                        type="datetime-local"
                        name="end_date"
                        class="form-control"
                        value="<?= !empty($voucher['end_date']) ? date('Y-m-d\TH:i', strtotime($voucher['end_date'])) : ''; ?>">

                </div>

            </div>

            <div class="mt-3">

                <label class="form-label">Status</label>

                <select name="status" class="form-select">

                    <option value="active" <?= $voucher['status'] === 'active' ? 'selected' : ''; ?>>

                        Aktif

                    </option>

                    <option value="inactive" <?= $voucher['status'] === 'inactive' ? 'selected' : ''; ?>>

                        Nonaktif

                    </option>

                </select>

            </div>

            <div class="mt-3">

                <label class="form-label">

                    Gambar Voucher

                </label>

                <?php if (!empty($voucher['image'])): ?>

                    <div class="mb-2">

                        <img
                            src="<?= base_url('uploads/vouchers/' . $voucher['image']); ?>"
                            alt="Voucher"
                            style="max-width:200px"
                            class="img-thumbnail">

                    </div>

                <?php endif; ?>

                <input
                    type="file"
                    name="image"
                    class="form-control"
                    accept=".jpg,.jpeg,.png">

                <small class="text-muted">

                    Kosongkan jika tidak ingin mengganti gambar.

                </small>

            </div>

            <div class="mt-4">

                <button type="submit" class="btn btn-success">

                    <i class="bi bi-save"></i>

                    Update Voucher

                </button>

                <a href="<?= site_url('voucher'); ?>" class="btn btn-secondary">

                    Kembali

                </a>

            </div>

        </form>

    </div>

</div>

<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>

<?= $this->endSection(); ?>