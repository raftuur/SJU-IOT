<div class="card">

    <div class="card-header">

        <h5 class="card-title">

            Trash Machine

        </h5>

        <span class="badge-custom badge-danger">

            Total : <?= count($machines); ?> Machine

        </span>

    </div>

    <div class="table-responsive">

        <table class="custom-table">

            <thead>

                <tr>

                    <th>Kode</th>

                    <th>Nama Machine</th>

                    <th>Lokasi</th>

                    <th>Status</th>

                    <th>Dihapus Pada</th>

                    <th class="text-center" width="140">

                        Aksi

                    </th>

                </tr>

            </thead>

            <tbody>

                <?php if (!empty($machines)): ?>

                    <?php foreach ($machines as $machine): ?>

                        <tr>

                            <td>

                                <strong>

                                    <?= esc($machine['machine_code']); ?>

                                </strong>

                            </td>

                            <td>

                                <?= esc($machine['machine_name']); ?>

                            </td>

                            <td>

                                <?= esc($machine['location']); ?>

                            </td>

                            <td>

                                <span class="badge-custom badge-danger">

                                    Dihapus

                                </span>

                            </td>

                            <td>

                                <?= date('d M Y H:i', strtotime($machine['deleted_at'])); ?>

                            </td>

                            <td>

                                <div class="table-action d-flex justify-content-center gap-2">

                                    <!-- Tombol Restore -->
                                    <form
                                        action="<?= site_url('machine/restore/' . $machine['id']); ?>"
                                        method="post">

                                        <?= csrf_field(); ?>

                                        <button
                                            type="submit"
                                            class="btn-custom btn-success-custom btn-icon"
                                            title="Restore">

                                            <i class="bi bi-arrow-counterclockwise"></i>

                                        </button>

                                    </form>

                                    <!-- Tombol Hapus Permanen -->
                                    <button
                                        type="button"
                                        class="btn-custom btn-danger-custom btn-icon"
                                        data-bs-toggle="modal"
                                        data-bs-target="#forceDeleteModal<?= $machine['id']; ?>"
                                        title="Hapus Permanen">

                                        <i class="bi bi-trash3-fill"></i>

                                    </button>

                                </div>

                            </td>

                        </tr>

                        <!-- Modal Konfirmasi Hapus Permanen -->
                        <div class="modal fade"
                             id="forceDeleteModal<?= $machine['id']; ?>"
                             tabindex="-1">

                            <div class="modal-dialog">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title">

                                            Hapus Permanen Machine

                                        </h5>

                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal">
                                        </button>

                                    </div>

                                    <div class="modal-body">

                                        <p>

                                            Apakah Anda yakin ingin menghapus permanen machine
                                            <strong><?= esc($machine['machine_name']); ?></strong>?

                                        </p>

                                        <p class="text-danger mb-0">

                                            <i class="bi bi-exclamation-triangle-fill"></i>

                                            Data ini akan hilang selamanya dan tidak dapat dikembalikan.

                                        </p>

                                    </div>

                                    <div class="modal-footer">

                                        <button
                                            type="button"
                                            class="btn-custom btn-outline-custom"
                                            data-bs-dismiss="modal">

                                            Batal

                                        </button>

                                        <form
                                            action="<?= site_url('machine/force-delete/' . $machine['id']); ?>"
                                            method="post">

                                            <?= csrf_field(); ?>

                                            <button
                                                type="submit"
                                                class="btn-custom btn-danger-custom">

                                                <i class="bi bi-trash"></i>

                                                Ya, Hapus Permanen

                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="6">

                            <?= view('admin/components/empty-state', [

                                'title' => 'Trash Kosong',

                                'description' => 'Belum ada machine yang dihapus.',

                                'buttonText' => 'Kembali',

                                'buttonUrl' => site_url('machine')

                            ]); ?>

                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>