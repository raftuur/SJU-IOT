<div class="wallet-history-panel">

    <div class="wallet-history-header">

        <h5>
            <i class="bi bi-clock-history"></i>
            Riwayat Transaksi Wallet
        </h5>

    </div>


    <div class="wallet-history-body">

        <?php if (!empty($histories)): ?>

            <div class="table-responsive">

                <table class="wallet-history-table">

                    <thead>

                        <tr>

                            <th>
                                Tanggal
                            </th>

                            <th>
                                Tipe
                            </th>

                            <th class="text-end">
                                Point
                            </th>

                            <th class="text-end">
                                Saldo Akhir
                            </th>

                            <th>
                                Keterangan
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php foreach ($histories as $history): ?>

                            <?php

                            $type = strtolower(
                                $history['type'] ?? ''
                            );

                            $badge = 'secondary';

                            if ($type === 'earn') {
                                $badge = 'success';
                            } elseif ($type === 'redeem') {
                                $badge = 'warning';
                            } elseif ($type === 'withdraw') {
                                $badge = 'primary';
                            }

                            ?>

                            <tr>

                                <td>

                                    <?= !empty($history['created_at'])
                                        ? date(
                                            'd M Y H:i',
                                            strtotime(
                                                $history['created_at']
                                            )
                                        )
                                        : '-'; ?>

                                </td>


                                <td>

                                    <span class="wallet-type-badge <?= $badge ?>">

                                        <?= ucfirst($type ?: '-'); ?>

                                    </span>

                                </td>


                                <td class="text-end">

                                    <?= number_format(
                                        $history['point'] ?? 0,
                                        0,
                                        ',',
                                        '.'
                                    ); ?>

                                </td>


                                <td class="text-end">

                                    <?= number_format(
                                        $history['balance_after'] ?? 0,
                                        0,
                                        ',',
                                        '.'
                                    ); ?>

                                </td>


                                <td>

                                    <?= esc(
                                        $history['description'] ?? '-'
                                    ); ?>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        <?php else: ?>

            <div class="wallet-empty">

                <div class="wallet-empty-icon">

                    <i class="bi bi-wallet2"></i>

                </div>

                <h5>
                    Belum Ada Riwayat Transaksi
                </h5>

                <p>
                    Riwayat transaksi wallet Anda akan muncul di sini.
                </p>

            </div>

        <?php endif; ?>

    </div>

</div>