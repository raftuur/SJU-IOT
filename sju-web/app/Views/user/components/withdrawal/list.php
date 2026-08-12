<div class="dashboard-panel">

    <div class="panel-header">

        <div class="d-flex justify-content-between align-items-center">

            <h5>

                <i class="bi bi-cash-stack me-2"></i>

                Riwayat Withdrawal

            </h5>

            <a
                href="<?= site_url('user/withdrawal/create'); ?>"
                class="btn btn-success">

                <i class="bi bi-plus-lg"></i>

                Ajukan Withdrawal

            </a>

        </div>

    </div>

    <div class="panel-body">

        <?php if (!empty($withdrawals)): ?>

            <div class="table-responsive">

                <table class="table withdrawal-table align-middle">

                    <thead>

                        <tr>

                            <th>Kode</th>

                            <th class="text-center">

                                Point

                            </th>

                            <th class="text-center">

                                Status

                            </th>

                            <th class="text-center">

                                Tanggal

                            </th>

                            <th class="text-center" width="120">

                                Aksi

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($withdrawals as $withdrawal): ?>

                            <tr>

                                <td>

                                    <strong>

                                        <?= esc($withdrawal['withdrawal_code']); ?>

                                    </strong>

                                </td>

                                <td class="text-center">

                                    <?= number_format($withdrawal['amount'],0,',','.'); ?>

                                </td>

                                <td class="text-center">

                                    <?php if ($withdrawal['status'] === 'pending'): ?>

                                        <span class="status-badge pending">

                                            Pending

                                        </span>

                                    <?php elseif ($withdrawal['status'] === 'processing'): ?>

                                        <span class="status-badge processing">

                                            Processing

                                        </span>

                                    <?php elseif ($withdrawal['status'] === 'completed'): ?>

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

                                    <?= date('d M Y', strtotime($withdrawal['created_at'])); ?>

                                </td>

                                <td class="text-center">

                                    <a
                                        href="<?= site_url('user/withdrawal/'.$withdrawal['id']); ?>"
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

            <?= $this->include('user/components/empty-state', [

                'title' => 'Belum Ada Withdrawal',

                'description' => 'Anda belum pernah mengajukan withdrawal.',

                'button' => [

                    'url' => site_url('user/withdrawal/create'),

                    'text' => 'Ajukan Withdrawal'

                ]

            ]) ?>

        <?php endif; ?>

    </div>

</div>