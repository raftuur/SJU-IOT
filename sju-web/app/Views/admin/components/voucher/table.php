<div class="dashboard-panel">

    <div class="panel-header d-flex justify-content-between align-items-center">

        <h5>
            <i class="bi bi-gift me-2"></i>
            Daftar Voucher
        </h5>

        <a href="<?= site_url('voucher/create'); ?>"
           class="btn btn-success">

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

                            <th width="60">
                                No
                            </th>

                            <th>
                                Voucher
                            </th>

                            <th class="text-center">
                                Point
                            </th>

                            <th class="text-center">
                                Stok
                            </th>

                            <th class="text-center">
                                Redeem
                            </th>

                            <th class="text-center">
                                Status
                            </th>

                            <th width="120" class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($vouchers as $index => $voucher): ?>

                            <tr>

                                <!-- NO -->

                                <td>

                                    <?= $index + 1 ?>

                                </td>


                                <!-- VOUCHER -->

                                <td>

                                    <div class="voucher-info">

                                        <?php if (!empty($voucher['image'])): ?>

                                            <img
                                                src="<?= base_url('uploads/vouchers/' . $voucher['image']); ?>"
                                                alt="<?= esc($voucher['title']); ?>"
                                                class="voucher-image">

                                        <?php else: ?>

                                            <div class="voucher-image voucher-image-empty">

                                                <i class="bi bi-gift"></i>

                                            </div>

                                        <?php endif; ?>


                                        <div class="voucher-content">

                                            <strong>

                                                <?= esc($voucher['title']) ?>

                                            </strong>

                                            <small>

                                                Kode:
                                                <?= esc($voucher['code']) ?>

                                            </small>

                                        </div>

                                    </div>

                                </td>


                                <!-- POINT -->

                                <td class="text-center">

                                    <?= number_format(
                                        $voucher['point'],
                                        0,
                                        ',',
                                        '.'
                                    ) ?>

                                </td>


                                <!-- STOK -->

                                <td class="text-center">

                                    <?= $voucher['stock'] ?>

                                </td>


                                <!-- REDEEM -->

                                <td class="text-center">

                                    <?= $voucher['redeemed'] ?>

                                </td>


                                <!-- STATUS -->

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


                                <!-- AKSI -->

                                <td class="text-center">

                                    <div class="d-flex justify-content-center gap-2">

                                        <a
                                            href="<?= site_url('voucher/' . $voucher['id']) ?>"
                                            class="btn btn-sm btn-primary"
                                            title="Detail">

                                            <i class="bi bi-eye"></i>

                                        </a>


                                        <a
                                            href="<?= site_url('voucher/edit/' . $voucher['id']) ?>"
                                            class="btn btn-sm btn-warning"
                                            title="Edit">

                                            <i class="bi bi-pencil-square"></i>

                                        </a>


                                        <form
                                            action="<?= site_url('voucher/delete/' . $voucher['id']) ?>"
                                            method="post"
                                            onsubmit="return confirm('Yakin ingin menghapus voucher ini?');">

                                            <?= csrf_field(); ?>

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-danger"
                                                title="Hapus">

                                                <i class="bi bi-trash"></i>

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