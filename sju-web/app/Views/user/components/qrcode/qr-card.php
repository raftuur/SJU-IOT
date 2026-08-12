<div class="dashboard-panel">

    <div class="panel-header">

        <h5>

            <i class="bi bi-qr-code me-2"></i>

            QR Code Pengguna

        </h5>

    </div>

    <div class="panel-body">

        <div class="row align-items-center">

            <div class="col-lg-5 text-center">

                <div class="border rounded-4 p-4 bg-light">

                    <img
                        src="<?= esc($qrCode) ?>"
                        alt="QR Code"
                        class="img-fluid">

                    <p class="mt-3 text-muted mb-0">

                        Scan QR Code ini pada mesin Reverse Vending Machine.

                    </p>

                </div>

            </div>

            <div class="col-lg-7">

                <table class="table table-borderless mb-0">

                    <tr>

                        <th width="160">Nama</th>

                        <td><?= esc($user['fullname']) ?></td>

                    </tr>

                    <tr>

                        <th>Email</th>

                        <td><?= esc($user['email']) ?></td>

                    </tr>

                    <tr>

                        <th>Username</th>

                        <td><?= esc($user['username']) ?></td>

                    </tr>

                    <tr>

                        <th>UUID</th>

                        <td>

                            <code>

                                <?= esc($user['uuid']) ?>

                            </code>

                        </td>

                    </tr>

                    <tr>

                        <th>Status</th>

                        <td>

                            <span class="badge bg-success">

                                Aktif

                            </span>

                        </td>

                    </tr>

                </table>

                <hr>

                <div class="d-flex gap-2">

                    <button
                        class="btn btn-success"
                        disabled>

                        <i class="bi bi-download me-2"></i>

                        Download QR

                    </button>

                    <button
                        class="btn btn-outline-success"
                        disabled>

                        <i class="bi bi-arrow-clockwise me-2"></i>

                        Refresh QR

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>