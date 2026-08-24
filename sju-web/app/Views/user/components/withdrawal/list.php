<div class="withdrawal-history">

    <div class="withdrawal-history-header">

        <div class="withdrawal-history-title">

            <i class="bi bi-cash-stack"></i>

            <h5>
                Riwayat Withdrawal
            </h5>

        </div>


        <a
            href="<?= site_url('user/withdrawal/create'); ?>"
            class="btn btn-success">

            <i class="bi bi-plus-lg me-1"></i>

            Ajukan Withdrawal

        </a>

    </div>


    <?php if (!empty($withdrawals)): ?>

        <div class="table-responsive">

            <table class="table withdrawal-table align-middle mb-0">

                <thead>

                    <tr>

                        <th>
                            Kode
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

                    <?php foreach ($withdrawals as $withdrawal): ?>

                        <tr>

                            <td>

                                <strong>
                                    <?= esc(
                                        $withdrawal['withdrawal_code']
                                    ); ?>
                                </strong>

                            </td>


                            <td class="text-center">

                                <?= number_format(
                                    $withdrawal['point_used'] ?? 0,
                                    0,
                                    ',',
                                    '.'
                                ); ?>

                            </td>


                            <td class="text-center">

                                <?php
                                    $status =
                                        strtolower(
                                            $withdrawal['status'] ?? ''
                                        );
                                ?>


                                <?php if ($status === 'pending'): ?>

                                    <span class="status-badge pending">
                                        Pending
                                    </span>

                                <?php elseif ($status === 'processing'): ?>

                                    <span class="status-badge processing">
                                        Processing
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

                                <?= !empty($withdrawal['created_at'])
                                    ? date(
                                        'd M Y',
                                        strtotime(
                                            $withdrawal['created_at']
                                        )
                                    )
                                    : '-'; ?>

                            </td>


                            <td class="text-center">

                                <a
                                    href="<?= site_url(
                                        'user/withdrawal/' .
                                        $withdrawal['id']
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


        <div class="withdrawal-empty">

            <div class="withdrawal-empty-icon">

                <i class="bi bi-wallet2"></i>

            </div>


            <h5>
                Belum Ada Withdrawal
            </h5>


            <p>
                Kamu belum pernah mengajukan withdrawal.
            </p>


            <a
                href="<?= site_url('user/withdrawal/create'); ?>"
                class="btn btn-success mt-3">

                <i class="bi bi-plus-lg me-1"></i>

                Ajukan Withdrawal

            </a>

        </div>


    <?php endif; ?>

</div>