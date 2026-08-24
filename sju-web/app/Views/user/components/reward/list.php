<div class="reward-history-panel">

    <div class="reward-history-header">

        <div class="reward-history-title">

            <h5>
                <i class="bi bi-clock-history"></i>
                Riwayat Reward
            </h5>

        </div>


        <span class="total-badge">

            Total : <?= count($rewards); ?> Reward

        </span>

    </div>


    <div class="reward-history-body">

        <?php if (!empty($rewards)): ?>

            <div class="table-responsive">

                <table class="table reward-table">

                    <thead>

                        <tr>

                            <th>
                                Kode
                            </th>

                            <th>
                                Voucher
                            </th>

                            <th class="text-center">
                                Point
                            </th>

                            <th class="text-center">
                                Status
                            </th>

                            <th class="text-center">
                                Tanggal
                            </th>

                            <th class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php foreach ($rewards as $reward): ?>

                            <tr>

                                <td>

                                    <strong>
                                        <?= esc(
                                            $reward['redemption_code']
                                        ); ?>
                                    </strong>

                                </td>


                                <td>

                                    <?= esc(
                                        $reward['voucher_title']
                                    ); ?>

                                </td>


                                <td class="text-center">

                                    <?= number_format(
                                        $reward['point'],
                                        0,
                                        ',',
                                        '.'
                                    ); ?>

                                </td>


                                <td class="text-center">

                                    <?php
                                    $status =
                                        strtolower(
                                            $reward['status'] ?? ''
                                        );
                                    ?>

                                    <?php if ($status === 'pending'): ?>

                                        <span class="status-badge pending">
                                            Pending
                                        </span>

                                    <?php elseif ($status === 'completed'): ?>

                                        <span class="status-badge success">
                                            Completed
                                        </span>

                                    <?php else: ?>

                                        <span class="status-badge danger">
                                            Rejected
                                        </span>

                                    <?php endif; ?>

                                </td>


                                <td class="text-center">

                                    <?= !empty(
                                        $reward['redeemed_at']
                                    )
                                        ? date(
                                            'd M Y',
                                            strtotime(
                                                $reward['redeemed_at']
                                            )
                                        )
                                        : '-'; ?>

                                </td>


                                <td class="text-center">

                                    <a
                                        href="<?= site_url(
                                            'user/reward/' .
                                            $reward['id']
                                        ); ?>"
                                        class="btn-detail">

                                        <i class="bi bi-eye"></i>

                                        Detail

                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        <?php else: ?>

            <?= $this->include(
                'user/components/empty-state',
                [
                    'title' => 'Belum Ada Reward',

                    'description' =>
                        'Anda belum pernah melakukan penukaran voucher.',

                    'button' => [
                        'url' =>
                            site_url('user/voucher'),

                        'text' =>
                            'Tukarkan Voucher'
                    ]
                ]
            ) ?>

        <?php endif; ?>

    </div>

</div>