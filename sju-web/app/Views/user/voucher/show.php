<?= $this->extend('layouts/user'); ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/user/voucher.css'); ?>">

<?= $this->endSection(); ?>


<?= $this->section('dashboard-content'); ?>

<div class="row">

    <div class="col-lg-4">

        <div class="card-custom">

            <div class="card-body text-center">

                <?php if (!empty($voucher['image'])): ?>

                    <img
                        src="<?= base_url('uploads/vouchers/' . $voucher['image']); ?>"
                        class="img-fluid rounded voucher-detail-image"
                        alt="<?= esc($voucher['title']); ?>">

                <?php else: ?>

                    <div class="voucher-placeholder">

                        <i class="bi bi-image"></i>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>

    <div class="col-lg-8">

        <div class="card-custom">

            <div class="card-header-custom">

                <h4>

                    <?= esc($voucher['title']); ?>

                </h4>

            </div>

            <div class="card-body">

                <table class="table table-borderless">

                    <tr>

                        <th width="220">

                            Kode Voucher

                        </th>

                        <td>

                            <?= esc($voucher['code']); ?>

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Point

                        </th>

                        <td>

                            <?= number_format($voucher['point']); ?>

                            Point

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Stock

                        </th>

                        <td>

                            <?= esc($voucher['stock']); ?>

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Sudah Ditukar

                        </th>

                        <td>

                            <?= esc($voucher['redeemed']); ?>

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Berlaku

                        </th>

                        <td>

                            <?= date('d M Y', strtotime($voucher['start_date'])); ?>

                            -

                            <?= date('d M Y', strtotime($voucher['end_date'])); ?>

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Status

                        </th>

                        <td>

                            <?php if ($voucher['status'] == 'active'): ?>

                                <span class="badge bg-success">

                                    Aktif

                                </span>

                            <?php else: ?>

                                <span class="badge bg-danger">

                                    Tidak Aktif

                                </span>

                            <?php endif; ?>

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Deskripsi

                        </th>

                        <td>

                            <?= nl2br(esc($voucher['description'])); ?>

                        </td>

                    </tr>

                </table>

                <div class="mt-4 d-flex gap-2">

                    <a
                        href="<?= site_url('user/voucher'); ?>"
                        class="btn btn-secondary">

                        <i class="bi bi-arrow-left"></i>

                        Kembali

                    </a>

                    <form
                        action="<?= site_url('user/voucher/redeem/' . $voucher['id']); ?>"
                        method="post"
                        onsubmit="return confirm('Apakah Anda yakin ingin menukarkan voucher ini?');">

                        <?= csrf_field(); ?>

                        <button
                            type="submit"
                            class="btn btn-success">

                            <i class="bi bi-gift"></i>

                            Tukarkan Voucher

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>

<script src="<?= base_url('assets/js/user/voucher.js'); ?>"></script>

<?= $this->endSection(); ?>