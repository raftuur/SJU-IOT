<div class="dashboard-panel">

    <div class="panel-header">

        <h5>
            <i class="bi bi-cpu me-2"></i>
            Status Mesin
        </h5>

    </div>

    <div class="panel-body">

        <?php if (!empty($machines)): ?>

            <?php foreach ($machines as $machine): ?>

                <div class="machine-status mb-3">

                    <div class="machine-item">

                        <div>

                            <div class="machine-name">
                                <?= esc($machine['machine_code']); ?>
                            </div>

                            <div class="machine-info">
                                <?= esc($machine['machine_name']); ?>
                            </div>

                        </div>

                        <?php if ($machine['status'] === 'online'): ?>

                            <span class="badge bg-success">
                                Online
                            </span>

                        <?php elseif ($machine['status'] === 'maintenance'): ?>

                            <span class="badge bg-warning text-dark">
                                Maintenance
                            </span>

                        <?php else: ?>

                            <span class="badge bg-danger">
                                Offline
                            </span>

                        <?php endif; ?>

                    </div>

                    <div class="machine-detail">

                        <div>

                            <small>
                                Lokasi
                            </small>

                            <strong>
                                <?= esc($machine['location']); ?>
                            </strong>

                        </div>

                        <div>

                            <small>
                                IP Address
                            </small>

                            <strong>
                                <?= esc($machine['ip_address'] ?? '-'); ?>
                            </strong>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="text-center text-muted py-4">

                <i class="bi bi-cpu fs-2"></i>

                <p class="mt-2 mb-0">
                    Belum ada machine.
                </p>

            </div>

        <?php endif; ?>

    </div>

</div>