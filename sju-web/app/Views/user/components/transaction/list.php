<div class="card">

    <div class="card-header">

        <h5 class="card-title">

            Riwayat Transaction

        </h5>

        <span class="badge-custom badge-success">

            Total : <?= count($transactions); ?> Transaction

        </span>

    </div>

    <div class="table-responsive">

        <table class="custom-table">

            <thead>

                <tr>

                    <th width="18%">
                        Kode
                    </th>

                    <th>
                        Machine
                    </th>

                    <th width="90">
                        Botol
                    </th>

                    <th width="110">
                        Berat
                    </th>

                    <th width="110">
                        Point
                    </th>

                    <th width="120">
                        Status
                    </th>

                    <th width="170">
                        Tanggal
                    </th>

                    <th width="120" class="text-center">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                <?php if (!empty($transactions)): ?>

                    <?php foreach ($transactions as $transaction): ?>

                        <tr>

                            <td>

                                <strong>

                                    <?= esc($transaction['transaction_code']); ?>

                                </strong>

                            </td>

                            <td>

                                <strong>

                                    <?= esc($transaction['machine_name']); ?>

                                </strong>

                                <br>

                                <small class="text-muted">

                                    <?= esc($transaction['location']); ?>

                                </small>

                            </td>

                            <td>

                                <?= esc($transaction['bottle_count']); ?>

                                Botol

                            </td>

                            <td>

                                <?= esc($transaction['weight']); ?> Kg

                            </td>

                            <td>

                                <span class="text-success fw-bold">

                                    +<?= esc($transaction['point_earned']); ?>

                                </span>

                            </td>

                            <td>

                                <?php if ($transaction['status'] == 'success'): ?>

                                    <span class="badge-custom badge-success">

                                        Success

                                    </span>

                                <?php elseif ($transaction['status'] == 'failed'): ?>

                                    <span class="badge-custom badge-danger">

                                        Failed

                                    </span>

                                <?php else: ?>

                                    <span class="badge-custom badge-warning">

                                        <?= ucfirst($transaction['status']); ?>

                                    </span>

                                <?php endif; ?>

                            </td>

                            <td>

                                <?= date('d M Y H:i', strtotime($transaction['created_at'])); ?>

                            </td>

                            <td class="text-center">

                                <div class="table-action">

                                    <a href="<?= site_url('user/transaction/'.$transaction['id']); ?>"
                                       class="btn-custom btn-info-custom btn-icon"
                                       title="Detail">

                                        <i class="bi bi-eye"></i>

                                    </a>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="8">

                            <?= view('admin/components/empty-state', [

                                'title' => 'Belum Ada Transaction',

                                'description' => 'Belum ada transaksi Reverse Vending Machine.',

                                'buttonText' => 'Gunakan Machine',

                                'buttonUrl' => site_url('user/machine')

                            ]); ?>

                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>