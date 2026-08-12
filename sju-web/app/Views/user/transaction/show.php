<?= $this->extend('layouts/user'); ?>

<?= $this->section('styles'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/user/transaction.css'); ?>">

<?= $this->endSection(); ?>


<?= $this->section('dashboard-content'); ?>

<div class="card-custom">

    <div class="card-header-custom d-flex justify-content-between align-items-center">

        <div>

            <h4 class="mb-1">

                Detail Transaction

            </h4>

            <p class="text-muted mb-0">

                Informasi lengkap transaksi Reverse Vending Machine.

            </p>

        </div>

        <a
            href="<?= site_url('user/transaction'); ?>"
            class="btn btn-success">

            <i class="bi bi-arrow-left"></i>

            Kembali

        </a>

    </div>

    <div class="card-body">

        <table class="table table-borderless">

            <tr>

                <th width="250">Kode Transaction</th>

                <td><?= esc($transaction['transaction_code']); ?></td>

            </tr>

            <tr>

                <th>Machine</th>

                <td><?= esc($transaction['machine_name']); ?></td>

            </tr>

            <tr>

                <th>Lokasi</th>

                <td><?= esc($transaction['location']); ?></td>

            </tr>

            <tr>

                <th>Jumlah Botol</th>

                <td><?= esc($transaction['bottle_count']); ?></td>

            </tr>

            <tr>

                <th>Berat</th>

                <td><?= esc($transaction['weight']); ?> Kg</td>

            </tr>

            <tr>

                <th>Point</th>

                <td><?= esc($transaction['point_earned']); ?></td>

            </tr>

            <tr>

                <th>Status</th>

                <td>

                    <span class="badge-status status-<?= esc($transaction['status']); ?>">

                        <?= ucfirst($transaction['status']); ?>

                    </span>

                </td>

            </tr>

            <tr>

                <th>Tanggal</th>

                <td>

                    <?= date('d M Y H:i', strtotime($transaction['created_at'])); ?>

                </td>

            </tr>

        </table>

    </div>

</div>

<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>

<script src="<?= base_url('assets/js/user/transaction.js'); ?>"></script>

<?= $this->endSection(); ?>