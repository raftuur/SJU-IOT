<div class="dashboard-panel">

    <div class="panel-header">

        <h5>

            <i class="bi bi-ticket-perforated me-2"></i>

            Daftar Redemption

        </h5>

    </div>

    <div class="panel-body">

        <form method="get" action="<?= site_url('redemption'); ?>" class="mb-3">

            <div class="input-group">

                <input
                    type="text"
                    name="keyword"
                    class="form-control"
                    placeholder="Cari kode redemption, user, atau voucher..."
                    value="<?= esc($keyword ?? '') ?>">

                <button class="btn btn-primary" type="submit">

                    <i class="bi bi-search"></i>

                    Cari

                </button>

                <?php if (!empty($keyword)): ?>

                    <a href="<?= site_url('redemption'); ?>"
                       class="btn btn-outline-secondary">

                        Reset

                    </a>

                <?php endif; ?>

            </div>

        </form>

        <?php if (!empty($redemptions)): ?>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th>User</th>

                            <th>Voucher</th>

                            <th class="text-center">Point</th>

                            <th class="text-center">Status</th>

                            <th class="text-center">Tanggal</th>

                            <th width="120" class="text-center">

                                Aksi

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($redemptions as $redemption): ?>

                            <tr>

                                <td>

                                    <strong>

                                        <?= esc($redemption['fullname']) ?>

                                    </strong>

                                    <br>

                                    <small class="text-muted">

                                        <?= esc($redemption['email']) ?>

                                    </small>

                                </td>

                                <td>

                                    <?= esc($redemption['voucher_title']) ?>

                                </td>

                                <td class="text-center">

                                    <?= number_format($redemption['point'], 0, ',', '.') ?>

                                </td>

                                <td class="text-center">

                                    <span class="badge bg-secondary">

                                        <?= ucfirst($redemption['status']) ?>

                                    </span>

                                </td>

                                <td class="text-center">

                                    <?= date('d M Y H:i', strtotime($redemption['created_at'])) ?>

                                </td>

                                <td class="text-center">

                                    <a href="<?= site_url('redemption/' . $redemption['id']) ?>"
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

                'title' => 'Belum Ada Redemption',

                'description' => 'Belum ada pengguna yang menukarkan voucher.'

            ]) ?>

        <?php endif; ?>

    </div>

</div>