<div class="dashboard-panel">

    <div class="panel-header d-flex justify-content-between align-items-center">

        <h5>

            <i class="bi bi-wallet2 me-2"></i>

            Daftar Wallet Pengguna

        </h5>

    </div>

    <div class="panel-body">

        <?php if (!empty($wallets)): ?>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th>Nama</th>

                            <th>Email</th>

                            <th class="text-center">Saldo</th>

                            <th class="text-center">Point Masuk</th>

                            <th class="text-center">Point Ditukar</th>

                            <th width="120" class="text-center">

                                Aksi

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($wallets as $wallet): ?>

                            <tr>

                                <td>

                                    <strong>

                                        <?= esc($wallet['fullname']) ?>

                                    </strong>

                                </td>

                                <td>

                                    <?= esc($wallet['email']) ?>

                                </td>

                                <td class="text-center">

                                    <?= number_format($wallet['balance'], 0, ',', '.') ?>

                                </td>

                                <td class="text-center">

                                    <?= number_format($wallet['total_earned'], 0, ',', '.') ?>

                                </td>

                                <td class="text-center">

                                    <?= number_format($wallet['total_redeemed'], 0, ',', '.') ?>

                                </td>

                                <td class="text-center">

                                    <a href="<?= site_url('wallet/'.$wallet['id']) ?>"
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

                'title' => 'Belum Ada Wallet',

                'description' => 'Belum ada wallet yang terdaftar.'

            ]) ?>

        <?php endif; ?>

    </div>

</div>