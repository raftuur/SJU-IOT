<?= $this->extend('layouts/user'); ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/user/reward.css'); ?>">

<?= $this->endSection(); ?>


<?= $this->section('dashboard-content'); ?>

<div class="dashboard-panel">

    <div class="panel-header">

        <h5>

            <i class="bi bi-gift me-2"></i>

            Detail Reward

        </h5>

    </div>

    <div class="panel-body">

        <div class="row">

            <div class="col-lg-4">

                <?php if (!empty($reward['voucher_image'])): ?>

                    <img
                        src="<?= base_url('uploads/vouchers/'.$reward['voucher_image']); ?>"
                        class="img-fluid rounded-4 shadow-sm">

                <?php else: ?>

                    <div class="empty-image">

                        <i class="bi bi-image"></i>

                        <p>

                            Tidak ada gambar

                        </p>

                    </div>

                <?php endif; ?>

            </div>

            <div class="col-lg-8">

                <table class="table table-borderless detail-table">

                    <tr>

                        <th width="220">

                            Kode Redemption

                        </th>

                        <td>

                            <?= esc($reward['redemption_code']); ?>

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Voucher

                        </th>

                        <td>

                            <?= esc($reward['voucher_title']); ?>

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Point

                        </th>

                        <td>

                            <?= number_format($reward['point'],0,',','.'); ?>

                            Point

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Status

                        </th>

                        <td>

                            <?php if($reward['status']=='pending'): ?>

                                <span class="status-badge pending">

                                    Pending

                                </span>

                            <?php elseif($reward['status']=='completed'): ?>

                                <span class="status-badge success">

                                    Completed

                                </span>

                            <?php else: ?>

                                <span class="status-badge danger">

                                    Rejected

                                </span>

                            <?php endif; ?>

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Tanggal Penukaran

                        </th>

                        <td>

                            <?= date('d F Y H:i',strtotime($reward['redeemed_at'])); ?>

                        </td>

                    </tr>

                    <?php if(!empty($reward['completed_at'])): ?>

                    <tr>

                        <th>

                            Diproses

                        </th>

                        <td>

                            <?= date('d F Y H:i',strtotime($reward['completed_at'])); ?>

                        </td>

                    </tr>

                    <?php endif; ?>

                    <?php if(!empty($reward['notes'])): ?>

                    <tr>

                        <th>

                            Catatan Admin

                        </th>

                        <td>

                            <?= nl2br(esc($reward['notes'])); ?>

                        </td>

                    </tr>

                    <?php endif; ?>

                </table>

                <a
                    href="<?= site_url('user/reward'); ?>"
                    class="btn-back">

                    <i class="bi bi-arrow-left"></i>

                    Kembali

                </a>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>

<script src="<?= base_url('assets/js/user/reward.js'); ?>"></script>

<?= $this->endSection(); ?>