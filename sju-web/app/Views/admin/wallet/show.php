<?= $this->extend('layouts/admin'); ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin/dashboard.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/admin/panel.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/admin/wallet.css'); ?>">

<?= $this->endSection(); ?>


<?= $this->section('dashboard-content'); ?>

<div class="dashboard-panel">

    <div class="panel-header">

        <h5>

            <i class="bi bi-wallet2 me-2"></i>

            Informasi Wallet

        </h5>

    </div>

    <div class="panel-body">

        <table class="table table-borderless">

            <tr>

                <th width="220">Nama</th>

                <td><?= esc($wallet['fullname']); ?></td>

            </tr>

            <tr>

                <th>Username</th>

                <td><?= esc($wallet['username']); ?></td>

            </tr>

            <tr>

                <th>Email</th>

                <td><?= esc($wallet['email']); ?></td>

            </tr>

            <tr>

                <th>Saldo Point</th>

                <td>

                    <?= number_format($wallet['balance'],0,',','.'); ?>

                </td>

            </tr>

            <tr>

                <th>Total Point Masuk</th>

                <td>

                    <?= number_format($wallet['total_earned'],0,',','.'); ?>

                </td>

            </tr>

            <tr>

                <th>Total Point Ditukar</th>

                <td>

                    <?= number_format($wallet['total_redeemed'],0,',','.'); ?>

                </td>

            </tr>

        </table>

    </div>

</div>

<div class="dashboard-panel mt-4">

    <div class="panel-header">

        <h5>

            <i class="bi bi-clock-history me-2"></i>

            Riwayat Wallet

        </h5>

    </div>

    <div class="panel-body">

        <?php if (!empty($histories)): ?>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th>Tanggal</th>

                            <th>Tipe</th>

                            <th class="text-center">Point</th>

                            <th class="text-center">Saldo Sebelum</th>

                            <th class="text-center">Saldo Sesudah</th>

                            <th>Keterangan</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($histories as $history): ?>

                            <tr>

                                <td>

                                    <?= date('d M Y H:i', strtotime($history['created_at'])) ?>

                                </td>

                                <td>

                                    <?= ucfirst($history['type']) ?>

                                </td>

                                <td class="text-center">

                                    <?= number_format($history['point'], 0, ',', '.') ?>

                                </td>

                                <td class="text-center">

                                    <?= number_format($history['balance_before'], 0, ',', '.') ?>

                                </td>

                                <td class="text-center">

                                    <?= number_format($history['balance_after'], 0, ',', '.') ?>

                                </td>

                                <td>

                                    <?= esc($history['description']) ?>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        <?php else: ?>

            <?= $this->include('admin/components/empty-state', [

                'title' => 'Belum Ada Riwayat',

                'description' => 'Belum ada perubahan saldo pada wallet ini.'

            ]) ?>

        <?php endif; ?>

    </div>

</div>

<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>

<?= $this->endSection(); ?>