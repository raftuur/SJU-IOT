<div class="dashboard-panel">

    <div class="panel-header">

        <h5>

            <i class="bi bi-cpu me-2"></i>

            Informasi Machine

        </h5>

    </div>

    <div class="panel-body">

        <div class="row g-4">

            <div class="col-md-6">

                <label class="text-muted small">

                    Nama Machine

                </label>

                <h5>

                    <?= esc($machine['machine_name']); ?>

                </h5>

            </div>

            <div class="col-md-6">

                <label class="text-muted small">

                    Kode Machine

                </label>

                <h5>

                    <?= esc($machine['machine_code']); ?>

                </h5>

            </div>

            <div class="col-12">

                <label class="text-muted small">

                    Lokasi

                </label>

                <h6>

                    <i class="bi bi-geo-alt-fill text-danger me-2"></i>

                    <?= esc($machine['location']); ?>

                </h6>

            </div>

            <div class="col-md-6">

                <label class="text-muted small">

                    Status

                </label>

                <div>

                    <?php if ($machine['status'] == 'online'): ?>

                        <span class="badge bg-success">

                            <i class="bi bi-check-circle-fill me-1"></i>

                            Online

                        </span>

                    <?php elseif ($machine['status'] == 'maintenance'): ?>

                        <span class="badge bg-warning text-dark">

                            <i class="bi bi-tools me-1"></i>

                            Maintenance

                        </span>

                    <?php else: ?>

                        <span class="badge bg-danger">

                            <i class="bi bi-x-circle-fill me-1"></i>

                            Offline

                        </span>

                    <?php endif; ?>

                </div>

            </div>

            <div class="col-md-6">

                <label class="text-muted small">

                    Online Terakhir

                </label>

                <h6>

                    <?= $machine['last_online']
                        ? date('d F Y H:i', strtotime($machine['last_online']))
                        : '-'; ?>

                </h6>

            </div>

            <?php if (!empty($machine['latitude']) && !empty($machine['longitude'])): ?>

                <div class="col-12">

                    <a href="https://www.google.com/maps?q=<?= $machine['latitude']; ?>,<?= $machine['longitude']; ?>"
                       target="_blank"
                       class="btn btn-outline-primary">

                        <i class="bi bi-geo-alt-fill me-2"></i>

                        Buka di Google Maps

                    </a>

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>