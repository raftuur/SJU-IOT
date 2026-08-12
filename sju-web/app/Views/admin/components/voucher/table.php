<div class="dashboard-panel">

    <div class="panel-header d-flex justify-content-between align-items-center">

        <h5>

            <i class="bi bi-gift me-2"></i>

            Daftar Voucher

        </h5>

        <a href="<?= site_url('voucher/create'); ?>" class="btn btn-success">

            <i class="bi bi-plus-lg"></i>

            Tambah Voucher

        </a>

    </div>

    <div class="panel-body">

        <?php if (!empty($vouchers)): ?>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th>Voucher</th>

                            <th class="text-center">Point</th>

                            <th class="text-center">Stok</th>

                            <th class="text-center">Redeem</th>

                            <th class="text-center">Status</th>

                            <th width="120" class="text-center">

                                Aksi

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($vouchers as $voucher): ?>

                            <tr>

                                <td>

                                    <strong>

                                        <?= esc($voucher['title']) ?>

                                    </strong>

                                    <br>

                                    <small class="text-muted">

                                        <?= esc($voucher['code']) ?>

                                    </small>

                                </td>

                                <td class="text-center">

                                    <?= number_format($voucher['point'], 0, ',', '.') ?>

                                </td>

                                <td class="text-center">

                                    <?= $voucher['stock'] ?>

                                </td>

                                <td class="text-center">

                                    <?= $voucher['redeemed'] ?>

                                </td>

                                <td class="text-center">

                                    <?php if ($voucher['status'] === 'active'): ?>

                                        <span class="badge bg-success">

                                            Aktif

                                        </span>

                                    <?php else: ?>

                                        <span class="badge bg-danger">

                                            Nonaktif

                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td class="text-center">

                                    <div class="d-flex justify-content-center gap-2">

                                        <a
                                            href="<?= site_url('voucher/'.$voucher['id']) ?>"
                                            class="btn btn-sm btn-primary">

                                            <i class="bi bi-eye"></i>

                                            Detail

                                        </a>

                                        <a
                                            href="<?= site_url('voucher/edit/'.$voucher['id']) ?>"
                                            class="btn btn-sm btn-warning">

                                            <i class="bi bi-pencil-square"></i>

                                            Edit

                                        </a>

                                        <form
                                            action="<?= site_url('voucher/delete/'.$voucher['id']) ?>"
                                            method="post"
                                            onsubmit="return confirm('Yakin ingin menghapus voucher ini?');">

                                            <?= csrf_field(); ?>

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-danger">

                                                <i class="bi bi-trash"></i>

                                                Hapus

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        <?php else: ?>

            <?= $this->include('admin/components/empty-state', [

                'title' => 'Belum Ada Voucher',

                'description' => 'Belum ada voucher yang tersedia.'

            ]) ?>

        <?php endif; ?>

    </div>

</div>