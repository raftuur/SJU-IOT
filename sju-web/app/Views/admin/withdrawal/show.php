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

            <i class="bi bi-cash-stack me-2"></i>

            Detail Withdrawal

        </h5>

    </div>

    <div class="panel-body">

        <div class="row">

            <div class="col-md-7">

                <table class="table table-borderless">

                    <tr>
                        <th width="220">Kode Withdrawal</th>
                        <td><?= esc($withdrawal['withdrawal_code']) ?></td>
                    </tr>

                    <tr>
                        <th>Nama User</th>
                        <td><?= esc($withdrawal['fullname']) ?></td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td><?= esc($withdrawal['email']) ?></td>
                    </tr>

                    <tr>
                        <th>Saldo Wallet</th>
                        <td>Rp <?= number_format($withdrawal['balance'],0,',','.') ?></td>
                    </tr>

                    <tr>
                        <th>Nominal Withdrawal</th>
                        <td>Rp <?= number_format($withdrawal['amount'],0,',','.') ?></td>
                    </tr>

                    <tr>
                        <th>Bank</th>
                        <td><?= esc($withdrawal['bank_code']) ?></td>
                    </tr>

                    <tr>
                        <th>Nama Rekening</th>
                        <td><?= esc($withdrawal['account_name']) ?></td>
                    </tr>

                    <tr>
                        <th>Nomor Rekening</th>
                        <td><?= esc($withdrawal['account_number']) ?></td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td><?= ucfirst($withdrawal['status']) ?></td>
                    </tr>

                    <tr>
                        <th>Requested At</th>
                        <td><?= esc($withdrawal['requested_at']) ?></td>
                    </tr>

                    <tr>
                        <th>Processed At</th>
                        <td><?= esc($withdrawal['processed_at'] ?? '-') ?></td>
                    </tr>

                    <tr>
                        <th>Completed At</th>
                        <td><?= esc($withdrawal['completed_at'] ?? '-') ?></td>
                    </tr>

                    <tr>
                        <th>External ID</th>
                        <td><?= esc($withdrawal['external_id'] ?? '-') ?></td>
                    </tr>

                    <tr>
                        <th>Xendit ID</th>
                        <td><?= esc($withdrawal['xendit_disbursement_id'] ?? '-') ?></td>
                    </tr>

                    <tr>
                        <th>Reference Number</th>
                        <td><?= esc($withdrawal['reference_number'] ?? '-') ?></td>
                    </tr>

                    <tr>
                        <th>Failure Reason</th>
                        <td><?= esc($withdrawal['failure_reason'] ?? '-') ?></td>
                    </tr>

                </table>

                <div class="d-flex gap-2">

                    <?php if ($withdrawal['status'] === 'pending'): ?>

                        <form action="<?= site_url('withdrawal/approve/' . $withdrawal['id']); ?>" method="post">

                            <?= csrf_field(); ?>

                            <button type="submit" class="btn btn-success">

                                <i class="bi bi-check-circle"></i>

                                Approve

                            </button>

                        </form>

                    <?php endif; ?>

                    <a href="<?= site_url('withdrawal'); ?>"
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