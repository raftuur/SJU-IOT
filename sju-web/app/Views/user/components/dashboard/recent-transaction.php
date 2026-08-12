<div class="dashboard-panel">

    <div class="panel-header d-flex justify-content-between align-items-center">

        <h5>

            <i class="bi bi-clock-history me-2"></i>

            Transaksi Terbaru

        </h5>

        <a href="<?= site_url('user/transaction') ?>" class="btn btn-sm btn-success">

            Lihat Semua

        </a>

    </div>

    <div class="panel-body">

        <?php if (empty($transactions)) : ?>

            <?= $this->include('user/components/empty-state', [

                'title'       => 'Belum Ada Transaksi',

                'description' => 'Transaksi akan muncul setelah Anda menggunakan mesin Reverse Vending Machine.'

            ]) ?>

        <?php else : ?>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th>Kode</th>

                            <th>Point</th>

                            <th>Status</th>

                            <th>Tanggal</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($transactions as $trx) : ?>

                            <tr>

                                <td>

                                    <?= esc($trx['transaction_code'] ?? '-') ?>

                                </td>

                                <td>

                                    <?= number_format($trx['point_earned'] ?? 0) ?>

                                </td>

                                <td>

                                    <?php
                                        $status = strtolower($trx['status'] ?? 'pending');

                                        $badge = 'secondary';

                                        if ($status === 'success' || $status === 'completed') {
                                            $badge = 'success';
                                        } elseif ($status === 'pending') {
                                            $badge = 'warning';
                                        } elseif ($status === 'failed') {
                                            $badge = 'danger';
                                        }
                                    ?>

                                    <span class="badge bg-<?= $badge ?>">

                                        <?= ucfirst($status) ?>

                                    </span>

                                </td>

                                <td>

                                    <?= !empty($trx['created_at'])
                                        ? date('d M Y H:i', strtotime($trx['created_at']))
                                        : '-' ?>

                                </td>

                            </tr>

                        <?php endforeach ?>

                    </tbody>

                </table>

            </div>

        <?php endif ?>

    </div>

</div>