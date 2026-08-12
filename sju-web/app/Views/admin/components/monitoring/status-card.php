<div class="card">

    <div class="card-header">

        <h5 class="card-title">

            Status Machine

        </h5>

    </div>

    <div class="card-body">

        <div class="row g-4">

            <div class="col-md-4">

                <div class="border rounded p-3 h-100">

                    <small class="text-muted">

                        Machine Code

                    </small>

                    <h5 class="mt-2 mb-0">

                        <?= esc($machine['machine_code']); ?>

                    </h5>

                </div>

            </div>

            <div class="col-md-4">

                <div class="border rounded p-3 h-100">

                    <small class="text-muted">

                        Machine Name

                    </small>

                    <h5 class="mt-2 mb-0">

                        <?= esc($machine['machine_name']); ?>

                    </h5>

                </div>

            </div>

            <div class="col-md-4">

                <div class="border rounded p-3 h-100">

                    <small class="text-muted">

                        Status

                    </small>

                    <h5 class="mt-2 mb-0">

                        <?php if ($machine['realtime_status'] == 'online'): ?>

                            <span class="badge-custom badge-success">

                                Online

                            </span>

                        <?php elseif ($machine['realtime_status'] == 'maintenance'): ?>

                            <span class="badge-custom badge-warning">

                                Maintenance

                            </span>

                        <?php else: ?>

                            <span class="badge-custom badge-danger">

                                Offline

                            </span>

                        <?php endif; ?>

                    </h5>

                </div>

            </div>

        </div>

        <hr>

        <div class="row">

            <div class="col-md-6">

                <strong>Lokasi</strong>

                <br>

                <?= esc($machine['location']); ?>

            </div>

            <div class="col-md-3">

                <strong>Firmware</strong>

                <br>

                <?= esc($machine['firmware_version'] ?: '-'); ?>

            </div>

            <div class="col-md-3">

                <strong>IP Address</strong>

                <br>

                <?= esc($machine['ip_address'] ?: '-'); ?>

            </div>

        </div>

        <hr>

        <strong>Last Online</strong>

        <br>

        <?= !empty($machine['last_online'])
            ? date('d M Y H:i:s', strtotime($machine['last_online']))
            : '-'; ?>

    </div>

</div>