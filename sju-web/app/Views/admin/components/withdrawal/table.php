<div class="dashboard-panel">

    <div class="panel-header">

        <h5>

            <i class="bi bi-cash-stack me-2"></i>

            Daftar Withdrawal

        </h5>

    </div>

    <div class="panel-body">

        <form method="get" action="<?= site_url('withdrawal'); ?>" class="mb-3">

            <div class="input-group">

                <input
                    type="text"
                    name="keyword"
                    class="form-control"
                    placeholder="Cari kode withdrawal atau user..."
                    value="<?= esc($keyword ?? '') ?>">

                <button class="btn btn-primary" type="submit">

                    <i class="bi bi-search"></i>

                    Cari

                </button>

                <?php if (!empty($keyword)): ?>

                    <a href="<?= site_url('withdrawal'); ?>"
                       class="btn btn-outline-secondary">

                        Reset

                    </a>

                <?php endif; ?>

            </div>

        </form>

        <?php if (!empty($withdrawals)): ?>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th>User</th>

                            <th>Nominal</th>

                            <th>Bank</th>

                            <th class="text-center">Status</th>

                            <th class="text-center">Tanggal</th>

                            <th width="120" class="text-center">

                                Aksi

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($withdrawals as $withdrawal): ?>

                            <tr>

                                <td>

                                    <strong>

                                        <?= esc($withdrawal['fullname']) ?>

                                    </strong>

                                    <br>

                                    <small class="text-muted">

                                        <?= esc($withdrawal['email']) ?>

                                    </small>

                                </td>

                                <td>

                                    Rp <?= number_format($withdrawal['amount'], 0, ',', '.') ?>

                                </td>

                                <td>

                                    <?= esc($withdrawal['bank_code']) ?>

                                </td>

                                <td class="text-center">

                                    <span class="badge bg-secondary">

                                        <?= ucfirst($withdrawal['status']) ?>

                                    </span>

                                </td>

                                <td class="text-center">

                                    <?= date('d M Y H:i', strtotime($withdrawal['created_at'])) ?>

                                </td>

                                <td class="text-center">

                                    <a href="<?= site_url('withdrawal/' . $withdrawal['id']) ?>"
                                       class="btn btn-sm btn-primary">

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

            <?= $this->include('admin/components/empty-state', [

                'title' => 'Belum Ada Withdrawal',

                'description' => 'Belum ada permintaan pencairan saldo.'

            ]) ?>

        <?php endif; ?>

    </div>

</div>