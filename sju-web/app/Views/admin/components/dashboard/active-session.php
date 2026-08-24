<div class="dashboard-panel">

    <div class="panel-header">

        <h5>
            <i class="bi bi-person-workspace me-2"></i>
            Session Mesin Aktif
        </h5>

    </div>

    <div class="panel-body">

        <?php if (!empty($activeSession)): ?>

            <div class="session-box">

                <div class="session-header">

                    <div>

                        <h6>
                            <?= esc($activeSession['machine_code']); ?>
                        </h6>

                        <span>
                            <?= esc($activeSession['machine_name']); ?>
                        </span>

                    </div>

                    <span class="badge bg-success">
                        Active
                    </span>

                </div>

                <div class="session-detail">

                    <div>

                        <small>
                            User
                        </small>

                        <strong>
                            <?= esc($activeSession['fullname'] ?? 'Tidak diketahui'); ?>
                        </strong>

                    </div>

                    <div>

                        <small>
                            Waktu Mulai
                        </small>

                        <strong>
                            <?= !empty($activeSession['started_at'])
                                ? date('d/m/Y H:i', strtotime($activeSession['started_at']))
                                : '-'; ?>
                        </strong>

                    </div>

                </div>

            </div>

        <?php else: ?>

            <div class="text-center text-muted py-4">

                <i class="bi bi-person-workspace fs-2"></i>

                <p class="mt-2 mb-0">
                    Belum ada session mesin aktif.
                </p>

            </div>

        <?php endif; ?>

    </div>

</div>