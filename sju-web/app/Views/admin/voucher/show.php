<?= $this->extend('layouts/admin'); ?>

<?= $this->section('dashboard-content'); ?>

<div class="dashboard-panel">

    <div class="panel-header">

        <h5>

            <i class="bi bi-gift me-2"></i>

            Detail Voucher

        </h5>

    </div>

    <div class="panel-body">

        <div class="row">

            <div class="col-md-4">

                <?php if (!empty($voucher['image'])): ?>

                    <img
                        src="<?= base_url('uploads/vouchers/'.$voucher['image']) ?>"
                        class="img-fluid rounded">

                <?php else: ?>

                    <div class="text-center py-5 border rounded">

                        <i class="bi bi-image fs-1 text-secondary"></i>

                        <p class="mt-3 mb-0">

                            Belum ada gambar

                        </p>

                    </div>

                <?php endif; ?>

            </div>

            <div class="col-md-8">

                <table class="table table-borderless">

                    <tr>

                        <th width="200">

                            Nama Voucher

                        </th>

                        <td>

                            <?= esc($voucher['title']) ?>

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Kode

                        </th>

                        <td>

                            <?= esc($voucher['code']) ?>

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Point

                        </th>

                        <td>

                            <?= number_format($voucher['point'],0,',','.') ?>

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Stok

                        </th>

                        <td>

                            <?= $voucher['stock'] ?>

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Redeemed

                        </th>

                        <td>

                            <?= $voucher['redeemed'] ?>

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Status

                        </th>

                        <td>

                            <?= ucfirst($voucher['status']) ?>

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Berlaku

                        </th>

                        <td>

                            <?= $voucher['start_date'] ?>

                            -

                            <?= $voucher['end_date'] ?>

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Deskripsi

                        </th>

                        <td>

                            <?= nl2br(esc($voucher['description'])) ?>

                        </td>

                    </tr>

                </table>

                <a
                    href="<?= site_url('voucher') ?>"
                    class="btn btn-secondary">

                    <i class="bi bi-arrow-left"></i>

                    Kembali

                </a>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection(); ?>