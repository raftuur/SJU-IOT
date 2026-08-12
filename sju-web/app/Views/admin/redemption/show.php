<?= $this->extend('layouts/admin'); ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/dashboard.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/admin/panel.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/admin/redemption.css'); ?>">

<?= $this->endSection(); ?>


<?= $this->section('dashboard-content'); ?>

<div class="dashboard-panel">

    <div class="panel-header">

        <h5>
            <i class="bi bi-ticket-perforated me-2"></i>
            Detail Redemption
        </h5>

    </div>

    <div class="panel-body">

        <div class="row">

            <div class="col-md-5">

                <?php if (!empty($redemption['voucher_image'])): ?>

                    <img
                        src="<?= base_url('uploads/vouchers/' . $redemption['voucher_image']); ?>"
                        class="img-fluid rounded border">

                <?php else: ?>

                    <div class="text-center p-5 border rounded">

                        <i class="bi bi-image fs-1 text-muted"></i>

                        <p class="mt-3 mb-0 text-muted">
                            Tidak ada gambar voucher.
                        </p>

                    </div>

                <?php endif; ?>

            </div>

            <div class="col-md-7">

                <table class="table table-borderless">

                    <tr>
                        <th width="220">Kode Redemption</th>
                        <td><?= esc($redemption['redemption_code']) ?></td>
                    </tr>

                    <tr>
                        <th>Nama User</th>
                        <td><?= esc($redemption['fullname']) ?></td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td><?= esc($redemption['email']) ?></td>
                    </tr>

                    <tr>
                        <th>Voucher</th>
                        <td><?= esc($redemption['voucher_title']) ?></td>
                    </tr>

                    <tr>
                        <th>Point Digunakan</th>
                        <td><?= number_format($redemption['point'],0,',','.') ?></td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td><?= ucfirst($redemption['status']) ?></td>
                    </tr>

                    <tr>
                        <th>Redeemed At</th>
                        <td><?= esc($redemption['redeemed_at']) ?></td>
                    </tr>

                    <tr>
                        <th>Catatan</th>
                        <td><?= esc($redemption['notes'] ?? '-') ?></td>
                    </tr>

                </table>

                <div class="d-flex gap-2">

                    <?php if ($redemption['status'] === 'pending'): ?>

                        <form action="<?= site_url('redemption/approve/' . $redemption['id']); ?>" method="post">

                            <?= csrf_field(); ?>

                            <button type="submit" class="btn btn-success">

                                <i class="bi bi-check-circle"></i>

                                Approve

                            </button>

                        </form>

                        <form action="<?= site_url('redemption/reject/' . $redemption['id']); ?>" method="post">

                            <?= csrf_field(); ?>

                            <button
                                type="submit"
                                class="btn btn-danger"
                                onclick="return confirm('Yakin ingin menolak redemption ini?')">

                                <i class="bi bi-x-circle"></i>

                                Reject

                            </button>

                        </form>

                    <?php endif; ?>

                    <a href="<?= site_url('redemption'); ?>"
                       class="btn btn-secondary">

                        <i class="bi bi-arrow-left"></i>

                        Kembali

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>

<?= $this->endSection(); ?>