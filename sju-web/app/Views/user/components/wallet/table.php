<div class="dashboard-panel">

    <div class="panel-header">

        <h5>

            <i class="bi bi-clock-history me-2"></i>

            Riwayat Transaksi Wallet

        </h5>

    </div>

    <div class="panel-body">

        <?php if (!empty($histories)): ?>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th width="180">Tanggal</th>

                            <th width="120">Tipe</th>

                            <th class="text-end">Point</th>

                            <th class="text-end">Saldo Akhir</th>

                            <th>Keterangan</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($histories as $history): ?>

                            <?php

                                $badge = 'secondary';

                                switch ($history['type']) {

                                    case 'earn':
                                        $badge = 'success';
                                        break;

                                    case 'redeem':
                                        $badge = 'warning';
                                        break;

                                    case 'withdraw':
                                        $badge = 'primary';
                                        break;

                                }

                            ?>

                            <tr>

                                <td>

                                    <?= date('d M Y H:i', strtotime($history['created_at'])) ?>

                                </td>

                                <td>

                                    <span class="badge bg-<?= $badge ?>">

                                        <?= ucfirst($history['type']) ?>

                                    </span>

                                </td>

                                <td class="text-end">

                                    <?= number_format($history['point'], 0, ',', '.') ?>

                                </td>

                                <td class="text-end">

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

                'title' => 'Belum Ada Riwayat Transaksi',

                'description' => 'Riwayat transaksi wallet Anda akan muncul di sini.'

            ]) ?>

        <?php endif; ?>

    </div>

</div>