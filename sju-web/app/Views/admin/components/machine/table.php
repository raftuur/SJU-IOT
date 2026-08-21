<div class="card">

    <div class="card-header">

        <h5 class="card-title">

            Daftar Machine

        </h5>

        <span class="badge-custom badge-success">

            Total : <?= $totalMachines; ?> Machine

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
                        Nama Machine
                    </th>

                    <th width="25%">
                        Lokasi
                    </th>

                    <th width="140">
                        Status
                    </th>

                    <th width="170">
                        Last Online
                    </th>

                    <th width="170" class="text-center">
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

                                <?php if ($machine['realtime_status'] === 'online'): ?>

                                    <span class="badge-custom badge-success">

                                        Online

                                    </span>

                                <?php elseif ($machine['realtime_status'] === 'maintenance'): ?>

                                    <span class="badge-custom badge-warning">

                                        Maintenance

                                    </span>

                                <?php else: ?>

                                    <span class="badge-custom badge-danger">

                                        Offline

                                    </span>

                                <?php endif; ?>

                            </td>

                            <td>

                                <?= $machine['last_online']
                                    ? date('d M Y H:i', strtotime($machine['last_online']))
                                    : '-'; ?>

                            </td>

                            <td class="text-center">

                                <div class="table-action">

                                    <a href="<?= site_url('machine/' . $machine['id']); ?>"
                                       class="btn-custom btn-info-custom btn-icon"
                                       title="Detail">

                                        <i class="bi bi-eye"></i>

                                    </a>

                                    <a href="<?= site_url('machine/edit/' . $machine['id']); ?>"
                                       class="btn-custom btn-warning-custom btn-icon"
                                       title="Edit">

                                        <i class="bi bi-pencil"></i>

                                    </a>

                                    <button
                                        type="button"
                                        class="btn-custom btn-danger-custom btn-icon"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal<?= $machine['id']; ?>"
                                        title="Hapus">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="6">

                            <?= view('admin/components/empty-state', [

                                'title' => 'Belum Ada Machine',

                                'description' => 'Belum ada mesin yang terdaftar.',

                                'buttonText' => 'Tambah Machine',

                                'buttonUrl' => site_url('machine/create')

                            ]); ?>

                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

    <?php if (!empty($machines)): ?>

        <div class="table-footer">

            <div class="ms-auto">

                <?= $pager->links(); ?>

            </div>

        </div>

    <?php endif; ?>

</div>

<!-- Modal Delete ditempatkan di luar card atau di luar table -->
<?php if (!empty($machines)): ?>

    <?php foreach ($machines as $machine): ?>

        <div class="modal fade"
             id="deleteModal<?= $machine['id']; ?>"
             tabindex="-1">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title">

                            Hapus Machine

                        </h5>

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body">

                        <p>

                            Apakah Anda yakin ingin menghapus machine
                            <strong><?= esc($machine['machine_name']); ?></strong>?

                        </p>

                        <p class="text-danger mb-0">

                            Data yang dihapus tidak dapat dikembalikan.

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
                            action="<?= site_url('machine/delete/' . $machine['id']); ?>"
                            method="post">

                            <?= csrf_field(); ?>

                            <button
                                type="submit"
                                class="btn-custom btn-danger-custom">

                                Ya, Hapus

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    <?php endforeach; ?>

<?php endif; ?>