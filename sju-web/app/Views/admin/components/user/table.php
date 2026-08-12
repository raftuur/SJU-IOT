<div class="card">

    <div class="card-header">

        <h5 class="card-title">
            Daftar User
        </h5>

        <span class="badge-custom badge-success">
            Total : <?= count($users); ?> User
        </span>

    </div>

    <div class="table-responsive">

        <table class="custom-table">

            <thead>

                <tr>

                    <th width="45%">
                        User
                    </th>

                    <th width="140">
                        Role
                    </th>

                    <th width="140">
                        Status
                    </th>

                    <th width="160">
                        Terdaftar
                    </th>

                    <th width="170" class="text-center">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                <?php if (!empty($users)): ?>

                    <?php foreach ($users as $user): ?>

                        <tr>

                            <td>

                                <div class="user-info">

                                    <div class="user-avatar">

                                        <?= strtoupper(substr($user['fullname'], 0, 1)); ?>

                                    </div>

                                    <div>

                                        <div class="user-name">

                                            <?= esc($user['fullname']); ?>

                                        </div>

                                        <div class="user-email">

                                            <?= esc($user['email']); ?>

                                        </div>

                                    </div>

                                </div>

                            </td>

                            <td>

                                <span class="badge-custom badge-primary">

                                    <?= ucfirst($user['role']); ?>

                                </span>

                            </td>

                            <td>

                                <?php if ($user['status'] === 'active'): ?>

                                    <span class="badge-custom badge-success">

                                        Active

                                    </span>

                                <?php else: ?>

                                    <span class="badge-custom badge-danger">

                                        Inactive

                                    </span>

                                <?php endif; ?>

                            </td>

                            <td class="text-nowrap">

                                <?= date('d M Y', strtotime($user['created_at'])); ?>

                            </td>

                            <td class="text-center">

                                <div class="table-action">

                                    <a href="<?= site_url('user/' . $user['id']); ?>"
                                       class="btn-custom btn-info-custom btn-icon"
                                       title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="<?= site_url('user/edit/' . $user['id']); ?>"
                                       class="btn-custom btn-warning-custom btn-icon"
                                       title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <?php if ($user['id'] != 1): ?>

                                        <button
                                            type="button"
                                            class="btn-custom btn-danger-custom btn-icon"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal<?= $user['id']; ?>"
                                            title="Hapus">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    <?php endif; ?>

                                </div>

                            </td>

                        </tr>

                        <?php if ($user['id'] != 1): ?>

                        <div class="modal fade"
                             id="deleteModal<?= $user['id']; ?>"
                             tabindex="-1">

                            <div class="modal-dialog">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title">

                                            Hapus User

                                        </h5>

                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal">
                                        </button>

                                    </div>

                                    <div class="modal-body">

                                        <p>

                                            Apakah Anda yakin ingin menghapus user
                                            <strong><?= esc($user['fullname']); ?></strong>?

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
                                            action="<?= site_url('user/delete/' . $user['id']); ?>"
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

                        <?php endif; ?>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="5">

                            <?= view('admin/components/empty-state', [

                                'title' => 'Belum Ada User',

                                'description' => 'Belum ada data pengguna yang terdaftar.',

                                'buttonText' => 'Tambah User',

                                'buttonUrl' => site_url('user/create')

                            ]); ?>

                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

    <div class="table-footer">

        <div class="ms-auto">

            <?= $pager->links(); ?>

        </div>

    </div>

</div>